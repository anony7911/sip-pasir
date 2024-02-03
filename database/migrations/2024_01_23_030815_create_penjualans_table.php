<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();


            // produk_id dan pelanggan_id akan dijadikan foreign key
            // ke tabel produks dan pelanggans
            $table->foreignId('produk_id');
            $table->foreignId('pelanggan_id');

            // jumlah akan diisi oleh user
            $table->integer('jumlah');

            //tanggal pengantaran akan diisi oleh user
            $table->date('tanggal_pengantaran');

            // alamat akan diisi oleh user
            $table->text('alamat_pengantaran');

            // long dan lat akan diisi oleh user
            $table->string('long')->nullable();
            $table->string('lat')->nullable();

            // jarak dan ongkir akan diisi oleh admin, float 8 angka dibelakang koma, 2 angka didepan koma
            $table->float('jarak', 8, 2)->nullable();
            $table->integer('ongkir')->nullable();

            // total akan diisi oleh admin, integer 11 angka
            $table->integer('total')->nullable();

            //pembayaran akan diisi oleh user
            $table->enum('pembayaran', ['cash', 'transfer'])->default('cash');

            // status akan diisi oleh admin
            $table->enum('status', ['menunggu', 'diproses', 'dikirim', 'selesai','batal'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
