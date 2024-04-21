<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\CMTQ;
use App\Models\GMTQ;
use App\Models\Kontingen;
use App\Models\MTQFiles;
use App\Models\PesertaFiles;
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
			$user->kontingen = $user->kontingen->kontingen ?? 'Other';
		   
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
			$user->kontingen = $user->kontingen->kontingen ?? 'Other';
		   
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
			$user->kontingen = $user->kontingen->kontingen ?? 'Other';
		   
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
		$kontingen = Kontingen::findOrfail($req->id);
		$peserta = User::where(['role' => 'Peserta', 'kontingen_id' => $req->id])->orderBy('kategori_id','ASC')->orderBy('jk','ASC')->orderBy('team','ASC')->get();
		
		$peserta = $peserta->map(function($f){
			$random = Str::random(20);
			$random2 = Str::random(20);
			
			if($f->pp() == 'NONE'){
				$pp = asset('uploads/BerkasPeserta').'/defaultpp.png?t='.$random;
			}else{
				$pp = asset('uploads/BerkasPeserta').'/'.$f->id.'/'.$f->pp().'?t='.$random;
			}
			
			$update = $f->peserta->updated_at ?? $f->update_at;
			$map = [
				'pp' => $pp,
				'id' => $f->id,
				'name' => $f->name,
				'nik' => "$f->nomor_induk",
				'tempat_lahir' => $f->tempat_lahir,
				'tanggal_lahir' => Carbon::parse($f->tanggal_lahir)->translatedFormat('d F Y'),
				'umur' => $f->umur(),
				'cabang' => $f->cmtq->kategori ?? '-',
				'golongan' => $f->gmtq->golongan ?? '-',
				'jk' => $f->jk,
				'teamstatus' => $f->gmtq->team,
				'team' => $f->team,
				'verifikator' => User::where('id',$f->peserta->verifikator ?? 0)->pluck('name')->first() ?? '-',
				'keterangan' => $f->peserta->keterangan ?? '-',
				'status' => $f->peserta->status ?? 1,
				'update' => Carbon::parse($update)->translatedFormat('d F Y H:i'),
			];
			return $map;
		});
		
		return response()->json([
				'success' => true,
				'data' => $peserta,
				'kontingen' => $kontingen->kontingen
		   ]);
	}
	
	public function savePeserta(Request $request){
		
		$messages = [
		  'required'  => '":attribute" Harus Diisi!!',
		  'unique'    => '":attribute" Sudah Pernah Disimpan/Terdaftar/Ada di Database'
		];
		
		if($request->statusx == 'reg'){
			$validator = \Validator::make($request->all(), [
				'nama' => 'required',
				'nik' => 'required',
				'kk' => 'required',
				'tempat_lahir' => 'required',
				'tanggal_lahir' => 'required',
				'telp' => 'required',
				'jk' => 'required',
				'email' => 'required',
				'password' => 'required',
			],$messages);
		}else{
			$validator = \Validator::make($request->all(), [
				'nama' => 'required',
				'nik' => 'required',
				'kk' => 'required',
				'tempat_lahir' => 'required',
				'tanggal_lahir' => 'required',
				'telp' => 'required',
				'jk' => 'required',
				'email' => 'required',
			],$messages);
		}
		
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
		
		if($request->statusx == 'reg'){
			$user = User::where('nomor_induk',$request->nik)->first();
		}else if($request->statusx == 'edit'){
			$user = User::where('id','!=',$request->gid)->where('nomor_induk',$request->nik)->first();
		}
		
		if(!$user){
			if($request->statusx == 'reg'){
				$cekemail = User::where('email',$request->email)->first();
				$berkas = MTQFiles::all();
			}else if($request->statusx == 'edit'){
				$cekemail = User::where('id','!=',$request->gid)->where('email',$request->email)->first();
			}
			
			if(!$cekemail){
				if($request->statusx == 'reg'){
					$kuota = GMTQ::findOrfail($request->gid);
					
					if($request->jk == 'Putra'){
						$utusan = User::where(['role' => 'Peserta', 'kategori_id' => $request->gid, 'kontingen_id' => Auth::user()->kontingen_id, 'jk' => 'Putra'])->count();
						if($kuota->team == 0){
							if($utusan >= $kuota->max_p){
								return response()->json([
									'success' => false,
									'message' => '<b style="font-size: 16px">Kuota untuk Peserta Putra sudah Terpenuhi/Didaftarkan!</b><hr/><i style="font-size: 15px">Silahkan <b>Hapus yang terdaftar sebelumnya</b> terlebih dahulu jika ingin Mengubah Peserta</i>',
								]);
							}
						}else{
							if($utusan >= $request->team*($kuota->max_p / $kuota->team)){
								return response()->json([
									'success' => false,
									'message' => '<b style="font-size: 16px">Kuota untuk •Team '.$request->team.'• Peserta Putra sudah Terpenuhi/Didaftarkan!</b><hr/><i style="font-size: 15px">Silahkan <b>Pilih Team lain</b> atau <b>Hapus yang terdaftar sebelumnya</b> terlebih dahulu jika ingin Mengubah Peserta</i>',
								]);
							}
						}
					}else{
						$utusan = User::where(['role' => 'Peserta', 'kategori_id' => $request->gid, 'kontingen_id' => Auth::user()->kontingen_id, 'jk' => 'Putri'])->count();
						if($kuota->team == 0){
							if($utusan >= $kuota->max_w){
								return response()->json([
									'success' => false,
									'message' => '<b style="font-size: 16px">Kuota untuk Peserta Putri sudah Terpenuhi/Didaftarkan!</b><hr/><i style="font-size: 15px">Silahkan <b>Hapus yang terdaftar sebelumnya</b> terlebih dahulu jika ingin Mengubah Peserta</i>',
								]);
							}
						}else{
							if($utusan >= $request->team*($kuota->max_w / $kuota->team)){
								return response()->json([
									'success' => false,
									'message' => '<b style="font-size: 16px">Kuota untuk •Team '.$request->team.'• Peserta Putri sudah Terpenuhi/Didaftarkan!</b><hr/><i style="font-size: 15px">Silahkan <b>Pilih Team lain</b> atau <b>Hapus yang terdaftar sebelumnya</b> terlebih dahulu jika ingin Mengubah Peserta</i>',
								]);
							}
						}
					}
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
						'role' => 'Peserta',
						'kontingen_id' => Auth::user()->kontingen_id,
						'golongan_id' => $request->cid,
						'kategori_id' => $request->gid,
						'team' => $request->team,
					]);
				}else if($request->statusx == 'edit'){
					if(empty($request->password) || $request->password == NULL || $request->password == ''){
						$save = User::where('id',$request->gid)->update([
							'name' => $request->nama,
							'email' => $request->email,
							'nomor_induk' => $request->nik,
							'kk' => $request->kk,
							'tempat_lahir' => $request->tempat_lahir,
							'tanggal_lahir' => Carbon::parse($request->tanggal_lahir),
							'jk' => $request->jk,
							'telp' => $request->telp,
							'pekerjaan' => $request->pekerjaan,
							'satker' => $request->satker,
							'alamat' => $request->alamat,
							'team' => $request->team,
						]);
					}else{
						$save = User::where('id',$request->gid)->update([
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
							'team' => $request->team,
						]);
					}
				}
				
				if($request->statusx == 'reg'){
					$cekuser = User::where('nomor_induk',$request->nik)->first();
					
					foreach($berkas as $berkas){
						PesertaFiles::create([
							'user_id' => $cekuser->id,
							'files_id' => $berkas->id,
							'filename' => 'NONE',
							'status' => 0,
							'keterangan' => 'Silahkan Upload Disini',
						]);
					}
				}
				
				return response()->json([
					'success' => true,
					'message' => 'Data Berhasil Disimpan!!',
			   ]);
			}else{
				return response()->json([
					'success' => false,
					'message' => '<hr/>Email sudah pernah Didaftarkan',
			   ]);
			}
		}else{
				return response()->json([
					'success' => false,
					'message' => 'Peserta dengan no NIK yang sama telah didaftarkan',
			   ]);	
		}
	}
	
    public function logout(Request $request)
    {
         if (Auth::user()) {
				$request->user()->currentAccessToken()->delete();
				return response()->json([
				'success' => true,
				'message' => 'Logout Berhasil.',
		   ]);
        } else {
            return response()->json([
			'success' => false,
			'message' => 'Logout Gagal.',
		   ]);
        }
    } 
}
