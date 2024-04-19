<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Auth;
use App\Models\CMTQ;
use App\Models\GMTQ;
use App\Models\Nilai;
use App\Models\User;
use App\Models\Peserta;
use App\Models\PesertaFiles;
use App\Models\NoPeserta;
use App\Models\NoLoot;
use App\Models\Bidang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Laravel\Facades\Telegram;

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
	
	public function store(Request $req)
	{
		$req->validate([
            'nama' => 'required',
            'jk' => 'required',
        ]);
		
		$uid = Auth::user()->id;
		
		User::where('id', $uid)->update([
			'name' => $req->nama,
			'nomor_induk' => $req->user_id,
			'email' => $req->email ?? NULL,
			'jk' => $req->jk,
			'tempat_lahir' => $req->ttl1,
			'tanggal_lahir' => $req->ttl2,
			'telp' => $req->no_telp,
			'pekerjaan' => $req->pekerjaan ?? NULL,
			'alamat' => $req->alamat,
		]);
		
		$cek = PesertaFiles::where('user_id',$uid)->first();
		$path = public_path('uploads/BerkasPeserta/'.Auth::user()->nomor_induk);
		
		$foto = $req->file('foto') ?? NULL;
		$kk = $req->file('kk') ?? NULL;
		$ktp = $req->file('ktp') ?? NULL;
		$akta = $req->file('akta') ?? NULL;
		$ijazah = $req->file('ijazah') ?? NULL;
		$s1 = $req->file('s1') ?? NULL;
		$dp = $req->file('dp') ?? NULL;
		
		$nfoto = $req->user_id.'.Foto';
		$nkk = $req->user_id.'.KK';
		$nktp = $req->user_id.'.KTP';
		$nakta = $req->user_id.'.Akta';
		$nijazah = $req->user_id.'.Ijazah';
		$ns1 = $req->user_id.'.Sertifikat';
		$ndp = $req->user_id.'.FileTambahan';
		
				if ($foto != null) {
					
					$flname = $nfoto.'.'.$foto->extension();
					if(!Storage::exists($path)){
						Storage::makeDirectory($path);
					}
					
					$foto->move($path, $flname);  
					$files = $nfoto;
				}
				if ($kk != null) {
					
					$flkk = $nkk.'.'.$kk->extension();
					if(!Storage::exists($path)){
						Storage::makeDirectory($path);
					}
					
					$kk->move($path, $flkk);  
					$files = $nkk;
				}
				if ($ktp != null) {
					
					$flktp = $nktp.'.'.$ktp->extension();
					if(!Storage::exists($path)){
						Storage::makeDirectory($path);
					}
					
					$ktp->move($path, $flktp);  
					$files = $nktp;
				}
				if ($akta != null) {
					
					$flakta = $nakta.'.'.$akta->extension();
					if(!Storage::exists($path)){
						Storage::makeDirectory($path);
					}
					
					$akta->move($path, $flakta);  
					$files = $nakta;
				}
				if ($ijazah != null) {
					
					$flijazah = $nijazah.'.'.$ijazah->extension();
					if(!Storage::exists($path)){
						Storage::makeDirectory($path);
					}
					
					$ijazah->move($path, $flijazah);  
					$files = $nijazah;
				}
				if ($s1 != null) {
					
					$fls1 = $ns1.'.'.$s1->extension();
					if(!Storage::exists($path)){
						Storage::makeDirectory($path);
					}
					
					$s1->move($path, $fls1);  
					$files = $ns1;
				}
				if ($dp != null) {
					
					$fldp = $ndp.'.'.$dp->extension();
					if(!Storage::exists($path)){
						Storage::makeDirectory($path);
					}
					
					$dp->move($path, $fldp);  
					$files = $ndp;
				}
		
		if(!empty($cek)){
			PesertaFiles::where('user_id',$uid)->update([
				'foto' => $flname ?? $cek->foto, 
				'kk' => $flkk  ?? $cek->kk, 
				'ktp' => $flktp ?? $cek->ktp, 
				'akta' => $flakta ?? $cek->akta, 
				'ijazah' => $flijazah ?? $cek->ijazah,
				'sertifikat' => $fls1 ?? $cek->sertifikat,
				'tambahan' => $fldp  ?? $cek->tambahan,
			]);
		}else{
			PesertaFiles::create([
				'user_id' => $uid,
				'foto' => $flname ?? NULL, 
				'kk' => $flkk ?? NULL,
				'ktp' => $flktp ?? NULL,
				'akta' => $flakta ?? NULL,
				'ijazah' => $flijazah ?? NULL,
				'sertifikat' => $fls1 ?? NULL,
				'tambahan' => $fldp ?? NULL,
			]);
		}
	}
}