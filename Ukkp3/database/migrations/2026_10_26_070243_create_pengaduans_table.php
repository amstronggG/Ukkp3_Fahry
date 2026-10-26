<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_pelanggan');
            $table->string('email');
            $table->string('no_telepon');
            $table->string('no_meja');
            $table->string('kategori');
            $table->text('isi_pengaduan');
            $table->string('bukti_foto')->nullable(); // Untuk upload gambar
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('pengaduans');
    }
};