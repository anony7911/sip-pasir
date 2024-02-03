<?php

namespace App\Livewire\Admin;

use App\Models\Produk;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class JenisPasir extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $paginate = 10;
    public $nama_produk, $slug, $deskripsi, $harga, $gambar, $id_produk;

    public function render()
    {
        $search = '%' . $this->search . '%';
        $produks = Produk::where('nama_produk', 'like', $search)
            ->orWhere('deskripsi', 'like', $search)
            ->orWhere('harga', 'like', $search)
            ->orderBy('created_at', 'DESC')
            ->paginate($this->paginate);
        return view('livewire.admin.jenis-pasir', compact('produks'))->title('Jenis Pasir');
    }

    public function resetFields()
    {
        $this->nama_produk = '';
        $this->slug = '';
        $this->deskripsi = '';
        $this->harga = '';
        $this->gambar = '';
    }

    public function store()
    {
        $this->validate([
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambar = md5($this->gambar . microtime() . '.' . $this->gambar->extension());
        $this->gambar->storeAs('public/produk', $gambar);

        Produk::create([
            'nama_produk' => $this->nama_produk,
            'slug' => Str::slug($this->nama_produk),
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'gambar' => $gambar,
        ]);

        $this->resetFields();
        session()->flash('message', 'Data Berhasil Disimpan.');
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        $this->id_produk = $id;
        $this->nama_produk = $produk->nama_produk;
        $this->slug = $produk->slug;
        $this->deskripsi = $produk->deskripsi;
        $this->harga = $produk->harga;
        $this->gambar = $produk->gambar;
    }

    public function update()
    {
        $this->validate([
            'nama_produk' => 'required',
            'slug' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
        ]);

        $produk = Produk::find($this->id_produk);

        if ($this->gambar != $produk->gambar) {
            unlink(storage_path('app/public/produk/' . $produk->gambar));
            $gambar = md5($this->gambar . microtime() . '.' . $this->gambar->extension());
            $this->gambar->storeAs('public/produk', $gambar);
        } else {
            $gambar = $produk->gambar;
        }

        $produk->update([
            'nama_produk' => $this->nama_produk,
            'slug' => $this->slug,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'gambar' => $gambar,
        ]);

        $this->resetFields();
        session()->flash('message', 'Data Berhasil Diubah.');
    }
}
