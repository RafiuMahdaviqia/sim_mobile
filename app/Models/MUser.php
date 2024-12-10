<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MUser extends Model
{
    protected $table = 'm_user';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'id_level',
        'nama_user',
        'username_user',
        'password_user',
        'nidn_user',
        'gelar_akademik',
        'email_user',
        'foto'
    ];

    public function level()
    {
        return $this->belongsTo(MLevel::class, 'id_level');
    }

    public function prodi()
    {
        return $this->hasMany(DataProdi::class, 'id_user');
    }

    public function bidangMinat()
    {
        return $this->hasMany(BidangMinat::class, 'id_user');
    }
}
