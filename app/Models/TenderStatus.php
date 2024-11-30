<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderStatus extends Model
{
    use HasFactory;

    protected $table = 'tender_statuses';

    protected $fillable = [
        'dibuat_tanggal', 'ltd_loc', 'lng_loc', 'penawaran_file', 'bukti_file', 'keterangan', 'tender_id', 'status_id'
    ];

    // Relasi ke Tender Project
    public function tender()
    {
        return $this->belongsTo(TenderProject::class, 'tender_id');
    }

    // Relasi ke Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
