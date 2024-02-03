<div>
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Keranjang</h1>
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
                                <th class="product-price">Harga</th>
                                <th class="product-quantity">Jumlah</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($keranjangs as $keranjang)
                            <tr>
                                {{-- <td class="product-thumbnail">
                                    <img src="{{ url('/') }}/asset/images/product-1.png" alt="Image" class="img-fluid">
                                </td> --}}
                                <td class="product-name">
                                    <h2 class="h5 text-black">
                                        {{ $keranjang->produk->nama_produk }}
                                    </h2>
                                </td>
                                <td>
                                    Rp. {{ number_format($keranjang->harga) }}
                                </td>
                                <td>
                                    {{ $keranjang->jumlah }} Truk
                                </td>
                                <td>
                                    Rp. {{ number_format($keranjang->total) }}
                                </td>
                                <td><a href="#" wire:click.prevent="delete({{ $keranjang->id }})" class="btn btn-black btn-sm">X</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Keranjang Kosong. </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- jika keranjang tidak kosong --}}
            @if ($keranjangs->count())
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="text-black" for="">Pembayaran</label>
                            <select wire:model="pembayaran" class="form-control">
                                <option value="">Pilih Pembayaran</option>
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                            @error('pembayaran') <small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="text-black" for="">Tanggal Pengantaran</label>
                            <input wire:model="tanggal_pengantaran" type="date" class="form-control">
                            @error('tanggal_pengantaran') <small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button wire:click.prevent="checkout()" class="btn btn-black btn-sm btn-block">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>


</div>
