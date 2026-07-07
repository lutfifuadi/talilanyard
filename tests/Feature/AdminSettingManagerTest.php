<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Setting;
use Livewire\Livewire;
use App\Livewire\Admin\SettingManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSettingManagerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed default settings first
        $settings = [
            'whatsapp_number' => '6282113328585',
            'address' => 'Jl. Percetakan Raya No. 45, Jakarta',
            'instagram_url' => 'https://instagram.com/cetaktalilanyard',
            'facebook_url' => 'https://facebook.com/cetaktalilanyard',
            'tiktok_url' => 'https://tiktok.com/@cetaktalilanyard',
            'email' => 'info@cetaktalilanyard.com',
            'brand_name' => 'AzagiPrint',
            'logo_text' => 'AzagiPrint Lanyard',
            'operating_hours' => 'Senin - Sabtu: 08.00 - 17.00 WIB',
            'hero_title' => 'Cetak Tali Lanyard',
            'hero_subtitle' => 'Berkualitas #1 di Jakarta',
            'meta_description' => 'AzagiPrint Lanyard berkualitas.',
            'trust_customer' => '1200',
            'trust_product' => '272',
            'trust_completed' => '566',
            'calculator_moq' => '40',
            'calculator_width_options' => '[{"width":"1.5","extra_price":0},{"width":"2.0","extra_price":500}]',
        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
    }

    public function test_setting_manager_loads_current_values(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin);

        Livewire::test(SettingManager::class)
            ->assertSet('whatsapp_number', '6282113328585')
            ->assertSet('address', 'Jl. Percetakan Raya No. 45, Jakarta')
            ->assertSet('brand_name', 'AzagiPrint')
            ->assertSet('logo_text', 'AzagiPrint Lanyard')
            ->assertSet('operating_hours', 'Senin - Sabtu: 08.00 - 17.00 WIB')
            ->assertSet('hero_title', 'Cetak Tali Lanyard')
            ->assertSet('hero_subtitle', 'Berkualitas #1 di Jakarta')
            ->assertSet('meta_description', 'AzagiPrint Lanyard berkualitas.')
            ->assertSet('trust_customer', '1200')
            ->assertSet('trust_product', '272')
            ->assertSet('trust_completed', '566')
            ->assertSet('calculator_moq', '40')
            ->assertSet('calculator_width_options', [
                ['width' => '1.5', 'extra_price' => 0],
                ['width' => '2.0', 'extra_price' => 500],
            ]);
    }

    public function test_admin_settings_page_renders_livewire_component(): void
    {
        $admin = User::factory()->create();
        $this->actingAs($admin);

        $response = $this->get('/admin/settings');
        $response->assertStatus(200);
        $response->assertSee('Branding');
    }

    public function test_setting_manager_can_update_settings(): void

    {
        $admin = User::factory()->create();

        $this->actingAs($admin);

        Livewire::test(SettingManager::class)
            ->set('brand_name', 'AzagiPrint Updated')
            ->set('logo_text', 'New Logo Text')
            ->set('trust_customer', 1500)
            ->set('calculator_moq', 50)
            ->call('addWidthOption')
            ->set('calculator_width_options.2.width', '2.5')
            ->set('calculator_width_options.2.extra_price', 1000)
            ->call('saveSettings')
            ->assertHasNoErrors()
            ->assertSee('Konfigurasi admin berhasil disimpan.');

        $this->assertEquals('AzagiPrint Updated', Setting::getValue('brand_name'));
        $this->assertEquals('New Logo Text', Setting::getValue('logo_text'));
        $this->assertEquals(1500, Setting::getValue('trust_customer'));
        $this->assertEquals(50, Setting::getValue('calculator_moq'));
        
        $widthOptions = json_decode(Setting::getValue('calculator_width_options'), true);
        $this->assertCount(3, $widthOptions);
        $this->assertEquals('2.5', $widthOptions[2]['width']);
        $this->assertEquals(1000, $widthOptions[2]['extra_price']);
    }

    public function test_setting_manager_can_remove_width_options(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin);

        Livewire::test(SettingManager::class)
            ->call('removeWidthOption', 0)
            ->call('saveSettings')
            ->assertHasNoErrors();

        $widthOptions = json_decode(Setting::getValue('calculator_width_options'), true);
        $this->assertCount(1, $widthOptions);
        $this->assertEquals('2.0', $widthOptions[0]['width']);
    }
}
