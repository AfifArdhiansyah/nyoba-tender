<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $table = 'offices';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'kota_kab', 'nama', 'alamat', 'ltd_loc', 'lng_loc', 'type', 'kanwil_id'
    ];

    // Relasi ke Users
    public function users()
    {
        return $this->hasMany(User::class, 'office_id');
    }

    // Relasi ke Tender Projects
    public function tenderProjects()
    {
        return $this->hasMany(TenderProject::class, 'branch_id');
    }
}
