<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\profesi;
use App\Models\province;
use App\Models\regency;
use App\Models\role;


class adminController extends Controller
{
    public function index($id)
    {
    	$admin = user::findOrFail($id);
    	$peran = role::findOrFail($admin->id_role);
    	// dd($peran);
    	return view('\admin\adminPage', ['ad'=>$admin, 'role' => $peran]);
    }

    public function dataUser($id)
    {
    	$admin = user::findOrFail($id);
    	$peran = role::findOrFail($admin->id_role);
    	return view('\admin\adminDataUser', ['ad'=>$admin, 'role' => $peran]);
    }

    public function perdes($id)
    {
    	$admin = user::findOrFail($id);
    	$peran = role::findOrFail($admin->id_role);
    	$perangkat = DB::table('users')
    					->join('roles', 'users.id_role','=','roles.id')
    					->join('profesi', 'users.profesi_id','=','profesi.id_prof')
    					->select('users.*', 'profesi.nama_profesi')
    					->where('roles.nama_role','=', 'perangkat desa')
                        ->orWhere('roles.nama_role','=', 'kepala desa')
    					->get();
    	// dd($perangkat);
    	return view('\admin\dataPerdes', ['ad'=>$admin, 'role' => $peran, 'list' => $perangkat]);
    }

    public function warga($id)
    {
        $admin = user::findOrFail($id);
        $peran = role::findOrFail($admin->id_role);
        $warga = DB::table('users')
                        ->join('roles', 'users.id_role','=','roles.id')
                        ->join('profesi', 'users.profesi_id','=','profesi.id_prof')
                        ->select('users.*', 'profesi.nama_profesi')
                        ->where('roles.nama_role','=', 'warga desa')
                        ->get();
        // dd($perangkat);
        return view('\admin\dataWarga', ['ad'=>$admin, 'role' => $peran, 'list' => $warga]);
    }

    public function admin($id)
    {
        $admin = user::findOrFail($id);
        $peran = role::findOrFail($admin->id_role);
        $dataAdm = DB::table('users')
                        ->join('roles', 'users.id_role','=','roles.id')
                        ->join('profesi', 'users.profesi_id','=','profesi.id_prof')
                        ->select('users.*', 'profesi.nama_profesi')
                        ->where('roles.nama_role','=', 'admin')
                        ->get();
        // dd($perangkat);
        return view('\admin\dataAdmin', ['ad'=>$admin, 'role' => $peran, 'list' => $dataAdm]);
    }

