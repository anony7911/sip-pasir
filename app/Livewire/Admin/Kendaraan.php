<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kendaraan as ModelsKendaraan;

class Kendaraan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $nomor_polisi, $merk_kendaraan, $tipe_kendaraan, $tahun_operasi, $kendaraan_id, $nama_supir, $telepon_supir, $alamat_supir;
    public $nama, $password, $email, $role;
    public $paginate = 10;

    public function render()
    {
        $kendaraans = ModelsKendaraan::where('nomor_polisi', 'like', '%' . $this->search . '%')
            ->orWhere('merk_kendaraan', 'like', '%' . $this->search . '%')
            ->orWhere('nama_supir', 'like', '%' . $this->search . '%')
            ->orWhere('telepon_supir', 'like', '%' . $this->search . '%')
            ->orWhere('alamat_supir', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate, pageName: 'kendaraans');
        return view('livewire.admin.kendaraan',
            compact('kendaraans')
        )->title('Kendaraan');
    }

    public function resetInput()
    {
        $this->nomor_polisi = null;
        $this->merk_kendaraan = null;
        $this->tipe_kendaraan = null;
        $this->tahun_operasi = null;
        $this->kendaraan_id = null;
        $this->nama_supir = null;
        $this->telepon_supir = null;
        $this->alamat_supir = null;
        $this->nama = null;
        $this->email = null;
        $this->password = null;

    }

    public function store()
    {
        $this->validate([
            'nomor_polisi' => 'required|min:3',
            'merk_kendaraan' => 'required',
            'tipe_kendaraan' => 'required',
            'tahun_operasi' => 'required',
            'nama_supir' => 'required',
            'telepon_supir' => 'required',
            'alamat_supir' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ], [
            'nomor_polisi.required' => 'Nomor Polisi tidak boleh kosong',
            'nomor_polisi.min' => 'Nomor Polisi minimal 3 karakter',
            'merk_kendaraan.required' => 'Merk Kendaraan tidak boleh kosong',
            'tipe_kendaraan.required' => 'Jenis Kendaraan tidak boleh kosong',
            'tahun_operasi.required' => 'Tahun Pembuatan tidak boleh kosong',
            'nama_supir.required' => 'Nama Supir tidak boleh kosong',
            'telepon_supir.required' => 'Telepon Supir tidak boleh kosong',
            'alamat_supir.required' => 'Alamat Supir tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong'

        ]);

        $user = \App\Models\User::create([
            'name' => $this->nama_supir,
            'email' => $this->email,
            'password' => \Hash::make($this->password),
            'role' => 'supir'
        ]);

        ModelsKendaraan::create([
            'nomor_polisi' => $this->nomor_polisi,
            'merk_kendaraan' => $this->merk_kendaraan,
            'tipe_kendaraan' => $this->tipe_kendaraan,
            'tahun_operasi' => $this->tahun_operasi,
            'nama_supir' => $this->nama_supir,
            'telepon_supir' => $this->telepon_supir,
            'alamat_supir' => $this->alamat_supir,
            'user_id' => $user->id
        ]);

        $this->resetInput();
        session()->flash('message', 'Kendaraan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kendaraan = ModelsKendaraan::find($id);
        $this->kendaraan_id = $kendaraan->id;
        $this->nomor_polisi = $kendaraan->nomor_polisi;
        $this->merk_kendaraan = $kendaraan->merk_kendaraan;
        $this->tipe_kendaraan = $kendaraan->tipe_kendaraan;
        $this->tahun_operasi = $kendaraan->tahun_operasi;
        $this->nama_supir = $kendaraan->nama_supir;
        $this->telepon_supir = $kendaraan->telepon_supir;
        $this->alamat_supir = $kendaraan->alamat_supir;
    }

    public function update()
    {
        $this->validate([
            'nomor_polisi' => 'required|min:3',
            'merk_kendaraan' => 'required',
            'tipe_kendaraan' => 'required',
            'tahun_operasi' => 'required',
            'nama_supir' => 'required',
            'telepon_supir' => 'required',
            'alamat_supir' => 'required',
        ], [
            'nomor_polisi.required' => 'Nomor Polisi tidak boleh kosong',
            'nomor_polisi.min' => 'Nomor Polisi minimal 3 karakter',
            'merk_kendaraan.required' => 'Merk Kendaraan tidak boleh kosong',
            'tipe_kendaraan.required' => 'Jenis Kendaraan tidak boleh kosong',
            'tahun_operasi.required' => 'Tahun Pembuatan tidak boleh kosong',
            'nama_supir.required' => 'Nama Supir tidak boleh kosong',
            'telepon_supir.required' => 'Telepon Supir tidak boleh kosong',
            'alamat_supir.required' => 'Alamat Supir tidak boleh kosong',
        ]);

        if ($this->kendaraan_id) {
            $kendaraan = ModelsKendaraan::find($this->kendaraan_id);
            $kendaraan->update([
                'nomor_polisi' => $this->nomor_polisi,
                'merk_kendaraan' => $this->merk_kendaraan,
                'tipe_kendaraan' => $this->tipe_kendaraan,
                'tahun_operasi' => $this->tahun_operasi,
                'nama_supir' => $this->nama_supir,
                'telepon_supir' => $this->telepon_supir,
                'alamat_supir' => $this->alamat_supir,
            ]);
            session()->flash('message', 'Kendaraan berhasil diupdate');
        }
    }

    public function delete($id)
    {
        $user = \App\Models\User::find(Modelskendaraan::find($id)->user_id);
        $user->delete();

        $kendaraan = ModelsKendaraan::find($id);
        $kendaraan->delete();
        session()->flash('message', 'Kendaraan berhasil dihapus');
    }


}
