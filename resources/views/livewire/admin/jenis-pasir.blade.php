<div>
    <div>
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Jenis Pasir</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 ">
                    <div class="row">
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            @include('livewire.alert')
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-2 col-md-6 col-sm-6 mb-2">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                    Tambah Data
                                </button>
                            </h6>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <select wire:model.live="paginate" class="form-control" id="paginate">
                                <option value="5">5 Data</option>
                                <option value="10">10 Data</option>
                                <option value="25">25 Data</option>
                                <option value="50">50 Data</option>
                                <option value="100">100 Data</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>updated_at</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>updated_at</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse ($produks as $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img class="rounded" src="{{ asset('storage/produk/'.$produk->gambar) }}" alt="" width="100px">
                                    </td>
                                    <td>{{ $produk->nama_produk }}</td>
                                    <td>{{ $produk->slug }}</td>
                                    <td>Rp. {{ number_format($produk->harga, 0, ',', '.') }},-</td>
                                    <td>{{ $produk->deskripsi }}</td>
                                    <td>{{ $produk->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate" wire:click.prevent="edit({{ $produk->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" wire:click.prevent="delete({{ $produk->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data Kosong.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $produks->links() }}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
        {{-- modal tambah --}}
        <!-- Logout Modal-->
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" wire:ignore.self data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Tambah Data</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('livewire.alert')
                        <!-- form -->
                        <div class="form-group">
                            <label for="jenis_pasir">Jenis Pasir</label>
                            <input wire:model="nama_produk" type="text" class="form-control" id="nama_produk" placeholder="Masukkan Jenis Pasir">
                            @error('nama_produk') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input wire:model="harga" type="text" class="form-control" id="harga" placeholder="Masukkan harga">
                            @error('harga') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea wire:model="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan deskripsi"></textarea>
                            @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input wire:model="gambar" type="file" class="form-control" id="gambar" placeholder="Masukkan gambar">
                            @error('gambar') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- end form -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" wire:click.prevent="store()">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Update Data</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('livewire.alert')
                        <!-- form -->
                        <div class="form-group">
                            <label for="jenis_pasir">Jenis Pasir</label>
                            <input wire:model="nama_produk" type="text" class="form-control" id="nama_produk" placeholder="Masukkan Jenis Pasir">
                            @error('nama_produk') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input wire:model="harga" type="text" class="form-control" id="harga" placeholder="Masukkan harga">
                            @error('harga') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea wire:model="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan deskripsi"></textarea>
                            @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input wire:model="gambar" type="file" class="form-control" id="gambar" placeholder="Masukkan gambar">
                            {{-- @error('gambar') <small class="text-danger">{{ $message }}</small> @enderror --}}
                        </div>

                        <!-- end form -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" wire:click.prevent="update()">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
