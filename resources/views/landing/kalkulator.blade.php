{{-- Kalkulator Harga Section --}}
<section id="kalkulator" class="py-16 md:py-24 scroll-mt-20" style="background-color: #F3F4F6;">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Section Header --}}
    <div class="text-center max-w-2xl mx-auto mb-12 lg:mb-16">
      <span class="font-cta text-xs font-semibold tracking-wider uppercase px-4 py-2 rounded-[5px]" style="background-color: #EFF6FF; color: #2563EB;">
        Kalkulator
      </span>
      <h2 class="font-heading text-2xl md:text-4xl font-extrabold mt-4 mb-4" style="color: #0A2463;">
        Simulasi Harga Instan
      </h2>
      <p class="font-body text-gray-500 text-sm md:text-base leading-relaxed">
        Masukkan spesifikasi yang Anda inginkan untuk mendapatkan estimasi harga secara langsung
      </p>
    </div>

    {{-- Calculator Card --}}
    <div class="max-w-4xl mx-auto" x-data="kalkulatorData()">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="grid lg:grid-cols-2">
          {{-- Left: Form --}}
          <div class="p-6 lg:p-8">
            <h3 class="font-heading text-base md:text-lg font-bold mb-6" style="color: #0A2463;">
              Pilih Spesifikasi
            </h3>

            {{-- Bahan --}}
            <div class="mb-5">
              <label class="font-body block text-sm font-semibold mb-2.5 text-gray-700">
                Jenis Bahan
              </label>
              <div class="grid grid-cols-2 gap-3">
                <template x-for="bahan in bahanList" :key="bahan.id">
                  <button 
                    @click="selectedBahan = bahan.id; hitungHarga()"
                    :class="selectedBahan === bahan.id 
                      ? 'ring-2 border-transparent text-white' 
                      : 'border-gray-200 text-gray-700 hover:border-gray-300'"
                    :style="selectedBahan === bahan.id ? 'background-color: #0A2463;' : ''"
                    class="px-4 py-3 rounded-[5px] border text-sm font-semibold transition-all duration-200 text-left font-body">
                    <span x-text="bahan.nama"></span>
                    <span class="block text-xs font-normal mt-0.5" 
                          :class="selectedBahan === bahan.id ? 'text-blue-200' : 'text-gray-400'"
                          x-text="'Mulai Rp ' + bahan.hargaMulai.toLocaleString() + '/pcs'"></span>
                  </button>
                </template>
              </div>
            </div>

            {{-- Lebar --}}
            <div class="mb-5">
              <label class="font-body block text-sm font-semibold mb-2.5 text-gray-700">
                Lebar Lanyard
              </label>
              <div class="grid grid-cols-3 gap-3">
                <template x-for="lebar in lebarList" :key="lebar.width">
                  <button 
                    @click="selectedLebar = lebar.width; hitungHarga()"
                    :class="selectedLebar === lebar.width 
                      ? 'ring-2 border-transparent text-white' 
                      : 'border-gray-200 text-gray-700 hover:border-gray-300'"
                    :style="selectedLebar === lebar.width ? 'background-color: #3B82F6;' : ''"
                    class="px-4 py-2.5 rounded-[5px] border text-sm font-semibold transition-all duration-200 font-body">
                    <span x-text="lebar.width + ' cm'"></span>
                  </button>
                </template>
              </div>
            </div>

            {{-- Quantity --}}
            <div class="mb-5">
              <label class="font-body block text-sm font-semibold mb-2.5 text-gray-700">
                Jumlah Pesanan
              </label>
              <div class="relative">
                <input 
                  type="number" 
                  x-model="quantity" 
                  @input.debounce.300ms="hitungHarga()"
                  min="1"
                  class="w-full px-4 py-3 rounded-[5px] border border-gray-200 text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all duration-200 font-body"
                  placeholder="Contoh: 100">
              </div>
              <p class="font-body text-xs text-gray-400 mt-1.5">
                *Minimal pemesanan <strong x-text="moq + ' pcs'"></strong> (MOQ)
              </p>
              <div class="flex gap-2 mt-2">
                <button @click="quantity = moq; hitungHarga()" class="px-3 py-1.5 text-xs font-semibold rounded-[5px] border border-gray-200 text-gray-600 hover:border-gray-300 hover:bg-gray-50 transition-all">
                  <span x-text="moq + ' pcs'"></span>
                </button>
                 <button @click="quantity = 100; hitungHarga()" class="px-3 py-1.5 text-xs font-semibold rounded-[5px] border border-gray-200 text-gray-600 hover:border-gray-300 hover:bg-gray-50 transition-all">
                   100 pcs
                 </button>
                 <button @click="quantity = 200; hitungHarga()" class="px-3 py-1.5 text-xs font-semibold rounded-[5px] border border-gray-200 text-gray-600 hover:border-gray-300 hover:bg-gray-50 transition-all">
                   200 pcs
                 </button>
                 <button @click="quantity = 500; hitungHarga()" class="px-3 py-1.5 text-xs font-semibold rounded-[5px] border border-gray-200 text-gray-600 hover:border-gray-300 hover:bg-gray-50 transition-all">
                   500 pcs
                 </button>
              </div>
            </div>

            {{-- Aksesoris --}}
            <div class="mb-6">
              <label class="font-body block text-sm font-semibold mb-2.5 text-gray-700">
                Aksesoris Tambahan
              </label>
              <div class="space-y-3">
                <template x-for="aksesoris in aksesorisList" :key="aksesoris.id">
                  <label class="flex items-center gap-3 cursor-pointer group">
                    <input 
                      type="checkbox" 
                      :value="aksesoris.id" 
                      x-model="selectedAksesoris"
                      @change="hitungHarga()"
                      class="w-4 h-4 rounded border-gray-300 transition-all"
                      style="accent-color: #0A2463;">
                    <div>
                      <span class="font-body text-sm font-medium text-gray-700 group-hover:text-gray-900 transition-colors" x-text="aksesoris.nama"></span>
                      <span class="text-xs text-gray-400 ml-1" x-text="'(+Rp ' + aksesoris.harga.toLocaleString() + ')'"></span>
                    </div>
                  </label>
                </template>
              </div>
            </div>

            {{-- Hitung Button (Mobile Only) --}}
            <button 
              @click="hitungHarga()"
              class="w-full lg:hidden font-cta text-sm font-semibold px-6 py-3.5 rounded-[5px] text-white transition-all duration-300 shadow-md hover:shadow-lg"
              style="background-color: #3B82F6;">
              Lihat Estimasi Harga
            </button>
          </div>

          {{-- Right: Result --}}
          <div class="p-6 lg:p-8 flex flex-col" style="background-color: #F8FAFC;">
            <div class="flex-1">
              <h3 class="font-heading text-base md:text-lg font-bold mb-6" style="color: #0A2463;">
                Estimasi Harga
              </h3>

              {{-- Result Placeholder --}}
              <div x-show="!showResult" class="text-center py-12">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                <p class="font-body text-gray-400 text-sm">
                  Pilih spesifikasi produk <br>untuk melihat estimasi harga
                </p>
              </div>

              {{-- Result Content --}}
              <div x-show="showResult" x-cloak>
                {{-- Detail --}}
                <div class="space-y-4 mb-6">
                  <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <span class="font-body text-sm text-gray-500">Bahan</span>
                    <span class="font-body text-sm font-semibold text-gray-800" x-text="getBahanNama()"></span>
                  </div>
                  <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <span class="font-body text-sm text-gray-500">Lebar</span>
                    <span class="font-body text-sm font-semibold text-gray-800" x-text="selectedLebar + ' cm'"></span>
                  </div>
                  <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <span class="font-body text-sm text-gray-500">Jumlah</span>
                    <span class="font-body text-sm font-semibold text-gray-800" x-text="quantity + ' pcs'"></span>
                  </div>
                  <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <span class="font-body text-sm text-gray-500">Aksesoris</span>
                    <span class="font-body text-sm font-semibold text-gray-800">
                      <span x-show="selectedAksesoris.length === 0" class="text-gray-400">Tidak ada</span>
                      <span x-show="selectedAksesoris.length > 0" x-text="selectedAksesoris.length + ' item'"></span>
                    </span>
                  </div>
                </div>

                {{-- Harga Total --}}
                <div class="rounded-xl p-5 mb-6" style="background-color: #EFF6FF;">
                  <p class="font-body text-xs font-semibold mb-1" style="color: #2563EB;">ESTIMASI TOTAL</p>
                  <p class="font-heading text-3xl font-extrabold" style="color: #0A2463;">
                    Rp <span x-text="formatRupiah(totalHarga)"></span>
                  </p>
                  <p class="font-body text-xs mt-1" style="color: #60A5FA;">
                    <span x-text="'Rp ' + formatRupiah(hargaPerPcs) + ' /pcs'"></span>
                  </p>
                </div>

                {{-- Info Produksi --}}
                <div class="rounded-xl p-4 mb-4" style="background-color: #FEF3C7;">
                  <p class="font-body text-xs font-semibold text-amber-800">
                    ✅ Sudah termasuk kait + stopper
                  </p>
                  <p class="font-body text-xs font-semibold text-amber-800 mt-1">
                    ✅ Cetak 2 sisi Full Colour
                  </p>
                  <p class="font-body text-xs font-semibold text-amber-800 mt-1">
                    ✅ DP 50% sebelum produksi
                  </p>
                </div>

                {{-- Catatan --}}
                <p class="font-body text-xs text-gray-400 mb-6 leading-relaxed">
                  *Harga estimasi ini bersifat indikatif. Harga final dapat berbeda tergantung kerumitan desain dan biaya pengiriman.
                </p>

                {{-- CTA --}}
                <button 
                   @click="kirimPemesanan()"
                   :disabled="isSubmitting"
                   class="w-full font-cta text-sm font-semibold px-6 py-3.5 rounded-[5px] text-white transition-all duration-300 inline-flex items-center justify-center gap-2 shadow-md hover:shadow-lg disabled:opacity-50"
                   style="background-color: #25D366;">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" x-show="!isSubmitting">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                  </svg>
                  <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" x-show="isSubmitting" x-cloak>
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  <span x-text="isSubmitting ? 'Memproses...' : 'Pesan Sekarang'"></span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Alpine.js Component --}}
  <script>
    function kalkulatorData() {
      return {
        bahanList: @json($products),
        lebarList: @json($calculatorWidthOptions),
        aksesorisList: @json($accessories),
        moq: @json((int)$calculatorMoq),
        selectedBahan: @if(count($products) > 0) @json($products[0]['id']) @else null @endif,
        selectedLebar: @json($calculatorWidthOptions[0]['width'] ?? '1.5'),
        quantity: @json((int)$calculatorMoq),
        selectedAksesoris: [],
        showResult: false,
        totalHarga: 0,
        hargaPerPcs: 0,
        isSubmitting: false,

        init() {
          this.hitungHarga();
        },

        hitungHarga() {
          const bahan = this.bahanList.find(b => b.id === this.selectedBahan);
          const qty = parseInt(this.quantity) || 0;
          
          if (qty < this.moq) {
            this.showResult = false;
            return;
          }

          // Harga dasar per pcs berdasarkan tiering kuantitas produk dari DB
          let hargaDasar = 0;
          if (bahan && bahan.prices && bahan.prices.length > 0) {
            // cari tier yang cocok
            const tier = bahan.prices.find(p => {
              const min = parseInt(p.min_quantity);
              const max = p.max_quantity ? parseInt(p.max_quantity) : null;
              if (max) {
                return qty >= min && qty <= max;
              } else {
                return qty >= min;
              }
            });
            if (tier) {
              hargaDasar = parseFloat(tier.price_per_pcs);
            } else {
              // Jika kuantitas di bawah min_quantity tier pertama, gunakan harga tier pertama
              hargaDasar = parseFloat(bahan.prices[0].price_per_pcs);
            }
          } else {
            hargaDasar = bahan ? parseFloat(bahan.hargaMulai) : 0;
          }
          
          // Tambahan biaya lebar lanyard dari DB settings
          let biayaLebar = 0;
          const lebarOption = this.lebarList.find(l => l.width === this.selectedLebar);
          if (lebarOption) {
            biayaLebar = parseFloat(lebarOption.extra_price) || 0;
          }
          
          // Aksesoris terpilih
          let totalAksesoris = 0;
          this.selectedAksesoris.forEach(id => {
            const aks = this.aksesorisList.find(a => a.id === id);
            if (aks) {
              totalAksesoris += parseFloat(aks.harga);
            }
          });
          
          this.hargaPerPcs = Math.round(hargaDasar + biayaLebar + totalAksesoris);
          this.totalHarga = this.hargaPerPcs * qty;
          
          if (qty >= this.moq) {
            this.showResult = true;
          } else {
            this.showResult = false;
          }
        },

        getBahanNama() {
          const bahan = this.bahanList.find(b => b.id === this.selectedBahan);
          return bahan ? bahan.nama : '-';
        },

        formatRupiah(angka) {
          return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        },

        async kirimPemesanan() {
          if (this.quantity < this.moq) {
            alert('Jumlah pesanan minimal ' + this.moq + ' pcs');
            return;
          }
          
          this.isSubmitting = true;
          
          try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const response = await fetch('/admin/order-logs/store', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
              },
              body: JSON.stringify({
                product_id: this.selectedBahan,
                quantity: this.quantity,
                lebar: this.selectedLebar,
                accessories: this.selectedAksesoris,
                base_price: this.hargaPerPcs - this.selectedAksesoris.reduce((sum, id) => {
                  const aks = this.aksesorisList.find(a => a.id === id);
                  return sum + (aks ? parseFloat(aks.harga) : 0);
                }, 0),
                accessory_price: this.selectedAksesoris.reduce((sum, id) => {
                  const aks = this.aksesorisList.find(a => a.id === id);
                  return sum + (aks ? parseFloat(aks.harga) : 0);
                }, 0),
                total_price: this.totalHarga
              })
            });

            const data = await response.json();
            
            if (response.ok && data.redirect_url) {
              window.open(data.redirect_url, '_blank');
            } else {
              alert(data.message || 'Terjadi kesalahan saat memproses pesanan.');
            }
          } catch (error) {
            console.error(error);
            alert('Gagal menghubungi server. Silakan coba lagi.');
          } finally {
            this.isSubmitting = false;
          }
        }
      }
    }
  </script>
</section>
</section>
