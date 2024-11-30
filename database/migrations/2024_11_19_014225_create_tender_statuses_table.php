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
        Schema::create('tender_statuses', function (Blueprint $table) {
            $table->id();
            $table->date('dibuat_tanggal');
            $table->string('ltd_loc', 25)->nullable();
            $table->string('lng_loc', 25)->nullable();
            $table->string('penawaran_file', 255);
            $table->string('bukti_file', 255);
            $table->text('keterangan')->nullable();
            $table->string('tender_id');
            $table->unsignedBigInteger('status_id');
            $table->foreign('tender_id')->references('id')->on('tender_projects')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tender_statuses');
    }
};
