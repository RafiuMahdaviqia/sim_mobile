<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DosenProfileRequest;
use App\Http\Resources\DosenProfileResource;
use App\Models\MUser;
use App\Models\BidangMinat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class DosenProfileController extends Controller
{
    public function store(DosenProfileRequest $request)
    {
        try {
            DB::beginTransaction();

            // Upload foto if exists
            $foto = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto')->store('dosen-photos', 'public');
            }

            // Create user profile
            $dosen = MUser::create([
                'nama_user' => $request->nama_user,
                'username_user' => $request->username_user,
                'password_user' => Hash::make($request->password_user),
                'nidn_user' => $request->nidn_user,
                'gelar_akademik' => $request->gelar_akademik,
                'email_user' => $request->email_user,
                'foto' => $foto,
                'id_level' => 3, // Assuming 3 is for dosen level
            ]);

            // Create bidang minat if provided
            if ($request->bidang_minat) {
                foreach ($request->bidang_minat as $minat) {
                    BidangMinat::create([
                        'id_user' => $dosen->id_user,
                        'bidang_minat' => $minat
                    ]);
                }
            }

            DB::commit();

            return new DosenProfileResource($dosen);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error creating profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $dosen = MUser::with(['bidangMinat', 'prodi'])->find($id);
        
        if (!$dosen) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        return new DosenProfileResource($dosen);
    }

    public function update(DosenProfileRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $dosen = MUser::find($id);
            if (!$dosen) {
                return response()->json(['message' => 'Profile not found'], 404);
            }

            // Handle foto update
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($dosen->foto) {
                    Storage::disk('public')->delete($dosen->foto);
                }
                $foto = $request->file('foto')->store('dosen-photos', 'public');
                $dosen->foto = $foto;
            }

            // Update basic info
            $dosen->update([
                'nama_user' => $request->nama_user,
                'nidn_user' => $request->nidn_user,
                'gelar_akademik' => $request->gelar_akademik,
                'email_user' => $request->email_user,
            ]);

            // Update bidang minat
            if ($request->bidang_minat) {
                // Delete existing bidang minat
                $dosen->bidangMinat()->delete();
                
                // Create new bidang minat
                foreach ($request->bidang_minat as $minat) {
                    BidangMinat::create([
                        'id_user' => $dosen->id_user,
                        'bidang_minat' => $minat
                    ]);
                }
            }

            DB::commit();

            return new DosenProfileResource($dosen);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error updating profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
