<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Notification;
use Carbon\Carbon;
use App\Notifications\notifLaporan;
use App\Notifications\notifPengumuman;
use App\Models\User;
use App\Models\profesi;
use App\Models\province;
use App\Models\regency;
use App\Models\role;
use App\Models\pengumuman;
use App\Models\laporan;
use App\Models\tag;

class adminController extends Controller
{
    public function index($id)
    {
    	$admin = user::findOrFail($id);
    	$peran = role::findOrFail($admin->id_role);

        $tagAll = tag::all();
        $thisMonth = Carbon::now()->month;
        $thisYear = Carbon::now()->year;
        $namaBln = array("Januari", "Februari", "Maret", "April", "Mei", "juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $kriminalitas = tag::where('nama','Kriminalitas')->first();

        // $lap_month = laporan::where('created_at', '>' ,Carbon::now()->subMonth())->get();
        $lap_month = $kriminalitas->laporan()->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
        
    	// dd($peran);
    	return view('\admin\adminPage', ['ad'=>$admin, 'role' => $peran, 'lap_month'=>$lap_month, "thisMonth"=>$thisMonth, "namaBln"=>$namaBln, "tagAll"=>$tagAll]);
    }

    public function dataUser($id)
    {
    	$admin = user::findOrFail($id);
    	$peran = role::findOrFail($admin->id_role);
        $user = DB::table('users')
                    ->join('roles', 'users.id_role','=','roles.id')
                    ->join('profesi', 'users.profesi_id','=','profesi.id_prof')
                    ->select('users.*', 'profesi.nama_profesi', 'roles.nama_role')
                    ->get();
    	return view('\admin\adminDataUser', ['ad'=>$admin, 'role' => $peran, 'list' => $user]);
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
            'nama' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|string|email|max:40|unique:users',
            'username'  =>  'required|alpha_dash|max:30|unique:users',
            'password' => 'required|string|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'jenis_kelamin' => 'required',
            'alamat_asal' => 'required|string|min:5|max:100|not_regex:/^[\_~\-!@#\$%\^&*\(\)]/',
            'id_prov_asal' => 'required',
            'id_kab_asal' => 'required',
            'alamat_tinggal' => 'required|string|min:5|max:100',
            'profesi_id' => 'required',
            'tempat_lahir' => 'required|alpha|max:20|regex:/^[a-zA-Z ]+$/',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required|unique:users|digits_between:1,12',
            'nik' => 'required|unique:users|digits:16',
            'id_role' => 'required'
        ]);

        User::create([
            'nama' => $req->nama,
            'password' => Hash::make($req->password),
            // 'password' => ($data->password),
            'username' => $req->username,
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

        $user = user::findOrFail($id2);

        $prof = profesi::findOrFail($user->profesi_id);
        $provinsi = province::findOrFail($user->id_prov_asal);
        $kab = regency::findOrFail($user->id_kab_asal);
        $roles = role::findOrFail($user->id_role);

        return  view('\admin\dataLengkap', ['ad'=>$admin, 'role' => $peran, 'us'=>$user, 'profs' => $prof, 'provinsis' => $provinsi, 'kabs' => $kab, 'roles' => $roles]);
    }

    public function delUser($id, $id2)
    {
        if ($id == $id2) {
            return redirect('/admin/'.$id.'/data');
        }
        
        $del = User::findOrFail($id2);
        // dd($del);

        $del->delete();   

        return redirect('/admin/'.$id.'/data');
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
            'nama' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|string|email|max:40',
            'username'  =>  'required|alpha_dash|max:30',
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
        $up->username = $req->username;
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
        if (strcasecmp($rl->nama_role, "admin") == 0) {
            return redirect('/admin/'.$id.'/data/admin/'.$id2);

        }elseif (strcasecmp($rl->nama_role, "warga desa") == 0){
            return redirect('/admin/'.$id.'/data/warga/'.$id2);

        }elseif (strcasecmp($rl->nama_role, "perangkat desa") == 0 || strcasecmp($rl->nama_role, "kepala desa") == 0) {
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
            'password' => 'required|string|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ]);

        $pas = User::find($id2);
        $pas->password = Hash::make($req->password);
        $pas->save();

        $rl = role::findOrFail($pas->id_role);
        if (strcasecmp($rl->nama_role, "admin") == 0) {
            return redirect('/admin/'.$id.'/data/admin/'.$id2);

        }elseif (strcasecmp($rl->nama_role, "warga desa") == 0){
            return redirect('/admin/'.$id.'/data/warga/'.$id2);

        }elseif (strcasecmp($rl->nama_role, "perangkat desa") == 0 || strcasecmp($rl->nama_role, "kepala desa") == 0) {
            return redirect('/admin/'.$id.'/data/perdes/'.$id2);
        }
    }

    public function arahkanUser($id, $id2)
    {
        $us = User::findOrFail($id2);
        $rl = role::findOrFail($us->id_role);

        if (strcasecmp($rl->nama_role, "admin") == 0) {
            return redirect('/admin/'.$id.'/data/admin/'.$id2);

        }elseif (strcasecmp($rl->nama_role, "warga desa") == 0){
            return redirect('/admin/'.$id.'/data/warga/'.$id2);

        }elseif (strcasecmp($rl->nama_role, "perangkat desa") == 0 || strcasecmp($rl->nama_role, "kepala desa") == 0) {
            return redirect('/admin/'.$id.'/data/perdes/'.$id2);
        }
    }

    public function pengumuman($id)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);

        // $pengumuman = pengumuman::where('status','dipublikasi')->paginate(4);
        $ann = pengumuman::all();
        foreach ($ann as $key) {
            $pengumuman = DB::table('pengumuman')
                        ->join('users', 'pengumuman.id_penulis','=','users.id')
                        ->where('status','dipublikasi')
                        ->select('pengumuman.*','users.nama')
                        ->orderBy('published_at', 'desc')
                        ->paginate(4);    
        }

        $notifications = Auth::user()->unreadNotifications()->where('type','App\Notifications\notifPengumuman')->get();

        // dd($notifications);
        if ($notifications->isNotEmpty()) {
            foreach ($notifications as $notif) {
                $dt = $notif->data;
                $dataId[] = $dt['ann_id'];
                // dd($dt);
            }    
        }else {
            $dataId = 0;
        }

        return view('\admin\adminAnnounce', ['role' => $peran, 'ad'=>$user, 'ann'=>$pengumuman, 'data'=>$dataId]);
    }

