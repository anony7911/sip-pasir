{{-- @section('title', 'Pelanggan') --}}
<div>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pelanggan</h1>
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
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>JK</th>
                                <th>Perusahaan</th>
                                <th>updated_at</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>JK</th>
                                <th>Perusahaan</th>
                                <th>updated_at</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($pelanggans as $pelanggan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pelanggan->nama }}</td>
                                <td>{{ $pelanggan->alamat }}</td>
                                <td>{{ $pelanggan->email }}</td>
                                <td>{{ $pelanggan->telepon }}</td>
                                <td>{{ $pelanggan->jenis_kelamin }}</td>
                                <td>{{ $pelanggan->perusahaan ?? '-' }}</td>
                                <td>{{ $pelanggan->updated_at->diffForHumans() }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate" wire:click.prevent="edit({{ $pelanggan->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" wire:click.prevent="delete({{ $pelanggan->id }})">
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
                    {{ $pelanggans->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    {{-- modal tambah --}}
    <!-- Logout Modal-->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('livewire.alert')
                    <!-- form -->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input wire:model="nama" type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
                        @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea wire:model="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat"></textarea>
                        @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input wire:model="telepon" type="text" class="form-control" id="telepon" placeholder="Masukkan telepon">
                        @error('telepon') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select wire:model="jenis_kelamin" class="form-control" id="jenis_kelamin">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="perusahaan">Perusahaan (*Jika ada)</label>
                        <input wire:model="perusahaan" type="text" class="form-control" id="perusahaan" placeholder="Masukkan perusahaan">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input wire:model="email" type="email" class="form-control" id="email" placeholder="Masukkan Email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input wire:model="password" type="text" class="form-control" id="password" placeholder="Masukkan Password">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
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
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true" wire:ignore.self data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambah Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('livewire.alert')
                    <!-- form -->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input wire:model="nama" type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
                        @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea wire:model="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat"></textarea>
                        @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input wire:model="telepon" type="text" class="form-control" id="telepon" placeholder="Masukkan telepon">
                        @error('telepon') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select wire:model="jenis_kelamin" class="form-control" id="jenis_kelamin">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="perusahaan">Perusahaan (*Jika ada)</label>
                        <input wire:model="perusahaan" type="text" class="form-control" id="perusahaan" placeholder="Masukkan perusahaan">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input wire:model="email" type="email" class="form-control" id="email" placeholder="Masukkan Email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
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
