<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\role;
use App\Models\profesi;
use App\Models\province;
use App\Models\regency;

class perdesController extends Controller
{
    public function index($id)
    {
    	$user = user::findOrFail($id);
    	$peran = role::findOrFail($user->id_role);
    	// dd($perdes);
    	return view('\perdes\perdesPage', ['us'=>$user, 'role'=>$peran]);
    }

    public function profil($id)
    {
    	$user = user::findOrFail($id);
    	// $perdes = user::findOrFail($id);
    	$peran = role::findOrFail($user->id_role);

    	$prof = profesi::all();
        $provinsi = province::all();
        $kab = regency::all();
        $roles = role::all();

        return  view('profilUser', ['role' => $peran, 'us'=>$user, 'profs' => $prof, 'provinsis' => $provinsi, 'kabs' => $kab, 'roles' => $roles]);
    }
}
