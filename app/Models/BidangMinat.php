<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidangMinat extends Model
{
    public $timestamps = false; // Nonaktifkan timestamps jika tidak ada di database
    
    protected $table = 'bidang_minat';
    protected $primaryKey = 'id_bidang_minat';
    
    protected $fillable = [
        'id_user',          // Tambahkan ini
        'bidang_minat'      // Dan ini
    ];

    public function user()
    {
        return $this->belongsTo(MUser::class, 'id_user');
    }
}