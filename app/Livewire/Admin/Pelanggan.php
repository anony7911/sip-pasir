<?php

namespace App\Livewire\Admin;

use App\Models\Pelanggan as ModelsPelanggan;
use Livewire\Component;
use Livewire\WithPagination;

class Pelanggan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $nama, $alamat, $telepon, $email, $jenis_kelamin, $perusahaan, $pelanggan_id, $password;
    public $paginate = 10;

    public function render()
    {
        $pelanggans = ModelsPelanggan::where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('alamat', 'like', '%' . $this->search . '%')
            ->orWhere('telepon', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('jenis_kelamin', 'like', '%' . $this->search . '%')
            ->orWhere('perusahaan', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate, pageName: 'pelanggans');
        return view('livewire.admin.pelanggan',
            compact('pelanggans')
        )->title('Pelanggan');
    }

    public function resetInput()
    {
        $this->nama = null;
        $this->alamat = null;
        $this->telepon = null;
        $this->email = null;
        $this->jenis_kelamin = null;
        $this->perusahaan = null;
        $this->pelanggan_id = null;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|min:3',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:users,email',
            'jenis_kelamin' => 'required',
            'password' => 'required'
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.min' => 'Nama minimal 3 karakter',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'telepon.required' => 'Telepon tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        $user = \App\Models\User::create([
            'name' => $this->nama,
            'email' => $this->email,
            'password' => \Hash::make($this->password),
            'role' => 'pelanggan'
        ]);

        ModelsPelanggan::create([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'jenis_kelamin' => $this->jenis_kelamin,
            'perusahaan' => $this->perusahaan,
            'user_id' => $user->id
        ]);

        $this->resetInput();
        $this->dispatch('closeModal');
        session()->flash('message', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $pelanggan = ModelsPelanggan::find($id);
        $this->pelanggan_id = $pelanggan->id;
        $this->nama = $pelanggan->nama;
        $this->alamat = $pelanggan->alamat;
        $this->telepon = $pelanggan->telepon;
        $this->email = $pelanggan->email;
        $this->jenis_kelamin = $pelanggan->jenis_kelamin;
        $this->perusahaan = $pelanggan->perusahaan;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|min:3',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
            'jenis_kelamin' => 'required'
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.min' => 'Nama minimal 3 karakter',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'telepon.required' => 'Telepon tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong'
        ]);

        $pelanggan = ModelsPelanggan::find($this->pelanggan_id);
        $pelanggan->update([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'jenis_kelamin' => $this->jenis_kelamin,
            'perusahaan' => $this->perusahaan
        ]);

        $user = \App\Models\User::find($pelanggan->user_id);
        $user->update([
            'name' => $this->nama,
            'email' => $this->email
        ]);

        // jika password tidak kosong
        if ($this->password != null) {
            $this->validate([
                'password' => 'required'
            ], [
                'password.required' => 'Password tidak boleh kosong'
            ]);
            $user->update([
                'password' => \Hash::make($this->password)
            ]);
        }

        $this->resetInput();
        $this->dispatch('closeModal');
        session()->flash('message', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $user = \App\Models\User::find(ModelsPelanggan::find($id)->user_id);
        $user->delete();

        $pelanggan = ModelsPelanggan::find($id);
        $pelanggan->delete();

        session()->flash('message', 'Data berhasil dihapus');
    }

}
