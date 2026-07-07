{{-- FAQ Section --}}
<section id="faq" class="py-16 md:py-24 scroll-mt-20" style="background-color: #FFFFFF;">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Section Header --}}
    <div class="text-center max-w-2xl mx-auto mb-12 lg:mb-16">
      <span class="font-cta text-xs font-semibold tracking-wider uppercase px-4 py-2 rounded-full" style="background-color: #FEF3C7; color: #D97706;">
        Tanya Jawab
      </span>
      <h2 class="font-heading text-2xl md:text-4xl font-extrabold mt-4 mb-4" style="color: #0A2463;">
        Pertanyaan Umum
      </h2>
      <p class="font-body text-gray-500 text-sm md:text-base leading-relaxed">
        Temukan jawaban untuk pertanyaan yang sering diajukan
      </p>
    </div>

    {{-- FAQ Accordion --}}
    <div class="max-w-3xl mx-auto" x-data="{ activeFaq: null }">
      <div class="space-y-3">
        {{-- FAQ 1 --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300"
             :class="{ 'shadow-md': activeFaq === 1 }">
          <button 
            @click="activeFaq = activeFaq === 1 ? null : 1" 
            class="w-full flex items-center justify-between px-6 py-5 text-left transition-colors hover:bg-gray-50/50"
            :class="{ 'border-b border-gray-100': activeFaq === 1 }">
            <span class="font-heading font-bold text-sm md:text-base pr-4" style="color: #0A2463;">
              Berapa minimum order (MOQ) untuk cetak lanyard?
            </span>
            <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300" 
                 style="color: #3B82F6;"
                 :class="{ 'rotate-45': activeFaq === 1 }" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
          </button>
          <div x-show="activeFaq === 1" 
               x-transition:enter="transition-all ease-out duration-300"
               x-transition:enter-start="max-h-0 opacity-0"
               x-transition:enter-end="max-h-96 opacity-100"
               x-transition:leave="transition-all ease-in duration-200"
               x-transition:leave-start="max-h-96 opacity-100"
               x-transition:leave-end="max-h-0 opacity-0"
               class="overflow-hidden">
            <div class="px-6 pb-5">
              <p class="font-body text-gray-600 text-sm leading-relaxed">
                Minimum order (MOQ) untuk cetak lanyard di <strong>{{ \App\Models\Setting::getValue('brand_name', 'AzagiPrint') }} adalah {{ \App\Models\Setting::getValue('calculator_moq', 40) }} pcs</strong>. Dengan MOQ yang rendah, Anda bisa mendapatkan lanyard custom berkualitas dengan harga terjangkau. Cocok untuk kantor, event, sekolah, dan promosi bisnis.
              </p>
            </div>
          </div>
        </div>

        {{-- FAQ 2 --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300"
             :class="{ 'shadow-md': activeFaq === 2 }">
          <button 
            @click="activeFaq = activeFaq === 2 ? null : 2" 
            class="w-full flex items-center justify-between px-6 py-5 text-left transition-colors hover:bg-gray-50/50"
            :class="{ 'border-b border-gray-100': activeFaq === 2 }">
            <span class="font-heading font-bold text-sm md:text-base pr-4" style="color: #0A2463;">
              Berapa lama waktu produksi?
            </span>
            <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300" 
                 style="color: #3B82F6;"
                 :class="{ 'rotate-45': activeFaq === 2 }" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
          </button>
          <div x-show="activeFaq === 2" 
               x-transition:enter="transition-all ease-out duration-300"
               x-transition:enter-start="max-h-0 opacity-0"
               x-transition:enter-end="max-h-96 opacity-100"
               x-transition:leave="transition-all ease-in duration-200"
               x-transition:leave-start="max-h-96 opacity-100"
               x-transition:leave-end="max-h-0 opacity-0"
               class="overflow-hidden">
            <div class="px-6 pb-5">
              <p class="font-body text-gray-600 text-sm leading-relaxed">
                Waktu produksi standar adalah <strong>1-2 hari kerja</strong> setelah desain disetujui. Untuk pesanan di atas 500 pcs, estimasi produksi 3-5 hari kerja. Kami juga menyediakan layanan <strong>express 24 jam</strong> dengan biaya tambahan.
              </p>
            </div>
          </div>
        </div>

        {{-- FAQ 3 --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300"
             :class="{ 'shadow-md': activeFaq === 3 }">
          <button 
            @click="activeFaq = activeFaq === 3 ? null : 3" 
            class="w-full flex items-center justify-between px-6 py-5 text-left transition-colors hover:bg-gray-50/50"
            :class="{ 'border-b border-gray-100': activeFaq === 3 }">
            <span class="font-heading font-bold text-sm md:text-base pr-4" style="color: #0A2463;">
              Format file apa yang diterima untuk desain?
            </span>
            <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300" 
                 style="color: #3B82F6;"
                 :class="{ 'rotate-45': activeFaq === 3 }" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
          </button>
          <div x-show="activeFaq === 3" 
               x-transition:enter="transition-all ease-out duration-300"
               x-transition:enter-start="max-h-0 opacity-0"
               x-transition:enter-end="max-h-96 opacity-100"
               x-transition:leave="transition-all ease-in duration-200"
               x-transition:leave-start="max-h-96 opacity-100"
               x-transition:leave-end="max-h-0 opacity-0"
               class="overflow-hidden">
            <div class="px-6 pb-5">
              <p class="font-body text-gray-600 text-sm leading-relaxed">
                Kami menerima format file: <strong>PDF, CDR, AI, dan PSD</strong> dengan resolusi <strong>minimal 300 DPI</strong>. Jika Anda belum punya desain, tim desainer kami siap membantu membuatkan desain secara <strong>GRATIS</strong> tanpa biaya tambahan.
              </p>
            </div>
          </div>
        </div>

        {{-- FAQ 4 --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300"
             :class="{ 'shadow-md': activeFaq === 4 }">
          <button 
            @click="activeFaq = activeFaq === 4 ? null : 4" 
            class="w-full flex items-center justify-between px-6 py-5 text-left transition-colors hover:bg-gray-50/50"
            :class="{ 'border-b border-gray-100': activeFaq === 4 }">
            <span class="font-heading font-bold text-sm md:text-base pr-4" style="color: #0A2463;">
              Berapa biaya ongkos kirim?
            </span>
            <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300" 
                 style="color: #3B82F6;"
                 :class="{ 'rotate-45': activeFaq === 4 }" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
          </button>
          <div x-show="activeFaq === 4" 
               x-transition:enter="transition-all ease-out duration-300"
               x-transition:enter-start="max-h-0 opacity-0"
               x-transition:enter-end="max-h-96 opacity-100"
               x-transition:leave="transition-all ease-in duration-200"
               x-transition:leave-start="max-h-96 opacity-100"
               x-transition:leave-end="max-h-0 opacity-0"
               class="overflow-hidden">
            <div class="px-6 pb-5">
              <p class="font-body text-gray-600 text-sm leading-relaxed">
                Kami melayani pengiriman ke <strong>seluruh Indonesia</strong> melalui <strong>JNE, J&T, SiCepat, dan Pos Indonesia</strong>. Biaya ongkos kirim tergantung lokasi tujuan dan berat pesanan. Kami juga melayani pengiriman luar negeri dengan ketentuan khusus.
              </p>
            </div>
          </div>
        </div>

        {{-- FAQ 5 --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300"
             :class="{ 'shadow-md': activeFaq === 5 }">
          <button 
            @click="activeFaq = activeFaq === 5 ? null : 5" 
            class="w-full flex items-center justify-between px-6 py-5 text-left transition-colors hover:bg-gray-50/50"
            :class="{ 'border-b border-gray-100': activeFaq === 5 }">
            <span class="font-heading font-bold text-sm md:text-base pr-4" style="color: #0A2463;">
              Apa saja metode pembayaran yang tersedia?
            </span>
            <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300" 
                 style="color: #3B82F6;"
                 :class="{ 'rotate-45': activeFaq === 5 }" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
          </button>
          <div x-show="activeFaq === 5" 
               x-transition:enter="transition-all ease-out duration-300"
               x-transition:enter-start="max-h-0 opacity-0"
               x-transition:enter-end="max-h-96 opacity-100"
               x-transition:leave="transition-all ease-in duration-200"
               x-transition:leave-start="max-h-96 opacity-100"
               x-transition:leave-end="max-h-0 opacity-0"
               class="overflow-hidden">
            <div class="px-6 pb-5">
              <p class="font-body text-gray-600 text-sm leading-relaxed">
                Kami menerima pembayaran melalui: <strong>Transfer Bank (BCA, Mandiri, BRI, BNI), E-Wallet (GoPay, OVO, Dana, LinkAja), dan QRIS</strong>. Sistem pembayaran: <strong>DP 50%</strong> di muka sebelum produksi, dan <strong>50% pelunasan</strong> sebelum barang dikirim.
              </p>
            </div>
          </div>
        </div>

        {{-- FAQ 6 --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300"
             :class="{ 'shadow-md': activeFaq === 6 }">
          <button 
            @click="activeFaq = activeFaq === 6 ? null : 6" 
            class="w-full flex items-center justify-between px-6 py-5 text-left transition-colors hover:bg-gray-50/50"
            :class="{ 'border-b border-gray-100': activeFaq === 6 }">
            <span class="font-heading font-bold text-sm md:text-base pr-4" style="color: #0A2463;">
              Apakah bisa revisi desain setelah disetujui?
            </span>
            <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300" 
                 style="color: #3B82F6;"
                 :class="{ 'rotate-45': activeFaq === 6 }" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
          </button>
          <div x-show="activeFaq === 6" 
               x-transition:enter="transition-all ease-out duration-300"
               x-transition:enter-start="max-h-0 opacity-0"
               x-transition:enter-end="max-h-96 opacity-100"
               x-transition:leave="transition-all ease-in duration-200"
               x-transition:leave-start="max-h-96 opacity-100"
               x-transition:leave-end="max-h-0 opacity-0"
               class="overflow-hidden">
            <div class="px-6 pb-5">
              <p class="font-body text-gray-600 text-sm leading-relaxed">
                Ya, kami memberikan <strong>revisi gratis unlimited</strong> sebelum proses produksi dimulai. Setelah desain di-approve dan produksi berjalan, revisi tidak dapat dilakukan. Kami juga memberikan <strong>garansi kualitas</strong> — jika hasil cetak tidak sesuai, kami akan produksi ulang gratis.
              </p>
            </div>
          </div>
        </div>

        {{-- FAQ 7: Garansi Kualitas --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300"
             :class="{ 'shadow-md': activeFaq === 7 }">
          <button 
            @click="activeFaq = activeFaq === 7 ? null : 7" 
            class="w-full flex items-center justify-between px-6 py-5 text-left transition-colors hover:bg-gray-50/50"
            :class="{ 'border-b border-gray-100': activeFaq === 7 }">
            <span class="font-heading font-bold text-sm md:text-base pr-4" style="color: #0A2463;">
              Apakah ada garansi kualitas?
            </span>
            <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300" 
                 style="color: #3B82F6;"
                 :class="{ 'rotate-45': activeFaq === 7 }" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
          </button>
          <div x-show="activeFaq === 7" 
               x-transition:enter="transition-all ease-out duration-300"
               x-transition:enter-start="max-h-0 opacity-0"
               x-transition:enter-end="max-h-96 opacity-100"
               x-transition:leave="transition-all ease-in duration-200"
               x-transition:leave-start="max-h-96 opacity-100"
               x-transition:leave-end="max-h-0 opacity-0"
               class="overflow-hidden">
            <div class="px-6 pb-5">
              <p class="font-body text-gray-600 text-sm leading-relaxed">
                Tentu! <strong>{{ \App\Models\Setting::getValue('brand_name', 'AzagiPrint') }}</strong> memberikan garansi kualitas untuk setiap pesanan. Jika hasil cetak tidak sesuai dengan desain yang disetujui, kami akan <strong>produksi ulang gratis</strong> tanpa biaya tambahan. Kepuasan pelanggan adalah prioritas utama kami.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Still have questions? --}}
    <div class="text-center mt-12">
      <div class="inline-flex flex-col sm:flex-row items-center gap-3 px-6 py-4 rounded-xl" style="background-color: #F8FAFC;">
        <div class="text-center sm:text-left">
          <p class="font-body text-sm font-semibold text-gray-800">
            Masih punya pertanyaan?
          </p>
          <p class="font-body text-xs text-gray-500">
            Tim kami siap membantu Anda
          </p>
        </div>
        <a href="https://wa.me/{{ \App\Models\Setting::getValue('whatsapp_number', '6282113328585') }}?text=Halo%20{{ rawurlencode(\App\Models\Setting::getValue('brand_name', 'AzagiPrint')) }},%20saya%20ada%20pertanyaan%20tentang%20lanyard" 
           target="_blank"
           class="font-cta text-sm font-semibold px-5 py-2.5 rounded-[5px] text-white transition-all duration-300 inline-flex items-center gap-2 mt-2 sm:mt-0"
           style="background-color: #25D366;">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
          </svg>
          Tanya via WhatsApp
        </a>
      </div>
    </div>
  </div>
</section>
