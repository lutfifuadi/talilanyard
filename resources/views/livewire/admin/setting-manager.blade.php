<div>
    @section('title', 'Konfigurasi Aplikasi')

    <h4 class="mb-4">Konfigurasi Aplikasi</h4>

    <!-- Alert Message -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form wire:submit.prevent="saveSettings">
        <!-- Card 1: Branding & Identitas -->
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5 class="card-title mb-0">Branding & Identitas</h5>
                <small class="text-muted">Atur nama brand, teks logo, dan jam operasional website.</small>
            </div>
            <div class="card-body mt-3">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="brand_name" class="form-label">Nama Brand</label>
                        <input wire:model="brand_name" type="text" id="brand_name" class="form-control @error('brand_name') is-invalid @enderror" placeholder="Contoh: AzagiPrint">
                        @error('brand_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="logo_text" class="form-label">Teks Logo</label>
                        <input wire:model="logo_text" type="text" id="logo_text" class="form-control @error('logo_text') is-invalid @enderror" placeholder="Contoh: AzagiPrint Lanyard">
                        @error('logo_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="operating_hours" class="form-label">Jam Operasional</label>
                        <input wire:model="operating_hours" type="text" id="operating_hours" class="form-control @error('operating_hours') is-invalid @enderror" placeholder="Contoh: Senin - Sabtu: 08.00 - 17.00 WIB">
                        @error('operating_hours') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Hero Section & SEO -->
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5 class="card-title mb-0">Hero Section & SEO</h5>
                <small class="text-muted">Konfigurasi tampilan utama halaman depan dan metadata SEO.</small>
            </div>
            <div class="card-body mt-3">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="hero_title" class="form-label">Judul Utama (Hero Title)</label>
                        <input wire:model="hero_title" type="text" id="hero_title" class="form-control @error('hero_title') is-invalid @enderror" placeholder="Contoh: Cetak Tali Lanyard">
                        @error('hero_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="hero_subtitle" class="form-label">Subjudul (Hero Subtitle)</label>
                        <input wire:model="hero_subtitle" type="text" id="hero_subtitle" class="form-control @error('hero_subtitle') is-invalid @enderror" placeholder="Contoh: Berkualitas #1 di Jakarta">
                        @error('hero_subtitle') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="meta_description" class="form-label">Deskripsi Meta (SEO)</label>
                        <textarea wire:model="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="3" placeholder="Deskripsi untuk hasil pencarian Google..."></textarea>
                        @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Social Proof / Statistik Trust -->
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5 class="card-title mb-0">Statistik Trust / Social Proof</h5>
                <small class="text-muted">Menampilkan angka pencapaian perusahaan di halaman depan.</small>
            </div>
            <div class="card-body mt-3">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="trust_customer" class="form-label">Pelanggan Puas</label>
                        <input wire:model="trust_customer" type="number" id="trust_customer" class="form-control @error('trust_customer') is-invalid @enderror" placeholder="Contoh: 1200">
                        @error('trust_customer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="trust_product" class="form-label">Pilihan Produk</label>
                        <input wire:model="trust_product" type="number" id="trust_product" class="form-control @error('trust_product') is-invalid @enderror" placeholder="Contoh: 272">
                        @error('trust_product') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="trust_completed" class="form-label">Project Selesai</label>
                        <input wire:model="trust_completed" type="number" id="trust_completed" class="form-control @error('trust_completed') is-invalid @enderror" placeholder="Contoh: 566">
                        @error('trust_completed') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Kalkulator & Opsi Lebar Lanyard -->
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5 class="card-title mb-0">Pengaturan Kalkulator Lanyard</h5>
                <small class="text-muted">Atur batas minimal order (MOQ) dan kelola pilihan lebar lanyard beserta biaya tambahannya.</small>
            </div>
            <div class="card-body mt-3">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="calculator_moq" class="form-label font-weight-bold">Minimum Order Quantity (MOQ)</label>
                        <input wire:model="calculator_moq" type="number" id="calculator_moq" class="form-control @error('calculator_moq') is-invalid @enderror" placeholder="Contoh: 40">
                        @error('calculator_moq') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="my-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Pilihan Lebar Lanyard & Biaya Tambahan</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary" wire:click="addWidthOption">
                        <i class="ti ti-plus me-1"></i> Tambah Pilihan Lebar
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Lebar Lanyard (cm)</th>
                                <th>Biaya Tambahan (Rp)</th>
                                <th class="text-center" style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($calculator_width_options as $index => $option)
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <input type="number" step="0.1" wire:model="calculator_width_options.{{ $index }}.width" class="form-control @error('calculator_width_options.'.$index.'.width') is-invalid @enderror" placeholder="Contoh: 1.5">
                                            <span class="input-group-text">cm</span>
                                            @error('calculator_width_options.'.$index.'.width')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" wire:model="calculator_width_options.{{ $index }}.extra_price" class="form-control @error('calculator_width_options.'.$index.'.extra_price') is-invalid @enderror" placeholder="Contoh: 500">
                                            @error('calculator_width_options.'.$index.'.extra_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-label-danger" wire:click="removeWidthOption({{ $index }})">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        Belum ada pilihan lebar lanyard. Klik tombol "Tambah Pilihan Lebar" di atas untuk menambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Card 5: Informasi Kontak & Sosial Media -->
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5 class="card-title mb-0">Informasi Kontak & Sosial Media</h5>
                <small class="text-muted">Gunakan data valid agar redirect WhatsApp dan Footer Link berjalan normal.</small>
            </div>
            <div class="card-body mt-3">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="whatsapp_number" class="form-label">Nomor WhatsApp Admin (Gunakan format 62...)</label>
                        <input wire:model="whatsapp_number" type="text" id="whatsapp_number" class="form-control @error('whatsapp_number') is-invalid @enderror" placeholder="Contoh: 6282113328585">
                        @error('whatsapp_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Tuliskan angka saja tanpa spasi, tanda tambah (+), atau tanda strip (-).</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email Kontak</label>
                        <input wire:model="email" type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Contoh: info@cetaktalilanyard.com">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="address" class="form-label">Alamat Kantor/Toko</label>
                        <textarea wire:model="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3" placeholder="Jl. Percetakan Raya No. 45, Jakarta"></textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <hr class="my-4">
                    <h5 class="mb-3 px-3">Tautan Media Sosial</h5>

                    <div class="col-md-4 mb-3">
                        <label for="instagram_url" class="form-label">Link Instagram</label>
                        <input wire:model="instagram_url" type="text" id="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" placeholder="https://instagram.com/akun">
                        @error('instagram_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="facebook_url" class="form-label">Link Facebook</label>
                        <input wire:model="facebook_url" type="text" id="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" placeholder="https://facebook.com/halaman">
                        @error('facebook_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="tiktok_url" class="form-label">Link TikTok</label>
                        <input wire:model="tiktok_url" type="text" id="tiktok_url" class="form-control @error('tiktok_url') is-invalid @enderror" placeholder="https://tiktok.com/@akun">
                        @error('tiktok_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="saveSettings">Simpan Perubahan</span>
                <span wire:loading wire:target="saveSettings" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            </button>
        </div>
    </form>
</div>
