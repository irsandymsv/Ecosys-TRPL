<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dash()
    {
        $user = Auth::user();
        // $orang = User::find(3);
        
        // dd($user);
        if ($user->id_role == 1) {
            return redirect('/admin/'.$user->id);
            // return view('\admin\adminPage', ['use' => $user]);
        }
        elseif ($user->id_role == 2){
            return redirect('/warga/'.$user->id);
        }
        elseif ($user->id_role == 4) {
            return redirect('/kades/'.$user->id);
        }
        elseif ($user->id_role == 3){
            return redirect('/perdes/'.$user->id);   
        }
        
    }
}
