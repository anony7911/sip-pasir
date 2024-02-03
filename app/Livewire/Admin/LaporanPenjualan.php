<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Penjualan;

class LaporanPenjualan extends Component
{
    public $tanggal_awal, $tanggal_akhir;

    public function render()
    {
        return view('livewire.admin.laporan-penjualan')->title('Laporan Penjualan');
    }

    public function cetak()
    {
        date_default_timezone_set('Asia/Makassar');

        // $image = base64_encode(file_get_contents(url('/assets/img/logokoltim.png')));
        // $image1 = base64_encode(file_get_contents(url('/assets/img/bpbd.png')));

        $data = Penjualan::whereBetween('tanggal_pengantaran', [$this->tanggal_awal, $this->tanggal_akhir])->get();

        $tglNow = Carbon::now();

        $pdf = \Pdf::loadView('livewire.admin.pdf-laporan-penjualan', compact('data', 'tglNow'))->setOptions(['defaultFont' => 'sans-serif'])->output();
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
        }, Carbon::now()->format('Y-m-d') . '-Laporan-Penjualan' . '.pdf'
        );
    }
}