    public function new($id)
    {
        $admin = user::findOrFail($id);
        $peran = role::findOrFail($admin->id_role);

        $prof = profesi::all();
        $provinsi = province::all();
        $kab = regency::all();
        $roles = role::all();
        return view('\admin\dataUserBaru', ['ad'=>$admin, 'role' => $peran, 'profs' => $prof, 'provinsis' => $provinsi, 'kabs' => $kab, 'roles' => $roles]);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'nama' => 'required|string|max:50',
            'email' => 'required|string|email|max:40|unique:users',
            'password' => 'required|string|min:6',
            'jenis_kelamin' => 'required',
            'alamat_asal' => 'required|string|max:100',
            'id_prov_asal' => 'required',
            'id_kab_asal' => 'required',
            'alamat_tinggal' => 'required|string|max:100',
            'profesi_id' => 'required',
            'tempat_lahir' => 'required|string|max:20|regex:/^[a-zA-Z ]+$/',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required|digits_between:1,12',
            'nik' => 'required|unique:users|digits:16',
            'id_role' => 'required'
        ]);

        User::create([
            'nama' => $req->nama,
            'password' => Hash::make($req->password),
            // 'password' => ($data->password),
            'jenis_kelamin' => $req->jenis_kelamin,
            'alamat_asal' => $req->alamat_asal,
            'id_prov_asal' => $req->id_prov_asal,
            'id_kab_asal' => $req->id_kab_asal,
            'alamat_tinggal' => $req->alamat_tinggal,
            'profesi_id' => $req->profesi_id,
            'tempat_lahir' => $req->tempat_lahir,
            'tanggal_lahir' => $req->tanggal_lahir,
            'no_hp' => $req->no_hp,
            'email' => $req->email,
            'nik' => $req->nik,
            'id_role' => $req->id_role
        ]);

        $user = Auth::user();
        // $admin = user::findOrFail($user->id);
        // $peran = role::findOrFail($admin->id_role);

        return redirect('/admin/'.$user->id.'/data');
    }

    public function detailUser($id, $id2)
    {
        $admin = user::findOrFail($id);
        $peran = role::findOrFail($admin->id_role);

        $prof = profesi::all();
        $provinsi = province::all();
        $kab = regency::all();
        $roles = role::all();

        $user = user::findOrFail($id2);
        return  view('\admin\dataLengkap', ['ad'=>$admin, 'role' => $peran, 'us'=>$user, 'profs' => $prof, 'provinsis' => $provinsi, 'kabs' => $kab, 'roles' => $roles]);
    }

    public function perdesDel($id, $id2)
    {
        $del = User::findOrFail($id2);
        $del->delete();   

        return redirect('/admin/'.$id.'/data/perdes');
    }

    public function wargaDel($id, $id2)
    {
        $del = User::findOrFail($id2);
        $del->delete();   

        return redirect('/admin/'.$id.'/data/warga');
    }

    public function adminDel($id, $id2)
    {
        $del = User::findOrFail($id2);
        $del->delete();   

        return redirect('/admin/'.$id.'/data/admin');
    }

    public function editUser($id, $id2)
    {
        $admin = user::findOrFail($id);
        $peran = role::findOrFail($admin->id_role);

        $prof = profesi::all();
        $provinsi = province::all();
        $kab = regency::all();
        $roles = role::all();

        $us = user::findOrFail($id2);
        return  view('\admin\editDataUser', ['ad'=>$admin, 'role' => $peran, 'user'=>$us, 'profs' => $prof, 'provinsis' => $provinsi, 'kabs' => $kab, 'roles' => $roles]);
        return view();
    }

    public function updateUser(Request $req, $id, $id2)
    {
        $this->validate($req,[
            'nama' => 'required|string|max:50',
            'email' => 'required|string|email|max:40',
            // 'password' => 'required|string|min:6',
            'jenis_kelamin' => 'required',
            'alamat_asal' => 'required|string|max:100',
            'id_prov_asal' => 'required',
            'id_kab_asal' => 'required',
            'alamat_tinggal' => 'required|string|max:100',
            'profesi_id' => 'required',
            'tempat_lahir' => 'required|string|max:20|regex:/^[a-zA-Z ]+$/',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required|digits_between:1,12',
            // 'nik' => 'required|unique:users|digits:16',
            'id_role' => 'required'
        ]);

        $up = User::find($id2);
        $up->nama = $req->nama;
        $up->jenis_kelamin = $req->jenis_kelamin;
        $up->alamat_asal = $req->alamat_asal;
        $up->id_prov_asal = $req->id_prov_asal;
        $up->id_kab_asal = $req->id_kab_asal;
        $up->alamat_tinggal = $req->alamat_tinggal;
        $up->profesi_id = $req->profesi_id;
        $up->tempat_lahir = $req->tempat_lahir;
        $up->tanggal_lahir = $req->tanggal_lahir;
        $up->no_hp = $req->no_hp;
        $up->email = $req->email;
        $up->nik = $req->nik;
        $up->id_role = $req->id_role;
        $up->save();

        $rl = role::findOrFail($req->id_role);
        if ($rl->nama_role == "admin") {
            return redirect('/admin/'.$id.'/data/admin/'.$id2);

        }elseif ($rl->nama_role == "warga desa"){
            return redirect('/admin/'.$id.'/data/warga/'.$id2);

        }elseif ($rl->nama_role == "perangkat desa" || $rl->nama_role == "kepala Desa") {
            return redirect('/admin/'.$id.'/data/perdes/'.$id2);
        }

    }

    public function editPass($id, $id2)
    {
        $admin = user::findOrFail($id);
        $peran = role::findOrFail($admin->id_role);

        $us = user::findOrFail($id2);
        return view('admin\ubahPassword',['ad'=>$admin, 'role' => $peran, 'user'=>$us]);
    }

    public function updatePass(Request $req, $id, $id2)
    {
        $this->validate($req,[
            'password' => 'required|string|min:6'
        ]);

        $pas = User::find($id2);
        $pas->password = Hash::make($req->password);
        $pas->save();

        $rl = role::findOrFail($pas->id_role);
        if ($rl->nama_role == "admin") {
            return redirect('/admin/'.$id.'/data/admin/'.$id2);

        }elseif ($rl->nama_role == "warga desa"){
            return redirect('/admin/'.$id.'/data/warga/'.$id2);

        }elseif ($rl->nama_role == "perangkat desa" || $rl->nama_role == "kepala Desa") {
            return redirect('/admin/'.$id.'/data/perdes/'.$id2);
        }
    }

    public function arahkanUser($id, $id2)
    {
        $us = User::findOrFail($id2);
        $rl = role::findOrFail($us->id_role);

        if ($rl->nama_role == "admin") {
            return redirect('/admin/'.$id.'/data/admin/'.$id2);

        }elseif ($rl->nama_role == "warga desa"){
            return redirect('/admin/'.$id.'/data/warga/'.$id2);

        }elseif ($rl->nama_role == "perangkat desa" || $rl->nama_role == "kepala Desa") {
            return redirect('/admin/'.$id.'/data/perdes/'.$id2);
        }
    }

    // public function tablePerdes($id)
    // {
    // 	return datatables::of(User::query())->make(true);
    // }
}
