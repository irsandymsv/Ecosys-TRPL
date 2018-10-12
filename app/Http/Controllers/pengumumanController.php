<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Notification;
use App\Models\pengumuman;
use App\Models\User;
use App\Models\role;
use App\Notifications\notifPengumuman;

class pengumumanController extends Controller
{
    public function index($id)
    {
    	
    }

    public function filterStat(Request $req)
    {
    	$stat = $req->status;
    	$user = Auth::user();
        $peran = role::findOrFail($user->id_role);

    	if ($req->status == "disimpan") {
			$ann = pengumuman::all();
	        foreach ($ann as $key) {
	            $pengumuman = DB::table('pengumuman')
	                        ->join('users', 'pengumuman.id_penulis','=','users.id')
	                        ->where('status', '=', $req->status)
	                        ->select('pengumuman.*','users.nama')
	                        ->orderBy('published_at', 'desc')
	                        ->paginate(4);    
	        }
	        
	    }
    	elseif ($req->status == "dipublikasi") {
    		$ann = pengumuman::all();
	        foreach ($ann as $key) {
	            $pengumuman = DB::table('pengumuman')
	                        ->join('users', 'pengumuman.id_penulis','=','users.id')
	                        ->where('status', '=', $req->status)
	                        ->select('pengumuman.*','users.nama')
	                        ->orderBy('published_at', 'desc')
	                        ->paginate(4);    
	        }
    	}elseif ($req->status == "semua"){
    		$ann = pengumuman::all();
	        foreach ($ann as $key) {
	            $pengumuman = DB::table('pengumuman')
	                        ->join('users', 'pengumuman.id_penulis','=','users.id')
	                        // ->where($req->status, '=', 'dipublikasi')
	                        ->select('pengumuman.*','users.nama')
	                        ->orderBy('published_at', 'desc')
	                        ->paginate(4);    
	        }
    	}

    	$notifications = Auth::user()->unreadNotifications()->where('type','App\Notifications\notifPengumuman')->get();

	    if ($notifications->isNotEmpty()) {
	        foreach ($notifications as $notif) {
                $dt = $notif->data;
                $dataId[] = $dt['ann_id'];
	            
	        }    
	    } else {
            $dataId = 0;
        }
        // dd($pengumuman);

    	return view('\perdes\announcePerdes', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId, 'status'=>$stat]);
    }

    public function cariAnn(Request $req)
    {
    	$user = Auth::user();
        $peran = role::findOrFail($user->id_role);

        $ann = pengumuman::all();
        foreach ($ann as $key) {
            $pengumuman = DB::table('pengumuman')
                        ->join('users', 'pengumuman.id_penulis','=','users.id')
                        ->where('pengumuman.judul','like', "%$req->cari%")
                        ->select('pengumuman.*','users.nama')
                        ->orderBy('published_at', 'desc')
                        ->paginate(4);    
        }
        // dd($pengumuman);

        $notifications = Auth::user()->unreadNotifications()->where('type','App\Notifications\notifPengumuman')->get();

        // dd($notifications);
        if ($notifications->isNotEmpty()) {
            foreach ($notifications as $notif) {
                $dt = $notif->data;
                $dataId[] = $dt['ann_id'];
            }    
        }else {
            $dataId = 0;
        }

        // dd($peran);
        if ($peran->nama_role == "admin") {
             return view('\admin\adminAnnounce', ['ad'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId]);

        }elseif ($peran->nama_role == "kepala desa") {
            return view('\kades\announceKades', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId]);

        }elseif ($peran->nama_role == "perangkat desa") {
            return view('\perdes\announcePerdes', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId]);

        }elseif ($peran->nama_role == "warga desa") {
            return view('\warga\wargaAnnounce', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId]);

        }
        
    }

    public function cariAnnPublish(Request $req)
    {
        $user = Auth::user();
        $peran = role::findOrFail($user->id_role);

        $ann = pengumuman::all();
        foreach ($ann as $key) {
            $pengumuman = DB::table('pengumuman')
                        ->join('users', 'pengumuman.id_penulis','=','users.id')
                        ->where('pengumuman.status','dipublikasi')
                        ->where('pengumuman.judul','like', "%$req->cari%")
                        ->select('pengumuman.*','users.nama')
                        ->orderBy('published_at', 'desc')
                        ->paginate(4);    
        }
        // dd($pengumuman);

        $notifications = Auth::user()->unreadNotifications()->where('type','App\Notifications\notifPengumuman')->get();

        // dd($notifications);
        if ($notifications->isNotEmpty()) {
            foreach ($notifications as $notif) {
                $dt = $notif->data;
                $dataId[] = $dt['ann_id'];
            }    
        }else {
            $dataId = 0;
        }

        // dd($peran);
        if ($peran->nama_role == "admin") {
             return view('\admin\adminAnnounce', ['ad'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId]);

        }elseif ($peran->nama_role == "kepala desa") {
            return view('\kades\announceKades', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId]);

        }elseif ($peran->nama_role == "perangkat desa") {
            return view('\perdes\announcePerdes', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId]);

        }elseif ($peran->nama_role == "warga desa") {
            return view('\warga\wargaAnnounce', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId]);

        }
        
    }
}
