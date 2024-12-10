<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MLevel extends Model
{
    protected $table = 'm_level';
    protected $primaryKey = 'id_level';
    protected $fillable = ['kode_level', 'nama_level'];

    public function users()
    {
        return $this->hasMany(MUser::class, 'id_level');
    }
}
