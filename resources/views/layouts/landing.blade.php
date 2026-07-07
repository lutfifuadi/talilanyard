<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', \App\Models\Setting::getValue('brand_name', 'AzagiPrint') . ' — Cetak Tali Lanyard Custom Jakarta')</title>
  <meta name="description" content="@yield('meta_description', \App\Models\Setting::getValue('meta_description', 'AzagiPrint — Desa Percetakan Online. Cetak Tali Lanyard custom Jakarta, MOQ 40 pcs, cetak 2 sisi Full Colour, gratis desain, kualitas terbaik.'))">

  <!-- Open Graph -->
  <meta property="og:title" content="@yield('title', \App\Models\Setting::getValue('brand_name', 'AzagiPrint') . ' — Cetak Tali Lanyard Custom Jakarta')">
  <meta property="og:description" content="{{ \App\Models\Setting::getValue('meta_description', 'AzagiPrint — Desa Percetakan Online. Cetak Tali Lanyard custom Jakarta, MOQ 40 pcs, cetak 2 sisi Full Colour, gratis desain.') }}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">

  <!-- Google Fonts: Plus Jakarta Sans + Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">

  <!-- Vite Assets -->
  @vite(['resources/css/landing.css', 'resources/js/landing.js'])
  @stack('styles')
</head>
<body class="font-body text-gray-900 antialiased" style="background-color: #F8FAFC;">

  {{-- Navbar --}}
  <nav class="landing-navbar fixed top-0 left-0 right-0 z-50 transition-all duration-300" style="background: transparent;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 lg:h-20">
        {{-- Logo --}}
        <a href="{{ route('landing') }}" class="flex items-center gap-2">
          <span class="landing-navbar-logo font-heading text-xl lg:text-2xl font-extrabold text-white transition-colors duration-300">
            {{ \App\Models\Setting::getValue('logo_text', \App\Models\Setting::getValue('brand_name', 'AzagiPrint')) }}
          </span>
        </a>

        {{-- Desktop Nav --}}
        <div class="hidden md:flex items-center gap-6">
          <a href="#keunggulan" class="landing-nav-link font-body text-sm font-medium text-white/90 hover:text-white transition-colors">Keunggulan</a>
          <a href="#galeri" class="landing-nav-link font-body text-sm font-medium text-white/90 hover:text-white transition-colors">Galeri</a>
          <a href="#kalkulator" class="landing-nav-link font-body text-sm font-medium text-white/90 hover:text-white transition-colors">Simulasi Harga</a>
          <a href="#faq" class="landing-nav-link font-body text-sm font-medium text-white/90 hover:text-white transition-colors">FAQ</a>
          <a href="https://wa.me/{{ \App\Models\Setting::getValue('whatsapp_number', '6282113328585') }}?text=Halo%20{{ rawurlencode(\App\Models\Setting::getValue('brand_name', 'AzagiPrint')) }},%20saya%20tertarik%20dengan%20produk%20lanyard" target="_blank" class="font-cta text-sm font-semibold px-5 py-2.5 rounded-[5px] transition-all duration-300 inline-flex items-center gap-2" style="background-color: #25D366; color: white;">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            <span>Hubungi Kami</span>
          </a>
        </div>

        {{-- Mobile Menu Button --}}
        <button id="mobile-menu-btn" class="md:hidden p-2 rounded-[5px] text-white/90 hover:text-white" onclick="toggleMobileMenu()">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg rounded-b-2xl mx-4 mb-2 overflow-hidden transition-all duration-300">
      <div class="px-4 py-4 space-y-3">
        <a href="#keunggulan" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors" onclick="closeMobileMenu()">Keunggulan</a>
        <a href="#galeri" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors" onclick="closeMobileMenu()">Galeri</a>
        <a href="#kalkulator" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors" onclick="closeMobileMenu()">Simulasi Harga</a>
        <a href="#faq" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors" onclick="closeMobileMenu()">FAQ</a>
        <a href="https://wa.me/{{ \App\Models\Setting::getValue('whatsapp_number', '6282113328585') }}?text=Halo%20{{ rawurlencode(\App\Models\Setting::getValue('brand_name', 'AzagiPrint')) }},%20saya%20tertarik%20dengan%20produk%20lanyard" target="_blank" class="block w-full text-center font-cta text-sm font-semibold px-5 py-3 rounded-[5px] text-white transition-all duration-300" style="background-color: #25D366;">
          Hubungi via WhatsApp
        </a>
      </div>
    </div>
  </nav>

  {{-- Main Content --}}
  <main>
    @yield('content')
  </main>

  {{-- Floating WhatsApp Widget --}}
  <a href="https://wa.me/{{ \App\Models\Setting::getValue('whatsapp_number', '6282113328585') }}?text=Halo%20{{ rawurlencode(\App\Models\Setting::getValue('brand_name', 'AzagiPrint')) }},%20saya%20tertarik%20dengan%20produk%20lanyard" target="_blank" class="whatsapp-widget hidden lg:flex" aria-label="Chat via WhatsApp">
    <span class="tooltip-text">Chat via WhatsApp</span>
    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
  </a>

  {{-- Mobile Sticky Bottom Navigation --}}
  <div class="fixed bottom-4 left-4 right-4 z-50 lg:hidden">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-[0_-8px_30px_rgba(0,0,0,0.12)] border border-gray-100/50 relative h-16 px-6 flex items-center justify-between">
      
      {{-- Left Menu: Hitung --}}
      <a href="#kalkulator" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#0A2463] active:text-[#0A2463] transition-colors duration-200 w-20">
        <svg class="w-8 h-8 mb-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <rect x="4" y="3" width="16" height="18" rx="2" stroke="currentColor" stroke-width="2"></rect>
          <rect x="7" y="6" width="10" height="3" rx="0.5" stroke="currentColor" stroke-width="2"></rect>
          <path d="M8 12h.01M12 12h.01M16 12h.01M8 16h.01M12 16h.01M16 16h.01" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
        </svg>
        <span class="text-[10px] font-semibold tracking-wide">Hitung</span>
      </a>

      {{-- Center FAB Wrapper --}}
      <div class="absolute -top-8 left-1/2 -translate-x-1/2 flex items-center justify-center">
        <a href="https://wa.me/{{ \App\Models\Setting::getValue('whatsapp_number', '6282113328585') }}?text=Halo%20{{ rawurlencode(\App\Models\Setting::getValue('brand_name', 'AzagiPrint')) }},%20saya%20tertarik%20dengan%20produk%20lanyard" target="_blank" class="w-16 h-16 bg-[#25D366] rounded-full flex items-center justify-center text-white shadow-[0_8px_20px_rgba(37,211,102,0.4)] border-4 border-[#F8FAFC] hover:scale-105 transition-all duration-300" aria-label="Chat via WhatsApp">
          <svg class="w-9 h-9" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
          </svg>
        </a>
      </div>

      {{-- Right Menu: FAQ --}}
      <a href="#faq" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#0A2463] active:text-[#0A2463] transition-colors duration-200 w-20">
        <svg class="w-8 h-8 mb-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="text-[10px] font-semibold tracking-wide">FAQ</span>
      </a>

    </div>
  </div>

  {{-- Mobile Menu Toggle Script --}}
  <script>
    function toggleMobileMenu() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    }
    function closeMobileMenu() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.add('hidden');
    }
  </script>

  @stack('scripts')
</body>
</html>
