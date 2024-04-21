<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Auth;
use App\Models\CMTQ;
use App\Models\GMTQ;
use App\Models\Nilai;
use App\Models\User;
use App\Models\Peserta;
use App\Models\MTQFiles;
use App\Models\PesertaFiles;
use App\Models\Komentar;
use App\Models\NoPeserta;
use App\Models\NoLoot;
use App\Models\Bidang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Laravel\Facades\Telegram;
use Carbon\Carbon;
use File;

class PesertaController extends Controller
{
    public function index()
    {
		$path = public_path('uploads/FilePeserta/');
        return view('frontend.peserta.profil',[
            'files' => PesertaFiles::where('user_id', Auth::user()->id)->first(),
            'path' => public_path('uploads/BerkasPeserta/'),
        ]);
    }
	
	public function getCabang(){
		$cabang = CMTQ::all();
		
		return response()->json([
				'success' => true,
				'data' => $cabang,
			]);
	}
	
	public function getKategori(){
		$cabang = GMTQ::all();
		
		return response()->json([
				'success' => true,
				'data' => $cabang,
			]);
	}
	
	public function cabangMTQ($id){
		$cabang = GMTQ::where('cmtq_id',$id)->get();
		$role = Auth::user()->role ?? 'none';
		$kontingen = Auth::user()->kontingen_id ?? 0;
		
		$cabang = $cabang->map(function($f) use ($role,$kontingen){
			
			if($role == 'Official'){
				$jmlp = User::where(['role' => 'Peserta', 'kategori_id' => $f->id, 'kontingen_id' => $kontingen, 'jk' => 'Putra'])->count();
				$jmlw = User::where(['role' => 'Peserta', 'kategori_id' => $f->id, 'kontingen_id' => $kontingen, 'jk' => 'Putri'])->count();
			}else{
				$jmlp = Peserta::where(['kategori_id' => $id,'jk' => 'Putra'])->where(function ($query){
						$query->where('status',3)->orWhere('status',5);
					})->count();
				$jmlw = Peserta::where(['kategori_id' => $id,'jk' => 'Putri'])->where(function ($query){
						$query->where('status',3)->orWhere('status',5);
					})->count();
			}
			
			if($f->team > 0){
				$teamstatus = 'team';
			}else{
				$teamstatus = 'personal';
			}
			
			$map = [
				'id' => $f->id,
				'golongan' => $f->golongan,
				'cmtq_id' => $f->cmtq_id,
				'jml_p' => $f->jml_p,
				'jml_w' => $f->jml_w,
				'jmlp' => $jmlp,
				'jmlw' => $jmlw,
				'max_p' => $f->max_p,
				'max_w' => $f->max_w,
				'team' => $f->team,
				'teamstatus' => $teamstatus,
				'kode' => $f->kode,
				'min' => $f->min,
				'max' => $f->max,
				'user_id' => $f->user_id,
			];
			return $map;
		});
		
		return response()->json([
				'success' => true,
				'data' => $cabang,
			]);
	}
	
	public function pesertaMTQ($id){
		$peserta = Peserta::where('kategori_id',$id)->where(function ($query){
					$query->where('status',3)->orWhere('status',5);
				})->orderBy('jk','ASC')->orderBy('team','ASC')->get();
		
		$peserta = $peserta->map(function($f){
			$random = Str::random(20);
			$random2 = Str::random(20);
			
			if($f->pp() == 'NONE'){
				$pp = asset('uploads/BerkasPeserta').'/defaultpp.png?t='.$random;
			}else{
				$pp = asset('uploads/BerkasPeserta').'/'.$f->id.'/'.$f->pp().'?t='.$random;
			}
			
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
				'status' => $f->peserta->status ?? 1,
				'update' => Carbon::parse($f->updated_at)->translatedFormat('d F Y H:i'),
			];
			return $map;
		});
		
		$kategori = GMTQ::findOrfail($id);
		$cabang = $kategori->cmtq->kategori;
		
