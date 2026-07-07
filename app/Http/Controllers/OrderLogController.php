<?php

namespace App\Http\Controllers;

use App\Models\OrderLog;
use App\Models\Product;
use App\Models\Accessory;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderLogController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'lebar' => 'required|string',
            'accessories' => 'array',
            'accessories.*' => 'exists:accessories,id',
            'base_price' => 'required|numeric|min:0',
            'accessory_price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        // 1. Catat ke tabel order_logs
        $orderLog = OrderLog::create([
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'base_price' => $validated['base_price'],
            'accessory_price' => $validated['accessory_price'],
            'total_price' => $validated['total_price'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // 2. Rekam pivot aksesorisnya
        if (!empty($validated['accessories'])) {
            $orderLog->accessories()->sync($validated['accessories']);
        }

        // 3. Ambil data penunjang untuk pesan WhatsApp
        $product = Product::find($validated['product_id']);
        $accessories = Accessory::whereIn('id', $validated['accessories'] ?? [])->get();
        $brandName = Setting::getValue('brand_name', 'AzagiPrint');
        $whatsappNumber = Setting::getValue('whatsapp_number', '6282113328585');

        // 4. Susun pesan text WA dinamis
        $accessoriesNames = $accessories->isNotEmpty() 
            ? $accessories->pluck('name')->implode(', ') 
            : 'Tidak ada';

        $text = "Halo *{$brandName}*,\n\n"
              . "Saya ingin memesan lanyard dengan spesifikasi berikut:\n"
              . "- *Bahan*: {$product->name}\n"
              . "- *Lebar Lanyard*: {$validated['lebar']} cm\n"
              . "- *Jumlah (Qty)*: {$validated['quantity']} pcs\n"
              . "- *Aksesoris*: {$accessoriesNames}\n"
              . "- *Estimasi Total*: Rp " . number_format($validated['total_price'], 0, ',', '.') . "\n\n"
              . "Mohon info selanjutnya untuk proses desain & pembayaran. Terima kasih.";

        $redirectUrl = "https://wa.me/{$whatsappNumber}?text=" . rawurlencode($text);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dicatat.',
            'redirect_url' => $redirectUrl
        ]);
    }
}
