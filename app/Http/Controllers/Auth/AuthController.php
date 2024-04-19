<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
	
	public function register()
    {
        return view('auth.register');
    }
	
	public function isEmailExist(Request $req)
    {
		echo "<span>tes tes</span>";
    }
	
    public function login()
    {
        return view('auth.BE_login');
    }

    public function prosesLogin(Request $req)
    {
        // dd($req->all());
        if (Auth::attempt(['email' => $req->email, 'password' => '12345'])) {
            if(Auth::user()->role === 'user' ) {
               return redirect(route('cmtq'));   
            }
			else if(Auth::user()->role === 'peserta' ) {
               return redirect(route('profil'));   
            }
            else if (Auth::user()->role === 'admin' || Auth::user()->role === 'petugas'){
                return redirect(route('dashboard'));
            }
        } else {
            return redirect()->back()->with('error', 'User ID Yang Anda Masukan Salah');
        }
    }
	
	public function prosesRegister(Request $request)
    {
        $request->validate([
            'nomor_induk' => 'required|unique:users',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'name' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'alamat' => 'required'
        ]);
		
		User::create([
            'nomor_induk' => $request->nomor_induk,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
			'name' => $request->name,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'role' => 'user',
            'dept_id' => '103',
        ]);
		
		return redirect()->route('login')->with('status', 'Akun Berhasil Didaftarkan, Silahkan Login untuk Melanjutkan');;
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
            return redirect()->route('login')->with('status', 'Logout Berhasil, Silahkan Login kembali untuk memakai layanan kami');
        } else {
            return redirect()->back();
        }
    }
}
