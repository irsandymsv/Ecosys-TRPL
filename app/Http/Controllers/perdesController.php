<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Notification;
use App\Notifications\notifPengumuman;
use Carbon\Carbon;
use App\Models\User;
use App\Models\role;
use App\Models\profesi;
use App\Models\province;
use App\Models\regency;
use App\Models\pengumuman;


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

        $prof = profesi::findOrFail($user->profesi_id);
        $provinsi = province::findOrFail($user->id_prov_asal);
        $kab = regency::findOrFail($user->id_kab_asal);
        $roles = role::findOrFail($user->id_role);

    	// $prof = profesi::all();
     //    $provinsi = province::all();
     //    $kab = regency::all();
     //    $roles = role::all();

        return  view('\perdes\perdesProfil', ['role' => $peran, 'us'=>$user, 'profs' => $prof, 'provinsis' => $provinsi, 'kabs' => $kab, 'roles' => $roles]);
    }

    public function pengumuman($id)
    {
        $stat = "";
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);

        $ann = pengumuman::all();
        foreach ($ann as $key) {
            $pengumuman = DB::table('pengumuman')
                        ->join('users', 'pengumuman.id_penulis','=','users.id')
                        // ->where('users.id','=', $key->id_penulis)
                        ->select('pengumuman.*','users.nama')
                        ->orderBy('created_at', 'desc')
                        ->paginate(4);    
        }
        // dd($pengumuman);

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
        // dd($dataId);
        return view('\perdes\announcePerdes', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId, 'status'=>$stat]);
    }

    public function lihatAnn($id, $id2)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);
        // $umumkan = pengumuman::findOrFail($id2);
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

        return view('\perdes\LihatAnnounce', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'ubah'=>$ubah]);
    }

    public function baruAnn($id)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);
        
        return view('\perdes\newAnnounce', ['us'=>$user, 'role'=>$peran]);
    }

    public function createAnn(Request $req, $id)
    {
        $this->validate($req,[
            'judul' => 'required|string|min:4|unique:pengumuman',
            'isi' => 'required|string|min:12',
            'status' => 'required',
        ]);

        // pengumuman::create([
        //     'judul' => $req->judul,
        //     'isi' => $req->isi,
        //     'id_penulis' => $id
            
        // ]);

        // $date = Carbon::now();
        // $carbon = Carbon::createFromFormat('Y-m-d H:i:s', $date, 'UTC'); 
        // $carbon->tz = 'Asia/Jakarta';

        $ann = new pengumuman;
        $ann->judul = $req->judul;
        $ann->isi = $req->isi;
        $ann->status = $req->status;
        $ann->id_penulis = $id;
        $ann->save();

        $id2 = $ann->id;
        return redirect('/perdes/'.$id.'/pengumuman/'.$id2);
    }

    public function editAnn($id, $id2)
    {
        $user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);
        $ann = pengumuman::findOrFail($id2);

        return view('\perdes\editAnnounce', ['us'=>$user, 'role'=>$peran, 'ann'=>$ann]);
    }

    public function updateAnn(Request $req, $id, $id2)
    {
        $this->validate($req,[
            'judul' => 'required|string|min:4',
            'isi' => 'required|string|min:12',
            // 'status' => 'required',
        ]);

        $ann = pengumuman::findOrFail($id2);
        $ann->judul = $req->judul;
        $ann->isi = $req->isi;
        // $ann->status = $req->status;
        $ann->id_pengubah = $id;
        $ann->save();

        return redirect('/perdes/'.$id.'/pengumuman/'.$id2);

    }

    public function statusAnn(Request $req, $id, $id2)
    {
        $this->validate($req,[
            'status' => 'required'
        ]);
        
        $ann = pengumuman::findOrFail($id2);

        if ( ($req->status == "dipublikasi") && ($ann->published_at == "") ) {
            $publish = Carbon::now();
            $ann->status = $req->status;
            $ann->published_at = $publish;
            $ann->id_pengubah = $id;
            $ann->save();

            $users = User::where('id','!=',$id)->get();
            Notification::send($users, new notifPengumuman($ann));
        }
        elseif ( ($req->status == "dipublikasi") && ($ann->published_at != "") ) {
            $publish = Carbon::now();
            $ann->status = $req->status;
            $ann->published_at = $publish;
            $ann->id_pengubah = $id;
            $ann->save();
        }
        elseif ($req->status == "disimpan") {
            $ann->status = $req->status;
            $ann->id_pengubah = $id;
            $ann->save();

            // $notifikasi = Notification:: where("data['ann_id']",$id2)->get();
            $notifikasi = DB::table('notifications')->where('type','App\Notifications\notifPengumuman')->get();
            // dd($notifikasi);
            foreach ($notifikasi as $key) {
                $isiData = $key->data;
                $hasil = json_decode($isiData);
                $annId = $hasil->ann_id;
                // dd($annId);

                if ($annId == $id2) {
                    // dd($key->id);
                    DB::table('notifications')->where('id', $key->id)->delete();
                }
            }
        }
        
        return redirect('/perdes/'.$id.'/pengumuman/'.$id2);

    }

    // public function filterStat(Request $req)
    // {
    //     $stat = $req->status;
    //     $user = Auth::user();
    //     $peran = role::findOrFail($user->id_role);

    //     if ($req->status == "disimpan") {
    //         $ann = pengumuman::all();
    //         foreach ($ann as $key) {
    //             $pengumuman = DB::table('pengumuman')
    //                         ->join('users', 'pengumuman.id_penulis','=','users.id')
    //                         ->where('status', '=', $req->status)
    //                         ->select('pengumuman.*','users.nama')
    //                         ->orderBy('published_at', 'desc')
    //                         ->paginate(4);    
    //         }
            
    //     }
    //     elseif ($req->status == "dipublikasi") {
    //         $ann = pengumuman::all();
    //         foreach ($ann as $key) {
    //             $pengumuman = DB::table('pengumuman')
    //                         ->join('users', 'pengumuman.id_penulis','=','users.id')
    //                         ->where('status', '=', $req->status)
    //                         ->select('pengumuman.*','users.nama')
    //                         ->orderBy('published_at', 'desc')
    //                         ->paginate(4);    
    //         }
    //     }elseif ($req->status == "semua"){
    //         $ann = pengumuman::all();
    //         foreach ($ann as $key) {
    //             $pengumuman = DB::table('pengumuman')
    //                         ->join('users', 'pengumuman.id_penulis','=','users.id')
    //                         // ->where($req->status, '=', 'dipublikasi')
    //                         ->select('pengumuman.*','users.nama')
    //                         ->orderBy('published_at', 'desc')
    //                         ->paginate(4);    
    //         }
    //     }

    //     $notifications = Auth::user()->unreadNotifications()->where('type','App\Notifications\notifPengumuman')->get();

    //     if ($notifications->isNotEmpty()) {
    //         foreach ($notifications as $notif) {
    //             $dt = $notif->data;
    //             $dataId[] = $dt['ann_id'];
                
    //         }    
    //     } else {
    //         $dataId = 0;
    //     }
    //     // dd($pengumuman);

    //     return view('\perdes\announcePerdes', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId, 'status'=>$stat]);
    // }

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
        return view('\perdes\announcePerdes', ['us'=>$user, 'role'=>$peran, 'ann'=>$pengumuman, 'data'=>$dataId]);
    }

}
