@section('title', 'Manajemen User')
<div>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Manajemen User</h1>
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
                            <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>updated_at</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>updated_at</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                <td>
                                    {{ $user->role }}
                                </td>
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate" wire:click.prevent="edit({{ $user->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" wire:click.prevent="delete({{ $user->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Data Kosong.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
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
                        <label for="name">Nama</label>
                        <input wire:model="name" type="text" class="form-control" id="name" placeholder="Masukkan Nama">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input wire:model="email" type="email" class="form-control" id="email" placeholder="Masukkan Email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select wire:model="role" class="form-control" id="role">
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="pimpinan">Pimpinan</option>
                        </select>
                        @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input wire:model="password" type="password" class="form-control" id="password" placeholder="Masukkan Password">
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
                    <h5 class="modal-title" id="exampleModalLabel1">Update Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('livewire.alert')
                    <!-- form -->
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input wire:model="name" type="text" class="form-control" id="name" placeholder="Masukkan Nama">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input wire:model="email" type="email" class="form-control" id="email" placeholder="Masukkan Email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select wire:model="role" class="form-control" id="role">
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="pimpinan">Pimpinan</option>
                        </select>
                        @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input wire:model="password" type="password" class="form-control" id="password" placeholder="Masukkan Password">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
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
