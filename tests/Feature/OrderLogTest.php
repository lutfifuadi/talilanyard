<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Accessory;
use App\Models\Setting;
use App\Models\OrderLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderLogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Setting::setValue('brand_name', 'AzagiPrint');
        Setting::setValue('whatsapp_number', '6282113328585');
    }

    public function test_order_log_can_be_stored_and_returns_wa_redirect_url()
    {
        $product = Product::create([
            'name' => 'Tisue Lanyard',
            'slug' => 'tisue-lanyard',
            'is_active' => true,
        ]);

        $accessory1 = Accessory::create([
            'code' => 'stopper',
            'name' => 'Stopper',
            'price' => 500,
            'is_active' => true,
        ]);

        $accessory2 = Accessory::create([
            'code' => 'holder',
            'name' => 'Holder',
            'price' => 1000,
            'is_active' => true,
        ]);

        $response = $this->postJson(route('admin.order-logs.store'), [
            'product_id' => $product->id,
            'quantity' => 100,
            'lebar' => '2.0',
            'accessories' => [$accessory1->id, $accessory2->id],
            'base_price' => 10000,
            'accessory_price' => 1500,
            'total_price' => 1150000,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['success', 'message', 'redirect_url']);

        $data = $response->json();
        $this->assertTrue($data['success']);
        $this->assertStringContainsString('6282113328585', $data['redirect_url']);
        $this->assertStringContainsString('Tisue Lanyard', urldecode($data['redirect_url']));

        $this->assertDatabaseHas('order_logs', [
            'product_id' => $product->id,
            'quantity' => 100,
            'base_price' => 10000,
            'accessory_price' => 1500,
            'total_price' => 1150000,
        ]);

        $orderLog = OrderLog::first();
        $this->assertCount(2, $orderLog->accessories);
    }
}
