<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Notification;
use Carbon\Carbon;
use App\Notifications\notifLaporan;
use App\Models\User;
use App\Models\role;
use App\Models\profesi;
use App\Models\province;
use App\Models\regency;
use App\Models\pengumuman;
use App\Models\laporan;
use App\Models\tag;

class wargaController extends Controller
{
	public function index($id)
	{
		$user = user::findOrFail($id);
		$peran = role::findOrFail($user->id_role);
    	// dd($perdes);
    	return view('\warga\wargaPage', ['us'=>$user, 'role'=>$peran]);	
	}

	public function profil($id)
    {
    	$user = user::findOrFail($id);
    	$peran = role::findOrFail($user->id_role);

    	$prof = profesi::findOrFail($user->profesi_id);
        $provinsi = province::findOrFail($user->id_prov_asal);
        $kab = regency::findOrFail($user->id_kab_asal);
        $roles = role::findOrFail($user->id_role);
        
        return  view('\warga\wargaProfil', ['role' => $peran, 'us'=>$user, 'profs' => $prof, 'provinsis' => $provinsi, 'kabs' => $kab, 'roles' => $roles]);
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
                // $annStatus = pengumuman::findOrFail($dt['ann_id'])->status;
                $dataId[] = $dt['ann_id'];
                // dd($dt);
            }    
        }else {
            $dataId = 0;
        }
        // dd($dataId);
        return view('\warga\wargaAnnounce', ['role' => $peran, 'us'=>$user, 'ann'=>$pengumuman, 'data'=>$dataId]);
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

        return view('\warga\wargaDetailAnnounce', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'ubah'=>$ubah]);
    }

    public function laporan($id)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);
        $tgl = Carbon::now()->subDays(7);

        $laporan = DB::table('laporan')
                        ->join('users', 'laporan.id_penulis','=','users.id')
                        ->select('laporan.*','users.nama')
                        ->where('status', 'Belum ditangani')
                        ->orWhere('solved_at', '>', $tgl)
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

        return view('\warga\wargaLaporan', ['us'=>$user, 'role'=>$peran, 'laporan'=>$laporan, 'data'=>$dataId]);

    }

    public function laporanBaru($id)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);

        $prof = profesi::all();
        $tag = tag::all();
        return view('\warga\wargaNewLaporan', ['us'=>$user, 'role'=>$peran, 'prof'=>$prof, 'tag'=>$tag]);                
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

        return redirect('/warga/'.$id.'/laporan');
        
    }

    public function lihatLaporan($id,$id2)
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

        // dd(asset('storage/'.substr( $laporan->image_url, 7)));
        return view('/warga/wargaLihatLaporan', ['us'=>$user, 'role'=>$peran, 'laporan'=>$laporan, 'penulis'=>$penulis, 'pengubah'=>$pengubah, 'prof'=>$prof, 'tag'=>$tag]);
    }

    public function editLaporan($id, $id2)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);

        $laporan = laporan::findOrFail($id2);
        $tag = $laporan->tags()->get();
        $prof = $laporan->profesi()->get();

        $profAll = profesi::all();
        $tagAll = tag::all();

        return view('/warga/wargaEditLaporan', ['us'=>$user, 'role'=>$peran, 'laporan'=>$laporan, 'prof'=>$prof, 'tag'=>$tag, 'profAll' => $profAll, 'tagAll'=>$tagAll]);
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

        return redirect('/warga/'.$id.'/laporan/'.$id2);
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

        return redirect ('/warga/'.$id.'/laporan');
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

        }else if($req->status == "Belum ditangani"){
            $lap->status = $req->status;
            $lap->id_solver = null;
            $lap->solved_at = null;
            $lap->save();
        }else{
            
        }

        return redirect('/warga/'.$id.'/laporan/');
    }
    
}
