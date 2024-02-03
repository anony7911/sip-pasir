<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Keranjang extends Component
{
    #[Layout('layouts.app')]

    public $latitude, $longitude, $produkId, $jumlah, $alamat_pengantaran, $keranjangId;

    public $produk_id, $pelanggan_id, $harga, $total, $tanggal_pengantaran, $jarak, $pembayaran;

    public function render()
    {
        $keranjangs = \App\Models\Keranjang::where('pelanggan_id', Pelanggan::where('user_id', Auth::user()->id)->first()->id)->get();
        return view('livewire.user.keranjang', compact('keranjangs'))->title('Keranjang');
    }

    public function delete($id)
    {
        $keranjang = \App\Models\Keranjang::find($id);
        $keranjang->delete();
        session()->flash('message', 'Data berhasil dihapus');
    }

    public function checkout()
    {
        $this->validate([
            'pembayaran' => 'required',
            'tanggal_pengantaran' => 'required',
        ],[
            'pembayaran.required' => 'Pembayaran tidak boleh kosong',
            'tanggal_pengantaran.required' => 'Tanggal pengantaran tidak boleh kosong',
        ]);

        $keranjangs = \App\Models\Keranjang::where('pelanggan_id', Pelanggan::where('user_id', Auth::user()->id)->first()->id)->get();

        // ambil semua supir
        $supirs = \App\Models\Kendaraan::all();

        // jumlahkan semua supir
        $jumlahSupir = $supirs->count();
        
        foreach ($keranjangs as $keranjang) {
            // hitung jarak dari keranjang->longitude dan keranjang->latitude.
            $lat0 = -4.6746611;
            $long0 = 121.407311;

            // lat1 adalah latitude tujuan
            // long1 adalah longitude tujuan
            $lat1 = $keranjang->latitude;
            $long1 = $keranjang->longitude;

            // buat perhitungan jarak dalam satuan km
            // konversi ke radian
            $lat0 = $lat0 * M_PI / 180;
            $long0 = $long0 * M_PI / 180;
            $lat1 = $lat1 * M_PI / 180;
            $long1 = $long1 * M_PI / 180;

            // hitung jarak
            $jarak = 6371 * acos(cos($lat0) * cos($lat1) * cos($long1 - $long0) + sin($lat0) * sin($lat1));

            $penjualan = Penjualan::create([
                'produk_id' => $keranjang->produk_id,
                'pelanggan_id' => $keranjang->pelanggan_id,
                'jumlah' => $keranjang->jumlah,
                'total' => $keranjang->total,
                'tanggal_pengantaran' => $this->tanggal_pengantaran,
                'jarak' => $jarak,
                'pembayaran' => $this->pembayaran,
                'alamat_pengantaran' => $keranjang->alamat_pengantaran,
                'long' => $keranjang->longitude,
                'lat' => $keranjang->latitude,
            ]);
        }



        $jumlahTruk = $this->jumlah;
        $jumlahTrukPerSupir = floor($jumlahTruk / $jumlahSupir);
        $sisaTruk = $jumlahTruk % $jumlahSupir;

        foreach ($supirs as $index => $supir) {
            // Berikan jumlah truk per supir
            $jumlahTrukSupir = $jumlahTrukPerSupir;

            // Jika masih terdapat sisa truk, berikan satu truk ekstra
            if ($index < $sisaTruk) {
                $jumlahTrukSupir++;
            }

            // buat penugasan
            \App\Models\Penugasan::create([
                'penjualan_id' => $penjualan->id,
                'kendaraan_id' => $supir->id,
                'jumlah_truk' => $jumlahTrukSupir,
                'status' => 'belum',
            ]);
        }

        // hapus semua keranjang
        \App\Models\Keranjang::where('pelanggan_id', Pelanggan::where('user_id', Auth::user()->id)->first()->id)->delete();

        return redirect()->route('user-pesanan');
        session()->flash('message', 'Pesanan berhasil dilakukan. Silahkan tunggu konfirmasi ongkir dari admin.');
    }

}
