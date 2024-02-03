<div>
    <div>

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Penjualan
                @if ($tambahPenjualan == false)
                <button type="button" class="btn btn-primary" wire:click.prevent="tambahAktif()">
                    <i class="fas fa-plus"></i>
                </button>
                @else
                <button type="button" class="btn btn-danger" wire:click.prevent="tambahMati()">
                    <i class="fas fa-times"></i>
                </button>
                @endif
            </h1>
            <!-- DataTales Example -->
            @if ($tambahPenjualan)
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        {{-- range untuk multi form --}}
                        <div class="col-12">
                            <div class="mb-3 mt-2">
                                <div class="position-relative">
                                    <div class="d-flex justify-content-between position-absolute w-100">
                                        @for ($step = 1; $step <= $totalSteps; $step++) <button class="btn btn-outline-primary {{ $currentStep == $step ? 'active' : '' }}">
                                            {{ $step }}
                                            </button>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-between mt-2">
                                @for ($step = 1; $step <= $totalSteps; $step++) <div class="text-center @if($currentStep == $step) text-primary font-weight-bold @endif">
                                    {{ $stepLabels[$step]  }}
                            </div>
                            @endfor
                        </div>
                        <hr>
                        @if($currentStep == 1)
                        {{-- nama, alamat, telepon, email, jenis kelamin, perusahaan, password --}}
                        <form wire:submit.prevent="nextStep">
                            <div class="row">
                                <div class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input wire:model="nama" type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
                                        @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea wire:model="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukkan Alamat"></textarea>
                                        @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select wire:model="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="perusahaan">Perusahaan</label>
                                        <input wire:model="perusahaan" type="text" class="form-control" id="perusahaan" placeholder="Masukkan Perusahaan">
                                        @error('perusahaan') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input wire:model="telepon" type="text" class="form-control" id="telepon" placeholder="Masukkan Telepon">
                                        @error('telepon') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input wire:model="email" type="email" class="form-control" id="email" placeholder="Masukkan Email">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input wire:model="password" type="password" class="form-control" id="password" placeholder="Masukkan Password">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-sm btn-primary" type="submit">
                                            <i class="fas fa-arrow-right"></i>
                                            Next</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                    @elseif($currentStep == 2)
                    {{-- pilih produk, harga terbaru, jumlah, alamat pengiriman, lat, long, tanggal_pengantaran --}}
                    <form wire:submit.prevent="nextStep">
                        <div class="row">
                            <div class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="row">
                                    <div class="col-8 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                        <div class="form-group">
                                            <label for="produk_id">Nama Produk</label>
                                            <select wire:model="produk_id" wire:change="updateHarga" class="form-control" id="produk_id">
                                                <option value="">Pilih Produk</option>
                                                @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                                                @endforeach
                                            </select>
                                            @error('produk_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    {{-- harga berdasarkan produk --}}
                                    @if ($produk_id)
                                    <div class="col-4 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label for="harga">Harga Satuan</label>
                                            <label class="form-control" id="harga">Rp. {{ $harga ? number_format($harga, 0, ',', '.') : 'N/A' }}</label>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input wire:model="jumlah" type="number" class="form-control" id="jumlah" placeholder="Masukkan Jumlah">
                                    @error('jumlah') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_pengantaran">Tanggal Pengantaran</label>
                                    <input wire:model="tanggal_pengantaran" type="date" class="form-control" id="tanggal_pengantaran" placeholder="Masukkan Tanggal Pengantaran">
                                    @error('tanggal_pengantaran') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label for="alamat_pengantaran">Alamat Pengantaran</label>
                                    <textarea wire:model="alamat_pengantaran" class="form-control" id="alamat_pengantaran" rows="3" placeholder="Masukkan Alamat Lengkap Pengantaran"></textarea>
                                    @error('alamat_pengantaran') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lat">Latitude</label>
                                    <input wire:model="lat" type="text" class="form-control" id="lat" placeholder="Masukkan Latitude">
                                    @error('lat') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="long">Longitude</label>
                                    <input wire:model="long" type="text" class="form-control" id="long" placeholder="Masukkan Longitude">
                                    @error('long') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-sm btn-warning" type="button" wire:click="previousStep">
                                        <i class="fas fa-arrow-left"></i>
                                        Previous</button>
                                    <button class="btn btn-sm btn-primary" type="submit">
                                        <i class="fas fa-arrow-right"></i>
                                        Next</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @elseif($currentStep == 3)
                    {{-- jarak, ongkir, total, pilih pembayaran --}}
                    <form wire:submit.prevent="submitForm">
                    @csrf
                        <div class="row">
                            <div class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label for="jarak">Jarak</label>
                                    <label class="form-control" id="jarak">{{ $jarak ? number_format($jarak, 0, ',', '.') : 'N/A' }} Km</label>
                                    {{-- @error('jarak') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                <div class="form-group">
                                    <label for="ongkir">Ongkir</label>
                                    <input wire:model="ongkir" type="number" class="form-control" wire:change="updateOngkir" id="ongkir" placeholder="Masukkan Ongkir">
                                    {{-- @error('ongkir') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                            </div>
                            <div class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    @if ($ongkir)
                                    <label class="form-control" id="total">Rp. {{ $total ? number_format($total, 0, ',', '.') : 'N/A' }}</label>
                                    @error('total') <span class="text-danger">{{ $message }}</span> @enderror
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="pembayaran">Pembayaran</label>
                                    <select wire:model="pembayaran" class="form-control" id="pembayaran">
                                        <option value="">Pilih Pembayaran</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                    @error('pembayaran') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-sm btn-warning" type="button" wire:click="previousStep">
                                        <i class="fas fa-arrow-left"></i>
                                        Previous</button>
                                    <button class="btn btn-sm btn-primary" type="submit">
                                        <i class="fas fa-check"></i>
                                        Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
            @endif
</div>
<div class="col-lg-4 col-md-6 col-sm-12">

</div>
<div class="card shadow mb-4">
    @include('livewire.alert')
    <div class="card-body">
        <div class="row d-flex justify-content-between mb-2">
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
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center align-middle text-light bg-dark">
                    <tr class="text-center align-middle">
                        <th class="text-center align-middle">No.</th>
                        <th class="text-center align-middle"> Tanggal Pengantaran</th>
                        <th class="text-center align-middle"> Alamat Pengantaran</th>
                        <th class="text-center align-middle">Pelanggan
                            <br><small>Telepon</small>
                            <br><small>Alamat</small>
                        </th>
                        {{-- <th class="text-center align-middle">Mobil
                                        <br><small>Supir</small>
                                        <br><small>Nomor Polisi (Mer/Tipe)</small>
                                        <br><small>Telepon</small>
                                    </th> --}}
                        <th class="text-center align-middle"> Jenis Pasir </th>
                        <th class="text-center align-middle"> Jumlah (Truk) </th>
                        <th class="text-center align-middle"> Harga </th>
                        <th class="text-center align-middle"> Ongkir (Jarak) </th>
                        <th class="text-center align-middle"> Total </th>
                        <th class="text-center align-middle"> Pembayaran </th>
                        {{-- <th class="text-center align-middle"> Bukti Bayar </th> --}}
                        <th class="text-center align-middle"> Status Pesanan</th>
                        <th class="text-center align-middle"> Tanggal Pesanan</th>
                        <th class="text-center align-middle"> Aksi</th>
                    </tr>
                </thead>
                <tfoot class="text-center align-middle text-light bg-dark">
                    <tr class="text-center align-middle">
                        <th class="text-center align-middle">No.</th>
                        <th class="text-center align-middle"> Tanggal Pengantaran</th>
                        <th class="text-center align-middle"> Alamat Pengantaran</th>
                        <th class="text-center align-middle">Pelanggan
                            <br><small>Telepon</small>
                            <br><small>Alamat</small>
                        </th>
                        {{-- <th class="text-center align-middle">Mobil
                                        <br><small>Supir</small>
                                        <br><small>Nomor Polisi (Mer/Tipe)</small>
                                        <br><small>Telepon</small>
                                    </th> --}}
                        <th class="text-center align-middle"> Jenis Pasir </th>
                        <th class="text-center align-middle"> Jumlah (Truk) </th>
                        <th class="text-center align-middle"> Harga </th>
                        <th class="text-center align-middle"> Ongkir Ongkir (Jarak) </th>
                        <th class="text-center align-middle"> Total </th>
                        <th class="text-center align-middle"> Pembayaran </th>
                        {{-- <th class="text-center align-middle"> Bukti Bayar </th> --}}
                        <th class="text-center align-middle"> Status Pesanan</th>
                        <th class="text-center align-middle"> Tanggal Pesanan</th>
                        <th class="text-center align-middle"> Aksi</th>

                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($penjualans as $penjualan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Carbon\Carbon::parse($penjualan->tanggal_pengantaran)->isoFormat('dddd, D MMMM Y') }}</td>
                        <td>{{ $penjualan->alamat_pengantaran }} <br>
                            <small>
                                {{-- long & lat ke button google maps --}}
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $penjualan->lat }},{{ $penjualan->long }}" class="btn btn-sm btn-success" target="_blank">
                                    <i class="fas fa-map-marker-alt"></i> Google Maps
                                </a>
                            </small>
                        </td>
                        <td>{{ $penjualan->pelanggan->nama }}
                            <br><small>{{ $penjualan->pelanggan->telepon }}</small>
                            <br><small>{{ $penjualan->pelanggan->alamat }}</small>
                        </td>
                        {{-- <td>{{ $penjualan->mobil->nama }}
                        <br><small>{{ $penjualan->mobil->supir }}</small>
                        <br><small>{{ $penjualan->mobil->nomor_polisi }} ({{ $penjualan->mobil->merk }}/{{ $penjualan->mobil->tipe }})</small>
                        <br><small>{{ $penjualan->mobil->telepon }}</small>
                        </td> --}}
                        <td>{{ $penjualan->nama_produk }}</td>
                        <td>{{ $penjualan->jumlah }}</td>
                        <td>Rp. {{ number_format($penjualan->produk->harga, 0, ',', '.') }}</td>
                        <td>
                        @if($penjualan->ongkir == 0 && $penjualan->status == 'menunggu')
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalUpdate" wire:click.prevent="edit({{ $penjualan->id }})">
                                <i class="fas fa-plus"></i>
                            </button>
                        @else
                            Rp. {{ number_format($penjualan->ongkir, 0, ',', '.') }}
                        @endif
                            <br><small>({{ $penjualan->jarak }} KM)</small>
                        </td>
                        <td>Rp. {{ number_format($penjualan->total, 0, ',', '.') }}</td>
                        <td>
                            @if ($penjualan->pembayaran == 'cash')
                            <span class="badge badge-primary">{{ $penjualan->pembayaran }}</span>
                            @else
                            <span class="badge badge-warning">{{ $penjualan->pembayaran }}</span>
                            @endif
                        {{-- <td>
                                        @if ($penjualan->bukti_bayar)
                                        <a href="{{ asset('storage/bukti_bayar/'.$penjualan->bukti_bayar) }}" target="_blank">
                        <img src="{{ asset('storage/bukti_bayar/'.$penjualan->bukti_bayar) }}" alt="Bukti Bayar" width="100px">
                        </a>
                        @else
                        <img src="{{ asset('storage/bukti_bayar/default.png') }}" alt="Bukti Bayar" width="100px">
                        @endif
                        </td> --}}
                        <td class="text-uppercase">
                        {{-- 'menunggu', 'diproses', 'dikirim', 'selesai','batal' --}}
                            @if ($penjualan->status == 'diproses')
                            <span class="badge badge-warning">{{ $penjualan->status }}</span>
                            @elseif($penjualan->status == 'dikirim')
                            <span class="badge badge-primary">{{ $penjualan->status }}</span>
                            @elseif($penjualan->status == 'selesai')
                            <span class="badge badge-success">{{ $penjualan->status }}</span>
                            @elseif($penjualan->status == 'batal')
                            <span class="badge badge-danger">{{ $penjualan->status }}</span>
                            @else
                            <span class="badge badge-secondary">{{ $penjualan->status }}</span>
                            @endif
                        <td>{{ $penjualan->created_at->diffForHumans() }}</td>
                        <td>
                            {{-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate" wire:click.prevent="edit({{ $penjualan->id }})">
                                <i class="fas fa-edit"></i>
                            </button> --}}
                            <button type="button" class="btn btn-danger" wire:click.prevent="delete({{ $penjualan->id }})">
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
            {{ $penjualans->links() }}
        </div>
    </div>
    {{-- modal update --}}
    <div wire:ignore.self class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateLabel">Update Ongkir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="addOngkir">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="ongkir">Ongkir</label>
                            <input wire:model="ongkir" type="number" class="form-control" id="ongkir" placeholder="Masukkan Ongkir">
                            @error('ongkir') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
