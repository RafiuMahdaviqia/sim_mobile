<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataProdi extends Model
{
    public $timestamps = false;
    protected $table = 'data_prodi'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id_prodi';
    
    protected $fillable = [
        'id_user',
        'nama_prodi',
        'kode_prodi',
        'jenjang'
    ];

    public function user()
    {
        return $this->belongsTo(MUser::class, 'id_user');
    }
}