{{-- Galeri Contoh Produk Section --}}
<section id="galeri" class="py-16 md:py-24 scroll-mt-20" style="background-color: #FFFFFF;">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Section Header --}}
    <div class="text-center max-w-2xl mx-auto mb-12 lg:mb-16">
      <span class="font-cta text-xs font-semibold tracking-wider uppercase px-4 py-2 rounded-full" style="background-color: #E8EDF7; color: #0A2463;">
        Portofolio
      </span>
      <h2 class="font-heading text-2xl md:text-4xl font-extrabold mt-4 mb-4" style="color: #0A2463;">
        Contoh Produk Kami
      </h2>
      <p class="font-body text-gray-500 text-sm md:text-base leading-relaxed">
        Berbagai macam lanyard custom yang telah kami produksi untuk berbagai kebutuhan
      </p>
    </div>

    {{-- Gallery Grid --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
      {{-- Item 1 --}}
      <div class="gallery-item relative group cursor-pointer">
        <img src="{{ asset('assets/img/landing/lanyard-kantor.png') }}" 
             alt="Lanyard Kantor" 
             width="400" height="300"
             class="w-full h-64 sm:h-72 object-cover rounded-xl"
             loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <div class="absolute bottom-4 left-4 right-4">
            <h4 class="text-white font-heading font-bold text-base md:text-lg">Lanyard Kantor</h4>
            <p class="text-white/80 text-xs md:text-sm">Bahan Polyester premium</p>
          </div>
        </div>
      </div>

      {{-- Item 2 --}}
      <div class="gallery-item relative group cursor-pointer">
        <img src="{{ asset('assets/img/landing/lanyard_event.png') }}" 
             alt="Lanyard Event" 
             width="400" height="300"
             class="w-full h-64 sm:h-72 object-cover rounded-xl"
             loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <div class="absolute bottom-4 left-4 right-4">
            <h4 class="text-white font-heading font-bold text-base md:text-lg">Lanyard Event</h4>
            <p class="text-white/80 text-xs md:text-sm">Desain eksklusif untuk acara</p>
          </div>
        </div>
      </div>

      {{-- Item 3 --}}
      <div class="gallery-item relative group cursor-pointer">
        <img src="{{ asset('assets/img/landing/lanyard_promosi.png') }}" 
             alt="Lanyard Promosi" 
             width="400" height="300"
             class="w-full h-64 sm:h-72 object-cover rounded-xl"
             loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <div class="absolute bottom-4 left-4 right-4">
            <h4 class="text-white font-heading font-bold text-base md:text-lg">Lanyard Promosi</h4>
            <p class="text-white/80 text-xs md:text-sm">Cetak logo & brand Anda</p>
          </div>
        </div>
      </div>

      {{-- Item 4 --}}
      <div class="gallery-item relative group cursor-pointer">
        <img src="{{ asset('assets/img/landing/lanyard_sekolah.png') }}" 
             alt="Lanyard Sekolah" 
             width="400" height="300"
             class="w-full h-64 sm:h-72 object-cover rounded-xl"
             loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <div class="absolute bottom-4 left-4 right-4">
            <h4 class="text-white font-heading font-bold text-base md:text-lg">Lanyard Sekolah</h4>
            <p class="text-white/80 text-xs md:text-sm">Tersedia ukuran anak & dewasa</p>
          </div>
        </div>
      </div>

      {{-- Item 5 --}}
      <div class="gallery-item relative group cursor-pointer">
        <img src="{{ asset('assets/img/landing/lanyard_rumah_sakit.png') }}" 
             alt="Lanyard Rumah Sakit" 
             width="400" height="300"
             class="w-full h-64 sm:h-72 object-cover rounded-xl"
             loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <div class="absolute bottom-4 left-4 right-4">
            <h4 class="text-white font-heading font-bold text-base md:text-lg">Lanyard Rumah Sakit</h4>
            <p class="text-white/80 text-xs md:text-sm">ID card holder & aksesoris</p>
          </div>
        </div>
      </div>

      {{-- Item 6 --}}
      <div class="gallery-item relative group cursor-pointer">
        <img src="{{ asset('assets/img/landing/lanyard_custom.png') }}" 
             alt="Lanyard Custom" 
             width="400" height="300"
             class="w-full h-64 sm:h-72 object-cover rounded-xl"
             loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <div class="absolute bottom-4 left-4 right-4">
            <h4 class="text-white font-heading font-bold text-base md:text-lg">Lanyard Custom</h4>
            <p class="text-white/80 text-xs md:text-sm">Sesuai keinginan Anda</p>
          </div>
        </div>
      </div>
    </div>

    {{-- CTA after gallery --}}
    <div class="text-center mt-10">
      <p class="font-body text-gray-500 mb-4 text-sm">
        Punya desain sendiri? Kirimkan saja, kami siap cetak!
      </p>
      <a href="https://wa.me/6282113328585?text=Halo%20AzagiPrint,%20saya%20punya%20desain%20lanyard%20sendiri" 
         target="_blank"
         class="font-cta text-sm font-semibold px-6 py-3 rounded-[5px] text-white transition-all duration-300 inline-flex items-center gap-2"
         style="background-color: #3B82F6;">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        Konsultasi Desain Gratis
      </a>
    </div>
  </div>
</section>