    public function lihatAnn($id, $id2)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);

        $pengumuman = DB::table('pengumuman')
                        ->join('users', 'pengumuman.id_penulis','=','users.id')
                        ->where('pengumuman.id','=',$id2)
                        ->select('pengumuman.*', 'users.nama')
                        ->first();

        $pengubah = DB::table('pengumuman')
                        ->join('users', 'pengumuman.id_pengubah','=','users.id')
                        ->where('pengumuman.id','=',$id2)
                        ->select('users.nama')
                        ->first();

        if (is_null($pengubah)) {
            $ubah = $pengubah;
        } else {
            $ubah = $pengubah->nama;
        }
        // dd($ubah);

        $notifications = Auth::user()->unreadNotifications()->where('type','App\Notifications\notifPengumuman')->get();

        foreach ($notifications as $notif) {
            $dt = $notif->data;
            $dataId = $dt['ann_id'];
            if ($dataId == $id2) {
                $notif->markAsRead();
                break;
                // dd($notif);
            }
        }
        
        return view('\admin\adminDetailAnnounce', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'ubah'=>$ubah]);
    }

    public function laporan($id)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);

        $laporan = DB::table('laporan')
                        ->join('users', 'laporan.id_penulis','=','users.id')
                        ->select('laporan.*','users.nama')
                        ->orderBy('created_at', 'desc')
                        ->get();

        $notifications = Auth::user()->unreadNotifications()->where('type','App\Notifications\notifLaporan')->get();

        if ($notifications->isNotEmpty()) {
            foreach ($notifications as $notif) {
                $dt = $notif->data;
                $dataId[] = $dt['lap_id'];
                // dd($dt);
            }    
        }else {
            $dataId = 0;
        }

        return view('\admin\adminLaporan', ['us'=>$user, 'role'=>$peran, 'laporan'=>$laporan, 'data'=>$dataId]);
    }

    public function laporanBaru($id)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);

        $prof = profesi::all();
        $tag = tag::all();
        return view('\admin\adminNewLaporan', ['us'=>$user, 'role'=>$peran, 'prof'=>$prof, 'tag'=>$tag]);                
    }

    public function createLaporan(Request $req, $id)
    {
        $this->validate($req,[
            'judul' => 'required|string|min:4|unique:laporan',
            'isi' => 'required|string|min:12',
            'tag' => 'required|min:1',
            'prof' => 'required|min:1',
            'koordinat' => 'required',
            'status' => 'required',
        ]);

        // dd($req->koordinat);
        $path="";
        $lap = new laporan;
        if ($req->hasFile('img_file')) {
            $lap->judul = $req->judul;
            $lap->isi = $req->isi;
            $lap->koordinat = $req->koordinat;
            $lap->status = $req->status;
            $lap->id_penulis = $id;
            $lap->save();

            $fileName = $lap->id."_".date('d-M-Y').".".$req->file('img_file')->getClientOriginalExtension();
            $path = $req->file('img_file')->storeAs('laporan-image', $fileName);
            $lap->image_url = $path;
            $lap->save();
        }
        else{
            $lap->judul = $req->judul;
            $lap->isi = $req->isi;
            $lap->koordinat = $req->koordinat;
            $lap->status = $req->status;
            $lap->id_penulis = $id;
            $lap->save();
        }
        
        if ($req->tag != null) {
            foreach ($req->tag as $key) {
                $lap->tags()->attach($key);
            }
        }

        if ($req->prof != null) {
            foreach ($req->prof as $key) {
                $lap->profesi()->attach($key);
            }
        }

        $users = User::where('id', '!=', $id)->get();
        Notification::send($users, new notifLaporan($lap));

        return redirect('/admin/'.$id.'/laporan');
        
    }

    public function lihatLaporan($id, $id2)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);

        $laporan = laporan::findOrFail($id2);
        $tag = $laporan->tags()->get();
        $prof = $laporan->profesi()->get();
        $penulis = $laporan->user()->first();
        $pengubah = User::where('id',$laporan->id_pengubah)->first();

        $notifications = Auth::user()->unreadNotifications()->where('type','App\Notifications\notifLaporan')->get();

        foreach ($notifications as $notif) {
            $dt = $notif->data;
            $dataId = $dt['lap_id'];
            if ($dataId == $id2) {
                $notif->markAsRead();
                break;
                // dd($dt);
            }
        }

        return view('/admin/adminLihatLaporan', ['us'=>$user, 'role'=>$peran, 'laporan'=>$laporan, 'penulis'=>$penulis, 'pengubah'=>$pengubah, 'prof'=>$prof, 'tag'=>$tag]);
    }

    public function editLaporan($id, $id2)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);

        $laporan = laporan::findOrFail($id2);

        if ($laporan->id_penulis != $id) {
            return redirect('/admin/'.$id.'/laporan/'.$id2);
        }

        $tag = $laporan->tags()->get();
        $prof = $laporan->profesi()->get();

        $profAll = profesi::all();
        $tagAll = tag::all();

        return view('/admin/adminEditLaporan', ['us'=>$user, 'role'=>$peran, 'laporan'=>$laporan, 'prof'=>$prof, 'tag'=>$tag, 'profAll' => $profAll, 'tagAll'=>$tagAll]);
    }

    public function updateLaporan(Request $req, $id, $id2)
    {
        $this->validate($req,[
            'judul' => 'required|string|min:4',
            'isi' => 'required|string|min:12',
            'tag' => 'required|min:1',
            'prof' => 'required|min:1',
            'koordinat' => 'required',
        ]);
        
        $lap = laporan::findOrFail($id2);
        // dd($req->del);

        if ($req->hasFile('img_file')) {
            Storage::delete("$lap->image_url");
            $fileName = $lap->id."_".date('d-M-Y').".".$req->file('img_file')->getClientOriginalExtension();
            $path = $req->file('img_file')->storeAs('laporan-image', $fileName);
            
            $lap->judul = $req->judul;
            $lap->isi = $req->isi;
            $lap->koordinat = $req->koordinat;
            $lap->image_url = $path;
            $lap->id_pengubah = $id;
            $lap->save();
        }
        else{
            if ($req->del == "delete") {
                Storage::delete("$lap->image_url");
                $lap->judul = $req->judul;
                $lap->isi = $req->isi;
                $lap->koordinat = $req->koordinat;
                $lap->image_url = $req->file('img_file');
                $lap->id_pengubah = $id;
                $lap->save();
            }else{
                $lap->judul = $req->judul;
                $lap->isi = $req->isi;
                $lap->koordinat = $req->koordinat;
                $lap->id_pengubah = $id;
                $lap->save();
            }
            
        }

        if ($req->tag != null) {
            $lap->tags()->sync($req->tag);
        } else{
            $lap->tags()->detach();
        }

        if ($req->prof != null) {
            $lap->profesi()->sync($req->prof);
        } else{
            $lap->profesi()->detach();
        }

        return redirect('/admin/'.$id.'/laporan/'.$id2);
    }

    public function deleteLaporan($id, $id2)
    {
        $lap = laporan::findOrFail($id2);
        $notifikasi = DB::table('notifications')
                        ->where('type','App\Notifications\notifLaporan')
                        ->get();
        // dd($notifikasi);

        foreach ($notifikasi as $key) {
            $isiData = $key->data;
            $hasil = json_decode($isiData);
            $lapId = $hasil->lap_id;
            
            if ($lapId == $id2) {
                DB::table('notifications')->where('id', $key->id)->delete();
            }
        }
        
        Storage::delete("$lap->image_url");
        $lap->delete();

        return redirect ('/admin/'.$id.'/laporan');
    }

    public function statusLaporan(Request $req, $id, $id2)
    {
        // dd($id2, $req->status);
        $this->validate($req,[
            'status' => 'required',
        ]);

        $lap = laporan::findOrFail($id2);

        if ($req->status == "Sudah ditangani") {
            $lap->status = $req->status;
            $lap->id_solver = $id;
            $lap->solved_at = Carbon::now();
            $lap->save();
        // dd($req->status);

        }else if($req->status == "Belum ditangani"){
            $lap->status = $req->status;
            $lap->id_solver = null;
            $lap->solved_at = null;
            $lap->save();
        }else{
            
        }

        return redirect('/admin/'.$id.'/laporan/');
    }

}
