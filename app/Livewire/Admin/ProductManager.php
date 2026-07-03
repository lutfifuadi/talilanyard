<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductManager extends Component
{
    use WithFileUploads;

    // List & search properties
    public $search = '';
    
    // Form properties (Product)
    public $productId = null;
    public $name = '';
    public $description = '';
    public $is_active = true;
    public $image = null;
    public $existingImage = null;

    // Tier pricing for selected/currently editing product
    public $selectedProductForPrices = null;
    public $tierPrices = []; // Array of arrays: [['id' => null, 'min_quantity' => X, 'max_quantity' => Y, 'price_per_pcs' => Z]]

    // Modal state controllers
    public $isFormOpen = false;
    public $isPriceModalOpen = false;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function updatedName()
    {
        // Automatically set properties if needed, or slug can be handled automatically in model boot
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isFormOpen = true;
    }

    public function openEditModal($id)
    {
        $this->resetForm();
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->is_active = $product->is_active;
        $this->existingImage = $product->image_path;
        $this->isFormOpen = true;
    }

    public function resetForm()
    {
        $this->productId = null;
        $this->name = '';
        $this->description = '';
        $this->is_active = true;
        $this->image = null;
        $this->existingImage = null;
        $this->resetErrorBag();
    }

    public function saveProduct()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048', // max 2MB
        ];

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'is_active' => $this->is_active,
        ];

        if ($this->image) {
            // Store image in public disk
            $imagePath = $this->image->store('products', 'public');
            $data['image_path'] = $imagePath;

            // Delete old image if updating
            if ($this->productId && $this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }
        }

        if ($this->productId) {
            $product = Product::findOrFail($this->productId);
            $product->update($data);
            session()->flash('message', 'Produk berhasil diperbarui.');
        } else {
            Product::create($data);
            session()->flash('message', 'Produk baru berhasil ditambahkan.');
        }

        $this->isFormOpen = false;
        $this->resetForm();
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();
        session()->flash('message', 'Produk berhasil dihapus.');
    }

    public function toggleActive($id)
    {
        $product = Product::findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();
    }

    // Pricing methods
    public function openPriceModal($id)
    {
        $this->selectedProductForPrices = Product::with('prices')->findOrFail($id);
        $this->loadTierPrices();
        $this->isPriceModalOpen = true;
    }

    public function loadTierPrices()
    {
        $this->tierPrices = [];
        foreach ($this->selectedProductForPrices->prices as $price) {
            $this->tierPrices[] = [
                'id' => $price->id,
                'min_quantity' => $price->min_quantity,
                'max_quantity' => $price->max_quantity,
                'price_per_pcs' => (float)$price->price_per_pcs,
            ];
        }
    }

    public function addPriceTier()
    {
        $this->tierPrices[] = [
            'id' => null,
            'min_quantity' => 1,
            'max_quantity' => null,
            'price_per_pcs' => 0,
        ];
    }

    public function removePriceTier($index)
    {
        unset($this->tierPrices[$index]);
        $this->tierPrices = array_values($this->tierPrices);
    }

    public function saveTierPrices()
    {
        $this->validate([
            'tierPrices.*.min_quantity' => 'required|integer|min:1',
            'tierPrices.*.max_quantity' => 'nullable|integer|gt:tierPrices.*.min_quantity',
            'tierPrices.*.price_per_pcs' => 'required|numeric|min:0',
        ], [
            'tierPrices.*.min_quantity.required' => 'Min qty wajib diisi',
            'tierPrices.*.min_quantity.integer' => 'Min qty harus berupa angka',
            'tierPrices.*.max_quantity.gt' => 'Max qty harus lebih besar dari Min qty',
            'tierPrices.*.price_per_pcs.required' => 'Harga wajib diisi',
            'tierPrices.*.price_per_pcs.numeric' => 'Harga harus berupa angka',
        ]);

        // Truncate/Delete existing pricing first and recreate
        $this->selectedProductForPrices->prices()->delete();

        foreach ($this->tierPrices as $tier) {
            $this->selectedProductForPrices->prices()->create([
                'min_quantity' => $tier['min_quantity'],
                'max_quantity' => $tier['max_quantity'] ? $tier['max_quantity'] : null,
                'price_per_pcs' => $tier['price_per_pcs'],
            ]);
        }

        session()->flash('price_message', 'Tiering harga grosir berhasil disimpan.');
        $this->isPriceModalOpen = false;
        $this->selectedProductForPrices = null;
    }

    public function render()
    {
        $products = Product::with('prices')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.product-manager', [
            'products' => $products,
        ])->layout('layouts.layoutMaster');
    }
}
