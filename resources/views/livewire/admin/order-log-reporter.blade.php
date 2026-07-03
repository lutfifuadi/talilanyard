<div>
    @section('title', 'Laporan Klik WA')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Laporan Log Klik WhatsApp</h4>
        <button wire:click="exportCsv" class="btn btn-success">
            <i class="ti ti-download me-1"></i> Ekspor CSV
        </button>
    </div>

    <!-- Filters Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="search" class="form-label">Cari Produk</label>
                    <input wire:model.live.debounce.300ms="search" type="text" id="search" class="form-control" placeholder="Cari nama produk...">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="startDate" class="form-label">Tanggal Mulai</label>
                    <input wire:model.live="startDate" type="date" id="startDate" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="endDate" class="form-label">Tanggal Selesai</label>
                    <input wire:model.live="endDate" type="date" id="endDate" class="form-control">
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button wire:click="resetFilters" class="btn btn-label-secondary w-100">
                        <i class="ti ti-refresh me-1"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Produk</th>
                        <th>Jumlah (Pcs)</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Harga Aksesoris (Rp)</th>
                        <th>Total Estimasi (Rp)</th>
                        <th>Aksesoris Tambahan</th>
                        <th>IP Address / Browser</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            <td><strong>{{ $log->product->name ?? 'Produk Terhapus' }}</strong></td>
                            <td>{{ number_format($log->quantity) }}</td>
                            <td>Rp {{ number_format($log->base_price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($log->accessory_price, 0, ',', '.') }}</td>
                            <td><strong>Rp {{ number_format($log->total_price, 0, ',', '.') }}</strong></td>
                            <td>
                                @if($log->accessories->isNotEmpty())
                                    @foreach ($log->accessories as $acc)
                                        <span class="badge bg-label-secondary me-1">{{ $acc->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted" title="{{ $log->user_agent }}">
                                    {{ $log->ip_address }} / {{ Str::limit($log->user_agent, 40) }}
                                </small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Tidak ada log aktivitas ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer pb-0">
            {{ $logs->links() }}
        </div>
    </div>
</div>
