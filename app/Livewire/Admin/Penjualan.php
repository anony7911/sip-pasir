<?php

namespace App\Livewire\Admin;

use App\Models\Penjualan as ModelsPenjualan;
use Livewire\Component;
use Livewire\WithPagination;

class Penjualan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search;

    public $produk_id, $pelanggan_id, $jumlah, $long, $lat, $jarak, $ongkir, $total, $pembayaran, $status, $penjualan_id, $harga;

    public $nama, $email, $password, $telepon, $alamat, $jenis_kelamin, $perusahaan;

    public $tanggal_pengantaran, $alamat_pengantaran;

    public $currentStep = 1;

    // TAMBAH
    public $tambahPenjualan = false;

    public function render()
    {
        $totalSteps = 3;
        $stepLabels = [
            '1' => 'Informasi Pelanggan',
            '2' => 'Produk & Pengiriman',
            '3' => 'Harga & Pembayaran',
        ];

        $currentStep = $this->currentStep;

        $penjualans = ModelsPenjualan::join('produks', 'penjualans.produk_id', '=', 'produks.id')
            ->join('pelanggans', 'penjualans.pelanggan_id', '=', 'pelanggans.id')
            ->select('penjualans.*', 'produks.nama_produk', 'pelanggans.nama')
            ->orderBy('penjualans.created_at', 'DESC')
            ->paginate($this->paginate);
        $produks = \App\Models\Produk::all();
        return view('livewire.admin.penjualan',compact('penjualans', 'totalSteps', 'stepLabels', 'currentStep','produks'))->title('Penjualan');
    }

    public function edit($id){
        $penjualan = ModelsPenjualan::find($id);
        $this->penjualan_id = $penjualan->id;
        $this->produk_id = $penjualan->produk_id;
    }

    public function resetInputFields()
    {
        $this->nama = '';
        $this->email = '';
        $this->password = '';
        $this->telepon = '';
        $this->alamat = '';
        $this->jenis_kelamin = '';
        $this->perusahaan = '';

        $this->produk_id = '';
        $this->jumlah = '';
        $this->tanggal_pengantaran = '';
        $this->alamat_pengantaran = '';
        $this->long = '';
        $this->lat = '';
        $this->jarak = '';
        $this->ongkir = '';
        $this->total = '';
        $this->pembayaran = '';
        $this->status = '';
    }

    public function nextStep()
    {
        $this->validateStep();

        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    // function hitung jarak
    public function hitungJarak($lat0, $long0, $lat1, $long1)
    {
        // konversi ke radian
        $lat0 = $lat0 * M_PI / 180;
        $long0 = $long0 * M_PI / 180;
        $lat1 = $lat1 * M_PI / 180;
        $long1 = $long1 * M_PI / 180;

        // hitung jarak
        $jarak = 6371 * acos(cos($lat0) * cos($lat1) * cos($long1 - $long0) + sin($lat0) * sin($lat1));

        return $jarak; // jarak dalam kilometer
    }

    private function validateStep()
    {
        // Lakukan validasi berdasarkan langkah
        if ($this->currentStep == 1) {
            $this->validate([
                'nama' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'telepon' => 'required',
                'alamat' => 'required',
                'jenis_kelamin' => 'required',
                'perusahaan' => 'required',
            ],[
                'nama.required' => 'Nama tidak boleh kosong',
                'nama.min' => 'Nama minimal 3 karakter',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 6 karakter',
                'telepon.required' => 'Telepon tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
                'perusahaan.required' => 'Perusahaan tidak boleh kosong',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'produk_id' => 'required',
                'jumlah' => 'required',
                'tanggal_pengantaran' => 'required',
                'alamat_pengantaran' => 'required',
                'lat' => 'required',
                'long' => 'required',
            ],[
                'produk_id.required' => 'Produk tidak boleh kosong',
                'jumlah.required' => 'Jumlah tidak boleh kosong',
                'tanggal_pengantaran.required' => 'Tanggal pengantaran tidak boleh kosong',
                'alamat_pengantaran.required' => 'Alamat pengantaran tidak boleh kosong',
                'lat.required' => 'Latitude tidak boleh kosong',
                'long.required' => 'Longitude tidak boleh kosong',
            ]);
            // lat0 adalah latitude awal
            // long0 adalah longitude awal

            $lat0 = -4.6746611;
            $long0 = 121.407311;

            // lat1 adalah latitude tujuan
            // long1 adalah longitude tujuan
            $lat1 = $this->lat;
            $long1 = $this->long;

            // ambil jarak dari function hitungJarak dalam satuan km
            $this->jarak = $this->hitungJarak($lat0, $long0, $lat1, $long1);

            // dapatkan total harga
            // dapatkan harga berdasarkan produk_id

        } elseif ($this->currentStep == 3) {
            $produk = \App\Models\Produk::find($this->produk_id);

            // Lakukan validasi untuk langkah 3
            // jarak
            $this->validate([
                'ongkir' => 'required',
                'pembayaran' => 'required',
            ],[
                'ongkir.required' => 'Ongkir tidak boleh kosong',
                'pembayaran.required' => 'Pembayaran tidak boleh kosong',
            ]);

            $jarak = $this->jarak;
        }
    }

    public function updateHarga()
    {
        // Your logic to update $harga based on $produk_id
        $produk = \App\Models\Produk::find($this->produk_id);
        $this->harga = $produk ? $produk->harga : null;
    }

    public function updateOngkir()
    {
        // ubah total berdasarkan ongkir
        // jika ongkir 0 maka total = harga * jumlah
        // jika ongkir > 0 maka total = (harga * jumlah) + ongkir
        $produk = \App\Models\Produk::find($this->produk_id);

        $this->total = $this->ongkir > 0 ? ($produk->harga * $this->jumlah) + $this->ongkir : $produk->harga * $this->jumlah;

        // dd($this->total);
    }

    public function submitForm(){

        $user = \App\Models\User::create([
            'name' => $this->nama,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => 'pelanggan',
        ]);

        $pelanggan = \App\Models\Pelanggan::create([
            'user_id' => $user->id,
            'nama' => $this->nama,
            'email' => $this->email,
            'telepon' => $this->telepon,
            'alamat' => $this->alamat,
            'jenis_kelamin' => $this->jenis_kelamin,
            'perusahaan' => $this->perusahaan,
        ]);

        $penjualan = \App\Models\Penjualan::create([
            'produk_id' => $this->produk_id,
            'pelanggan_id' => $pelanggan->id,
            'jumlah' => $this->jumlah,
            'tanggal_pengantaran' => $this->tanggal_pengantaran,
            'alamat_pengantaran' => $this->alamat_pengantaran,
            'long' => $this->long,
            'lat' => $this->lat,
            'jarak' => $this->jarak,
            'ongkir' => $this->ongkir,
            'total' => $this->total,
            'pembayaran' => $this->pembayaran,
            'status' => 'menunggu',
        ]);

        // ambil semua supir
        $supirs = \App\Models\Kendaraan::all();

        // jumlahkan semua supir
        $jumlahSupir = $supirs->count();

        $jumlahTruk = $this->jumlah;
        $jumlahTrukPerSupir = floor($jumlahTruk / $jumlahSupir);
        $sisaTruk = $jumlahTruk % $jumlahSupir;

        // jika jumlah truk dibagi jumlah supir tidak ada sisa
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

        // jika hasil bagi masih ada
        $this->currentStep = 1;
        $this->resetInputFields();
        $this->tambahPenjualan = false;
        session()->flash('message', 'Penjualan berhasil ditambahkan.');
    }

    public function delete($id)
    {
        // JIKA PENJUALAN_ID ADA DITABEL PENUGASAN MAKA HAPUS DULU
        $penugasan = \App\Models\Penugasan::where('penjualan_id', $id)->first();
        // HAPUS SEMUA PENUGASAN BERDASARKAN PENJUALAN_ID
        if ($penugasan) {
            \App\Models\Penugasan::where('penjualan_id', $id)->delete();
        }

        // HAPUS PENJUALAN
        $penjualan = ModelsPenjualan::find($id);
        $penjualan->delete();

        session()->flash('message', 'Penjualan berhasil dihapus.');
    }

    public function tambahAktif()
    {
        $this->tambahPenjualan = true;
    }

    public function tambahMati()
    {
        $this->tambahPenjualan = false;
    }

    public function addOngkir()
    {
        $this->validate([
            'ongkir' => 'required',
        ]);

        $penjualan = ModelsPenjualan::find($this->penjualan_id);

        ModelsPenjualan::find($this->penjualan_id)->update([
            'ongkir' => $this->ongkir,
            'total' => $penjualan->total + $this->ongkir,
            'status' => 'diproses',
        ]);

        $jumlahTruk = $penjualan->jumlah;
        $jumlahSupir = \App\Models\Kendaraan::count();

        $penugasan = \App\Models\Penugasan::where('penjualan_id', $this->penjualan_id)->get();

        if ($penugasan->count() > 0) {
            $this->updatePenugasan($penugasan, $jumlahTruk, $jumlahSupir);
        } else {
            $this->buatPenugasan($jumlahTruk, $jumlahSupir);
        }

        $this->resetInputFields();
        session()->flash('message', 'Ongkir berhasil diubah.');
    }

    public function buatPenugasan($jumlahTruk, $jumlahSupir)
    {
        $supirs = \App\Models\Kendaraan::all();
        $jumlahTrukPerSupir = floor($jumlahTruk / $jumlahSupir);
        $sisaTruk = $jumlahTruk % $jumlahSupir;

        foreach ($supirs as $index => $supir) {
            $jumlahTrukSupir = $jumlahTrukPerSupir;

            if ($index < $sisaTruk) {
                $jumlahTrukSupir++;
            }

            \App\Models\Penugasan::create([
                'penjualan_id' => $this->penjualan_id,
                'kendaraan_id' => $supir->id,
                'jumlah_truk' => $jumlahTrukSupir,
                'status' => 'belum',
            ]);
        }
    }

    public function updatePenugasan($penugasan, $jumlahTruk, $jumlahSupir)
    {
        $jumlahTrukPerSupir = floor($jumlahTruk / $jumlahSupir);
        $sisaTruk = $jumlahTruk % $jumlahSupir;

        foreach ($penugasan as $index => $supir) {
            $jumlahTrukSupir = $jumlahTrukPerSupir;

            if ($index < $sisaTruk) {
                $jumlahTrukSupir++;
            }

            \App\Models\Penugasan::where('penjualan_id', $this->penjualan_id)
                ->where('kendaraan_id', $supir->kendaraan_id)
                ->update([
                    'jumlah_truk' => $jumlahTrukSupir,
                ]);
        }
    }
}
