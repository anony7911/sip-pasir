<div>
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Produk</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->



    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                <!-- Start Column 1 -->
                @foreach ($produks as $produk)
                <div class="col-12 col-md-6 col-lg-6 mb-5">
                    <a class="product-item" href="#" data-bs-toggle="modal" data-bs-target="#tambahProduk" wire:click.prevent="detail({{ $produk->id }})">
                        <img src="{{ asset('storage/produk/'.$produk->gambar) }}" class="product-thumbnail" style="object-fit: cover; width: 100%; height: 400px;">
                        <h3 class="product-title">{{ $produk->nama_produk }}</h3>
                        <strong class="product-price">Rp. {{ number_format($produk->harga) }}</strong>
                        {{-- deksripsi --}}
                        <p class="product-description">{{ $produk->deskripsi }}</p>
                        <span class="icon-cross">
                            <img src="{{ url('/') }}/asset/images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- modal tambah --}}
    <div wire:ignore.self class="modal fade" id="tambahProduk" tabindex="-1" aria-labelledby="tambahProdukLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahProdukLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Start Contact Form -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                    <label>Longitude<span class="form-label">*</span></label>
                                    <input wire:model.live="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" type="text" name="longitude">
                                    <small class="text-muted">*Tambahkan angka 0 di akhir </small>
                                    @error('longitude') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="mb-3">
                                    <label>Latitude<span class="form-label">*</span></label>
                                    <input wire:model.live="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" type="text" name="latitude">
                                    <small class="text-muted">*Tambahkan angka 0 di akhir </small>
                                    @error('latitude') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-sm btn-success" onclick="getGeolocation()">Dapatkan Lokasi</button>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input wire:model="jumlah" type="number" class="form-control" id="jumlah" placeholder="jumlah">
                                @error('jumlah') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat_pengantaran" class="form-label">Alamat Pengantaran</label>
                                <textarea wire:model="alamat_pengantaran" class="form-control" id="alamat_pengantaran" rows="3"></textarea>
                                <small class="text-muted">*Masukkan alamat lengkap</small>
                                @error('alamat_pengantaran') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Contact Form -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" wire:click.prevent="keranjang" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <!-- resources/views/livewire/geolocation.blade.php -->

    @push('scripts')
    <script>
        function getGeolocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        // Get the CSRF token from the page
                        const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');

                        if (csrfTokenElement) {
                            const csrfToken = csrfTokenElement.content;

                            // Send geolocation to the Laravel controller using an HTTP request
                            fetch('/get-geolocation', {
                                    method: 'POST'
                                    , headers: {
                                        'Content-Type': 'application/json'
                                        , 'Accept': 'application/json'
                                        , 'X-CSRF-TOKEN': csrfToken, // Include the CSRF token
                                    }
                                    , body: JSON.stringify({
                                        latitude: position.coords.latitude
                                        , longitude: position.coords.longitude
                                    , })
                                , })
                                .then(response => response.json())
                                .then(data => {
                                    // Populate the input fields with geolocation data
                                    document.getElementById('latitude').value = data.latitude;
                                    document.getElementById('longitude').value = data.longitude;
                                })
                                .catch(error => console.error('Error:', error));
                        } else {
                            console.error('CSRF token meta tag not found.');
                        }
                    }
                    , function(error) {
                        console.error('Error getting geolocation:', error);
                    }
                );
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        }

    </script>
    @endpush

</div>
