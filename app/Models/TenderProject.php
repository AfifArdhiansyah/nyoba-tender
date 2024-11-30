<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderProject extends Model
{
    use HasFactory;

    protected $table = 'tender_projects';

    protected $fillable = [
        'nama', 'lokasi_pekerjaan', 'nama_pemenang', 'npwp', 'lokasi_instansi', 'ltd_loc', 'lng_loc', 'nilai_tender', 'branch_id', 'ao_id'
    ];

    // Relasi ke Office (branch)
    public function branch()
    {
        return $this->belongsTo(Office::class, 'branch_id');
    }

    // Relasi ke User (account officer)
    public function accountOfficer()
    {
        return $this->belongsTo(User::class, 'ao_id');
    }

    // Relasi ke Tender Statuses
    public function tenderStatuses()
    {
        return $this->hasMany(TenderStatus::class, 'tender_id');
    }
}
