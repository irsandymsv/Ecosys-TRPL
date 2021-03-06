<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\role;
use App\Models\laporan;
use App\Models\tag;
use App\Models\profesi;
use App\Models\province;
use App\Models\regency;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function statistika($id)
    {
     	$user = user::findOrFail($id);
        $peran = role::findOrFail($user->id_role);

        $laporanAll = laporan::all();
        $tagAll = tag::all();
        $profAll = profesi::all();

        $lap_week = laporan::where('created_at', '>' ,Carbon::now()->subDays(7))->get();
        $lap_month = laporan::where('created_at', '>' ,Carbon::now()->subMonth())->get();
        $lap_year = laporan::where('created_at', '>' ,Carbon::now()->subYear())->get();

        $lap_belum = laporan::where('status', 'Belum ditangani')->get();
        $lap_sudah = laporan::where('status', 'Sudah ditangani')->get();

        $kesehatan = tag::where('nama','Kesehatan')->first();
        $pendidikan = tag::where('nama','Pendidikan')->first();
        $kriminalitas = tag::where('nama','Kriminalitas')->first();

        $kes_week = $kesehatan->laporan()->where('created_at', '>', Carbon::now()->subDays(7))->get();
        $pend_week = $pendidikan->laporan()->where('created_at', '>', Carbon::now()->subDays(7))->get();
        $krim_week = $kriminalitas->laporan()->where('created_at', '>', Carbon::now()->subDays(7))->get();

        $kes_month = $kesehatan->laporan()->where('created_at', '>', Carbon::now()->subMonth())->get();
        $pend_month = $pendidikan->laporan()->where('created_at', '>', Carbon::now()->subMonth())->get();
        $krim_month = $kriminalitas->laporan()->where('created_at', '>', Carbon::now()->subMonth())->get();

        $kes_year = $kesehatan->laporan()->where('created_at', '>', Carbon::now()->subYear())->get();
        $pend_year = $pendidikan->laporan()->where('created_at', '>', Carbon::now()->subYear())->get();
        $krim_year = $kriminalitas->laporan()->where('created_at', '>', Carbon::now()->subYear())->get();

        $kesAllYear = array();
        $pendAllYear = array();
        $krimAllYear = array();
        $thisYear = Carbon::now()->year;
        $thisMonth = Carbon::now()->month;
        // dd($thisMonth);
        for ($i=1; $i <= $thisMonth; $i++) { 
            $ks = $kesehatan->laporan()->whereMonth('created_at', $i)->whereYear('created_at', $thisYear)->get();
            $pd = $pendidikan->laporan()->whereMonth('created_at', $i)->whereYear('created_at', $thisYear)->get();
            $kr = $kriminalitas->laporan()->whereMonth('created_at', $i)->whereYear('created_at', $thisYear)->get();
            // dd($ks);

            array_push($kesAllYear, $ks);
            array_push($pendAllYear, $pd);
            array_push($krimAllYear, $kr);
        }
        
        // dd($thisYear);

        // $laps = laporan::where('created_at', '>', Carbon::now()->subDays(7))->get();
        // dd($lap_week);


        return view('/layouts/statistika',
            ['us'=>$user, 
            'role'=>$peran, 
            'laporanAll'=>$laporanAll, 
            'profAll' => $profAll, 
            'tagAll'=> $tagAll,
            'lap_belum' => $lap_belum,
            'lap_sudah' => $lap_sudah,
            'lap_week' => $lap_week,
            'lap_month' => $lap_month,
            'lap_year' => $lap_year,
            'kes_week' => $kes_week,
            'pend_week' => $pend_week,
            'krim_week' => $krim_week,
            'kes_month' => $kes_month,
            'pend_month' => $pend_month,
            'krim_month' => $krim_month,
            'kes_year' => $kes_year,
            'pend_year' => $pend_year,
            'krim_year' =>$krim_year,
            'kesAllYear' => $kesAllYear,
            'pendAllYear' => $pendAllYear,
            'krimAllYear' => $krimAllYear,
            'thisYear' => $thisYear
        ]);

    }

    public function ajaxMap(Request $req)
    {
        $kriminalitas = tag::where('nama','Kriminalitas')->first();
        $kesehatan = tag::where('nama','Kesehatan')->first();
        $pendidikan = tag::where('nama','Pendidikan')->first();
        $thisYear = Carbon::now()->year;

        if ($req->tag == "Kriminalitas") {
            $laporan = $kriminalitas->laporan()->whereMonth('created_at', $req->bulan)->whereYear('created_at', $thisYear)->get();
        }
        elseif ($req->tag == "Pendidikan") {
            $laporan = $pendidikan->laporan()->whereMonth('created_at', $req->bulan)->whereYear('created_at', $thisYear)->get();   
        }
        elseif ($req->tag == "Kesehatan") {
            $laporan = $kesehatan->laporan()->whereMonth('created_at', $req->bulan)->whereYear('created_at', $thisYear)->get(); 
        }
        elseif ($req->tag == "Semua") {
            $laporan = laporan::whereMonth('created_at', $req->bulan)->whereYear('created_at', $thisYear)->get();
        }

        echo $laporan;
    }


    public function ajaxProvKab(Request $req)
    {
        if ($req->id_prov != "") {
            $kab = regency::where("province_id", $req->id_prov)->get();
            foreach ($kab as $key) {
                echo "<option value=".$key->id.">".$key->name."</option>";
            }
        }
        else{
            $kab = regency::all();
            echo '<option value="">---Pilih Kota Asal---</option>';
            foreach ($kab as $key) {
                echo "<option value=".$key->id.">".$key->name."</option>";
            }
        }
    }



}
