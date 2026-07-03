<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Accessory;
use Illuminate\Support\Str;

class AccessoryManager extends Component
{
    public $search = '';

    // Form fields
    public $accessoryId = null;
    public $code = '';
    public $name = '';
    public $price = 0;
    public $is_active = true;

    public $isFormOpen = false;

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isFormOpen = true;
    }

    public function openEditModal($id)
    {
        $this->resetForm();
        $acc = Accessory::findOrFail($id);
        $this->accessoryId = $acc->id;
        $this->code = $acc->code;
        $this->name = $acc->name;
        $this->price = (float)$acc->price;
        $this->is_active = $acc->is_active;
        $this->isFormOpen = true;
    }

    public function resetForm()
    {
        $this->accessoryId = null;
        $this->code = '';
        $this->name = '';
        $this->price = 0;
        $this->is_active = true;
        $this->resetErrorBag();
    }

    public function saveAccessory()
    {
        $rules = [
            'code' => 'required|string|max:100|unique:accessories,code,' . $this->accessoryId,
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ];

        $this->validate($rules);

        $data = [
            'code' => Str::slug($this->code, '_'), // automatically ensure clean identifier
            'name' => $this->name,
            'price' => $this->price,
            'is_active' => $this->is_active,
        ];

        if ($this->accessoryId) {
            $acc = Accessory::findOrFail($this->accessoryId);
            $acc->update($data);
            session()->flash('message', 'Aksesoris berhasil diperbarui.');
        } else {
            Accessory::create($data);
            session()->flash('message', 'Aksesoris baru berhasil ditambahkan.');
        }

        $this->isFormOpen = false;
        $this->resetForm();
    }

    public function toggleActive($id)
    {
        $acc = Accessory::findOrFail($id);
        $acc->is_active = !$acc->is_active;
        $acc->save();
    }

    public function deleteAccessory($id)
    {
        $acc = Accessory::findOrFail($id);
        $acc->delete();
        session()->flash('message', 'Aksesoris berhasil dihapus.');
    }

    public function render()
    {
        $accessories = Accessory::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.accessory-manager', [
            'accessories' => $accessories,
        ])->layout('layouts.layoutMaster');
    }
}
