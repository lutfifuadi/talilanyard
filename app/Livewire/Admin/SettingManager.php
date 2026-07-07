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
    public $brand_name = '';
    public $logo_text = '';
    public $operating_hours = '';
    public $hero_title = '';
    public $hero_subtitle = '';
    public $meta_description = '';
    public $trust_customer = '';
    public $trust_product = '';
    public $trust_completed = '';
    public $calculator_moq = '';
    public $calculator_width_options = [];

    public function mount()
    {
        $this->whatsapp_number = Setting::getValue('whatsapp_number', '');
        $this->address = Setting::getValue('address', '');
        $this->instagram_url = Setting::getValue('instagram_url', '');
        $this->facebook_url = Setting::getValue('facebook_url', '');
        $this->tiktok_url = Setting::getValue('tiktok_url', '');
        $this->email = Setting::getValue('email', '');
        $this->brand_name = Setting::getValue('brand_name', '');
        $this->logo_text = Setting::getValue('logo_text', '');
        $this->operating_hours = Setting::getValue('operating_hours', '');
        $this->hero_title = Setting::getValue('hero_title', '');
        $this->hero_subtitle = Setting::getValue('hero_subtitle', '');
        $this->meta_description = Setting::getValue('meta_description', '');
        $this->trust_customer = Setting::getValue('trust_customer', '');
        $this->trust_product = Setting::getValue('trust_product', '');
        $this->trust_completed = Setting::getValue('trust_completed', '');
        $this->calculator_moq = Setting::getValue('calculator_moq', '');

        $widthOptionsJson = Setting::getValue('calculator_width_options', '[]');
        $this->calculator_width_options = json_decode($widthOptionsJson, true) ?: [];
    }

    public function addWidthOption()
    {
        $this->calculator_width_options[] = [
            'width' => '',
            'extra_price' => 0
        ];
    }

    public function removeWidthOption($index)
    {
        unset($this->calculator_width_options[$index]);
        $this->calculator_width_options = array_values($this->calculator_width_options);
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
            'brand_name' => 'required|string',
            'logo_text' => 'required|string',
            'operating_hours' => 'nullable|string',
            'hero_title' => 'required|string',
            'hero_subtitle' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'trust_customer' => 'required|integer|min:0',
            'trust_product' => 'required|integer|min:0',
            'trust_completed' => 'required|integer|min:0',
            'calculator_moq' => 'required|integer|min:1',
            'calculator_width_options' => 'array',
            'calculator_width_options.*.width' => 'required|numeric|min:0.1',
            'calculator_width_options.*.extra_price' => 'required|numeric|min:0',
        ]);

        Setting::setValue('whatsapp_number', $this->whatsapp_number);
        Setting::setValue('address', $this->address);
        Setting::setValue('instagram_url', $this->instagram_url);
        Setting::setValue('facebook_url', $this->facebook_url);
        Setting::setValue('tiktok_url', $this->tiktok_url);
        Setting::setValue('email', $this->email);
        Setting::setValue('brand_name', $this->brand_name);
        Setting::setValue('logo_text', $this->logo_text);
        Setting::setValue('operating_hours', $this->operating_hours);
        Setting::setValue('hero_title', $this->hero_title);
        Setting::setValue('hero_subtitle', $this->hero_subtitle);
        Setting::setValue('meta_description', $this->meta_description);
        Setting::setValue('trust_customer', $this->trust_customer);
        Setting::setValue('trust_product', $this->trust_product);
        Setting::setValue('trust_completed', $this->trust_completed);
        Setting::setValue('calculator_moq', $this->calculator_moq);

        Setting::setValue('calculator_width_options', json_encode(array_values($this->calculator_width_options)));

        session()->flash('message', 'Konfigurasi admin berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.setting-manager')->layout('layouts.layoutMaster');
    }
}



