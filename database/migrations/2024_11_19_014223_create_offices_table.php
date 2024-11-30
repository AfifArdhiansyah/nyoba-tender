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
        Schema::create('offices', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('kota_kab', 255);
            $table->string('nama', 255);
            $table->text('alamat');
            $table->string('ltd_loc', 25)->nullable();
            $table->string('lng_loc', 25)->nullable();
            $table->enum('type', ['pusat', 'wilayah', 'cabang'])->default('cabang');
            $table->integer('kanwil_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
