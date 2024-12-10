<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'nama_user' => 'required|string|max:100',
            'email_user' => 'required|email|max:100',
            'nidn_user' => 'required|string|max:20',
            'gelar_akademik' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bidang_minat' => 'nullable|array',
            'bidang_minat.*' => 'required|string|max:100',
        ];

        // Add username and password rules only for new profile creation
        if ($this->isMethod('post')) {
            $rules['username_user'] = 'required|string|max:50|unique:m_user,username_user';
            $rules['password_user'] = 'required|string|min:6';
        }

        return $rules;
    }
}