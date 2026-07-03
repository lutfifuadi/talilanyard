<div>
    @section('title', 'Kelola Produk')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Daftar Produk</h4>
        <button wire:click="openCreateModal" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Produk Baru
        </button>
    </div>

    <!-- Alert Message -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Table Card -->
    <div class="card mb-4">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Cari nama atau deskripsi produk...">
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Slug</th>
                        <th>Harga Terendah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                @if($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="rounded" width="50" height="50" style="object-fit: cover;">
                                @else
                                    <span class="badge bg-label-secondary p-2"><i class="ti ti-photo ti-md"></i></span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $product->name }}</strong>
                                <div class="text-muted text-wrap" style="max-width: 300px;"><small>{{ Str::limit($product->description, 60) }}</small></div>
                            </td>
                            <td><code>{{ $product->slug }}</code></td>
                            <td>
                                @if($product->prices->isNotEmpty())
                                    Rp {{ number_format($product->prices->last()->price_per_pcs, 0, ',', '.') }}
                                @else
                                    <span class="text-danger">Belum diset</span>
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="activeSwitch{{ $product->id }}" 
                                        {{ $product->is_active ? 'checked' : '' }} wire:click="toggleActive({{ $product->id }})">
                                    <label class="form-check-label" for="activeSwitch{{ $product->id }}">
                                        {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button wire:click="openEditModal({{ $product->id }})" class="btn btn-sm btn-icon btn-label-secondary" title="Edit Produk">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button wire:click="openPriceModal({{ $product->id }})" class="btn btn-sm btn-icon btn-label-info" title="Kelola Harga Grosir">
                                        <i class="ti ti-currency-dollar"></i>
                                    </button>
                                    <button onclick="confirm('Apakah Anda yakin ingin menghapus produk ini? Semua tier harga juga akan terhapus.') || event.stopImmediatePropagation()" 
                                        wire:click="deleteProduct({{ $product->id }})" class="btn btn-sm btn-icon btn-label-danger" title="Hapus Produk">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Tidak ada produk ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer pb-0">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Product Form Modal -->
    @if($isFormOpen)
        <div class="modal fade show" tabindex="-1" style="display: block; background: rgba(0,0,0,0.5);" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $productId ? 'Edit Produk' : 'Tambah Produk Baru' }}</h5>
                        <button type="button" class="btn-close" wire:click="$set('isFormOpen', false)" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="saveProduct">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input wire:model="name" type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Tisue Premium">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea wire:model="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Deskripsi produk..."></textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar Produk</label>
                                <input wire:model="image" type="file" id="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div wire:loading wire:target="image" class="text-primary mt-1"><small>Mengunggah gambar...</small></div>

                                @if ($image)
                                    <div class="mt-2 text-center">
                                        <p class="mb-1 text-muted"><small>Pratinjau Gambar Baru:</small></p>
                                        <img src="{{ $image->temporaryUrl() }}" class="rounded shadow-sm" width="100" style="object-fit: cover;">
                                    </div>
                                @elseif ($existingImage)
                                    <div class="mt-2 text-center">
                                        <p class="mb-1 text-muted"><small>Gambar Saat Ini:</small></p>
                                        <img src="{{ asset('storage/' . $existingImage) }}" class="rounded shadow-sm" width="100" style="object-fit: cover;">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch mt-4">
                                    <input wire:model="is_active" class="form-check-input" type="checkbox" id="modalActive">
                                    <label class="form-check-label" for="modalActive">Aktifkan Produk</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" wire:click="$set('isFormOpen', false)">Batal</button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="saveProduct">Simpan</span>
                                <span wire:loading wire:target="saveProduct" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Price Modal (Inline dynamic CRUD tier harga grosir) -->
    @if($isPriceModalOpen)
        <div class="modal fade show" tabindex="-1" style="display: block; background: rgba(0,0,0,0.5);" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title">Kelola Tier Harga Grosir</h5>
                            <small class="text-muted">Produk: {{ $selectedProductForPrices->name }}</small>
                        </div>
                        <button type="button" class="btn-close" wire:click="$set('isPriceModalOpen', false)" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="saveTierPrices">
                        <div class="modal-body">
                            @if (session()->has('price_message'))
                                <div class="alert alert-success">{{ session('price_message') }}</div>
                            @endif

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Tier Harga (Urutkan dari Qty Terendah)</h6>
                                <button type="button" wire:click="addPriceTier" class="btn btn-sm btn-outline-primary">
                                    <i class="ti ti-plus me-1"></i> Tambah Tier
                                </button>
                            </div>

                            <div class="table-responsive text-nowrap border rounded">
                                <table class="table table-sm table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Min Qty (Pcs)</th>
                                            <th>Max Qty (Pcs)</th>
                                            <th>Harga per Pcs (Rp)</th>
                                            <th style="width: 50px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tierPrices as $index => $tier)
                                            <tr>
                                                <td>
                                                    <input type="number" wire:model="tierPrices.{{ $index }}.min_quantity" class="form-control form-control-sm @error('tierPrices.'.$index.'.min_quantity') is-invalid @enderror" min="1" placeholder="Min Qty">
                                                    @error('tierPrices.'.$index.'.min_quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </td>
                                                <td>
                                                    <input type="number" wire:model="tierPrices.{{ $index }}.max_quantity" class="form-control form-control-sm @error('tierPrices.'.$index.'.max_quantity') is-invalid @enderror" placeholder="Tak Terhingga (kosongkan)">
                                                    @error('tierPrices.'.$index.'.max_quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </td>
                                                <td>
                                                    <input type="number" wire:model="tierPrices.{{ $index }}.price_per_pcs" class="form-control form-control-sm @error('tierPrices.'.$index.'.price_per_pcs') is-invalid @enderror" min="0" placeholder="Harga per pcs">
                                                    @error('tierPrices.'.$index.'.price_per_pcs') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" wire:click="removePriceTier({{ $index }})" class="btn btn-xs btn-label-danger btn-icon">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-3 text-muted">Belum ada tier harga grosir. Klik "Tambah Tier" untuk memulai.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" wire:click="$set('isPriceModalOpen', false)">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Tier Harga</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
