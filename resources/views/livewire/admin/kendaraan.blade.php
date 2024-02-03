<div>
    <div>
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Kendaraan</h1>
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
                            <thead class="text-center align-middle text-light bg-dark">
                                <tr class="text-center align-middle">
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">No Polisi</th>
                                    <th class="text-center align-middle">Merk/Tipe</th>
                                    <th class="text-center align-middle">Tahun</th>
                                    <th class="text-center align-middle">Supir/ No.Telp/ Alamat</th>
                                    <th class="text-center align-middle">updated_at</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center align-middle text-light bg-dark">
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">No Polisi</th>
                                    <th class="text-center align-middle">Merk/Tipe</th>
                                    <th class="text-center align-middle">Tahun</th>
                                    <th class="text-center align-middle">Supir/ No.Telp/ Alamat</th>
                                    <th class="text-center align-middle">updated_at</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse ($kendaraans as $kendaraan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kendaraan->nomor_polisi }}</td>
                                    <td>{{ $kendaraan->merk_kendaraan }}/{{ $kendaraan->tipe_kendaraan }}</td>
                                    <td>{{ $kendaraan->tahun_operasi }}</td>
                                    <td>{{ $kendaraan->nama_supir }}
                                        <br><small><a href="tel:{{ $kendaraan->telepon_supir }}">{{ $kendaraan->telepon_supir }}</a></small>
                                        <br><small>{{ $kendaraan->alamat_supir }}</small>
                                    </td>
                                    <td>{{ $kendaraan->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate" wire:click.prevent="edit({{ $kendaraan->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" wire:click.prevent="delete({{ $kendaraan->id }})">
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
                        {{ $kendaraans->links() }}
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
                            <label for="nomor_polisi">Nomor Polisi</label>
                            <input wire:model="nomor_polisi" type="text" class="form-control" id="nomor_polisi" placeholder="Masukkan nomor_polisi">
                            @error('nomor_polisi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="merk_kendaraan">Merk Kendaraan</label>
                            <input wire:model="merk_kendaraan" type="text" class="form-control" id="merk_kendaraan" placeholder="Masukkan merk_kendaraan">
                            @error('merk_kendaraan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="tipe_kendaraan">Tipe Kendaraan</label>
                            <input wire:model="tipe_kendaraan" type="text" class="form-control" id="tipe_kendaraan" placeholder="Masukkan tipe_kendaraan">
                            @error('tipe_kendaraan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="tahun_operasi">Tahun Operasi</label>
                            <input wire:model="tahun_operasi" type="text" class="form-control" id="tahun_operasi" placeholder="Masukkan tahun_operasi">
                            @error('tahun_operasi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_supir">Nama Supir</label>
                            <input wire:model="nama_supir" type="text" class="form-control" id="nama_supir" placeholder="Masukkan nama_supir">
                            @error('nama_supir') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="telepon_supir">Telepon Supir</label>
                            <input wire:model="telepon_supir" type="text" class="form-control" id="telepon_supir" placeholder="Masukkan telepon_supir">
                            @error('telepon_supir') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat_supir">Alamat Supir</label>
                            <textarea wire:model="alamat_supir" class="form-control" id="alamat_supir" placeholder="Masukkan alamat_supir"></textarea>
                            @error('alamat_supir') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email Supir</label>
                            <input wire:model="email" type="email" class="form-control" id="email" placeholder="Masukkan email">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password Supir</label>
                            <input wire:model="password" type="password" class="form-control" id="password" placeholder="Masukkan password">
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
        <div wire:ignore.self class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true" data-backdrop="static">
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
                            <label for="nomor_polisi">Nomor Polisi</label>
                            <input wire:model="nomor_polisi" type="text" class="form-control" id="nomor_polisi" placeholder="Masukkan nomor_polisi">
                            @error('nomor_polisi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="merk_kendaraan">Merk Kendaraan</label>
                            <input wire:model="merk_kendaraan" type="text" class="form-control" id="merk_kendaraan" placeholder="Masukkan merk_kendaraan">
                            @error('merk_kendaraan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="tipe_kendaraan">Tipe Kendaraan</label>
                            <input wire:model="tipe_kendaraan" type="text" class="form-control" id="tipe_kendaraan" placeholder="Masukkan tipe_kendaraan">
                            @error('tipe_kendaraan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="tahun_operasi">Tahun Operasi</label>
                            <input wire:model="tahun_operasi" type="text" class="form-control" id="tahun_operasi" placeholder="Masukkan tahun_operasi">
                            @error('tahun_operasi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_supir">Nama Supir</label>
                            <input wire:model="nama_supir" type="text" class="form-control" id="nama_supir" placeholder="Masukkan nama_supir">
                            @error('nama_supir') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="telepon_supir">Telepon Supir</label>
                            <input wire:model="telepon_supir" type="text" class="form-control" id="telepon_supir" placeholder="Masukkan telepon_supir">
                            @error('telepon_supir') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat_supir">Alamat Supir</label>
                            <textarea wire:model="alamat_supir" class="form-control" id="alamat_supir" placeholder="Masukkan alamat_supir"></textarea>
                            @error('alamat_supir') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <!-- end form -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" wire:click.prevent="update()">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
