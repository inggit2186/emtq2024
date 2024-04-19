<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Auth;
use App\Models\CMTQ;
use App\Models\GMTQ;
use App\Models\Nilai;
use App\Models\Peserta;
use App\Models\NoPeserta;
use App\Models\NoLoot;
use App\Models\PesertaSemifinal;
use App\Models\PesertaFinal;
use App\Models\Bidang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Laravel\Facades\Telegram;

class SiteController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }
	public function cover()
    {
        return view('frontend.cover');
    }
    // input pengaduan
	public function cmtq()
    {
        return view('frontend.subbagian', [
			'gmtq' => GMTQ::where('user_id', Auth::user()->id)->groupBy('cmtq_id')->get(),
		]);
    }
	
	public function score()
    {
		$user = Auth::user()->name;
		
		if( Auth::user()->role == 'user'){
			$peserta = Peserta::with(['cmtq', 'gmtq'])->where('operator',$user)->latest()->first();
		}else{
			$peserta = Peserta::with(['cmtq', 'gmtq'])->latest()->first();
		}
		
			$nilai = Nilai::with(['cmtq','gmtq','bidang','peserta'])->where(['peserta' => $peserta->nama, 'status' => 0])->get();
			
        return view('frontend.score', [
			'cmtq' => CMtq::all(),
			'peserta' => $peserta,
			'nilai' => $nilai,
		]);
    }
	public function scorefinal()
    {
		$user = Auth::user()->name;
		
		if( Auth::user()->role == 'user'){
			$peserta = PesertaFinal::with(['cmtq', 'gmtq'])->where('operator',$user)->latest()->first();
		}else{
			$peserta = PesertaFinal::with(['cmtq', 'gmtq'])->latest()->first();
		}
		
			$nilai = Nilai::with(['cmtq','gmtq','bidang','peserta'])->where(['peserta' => $peserta->nama,'status' => 2])->get();
			
        return view('frontend.scorefinal', [
			'cmtq' => CMtq::all(),
			'peserta' => $peserta,
			'nilai' => $nilai,
		]);
    }
	
	public function ranking()
    {
        return view('frontend.ranking', [
			'cmtq' => GMTQ::where('user_id', Auth::user()->id)->groupBy('cmtq_id')->get(),
		]);
    }
	
	public function rankingmtq($id)
    {
		$cid = Crypt::decrypt($id);
        return view('frontend.rankingmtq', [
			'cmtq' => CMtq::findOrfail(Crypt::decrypt($id)),
			'gmtq' => GMtq::with('cmtq')->where(['cmtq_id' => $cid,'user_id' => Auth::user()->id])->get(),
			'gmtq2' => GMtq::with('cmtq')->where(['cmtq_id' => $cid,'user_id' => Auth::user()->id])->get(),
		]);
    }
    
    public function rankingfinal($id)
    {
		$cid = Crypt::decrypt($id);
        return view('frontend.rankingfinal', [
			'cmtq' => CMtq::findOrfail(Crypt::decrypt($id)),
			'gmtq' => GMtq::with('cmtq')->where(['cmtq_id' => $cid,'user_id' => Auth::user()->id])->get(),
			'gmtq2' => GMtq::with('cmtq')->where(['cmtq_id' => $cid,'user_id' => Auth::user()->id])->get(),
		]);
    }
	
	public function deleterank($id)
    {
		$pid = Crypt::decrypt($id);
        $peserta = Peserta::findOrfail($pid);
		
		
		Activity::create([
			'user_id' => Auth::user()->id,
			'aktifitas' => "/Delete Nilai/",
			'target' => $peserta->nama,
			'location' => "/Ranking/".$peserta->gmtq->golongan,
			'ip' => \Request::ip(),
			'useragent' => \Request::userAgent(),
		]);
		
		
		$nilaip = Nilai::where(['peserta' => $peserta->nama, 'status' => 0])->delete();
		$peserta->delete();
		return redirect()->back()->with('status', 'Data Nilai berhasil dihapus :D');
    }
    
    public function deleterankfinal($id)
    {
		$pid = Crypt::decrypt($id);
        $peserta = PesertaFinal::findOrfail($pid);
		
		
		Activity::create([
			'user_id' => Auth::user()->id,
			'aktifitas' => "/Delete Nilai Final/",
			'target' => $peserta->nama,
			'location' => "/Ranking/".$peserta->gmtq->golongan,
			'ip' => \Request::ip(),
			'useragent' => \Request::userAgent(),
		]);
		
		
		$nilaip = Nilai::where(['peserta' => $peserta->nama, 'status' => 2])->delete();
		$peserta->delete();
		return redirect()->back()->with('status', 'Data Nilai berhasil dihapus :D');
    }
	
	public function editrank($id)
    {
		$pid = Crypt::decrypt($id);
        $peserta = Peserta::findOrfail($pid);
		$nilaip = Nilai::with(['cmtq','gmtq','peserta','bidang'])->where('peserta',$peserta->nama)->groupBy('bidang_id')->get();
		return view('frontend.editnilai', [
			'peserta' => $peserta,
			'nilai' => Bidang::with('cmtq')->where('cat_id',$peserta->kategori_id)->get(),
			'nilaip' => $nilaip,
			'pid' => $pid,
		]);
    }
    
    public function editrankfinalx($id)
    {
		$pid = Crypt::decrypt($id);
        $peserta = PesertaFinal::findOrfail($pid);
		$nilaip = Nilai::with(['cmtq','gmtq','peserta','bidang'])->where(['peserta' => $peserta->nama, 'status' => 2])->groupBy('bidang_id')->get();
		return view('frontend.editnilaifinal', [
			'peserta' => $peserta,
			'nilai' => Bidang::with('cmtq')->where('cat_id',$peserta->kategori_id)->get(),
			'nilaip' => $nilaip,
			'pid' => $pid,
		]);
    }
	
	public function editstore(Request $request)
    {	
		$date = date('Ymd',strtotime("now"));
		$dept_id = $request->cid;
		$gid = $request->gid;
		$vtotal = 0;
		$nilai = Bidang::with('cmtq')->where('cat_id',$dept_id)->get();
		
		$xtotal=0;
		$nilaip = Nilai::where(['peserta' => $request->dnama, 'status' => 0])->delete();
		
		foreach($nilai as $nilai){
		$i=0;
		$jhakim=0;
		$total = 0;
			for($i=0;$i < $nilai->hakim;$i++){
				$hakim[$i] = $request->input('hakim'.$nilai->id.'-'.$i) ?? NULL;
				
				if($hakim[$i] != NULL){
					$jhakim=$jhakim+1;
				}
				
				$bidang = $nilai->id;
				$xnilai[$i] = $request->input('nilai'.$nilai->id.'-'.$i) ?? NULL;
				$penanya = $request->penanya ?? NULL;
				
				$total = $total+$xnilai[$i];
				
				Nilai::create([
					'peserta' => $request->nama,
					'kategori_id' => $request->cid,
					'golongan_id' => $request->gid,
					'status' => 0,
					'penanya' => $penanya,
					'hakim' => $hakim[$i],
					'nilai' => $xnilai[$i],
					'bidang_id' => $bidang,
					]);
			}
				
				$vtotal = round(($total/$jhakim),2);
				Nilai::where('bidang_id',$nilai->id)->orderBy('id','desc')
						->take(1)->update(['total' => $vtotal]);
				
				
				$xtotal = $xtotal+$vtotal;
		}	
		
	    if($request->gid == 10){
		    $vtotal = $xtotal / 2;
		}
		else{
		    $vtotal = $xtotal;
		}
	    
		Peserta::where('id',$request->id)->update([
			'nama' => $request->nama,
			'utusan' => $request->utusan,
			'jk' => $request->jk,
			'nomor' => $request->nomor,
			'kategori_id' => $request->cid,
			'golongan_id' => $request->gid,
			'total' => $vtotal,
			'operator' => Auth::user()->name,
		]);
		
		Activity::create([
			'user_id' => Auth::user()->id,
			'aktifitas' => "/Edit Nilai/",
			'target' => $request->nama,
			'location' => "/Ranking/gmtq/".$request->gid,
			'ip' => $request->ip(),
			'useragent' => $request->userAgent(),
		]);
		
		$cid = Crypt::Encrypt($request->cid);
        return redirect()->route('ranking.mtq',$cid)->with('status', 'Data Nilai berhasil Dirubah :D');
    }
    
    public function editstorefinal(Request $request)
    {	
		$date = date('Ymd',strtotime("now"));
		$dept_id = $request->cid;
		$gid = $request->gid;
		$vtotal = 0;
		$nilai = Bidang::with('cmtq')->where('cat_id',$dept_id)->get();
		
		$xtotal=0;
		$nilaip = Nilai::where(['peserta' => $request->dnama, 'status' => 2])->delete();
		
		foreach($nilai as $nilai){
		$i=0;
		$jhakim=0;
		$total = 0;
			for($i=0;$i < $nilai->hakim;$i++){
				$hakim[$i] = $request->input('hakim'.$nilai->id.'-'.$i) ?? NULL;
				
				if($hakim[$i] != NULL){
					$jhakim=$jhakim+1;
				}
				
				$bidang = $nilai->id;
				$xnilai[$i] = $request->input('nilai'.$nilai->id.'-'.$i) ?? NULL;
				$penanya = $request->penanya ?? NULL;
				
				$total = $total+$xnilai[$i];
				
				Nilai::create([
					'peserta' => $request->nama,
					'kategori_id' => $request->cid,
					'golongan_id' => $request->gid,
					'status' => 2,
					'penanya' => $penanya,
					'hakim' => $hakim[$i],
					'nilai' => $xnilai[$i],
					'bidang_id' => $bidang,
					]);
			}
				
				$vtotal = round(($total/$jhakim),2);
				Nilai::where('bidang_id',$nilai->id)->orderBy('id','desc')
						->take(1)->update(['total' => $vtotal]);
				
				
				$xtotal = $xtotal+$vtotal;
		}	
		
	    if($request->gid == 10){
		    $vtotal = $xtotal / 2;
		}
		else{
		    $vtotal = $xtotal;
		}
	    
		PesertaFinal::where('id',$request->id)->update([
			'nama' => $request->nama,
			'utusan' => $request->utusan,
			'jk' => $request->jk,
			'nomor' => $request->nomor,
			'kategori_id' => $request->cid,
			'golongan_id' => $request->gid,
			'total' => $vtotal,
			'operator' => Auth::user()->name,
		]);
		
		Activity::create([
			'user_id' => Auth::user()->id,
			'aktifitas' => "/Edit Nilai Final/",
			'target' => $request->nama,
			'location' => "/Ranking/gmtq/".$request->gid,
			'ip' => $request->ip(),
			'useragent' => $request->userAgent(),
		]);
		
		$cid = Crypt::Encrypt($request->cid);
        return redirect()->route('rankingfinal.mtq',$cid)->with('status', 'Data Nilai berhasil Dirubah :D');
    }
	
    public function create($id)
    {
		$deptid = Crypt::decrypt($id);
        $data = [
            'title' => 'Input Nilai',
			'cmtq' => CMtq::findOrfail(Crypt::decrypt($id)),
            'gmtq' => GMtq::with('cmtq')->where(['cmtq_id' => $deptid, 'user_id' => Auth::user()->id])->get(),
            'nilai' => Bidang::with('cmtq')->where('cat_id',$deptid)->get(),
            'nilai2' => Bidang::with('cmtq')->where('cat_id',$deptid)->get(),
            'nilai3' => Bidang::with('cmtq')->where('cat_id',$deptid)->get(),
        ];
        //return view('frontend.input-pengaduan');
		return view('frontend.input-pengaduan', $data);
    }
	
    // storer
    public function store(Request $request, $id)
    {
        // action to store data request into database
        if($request->gid == 0){
		$request->validate([
            'nama' => 'required|unique:mtq_peserta',
            'utusan' => 'required',
            'jlayanan' => 'required',
            'gid' => 'required',
            'jk' => 'required',
        ]);
		}elseif($request->gid == 1){
			$request->validate([
            'nama' => 'required|unique:mtq_peserta_semifinal',
            'utusan' => 'required',
            'jlayanan' => 'required',
            'gid' => 'required',
            'jk' => 'required',
        ]);
		}else{
			$request->validate([
            'nama' => 'required|unique:mtq_peserta_final',
            'jlayanan' => 'required',
            'utusan' => 'required',
            'gid' => 'required',
            'jk' => 'required',
        ]);
		}
		
		$date = date('Ymd',strtotime("now"));
		$dept_id = $id;
		$gid = $request->jlayanan;
		$vtotal = 0;
		$nilai = Bidang::with('cmtq')->where('cat_id',$dept_id)->get();
		
		$xtotal=0;
		foreach($nilai as $nilai){
		$i=0;
		$jhakim=0;
		$total = 0;
			for($i=0;$i < $nilai->hakim;$i++){
				$hakim[$i] = $request->input('hakim'.$nilai->id.'-'.$i) ?? NULL;
				
				if($hakim[$i] != NULL){
					$jhakim=$jhakim+1;
				}
				
				$bidang = $nilai->id;
				$xnilai[$i] = $request->input('nilai'.$nilai->id.'-'.$i) ?? NULL;
				$penanya = $request->penanya ?? NULL;
				
				$total = $total+$xnilai[$i];
				
				Nilai::create([
					'peserta' => $request->nama,
					'kategori_id' => $id,
					'golongan_id' => $request->jlayanan,
					'status' => $request->gid,
					'penanya' => $request->penanya,
					'hakim' => $hakim[$i],
					'nilai' => $xnilai[$i],
					'bidang_id' => $bidang,
					]);
			}
				
				$vtotal = round(($total/$jhakim),2);
				Nilai::where('bidang_id',$nilai->id)->orderBy('id','desc')
						->take(1)->update(['total' => $vtotal]);
		
		    $xtotal = $xtotal+$vtotal;		
		}
		
		if($gid == 10){
		    $dtotal = $xtotal/2;
		}
		else{
		    $dtotal = $xtotal;
		}
		
		if( $request->gid == 0 ){
		 Peserta::create([
			'nama' => $request->nama,
			'utusan' => $request->utusan,
			'jk' => $request->jk,
			'nomor' => $request->nomor,
			'kategori_id' => $id,
			'golongan_id' => $request->jlayanan,
			'total' => $dtotal,
			'operator' => Auth::user()->name,
		]);
		}elseif( $request->gid == 1 ){
		 PesertaSemifinal::create([
			'nama' => $request->nama,
			'utusan' => $request->utusan,
			'jk' => $request->jk,
			'nomor' => $request->nomor,
			'kategori_id' => $id,
			'golongan_id' => $request->jlayanan,
			'total' => $dtotal,
			'operator' => Auth::user()->name,
		]);
		}else{
		 PesertaFinal::create([
			'nama' => $request->nama,
			'utusan' => $request->utusan,
			'jk' => $request->jk,
			'nomor' => $request->nomor,
			'kategori_id' => $id,
			'golongan_id' => $request->jlayanan,
			'total' => $dtotal,
			'operator' => Auth::user()->name,
		]);
		}
		
		Activity::create([
			'user_id' => Auth::user()->id,
			'aktifitas' => "/Input Nilai/",
			'target' => $request->nama,
			'location' => "/Input/gmtq(".$request->jlayanan.")/sesi(".$request->gid.")",
			'ip' => $request->ip(),
			'useragent' => $request->userAgent(),
		]);
		
        return redirect()->route('success');
		
    }

    // sukses page
    public function success()
    {
        return view('frontend.sukses');
    }

    public function destroy($id)
    {
        UsersRequest::destroy($id);
        Activity::create([
            'activity' => Auth::user()->name . ' menghapus Request/Konsultasi/Pengaduan dengan no.Reg:',
        ]);
        return redirect()->route('pengaduan.check')->with('status', 'Data Berhasil Dihapus');
    }
	
	public function nomorloot()
	{
		return view('frontend.nosubbagian', [
			'gmtq' => GMTQ::where('user_id', Auth::user()->id)->groupBy('cmtq_id')->get(),
		]);
	}
	public function createnoloot($id)
    {
		$deptid = Crypt::decrypt($id);
        $data = [
            'title' => 'Pengambilan No Loot',
			'cmtq' => CMtq::findOrfail(Crypt::decrypt($id)),
            'gmtq' => GMtq::with('cmtq')->where(['cmtq_id' => $deptid, 'user_id' => Auth::user()->id])->get(),
        ];
		//return view('frontend.input-pengaduan');
		return view('frontend.input-noloot', $data);
    }
	
	public function storenoloot(Request $req, $id)
    {
			
		$req->validate([
            'peserta' => 'required|unique:no_peserta',
			'nik' => 'unique:no_peserta',
            'jk' => 'required',
            'asal' => 'required',
        ]);
		
		$max = GMTQ::where('id',$req->jlayanan)->first();
		$jmlp = NoPeserta::where(['gmtq_id' => $req->jlayanan, 'jk' => $req->jk])->count();
		if($req->jk == "Putra"){
			$cmax = $max->jml_p;
		}else{
			$cmax = $max->jml_w;
		}
		
		if($jmlp < $cmax){
         NoPeserta::create([
            'peserta' => $req->peserta,
            'nik' => $req->nik,
            'jk' => $req->jk,
            'asal' => $req->asal,
			'cmtq_id' => $id,
			'gmtq_id' => $req->jlayanan,
			'noloot' => 0,
			'operator' => Auth::user()->name,
        ]);
		}else{
			return redirect()->back()->with('error', 'Jumlah Peserta Sudah Penuh');
		}
		$pid = NoPeserta::where('nik', $req->nik )->first();
		$eid = Crypt::Encrypt($pid->id);
		
		Activity::create([
			'user_id' => Auth::user()->id,
			'aktifitas' => "/Input Data Loot Peserta/",
			'target' => $req->peserta,
			'location' => "/Input Loot/".$pid->gmtq->golongan,
			'ip' => $req->ip(),
			'useragent' => $req->userAgent(),
		]);
		
		return redirect()->route('take.noloot',$eid);
    }
	
	public function takenoloot($id)
	{
		$xid = Crypt::decrypt($id);
		$qp = NoPeserta::where('id', $xid)->first();
		
		return view('frontend.noloot', [
		'peserta' => $qp,
		'exlude' => NoPeserta::where('gmtq_id', $qp->gmtq_id)->get(),
		'noloot' => GMTQ::where('id', $qp->gmtq_id)->first(),
		]);
	}
	
	public function updatenoloot(Request $req, $id)
	{
		NoPeserta::where('id',$id)->update([
			'noloot' => $req->noloot,
		]);
		
		Activity::create([
			'user_id' => Auth::user()->id,
			'aktifitas' => "/Ambil Nomor Loot Peserta/",
			'target' => "/no_peserta/".$id,
			'location' => "/Nomor Loot/",
			'ip' => $req->ip(),
			'useragent' => $req->userAgent(),
		]);
	}
	
	
} 
