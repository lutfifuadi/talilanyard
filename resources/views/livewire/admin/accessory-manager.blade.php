<div>
    @section('title', 'Kelola Aksesoris')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Daftar Aksesoris</h4>
        <button wire:click="openCreateModal" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Aksesoris Baru
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
                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Cari nama atau kode aksesoris...">
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Kode Aksesoris</th>
                        <th>Nama Aksesoris</th>
                        <th>Harga per Pcs (Rp)</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($accessories as $acc)
                        <tr>
                            <td><code>{{ $acc->code }}</code></td>
                            <td><strong>{{ $acc->name }}</strong></td>
                            <td>Rp {{ number_format($acc->price, 0, ',', '.') }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="activeSwitch{{ $acc->id }}" 
                                        {{ $acc->is_active ? 'checked' : '' }} wire:click="toggleActive({{ $acc->id }})">
                                    <label class="form-check-label" for="activeSwitch{{ $acc->id }}">
                                        {{ $acc->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button wire:click="openEditModal({{ $acc->id }})" class="btn btn-sm btn-icon btn-label-secondary" title="Edit Aksesoris">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button onclick="confirm('Apakah Anda yakin ingin menghapus aksesoris ini?') || event.stopImmediatePropagation()" 
                                        wire:click="deleteAccessory({{ $acc->id }})" class="btn btn-sm btn-icon btn-label-danger" title="Hapus Aksesoris">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Tidak ada aksesoris ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer pb-0">
            {{ $accessories->links() }}
        </div>
    </div>

    <!-- Accessory Form Modal -->
    @if($isFormOpen)
        <div class="modal fade show" tabindex="-1" style="display: block; background: rgba(0,0,0,0.5);" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $accessoryId ? 'Edit Aksesoris' : 'Tambah Aksesoris Baru' }}</h5>
                        <button type="button" class="btn-close" wire:click="$set('isFormOpen', false)" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="saveAccessory">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="code" class="form-label">Kode Aksesoris (Unique)</label>
                                <input wire:model="code" type="text" id="code" class="form-control @error('code') is-invalid @enderror" placeholder="Contoh: stopper_plastik" {{ $accessoryId ? 'readonly' : '' }}>
                                @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <small class="text-muted">Kode identifikasi sistem. Contoh: <code>stopper_plastik</code></small>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Aksesoris</label>
                                <input wire:model="name" type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Stopper Plastik">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Harga Satuan (Rp)</label>
                                <input wire:model="price" type="number" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Contoh: 500">
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch mt-4">
                                    <input wire:model="is_active" class="form-check-input" type="checkbox" id="modalActive">
                                    <label class="form-check-label" for="modalActive">Aktifkan Aksesoris</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" wire:click="$set('isFormOpen', false)">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
