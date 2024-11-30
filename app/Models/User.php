<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'nama', 'password', 'is_active', 'role', 'office_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke Office
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    // Relasi ke Tender Projects
    public function tenderProjects()
    {
        return $this->hasMany(TenderProject::class, 'ao_id');
    }
}
