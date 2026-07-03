<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Accessory;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin & Test Users
        if (!User::where('email', 'admin@cetaktalilanyard.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin Cetak Lanyard',
                'email' => 'admin@cetaktalilanyard.com',
                'password' => bcrypt('admin123'),
            ]);
        }

        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // 2. Default Products
        $tisue = Product::updateOrCreate(
            ['slug' => 'tisue'],
            [
                'name' => 'Tisue',
                'description' => 'Bahan Lanyard Tisue halus dan lembut, sangat cocok untuk penggunaan sehari-hari dengan kualitas print sublimasi detail tinggi.',
                'is_active' => true,
            ]
        );

        $polyester = Product::updateOrCreate(
            ['slug' => 'polyester'],
            [
                'name' => 'Polyester',
                'description' => 'Bahan Lanyard Polyester bertekstur garis, sangat kuat dan awet untuk jangka panjang.',
                'is_active' => true,
            ]
        );

        // 3. Default Tiering Prices
        // Tiering prices:
        // 50-99 pcs: Rp 12.000 (Polyester: Rp 14.000)
        // 100-299 pcs: Rp 9.500 (Polyester: Rp 11.500)
        // 300-499: Rp 8.500 (Polyester: Rp 10.500)
        // 500-999: Rp 7.500 (Polyester: Rp 9.500)
        // 1000-4999: Rp 6.500 (Polyester: Rp 8.500)
        // >=5000: Rp 5.500 (Polyester: Rp 7.500)
        $tisuePrices = [
            ['min_quantity' => 50, 'max_quantity' => 99, 'price_per_pcs' => 12000],
            ['min_quantity' => 100, 'max_quantity' => 299, 'price_per_pcs' => 9500],
            ['min_quantity' => 300, 'max_quantity' => 499, 'price_per_pcs' => 8500],
            ['min_quantity' => 500, 'max_quantity' => 999, 'price_per_pcs' => 7500],
            ['min_quantity' => 1000, 'max_quantity' => 4999, 'price_per_pcs' => 6500],
            ['min_quantity' => 5000, 'max_quantity' => null, 'price_per_pcs' => 5500],
        ];

        $polyesterPrices = [
            ['min_quantity' => 50, 'max_quantity' => 99, 'price_per_pcs' => 14000],
            ['min_quantity' => 100, 'max_quantity' => 299, 'price_per_pcs' => 11500],
            ['min_quantity' => 300, 'max_quantity' => 499, 'price_per_pcs' => 10500],
            ['min_quantity' => 500, 'max_quantity' => 999, 'price_per_pcs' => 9500],
            ['min_quantity' => 1000, 'max_quantity' => 4999, 'price_per_pcs' => 8500],
            ['min_quantity' => 5000, 'max_quantity' => null, 'price_per_pcs' => 7500],
        ];

        // Clear existing product prices first
        ProductPrice::truncate();

        foreach ($tisuePrices as $price) {
            $tisue->prices()->create($price);
        }

        foreach ($polyesterPrices as $price) {
            $polyester->prices()->create($price);
        }

        // 4. Default Accessories
        $accessories = [
            ['code' => 'stopper_plastik', 'name' => 'Stopper Plastik', 'price' => 500, 'is_active' => true],
            ['code' => 'gantungan_hp', 'name' => 'Gantungan HP', 'price' => 500, 'is_active' => true],
            ['code' => 'holder_kulit', 'name' => 'Holder Kulit', 'price' => 3500, 'is_active' => true],
            ['code' => 'holder_plastik', 'name' => 'Holder Plastik', 'price' => 1000, 'is_active' => true],
        ];

        foreach ($accessories as $acc) {
            Accessory::updateOrCreate(['code' => $acc['code']], $acc);
        }

        // 5. Default Settings
        $settings = [
            'whatsapp_number' => '6282113328585',
            'address' => 'Jl. Percetakan Raya No. 45, Jakarta',
            'instagram_url' => 'https://instagram.com/cetaktalilanyard',
            'facebook_url' => 'https://facebook.com/cetaktalilanyard',
            'tiktok_url' => 'https://tiktok.com/@cetaktalilanyard',
            'email' => 'info@cetaktalilanyard.com',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
