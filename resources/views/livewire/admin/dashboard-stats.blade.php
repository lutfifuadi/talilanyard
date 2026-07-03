<div>
    @section('title', 'Admin Dashboard')

    <div class="row g-6 mb-6">
        <!-- Total Products Card -->
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Total Produk</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $totalProducts }}</h4>
                            </div>
                            <small class="mb-0">Katalog Produk Aktif</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="ti ti-package ti-lg"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Accessories Card -->
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Total Aksesoris</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $totalAccessories }}</h4>
                            </div>
                            <small class="mb-0">Pilihan Aksesoris Lanyard</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="ti ti-link ti-lg"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clicks Today Card -->
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Klik WA Hari Ini</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $todayClicks }}</h4>
                            </div>
                            <small class="mb-0">Akumulasi Klik Hari Ini</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-info">
                                <i class="ti ti-brand-whatsapp ti-lg"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clicks This Month Card -->
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Klik WA Bulan Ini</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $monthClicks }}</h4>
                            </div>
                            <small class="mb-0">Akumulasi Bulan Berjalan</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="ti ti-calendar ti-lg"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Order Logs Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Log Klik WhatsApp Terbaru (Maks. 10 Data)</h5>
            <a href="{{ route('admin.order-logs') }}" class="btn btn-primary btn-sm">
                <i class="ti ti-eye me-1"></i> Lihat Semua Laporan
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Produk</th>
                        <th>Jumlah (Pcs)</th>
                        <th>Aksesoris Tambahan</th>
                        <th>Total Estimasi</th>
                        <th>IP Address / Browser</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($recentLogs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            <td><strong>{{ $log->product->name ?? 'Produk Terhapus' }}</strong></td>
                            <td>{{ number_format($log->quantity) }}</td>
                            <td>
                                @if($log->accessories->isNotEmpty())
                                    @foreach ($log->accessories as $acc)
                                        <span class="badge bg-label-secondary me-1">{{ $acc->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($log->total_price, 0, ',', '.') }}</td>
                            <td>
                                <small class="text-muted" title="{{ $log->user_agent }}">
                                    {{ $log->ip_address }} / {{ Str::limit($log->user_agent, 30) }}
                                </small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada log klik WhatsApp terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
