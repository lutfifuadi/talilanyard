{{-- Hero Section --}}
<section class="hero-gradient relative overflow-hidden pt-28 pb-16 md:pt-36 md:pb-24">
  {{-- Decorative Elements --}}
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-blue-400/10 rounded-full blur-3xl"></div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
      {{-- Left Column: Text --}}
      <div class="text-center lg:text-left">
        <span class="inline-block font-cta text-xs font-semibold tracking-wider uppercase px-4 py-2 rounded-[5px] mb-6" style="background: rgba(255,255,255,0.15); color: #93C5FD;">
          {{ \App\Models\Setting::getValue('brand_name', 'AzagiPrint') }} — Desa Percetakan Online
        </span>

        <h1 class="hero-title font-heading text-2xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6" style="line-height: 1.15;">
          {{ \App\Models\Setting::getValue('hero_title', 'Cetak Tali Lanyard') }}
          <span class="block" style="color: #60A5FA;">{{ \App\Models\Setting::getValue('hero_subtitle', 'Berkualitas #1 di Jakarta') }}</span>
        </h1>

        <p class="font-body text-sm md:text-base text-white/80 max-w-xl mx-auto lg:mx-0 mb-8 leading-relaxed">
          Desa Percetakan Online | Mudah | Terlengkap. Cetak lanyard custom MOQ {{ \App\Models\Setting::getValue('calculator_moq', 40) }} pcs, 
          cetak 2 sisi Full Colour, gratis desain, dan sudah termasuk kait + stopper.
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
          <a href="#kalkulator" 
             class="font-cta text-base font-semibold px-8 py-3.5 rounded-[5px] text-white transition-all duration-300 text-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
             style="background-color: #EF4444;">
            <span class="flex items-center justify-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
              </svg>
              Hitung Harga
            </span>
          </a>
          <a href="https://wa.me/{{ \App\Models\Setting::getValue('whatsapp_number', '6282113328585') }}?text=Halo%20{{ rawurlencode(\App\Models\Setting::getValue('brand_name', 'AzagiPrint')) }},%20saya%20ingin%20konsultasi%20tentang%20lanyard" 
             target="_blank"
             class="font-cta text-base font-semibold px-8 py-3.5 rounded-[5px] text-white transition-all duration-300 text-center border-2 border-white/40 hover:border-white/60 hover:bg-white/10">
            <span class="flex items-center justify-center gap-2">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
              </svg>
              Konsultasi via WhatsApp
            </span>
          </a>
        </div>

        {{-- Trust Badges --}}
        <div class="flex flex-wrap items-center gap-6 mt-10 justify-center lg:justify-start">
          <div class="flex items-center gap-2 text-white/70 text-xs md:text-sm">
            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ \App\Models\Setting::getValue('trust_customer', '1.200') }}+ Pelanggan</span>
          </div>
          <div class="flex items-center gap-2 text-white/70 text-xs md:text-sm">
            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ \App\Models\Setting::getValue('trust_product', '272') }} Produk</span>
          </div>
          <div class="flex items-center gap-2 text-white/70 text-xs md:text-sm">
            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ \App\Models\Setting::getValue('trust_completed', '566') }}+ Pesanan Selesai</span>
          </div>
        </div>
      </div>

      {{-- Right Column: Image --}}
      <div class="relative flex justify-center lg:justify-end">
        {{-- Main Image --}}
        <div class="relative w-full max-w-md lg:max-w-none">
          <img src="{{ asset('assets/img/landing/hero-lanyard.png') }}" 
               alt="Cetak Tali Lanyard Berkualitas" 
               width="600" height="500"
               class="w-full h-auto rounded-2xl shadow-2xl object-cover"
               loading="eager">
          
          {{-- Floating Card 1 --}}
          <div class="absolute -bottom-4 -left-4 bg-white rounded-xl shadow-lg px-4 py-3 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #3B82F6;">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
            <div>
              <p class="text-xs text-gray-500">Pelanggan Puas</p>
              <p class="text-sm font-bold text-gray-800">1.200+</p>
            </div>
          </div>

          {{-- Floating Card 2 --}}
          <div class="absolute -top-4 -right-4 bg-white rounded-xl shadow-lg px-4 py-3 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #F59E0B;">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <p class="text-xs text-gray-500">Produksi 24 Jam</p>
              <p class="text-sm font-bold text-gray-800">Nonstop</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
