<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;

class SettingManager extends Component
{
    public $whatsapp_number = '';
    public $address = '';
    public $instagram_url = '';
    public $facebook_url = '';
    public $tiktok_url = '';
    public $email = '';

    public function mount()
    {
        $this->whatsapp_number = Setting::getValue('whatsapp_number', '');
        $this->address = Setting::getValue('address', '');
        $this->instagram_url = Setting::getValue('instagram_url', '');
        $this->facebook_url = Setting::getValue('facebook_url', '');
        $this->tiktok_url = Setting::getValue('tiktok_url', '');
        $this->email = Setting::getValue('email', '');
    }

    public function saveSettings()
    {
        $this->validate([
            'whatsapp_number' => 'required|string',
            'address' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'facebook_url' => 'nullable|string',
            'tiktok_url' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        Setting::setValue('whatsapp_number', $this->whatsapp_number);
        Setting::setValue('address', $this->address);
        Setting::setValue('instagram_url', $this->instagram_url);
        Setting::setValue('facebook_url', $this->facebook_url);
        Setting::setValue('tiktok_url', $this->tiktok_url);
        Setting::setValue('email', $this->email);

        session()->flash('message', 'Konfigurasi admin berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.setting-manager')->layout('layouts.layoutMaster');
    }
}
