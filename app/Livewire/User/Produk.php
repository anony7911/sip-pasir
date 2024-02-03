<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Pelanggan;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Http;

class Produk extends Component
{
    #[Layout('layouts.app')]

    public $latitude, $longitude, $produkId, $jumlah = 1, $alamat_pengantaran;

    public function render()
    {
        $produks = \App\Models\Produk::all();
        $longitude = $this->longitude;
        $latitude = $this->latitude;
        return view('livewire.user.produk', compact('produks', 'longitude', 'latitude'))->title('Produk');
    }

    public function detail($id)
    {
        $produk = \App\Models\Produk::find($id);
        $this->produkId = $produk->id;
    }

    public function keranjang()
    {
        $this->validate([
            'jumlah' => 'required|numeric|min:1',
            'alamat_pengantaran' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'alamat_pengantaran' => 'required',
        ],[
            'jumlah.required' => 'Jumlah tidak boleh kosong',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'alamat_pengantaran.required' => 'Alamat pengantaran tidak boleh kosong',
            'latitude.required' => 'Lokasi tidak boleh kosong',
            'longitude.required' => 'Lokasi tidak boleh kosong',
            'alamat_pengantaran.required' => 'Alamat pengantaran tidak boleh kosong',
        ]);

        $produk = \App\Models\Produk::find($this->produkId);
        $harga = $produk->harga;
        $total = $harga * $this->jumlah;

        $keranjang = \App\Models\Keranjang::create([
            'produk_id' => $this->produkId,
            'pelanggan_id' => Pelanggan::where('user_id', auth()->user()->id)->first()->id,
            'jumlah' => $this->jumlah,
            'harga' => $harga,
            'total' => $total,
            'alamat_pengantaran' => $this->alamat_pengantaran,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        return redirect()->route('user-keranjang');
        session()->flash('message', 'Berhasil menambahkan produk ke keranjang');
    }
}
