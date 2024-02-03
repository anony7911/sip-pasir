<div>
    <h4><i class="feather-printer"></i>
        Laporan Penjualan</h4>
    <div class="card">


        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="tanggal_awal">Tanggal Awal </label>
                    <input wire:model="tanggal_awal" type="date" class="form-control" id="tanggal_awal" placeholder="Masukkan Tanggal awal">
                    @error('tanggal_awal') <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tanggal_akhir">Tanggal Akhir </label>
                    <input wire:model="tanggal_akhir" type="date" class="form-control" id="tanggal_akhir" placeholder="Masukkan Tanggal akhir">
                    @error('tanggal_akhir') <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="button" wire:click.prevent="cetak()" class="btn btn-primary">
                        <i class="fas fa-print"></i>
                        Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
