<div>
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Pesanan</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                {{-- <th class="product-thumbnail">Image</th> --}}
                                <th class="product-name">Produk</th>
                                <th class="product-price">Diantar / Tujuan</th>
                                <th class="product-quantity">Jumlah</th>
                                <th class="product-price">Harga</th>
                                <th class="product-total">Ongkir</th>
                                <th class="product-total">Total</th>
                                <th class="product-total">Pembayaran</th>
                                <th class="product-remove">Status</th>
                                <th class="product-remove">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($pesanans as $pesanan)
                            <tr>
                                {{-- <td class="product-thumbnail">
                                    <img src="{{ url('/') }}/asset/images/product-1.png" alt="Image" class="img-fluid">
                                </td> --}}
                                <td class="product-name text-black">
                                        {{ $pesanan->produk->nama_produk }}
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($pesanan->tanggal_pengantaran)->isoFormat('dddd, D MMMM Y') }}
                                    <br>
                                    Ke: {{ $pesanan->alamat_pengantaran }}
                                </td>
                                <td>
                                    {{ $pesanan->jumlah }} Truk
                                </td>
                                <td>
                                    Rp. {{ number_format($pesanan->produk->harga) }}
                                </td>
                                <td>
                                @if($pesanan->ongkir == 0)
                                    Menunggu konfirmasi
                                @else
                                    Rp. {{ number_format($pesanan->ongkir) }}
                                @endif
                                </td>
                                <td>
                                @if($pesanan->ongkir == 0)
                                    Rp. {{ number_format($pesanan->total) }} (Belum termasuk ongkir)
                                @else
                                    Rp. {{ number_format($pesanan->total) }}
                                @endif
                                </td>
                                <td>
                                    {{ $pesanan->pembayaran }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ $pesanan->status == 'menunggu' ? 'warning' : ($pesanan->status == 'diproses' ? 'info' : ($pesanan->status == 'selesai' ? 'success' : 'danger')) }}" style="font-size: 12px;">
                                        {{ $pesanan->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($pesanan->status == 'menunggu')
                                    <button wire:click="batalkan({{ $pesanan->id }})" class="btn btn-sm" style="background-color: #f5365c !important; color: white;">Batalkan</button>
                                    {{-- <a href="#" class="btn btn-primary btn-sm">Detail</a> --}}
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada pesanan. </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
