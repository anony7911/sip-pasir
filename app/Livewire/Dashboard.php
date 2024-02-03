<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        // TOTAL PESANAN, TOTAL PENDAPATAN, PESANAN SELESAI, PESANAN MENUNGGU
        $totalPesanan = \App\Models\Penjualan::count();
        $totalPendapatan = \App\Models\Penjualan::sum('total');
        $pesananSelesai = \App\Models\Penjualan::where('status', 'selesai')->count();
        $pesananMenunggu = \App\Models\Penjualan::where('status', 'menunggu')->count();
        return view('livewire.dashboard', compact('totalPesanan', 'totalPendapatan', 'pesananSelesai', 'pesananMenunggu'))->title('Dashboard');
    }
}
