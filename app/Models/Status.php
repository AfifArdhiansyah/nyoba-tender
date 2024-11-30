<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    protected $fillable = [
        'nama'
    ];

    // Relasi ke Tender Statuses
    public function tenderStatuses()
    {
        return $this->hasMany(TenderStatus::class, 'status_id');
    }
}
