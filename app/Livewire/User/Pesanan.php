<?php

namespace App\Livewire\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Pesanan extends Component
{
    #[Layout('layouts.app')]

    public function render()
    {
        $pesanans = \App\Models\Penjualan::where('pelanggan_id', \App\Models\Pelanggan::where('user_id', auth()->user()->id)->first()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('livewire.user.pesanan', compact('pesanans'))->title('Pesanan');
    }

    public function batalkan($id)
    {
        $penjualan = \App\Models\Penjualan::find($id);
        $penjualan->update([
            'status' => 'batal'
        ]);

        session()->flash('success', 'Pesanan berhasil dibatalkan');
    }
}
