<div>

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Sistem Informasi <span clsas="d-block">Penjualan Pasir</span></h1>
								<p class="mb-4">
                                  {{-- penjelasan menarik --}}
                                    Sistem Informasi Penjualan Pasir adalah aplikasi yang digunakan untuk memudahkan pelanggan dalam melakukan pemesanan pasir. Aplikasi ini juga memudahkan penjual dalam melakukan penjualan pasir.
                                </p>
								<p><a href="/produk" class="btn btn-secondary me-2">Pesan</a><a href="/produk" class="btn btn-white-outline">Explore</a></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="{{ url('/') }}/logo_pt_pasir.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<!-- Start Product Section -->
		<div class="product-section">
			<div class="container">
				<div class="row">

					<!-- Start Column 1 -->
					<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
						<h2 class="mb-4 section-title">
                            Produk Terbaru
                        </h2>
						<p class="mb-4">
                            Produk terbaru yang kami tawarkan. Dapatkan penawaran menarik dari kami.
                        </p>
						<p><a href="/produk" class="btn">Explore</a></p>
					</div>
					<!-- End Column 1 -->

					<!-- Start Column 2 -->
                    @forelse ($produk as $item)
					<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
						<a class="product-item" href="/produk">
							<img src="{{ asset('storage/produk/'.$item->gambar) }}" class="product-thumbnail" style="object-fit: cover; width: 100%; height: 200px;">
							<h3 class="product-title">
                                {{ $item->nama_produk }}
                            </h3>
							<strong class="product-price">
                                Rp. {{ number_format($item->harga) }}
                            </strong>

							<span class="icon-cross">
								<img src="{{ url('/') }}/asset/images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div>
                    @empty
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <p>Produk Kosong</p>
                    </div>
                    @endforelse
					<!-- End Column 2 -->

				</div>
			</div>
		</div>
		<!-- End Product Section -->
</div>
