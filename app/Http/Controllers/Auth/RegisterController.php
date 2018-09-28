<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\profesi;
use App\Models\province;
use App\Models\regency;
use App\Models\role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'jenis_kelamin' => 'required',
            'alamat_asal' => 'required|string|max:100',
            'id_prov_asal' => 'required',
            'id_kab_asal' => 'required',
            'alamat_tinggal' => 'required|string|max:100',
            'profesi_id' => 'required',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required|numeric|max:12',
            'nik' => 'required|numeric|max:16',
            'id_role' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $data)
    {
        return User::create([
            'nama' => $data->nama,
            'password' => Hash::make($data->password),
            // 'password' => ($data->password),
            'jenis_kelamin' => $data->jenis_kelamin,
            'alamat_asal' => $data->alamat_asal,
            'id_prov_asal' => $data->id_prov_asal,
            'id_kab_asal' => $data->id_kab_asal,
            'alamat_tinggal' => $data->alamat_tinggal,
            'profesi_id' => $data->profesi_id,
            'tempat_lahir' => $data->tempat_lahir,
            'tanggal_lahir' => $data->tanggal_lahir,
            'no_hp' => $data->no_hp,
            'email' => $data->email,
            'nik' => $data->nik,
            'id_role' => $data->id_role
        ]);
        
    }

    public function daftar()
    {
        $prof = profesi::all();
        $provinsi = province::all();
        $kab = regency::all();
        $peran = role::all();

        return view('daftar', ['profs' => $prof, 'provinsis' => $provinsi, 'kabs' => $kab, 'roles' => $peran]);
    }

    public function ajax(Request $nilai)
    {
        $id = $nilai->get('nilai');
        $data = DB::table('regencies')->Where('province_id',$id)->get();
        $output = '<option value="">pilih kabupaten</option>';
        foreach ($data as $key) {
            $output .= '<option value="'.$key->id.'">'.$key->name.'</option>';
        }
        echo $output;
    }
}
