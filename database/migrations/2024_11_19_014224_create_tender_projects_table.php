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
        Schema::create('tender_projects', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama', 255);
            $table->string('lokasi_pekerjaan', 255);
            $table->string('nama_pemenang', length: 255);
            $table->char('npwp', 20);
            $table->string('lokasi_instansi', 255);
            $table->string('ltd_loc', 25)->nullable();
            $table->string('lng_lng', 25)->nullable();
            $table->string('nilai_tender', 255);
            $table->string('status', 20);
            $table->string('branch_id');
            $table->string('ao_id');
            $table->foreign('branch_id')->references('id')->on('offices')->onDelete('cascade');
            $table->foreign('ao_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tender_projects');
    }
};
