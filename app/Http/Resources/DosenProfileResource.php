<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DosenProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id_user,
            'nama' => $this->nama_user,
            'username' => $this->username_user,
            'nidn' => $this->nidn_user,
            'gelar_akademik' => $this->gelar_akademik,
            'email' => $this->email_user,
            'foto' => $this->foto ? asset('storage/' . $this->foto) : null,
            'bidang_minat' => $this->bidangMinat->pluck('bidang_minat'),
            'prodi' => $this->prodi->map(function($prodi) {
                return [
                    'id' => $prodi->id_prodi,
                    'nama' => $prodi->nama_prodi,
                    'kode' => $prodi->kode_prodi,
                    'jenjang' => $prodi->jenjang
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}