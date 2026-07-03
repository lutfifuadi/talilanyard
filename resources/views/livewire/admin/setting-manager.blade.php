<div>
    @section('title', 'Konfigurasi Aplikasi')

    <h4 class="mb-4">Pengaturan General</h4>

    <!-- Alert Message -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header pb-0">
            <h5 class="card-title mb-0">Informasi Kontak & Sosial Media</h5>
            <small class="text-muted">Gunakan data valid agar redirect WhatsApp dan Footer Link berjalan normal.</small>
        </div>
        <div class="card-body mt-3">
            <form wire:submit.prevent="saveSettings">
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

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="saveSettings">Simpan Perubahan</span>
                        <span wire:loading wire:target="saveSettings" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