		return response()->json([
				'success' => true,
				'cabang' => $cabang,
				'kategori' => $kategori->golongan,
				'data' => $peserta,
			]);
	}
	
	public function getBerkas($id){
		$random = Str::random(20);
		$random2 = Str::random(20);
		
		$peserta = User::where('id',$id)->first();
		
		if($peserta->kontingen_id == Auth::user()->kontingen_id){
			if($peserta->pp() == 'NONE'){
				$peserta->pp = asset('uploads/BerkasPeserta').'/defaultpp.png?t='.$random;
			}else{
				$peserta->pp = asset('uploads/BerkasPeserta').'/'.$peserta->id.'/'.$peserta->pp().'?t='.$random;
			}
			
			$peserta->nik = "$peserta->nomor_induk";
			$peserta->telp = preg_replace('/(?<=\d)(?=(\d{4})+$)/', ' ', $peserta->telp);
			$peserta->umur = $peserta->umur();
			$peserta->status = $peserta->peserta->status ?? 1;
			$peserta->kontingenx = $peserta->kontingen->kontingen;
			$peserta->tanggallahir = Carbon::parse($peserta->tanggal_lahir)->translatedFormat('d F Y');
			$peserta->cabang = $peserta->cmtq->kategori ?? '-';
			$peserta->kategori = $peserta->gmtq->golongan ?? '-';
			
			$komen = Komentar::where(['to_user' => $id])->orderBy('created_at','ASC')->get();
			$komen = $komen->map(function($f){
				
				if($f->user_id == Auth::user()->id){
					$sender = $f->user->name;
					$st = 'user';
				}else{
					$sender = $f->user->pekerjaan;
					$st = 'petugas';
				}
				
				$map = [
					'id' => $f->id,
					'sender' => $sender,
					'st' => $st,
					'komen' => $f->komentar,
					'waktu' => $f->created_at->diffForHumans()
				];
				return $map;
			});
			
			$syarat = PesertaFiles::where(['user_id' => $id])->join('mtq_files', function($join)
				{
					$join->on('peserta_files.files_id', '=', 'mtq_files.id');
				})->get();
			
			$syarat = $syarat->map(function($f){
					
					$random = Str::random(20);
			
					if($f->filename != 'NONE'){
						$path = asset('uploads/BerkasPeserta').'/'.$f->user_id.'/'.$f->filename.'?t='.$random;
					}else{
						$path = 'NONE';
					}
					
					$map = [
						'id' => $f->files_id,
						'nama' => $f->nama,
						'wajib' => $f->wajib,
						'fileUrl' => $path,
						'filename' => $f->filename,
					];
					return $map;
				});
			
			return response()->json([
					'success' => true,
					'data' => $peserta,
					'syarat' => $syarat,
					'komen' => $komen,
			   ]);
		}else{
			return response()->json([
					'success' => false,
					'message' => 'Anda Tidak Memiliki Hak Akses ke Bagian Ini',
			   ]);
		}
	}
	
	public function uploadSyarat(Request $req){
		$datareq = PesertaFiles::where(['user_id' => $req->userid, 'files_id' => $req->id])->first();
		$sy = MTQFiles::findOrfail($req->id);
		
		$fname=preg_replace('/[^A-Za-z0-9]/', '', $sy->nama);
		$name = $datareq->user_id.'.'.$fname;
		$extension = explode('/', mime_content_type($req->filex))[1];
		
		if(!empty($req->filex)){
			$flname = $name.'.'.$extension;
		}else{
			$flname = 'NONE';
		}
		
		$path = $datareq->user_id."/".$flname;
		
		if(!Storage::exists($path)){
			Storage::makeDirectory($path);
		}
		
		Storage::disk('berkas_peserta')->put($path, file_get_contents($req->filex));
		
		$upload = PesertaFiles::where(['user_id' => $req->userid, 'files_id' => $req->id])->update([
			'filename' => $flname,
			'status' => 1,
			'keterangan' => $sy->nama.' Sudah Diupload'
		]);
		
		$syarat = PesertaFiles::where(['user_id' => $req->userid])->join('mtq_files', function($join)
			{
				$join->on('peserta_files.files_id', '=', 'mtq_files.id');
			})->get();
		
		$syarat = $syarat->map(function($f){
				
				$random = Str::random(20);
		
				if($f->filename != 'NONE'){
					$path = asset('uploads/BerkasPeserta').'/'.$f->user_id.'/'.$f->filename.'?t='.$random;
				}else{
					$path = 'NONE';
				}
				
				$map = [
					'id' => $f->files_id,
					'nama' => $f->nama,
					'status' => $f->status,
					'wajib' => $f->wajib,
					'keterangan' => $f->keterangan,
					'fileUrl' => $path,
					'filename' => $f->filename,
				];
				return $map;
			});
		
		return response()->json([
				'success' => true,
				'message' => 'File Berhasil Diupload!!',
				'syarat' => $syarat,
		   ]);
	}
	
	public function deleteSyarat(Request $req){
		$datareq = PesertaFiles::where(['user_id' => $req->userid, 'files_id' => $req->id])->first();
		$file = public_path('uploads/BerkasPeserta/'.$datareq->user_id."/".$datareq->filename);
		$result = File::exists($file);
		if($result){
			unlink($file);
		}
		
		$delete = PesertaFiles::where(['user_id' => $req->userid, 'files_id' => $req->id])->update([
			'filename' => 'NONE',
			'status' => 0,
			'keterangan' => 'Silahkan Upload Disini',
		]);
		
		$syarat = PesertaFiles::where(['user_id' => $req->userid])->join('mtq_files', function($join)
			{
				$join->on('peserta_files.files_id', '=', 'mtq_files.id');
			})->get();
		
		$syarat = $syarat->map(function($f){
				
				$random = Str::random(20);
		
				if($f->filename != 'NONE'){
					$path = asset('uploads/BerkasPeserta').'/'.$f->user_id.'/'.$f->filename.'?t='.$random;
				}else{
					$path = 'NONE';
				}
				
				$map = [
					'id' => $f->files_id,
					'nama' => $f->nama,
					'status' => $f->status,
					'wajib' => $f->wajib,
					'keterangan' => $f->keterangan,
					'fileUrl' => $path,
					'filename' => $f->filename,
				];
				return $map;
			});
		
		return response()->json([
				'success' => true,
				'message' => 'File Berhasil Dihapus!!',
				'syarat' => $syarat,
		   ]);
	}
	
	public function updatePeserta(Request $req){
		$peserta = User::where('id',$req->userid)->first();
		
		if($peserta->kontingen_id == Auth::user()->kontingen_id){
			if($req->statusx == 'new'){
				Peserta::updateOrCreate([
					'user_id'   => $peserta->id,
				],[
					'jk' => $peserta->jk,
					'team' => $peserta->team,
					'kategori_id' => $peserta->kategori_id,
					'golongan_id' => $peserta->golongan_id,
					'status' => 2
				]);
				return response()->json([
					'success' => true,
					'message' => 'Data & Dokumen Peserta Berhasil Diajukan',
			   ]);
			}else if($req->statusx == 'batal'){
				Peserta::where('user_id',$peserta->id)->delete();
				
				return response()->json([
					'success' => true,
					'message' => 'Data & Dokumen Peserta Dibatalkan diajukan',
			   ]);
			}
		}else{
			return response()->json([
					'success' => false,
					'message' => 'Anda Tidak Memiliki Hak Akses ke Bagian Ini',
			   ]);
		}
	}
	
	function addKomen(Request $req){
		$addkomen = Komentar::create([
			'user_id' => Auth::user()->id,
			'komentar' => $req->komen,
			'to_user' => $req->userid
		]);
		
		$komen = Komentar::where(['to_user' => $req->userid])->orderBy('created_at','ASC')->get();
			$komen = $komen->map(function($f){
				
				if($f->user_id == Auth::user()->id){
					$sender = $f->user->name;
					$st = 'user';
				}else{
					$sender = $f->user->pekerjaan;
					$st = 'petugas';
				}
				
				$map = [
					'id' => $f->id,
					'sender' => $sender,
					'st' => $st,
					'komen' => $f->komentar,
					'waktu' => $f->created_at->diffForHumans()
				];
				return $map;
			});
			
		return response()->json([
				'success' => true,
				'message' => 'Komentar berhasil ditambahkan!',
				'komen' => $komen
			]);
	}
}