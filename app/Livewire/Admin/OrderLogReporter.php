<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OrderLog;
use Illuminate\Support\Facades\Response;

class OrderLogReporter extends Component
{
    use WithPagination;

    public $search = '';
    public $startDate = '';
    public $endDate = '';

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
        'startDate' => ['except' => ''],
        'endDate' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStartDate()
    {
        $this->resetPage();
    }

    public function updatingEndDate()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->startDate = '';
        $this->endDate = '';
        $this->resetPage();
    }

    public function exportCsv()
    {
        $query = OrderLog::with(['product', 'accessories'])
            ->when($this->search, function ($q) {
                $q->whereHas('product', function ($pq) {
                    $pq->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->startDate, function ($q) {
                $q->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($q) {
                $q->whereDate('created_at', '<=', $this->endDate);
            })
            ->latest();

        $logs = $query->get();

        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=log-klik-wa-" . date('Ymd-His') . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for proper excel reading
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // CSV Header
            fputcsv($file, ['Tanggal & Waktu', 'Produk', 'Jumlah (Pcs)', 'Harga Dasar', 'Harga Aksesoris', 'Total Harga', 'Aksesoris Tambahan', 'IP Address', 'User Agent']);

            foreach ($logs as $log) {
                $accessoriesStr = $log->accessories->pluck('name')->implode(', ');
                fputcsv($file, [
                    $log->created_at->format('Y-m-d H:i:s'),
                    $log->product->name ?? 'Produk Terhapus',
                    $log->quantity,
                    $log->base_price,
                    $log->accessory_price,
                    $log->total_price,
                    $accessoriesStr ?: '-',
                    $log->ip_address,
                    $log->user_agent
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function render()
    {
        $query = OrderLog::with(['product', 'accessories'])
            ->when($this->search, function ($q) {
                $q->whereHas('product', function ($pq) {
                    $pq->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->startDate, function ($q) {
                $q->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($q) {
                $q->whereDate('created_at', '<=', $this->endDate);
            })
            ->latest();

        return view('livewire.admin.order-log-reporter', [
            'logs' => $query->paginate(15),
        ])->layout('layouts.layoutMaster');
    }
}
