<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $req)
    {
		
		if(Auth::attempt(['email' => $req->email, 'password' => $req->password ])) {
			$user = Auth::user();
			
			if($user->role == "Petugas"){
			   $rtoken = '1456mdkjf898';
		   }else if($user->role == "Official"){
			   $rtoken = '5659cmzxkc5651';
		   }else if($user->role == "Admin"){
			   $rtoken = '1956kokciis3495';
		   }else{
			   $rtoken = 'peserta5659414';
		   }
		   
		   $token = $user->createToken('auth_token')->plainTextToken;
			$user->rtoken = $rtoken;
			$user->noid = "$user->nomor_induk";
			$user->token = $token;
			$user->token_type = 'Bearer';
			$user->kontingen = $user->kontingen->kontingen;
		   
			return response()->json([
				'success' => true,
				'message' => 'Halo '.$user->name.', Selamat Datang di Aplikasi eMTQ Kankemenag Kab.Tanah Datar',
				'data' => $user,
			]);
			   
		}else if(Auth::attempt(['nomor_induk' => $req->email, 'password' => $req->password ])) {
			$user = Auth::user();
			
			if($user->role == "Petugas"){
			   $rtoken = '1456mdkjf898';
		   }else if($user->role == "Official"){
			   $rtoken = '5659cmzxkc5651';
		   }else if($user->role == "Admin"){
			   $rtoken = '1956kokciis3495';
		   }else{
			   $rtoken = 'peserta5659414';
		   }
		   
		    $token = $user->createToken('auth_token')->plainTextToken;
			$user->rtoken = $rtoken;
			$user->noid = "$user->nomor_induk";
			$user->token = $token;
			$user->token_type = 'Bearer';
			$user->kontingen = $user->kontingen->kontingen;
		   
			return response()->json([
				'success' => true,
				'message' => 'Halo '.$user->name.', Selamat Datang di Aplikasi eMTQ Kankemenag Kab.Tanah Datar',
				'data' => $user,
			]);
			
		}else{
			$resp = Http::post(env('URL_SILATAR_API')."/login",[
								  "email" => $req->email,
								  "password" => $req->password,
							]);
			$data = json_decode($resp);
			
			if($data->success == true){
				if($data->data->role == "petugas"){
					$role = "Petugas";
				   $rtoken = '1456mdkjf898';
			   }else if($data->data->role == "pegawai" && $data->data->kategorisatker == 'kua'){
				   $role = "Official";
				   $rtoken = '5659cmzxkc5651';
			   }else if($user->role == "admin"){
				   $role = "Admin";
				   $rtoken = '1956kokciis3495';
			   }else{
				   return response()->json([
						'message' => "Anda Tidak memiliki Hak Akses ke Aplikasi Ini",
						'success' => false,
					]);
			   }
		   
			
				User::create([
					'name' => $data->data->name,
					'email' => $data->data->email,
					'password' => bcrypt($req->password),
					'nomor_induk' => $data->data->nomor_induk,
					'role' => $role,
					'dept_id' => $data->data->dept_id,
				]);
			
			Auth::attempt(['nomor_induk' => $req->email, 'password' => $req->password ]);
			$user = Auth::user();
			
			$token = $user->createToken('auth_token')->plainTextToken;
			$user->rtoken = $rtoken;
			$user->noid = "$user->nomor_induk";
			$user->token = $token;
			$user->token_type = 'Bearer';
			$user->kontingen = $user->kontingen->kontingen;
		   
			return response()->json([
				'success' => true,
				'message' => 'Halo '.$user->name.', Selamat Datang di Aplikasi eMTQ Kankemenag Kab.Tanah Datar',
				'data' => $user,
			]);
			
			}else{
				 return response()->json([
					'message' => $data->message,
					'success' => false,
				]);
			}
		}
    }

	public function cekAuth()
	{
		if(auth('sanctum')->check()){
			$user = auth('sanctum')->user();
			
			return response()->json([
			'success' => true,
			'message' => 'Selamat Datang Kembali Bpk/Ibu '.$user->name,
			'data' => $user,
		   ]);
		}else{
			return response()->json([
			'success' => false,
			'message' => '© Selamat Datang di Aplikasi SILATAR !',
		   ]);
		}
	}
	
	public function reqPeserta(Request $req){
		$peserta = User::where(['role' => 'Peserta', 'kontingen_id' => $req->id])->get();
		
		return response()->json([
				'success' => true,
				'data' => $peserta,
		   ]);
	}
	
	public function savePeserta(Request $request){
		$user = User::where('nomor_induk',$request->nik)->first();
		
		$messages = [
		  'required'  => '":attribute" Harus Diisi!!',
		  'unique'    => '":attribute" Sudah Pernah Disimpan/Terdaftar/Ada di Database'
		];
		
		$validator = \Validator::make($request->all(), [
			'nama' => 'required',
			'nik' => 'required|unique:users,nomor_induk',
			'kk' => 'required',
			'tempat_lahir' => 'required',
			'tanggal_lahir' => 'required',
			'telp' => 'required',
			'jk' => 'required',
			'email' => 'required',
			'password' => 'required',
		],$messages);
		
		if ($validator->fails()) {
			return response()->json([
				'success' => 'validfalse',
				'message' => 'Gagal Disimpan! wajib Diisi',
				'valid' => $validator->errors()
			]);
		};
		
		$cek = substr($request->telp, 0, 2);
		if($cek == '62'){
			$number = substr($request->telp, 2, null);
		}else if($cek == '+6'){
			$number = substr($request->telp, 3, null);
		}else if($cek == '08'){
			$number = substr($request->telp, 1, null);
		}else{
			$number = $request->telp;
		}
		
		if(!$user){
			$cekemail = User::where('email',$request->email)->first();
			
			if(!$cekemail){
				$save = User::create([
					'name' => $request->nama,
					'email' => $request->email,
					'password' => bcrypt($request->password),
					'nomor_induk' => $request->nik,
					'kk' => $request->kk,
					'tempat_lahir' => $request->tempat_lahir,
					'tanggal_lahir' => Carbon::parse($request->tanggal_lahir),
					'jk' => $request->jk,
					'telp' => $request->telp,
					'pekerjaan' => $request->pekerjaan,
					'satker' => $request->satker,
					'alamat' => $request->alamat,
					'role' => 'PESERTA',
					'kontingen_id' => Auth::user()->kontingen_id,
					'golongan_id' => '99',
					'kategori_id' => '99',
				]);
				
				return response()->json([
					'success' => true,
					'message' => 'Data Berhasil Disimpan!!',
			   ]);
			}else{
				return response()->json([
					'success' => false,
					'message' => 'Email sudah pernah Didaftarkan',
			   ]);
			}
		}else{
				return response()->json([
					'success' => false,
					'message' => 'Peserta dengan no NIK yang sama telah didaftarkan',
			   ]);	
		}
	}
	
    public function logout()
    {
        if(auth()){
            auth()->logout();
            return response()->json(
                [
                   'success' => 'Logout Berhasil', 
                   'code' => 200,
                ],201);
        }
    }   
}
