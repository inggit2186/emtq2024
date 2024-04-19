<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\CMTQ;
use App\Models\GMTQ;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Mail;
use App\Mail\ConfirmMail;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function cmtq()
    {
		return view('backend.pages.layanan.index', [
            'cmtq' => CMtq::all(),
			'title' => 'Daftar Kategori'
		]);	
    }
    
    public function cmtqfinal()
    {
		return view('backend.pages.layanan.indexfinal', [
            'cmtq' => CMtq::all(),
			'title' => 'Daftar Kategori'
		]);	
    }
	
	public function nilai($id)
	{
		$cid = Crypt::decrypt($id);
		return view('backend.pages.layanan.nilai', [
			'title' => 'Daftar Nilai',
			'cmtq' => CMtq::findOrfail(Crypt::decrypt($id)),
			'gmtq' => GMtq::with('cmtq')->where('cmtq_id',$cid)->get(),
			'gmtq2' => GMtq::with('cmtq')->where('cmtq_id',$cid)->get(),
		]);
	}
	
	public function nilaifinal($id)
	{
		$cid = Crypt::decrypt($id);
		return view('backend.pages.layanan.nilaifinal', [
			'title' => 'Daftar Nilai',
			'cmtq' => CMtq::findOrfail(Crypt::decrypt($id)),
			'gmtq' => GMtq::with('cmtq')->where('cmtq_id',$cid)->get(),
			'gmtq2' => GMtq::with('cmtq')->where('cmtq_id',$cid)->get(),
		]);
	}
	
	public function createPDF($id)
    {
        $cid = Crypt::decrypt($id);
        $pdf = PDF::loadView('backend.pages.layanan.nilai_pdf', [
				'cmtq' => CMTQ::findOrfail($cid),
				'gmtq' => GMTQ::with('cmtq')->where('cmtq_id',$cid)->get(),
				]);
        return $pdf->setPaper('a4', 'landscape')->setWarnings(false)->stream('MTQ-KemenagTD.pdf');
    }
    
    public function createPDFfinal($id)
    {
        $cid = Crypt::decrypt($id);
        $pdf = PDF::loadView('backend.pages.layanan.nilaifinal_pdf', [
				'cmtq' => CMTQ::findOrfail($cid),
				'gmtq' => GMTQ::with('cmtq')->where('cmtq_id',$cid)->get(),
				]);
        return $pdf->setPaper('a4', 'landscape')->setWarnings(false)->stream('MTQ-KemenagTD.pdf');
    }
    
    public function createPDF2($id)
    {
        $cid = Crypt::decrypt($id);
        $pdf = PDF::loadView('backend.pages.layanan.nilai2_pdf', [
				'cmtq' => CMTQ::all(),
				'gmtq' => GMTQ::all(),
				]);
        return $pdf->setPaper('a4', 'portrait')->setWarnings(false)->stream('MTQ-KemenagTD.pdf');
    }
    
    public function createPDF2final($id)
    {
        $cid = Crypt::decrypt($id);
        $pdf = PDF::loadView('backend.pages.layanan.nilai2final_pdf', [
				'cmtq' => CMTQ::all(),
				'gmtq' => GMTQ::all(),
				]);
        return $pdf->setPaper('a4', 'portrait')->setWarnings(false)->stream('MTQ-KemenagTD.pdf');
    }
	
	public function createFinalis($id)
    {
        $cid = Crypt::decrypt($id);
        $pdf = PDF::loadView('backend.pages.layanan.finalis_pdf', [
			'cmtq' => CMTQ::findOrfail($cid),
			'peserta' => Peserta::where('kategori_id',$cid)->get(),
			'title' => 'Daftar Kategori'
				]);
        return $pdf->setPaper('a4', 'portrait')->setWarnings(false)->stream('MTQ-KemenagTD.pdf');
    }
	
	
	public function filesurat($id)
	{
		//$sid = Crypt::decrypt($id);
		$syid = Surat::with(['user','dept'])->findOrfail($id);
		$path = public_path('uploads/SuratKeluar/');
		$file=$path."/".$syid->dept_id."/".$syid->surat;
		return response()->file($file);
	}
	
	public function downloadsurat($id)
	{
		//$sid = Crypt::decrypt($id);
		$syid = Surat::with(['user','dept'])->findOrfail($id);
		$path = public_path('uploads/SuratKeluar/');
		$file=$path."/".$syid->dept_id."/".$syid->surat;
		return response()->download($file);
	}
	
	public function filelampiran1($id)
	{
		//$sid = Crypt::decrypt($id);
		$syid = Surat::with(['user','dept'])->findOrfail($id);
		$path = public_path('uploads/SuratKeluar/');
		$file=$path."/".$syid->dept_id."/".$syid->lampiran1;
		return response()->file($file);
	}
	
	public function downloadlampiran1($id)
	{
		//$sid = Crypt::decrypt($id);
		$syid = Surat::with(['user','dept'])->findOrfail($id);
		$path = public_path('uploads/SuratKeluar/');
		$file=$path."/".$syid->dept_id."/".$syid->lampiran1;
		return response()->download($file);
	}
	
	public function filelampiran2($id)
	{
		//$sid = Crypt::decrypt($id);
		$syid = Surat::with(['user','dept'])->findOrfail($id);
		$path = public_path('uploads/SuratKeluar/');
		$file=$path."/".$syid->dept_id."/".$syid->lampiran2;
		return response()->file($file);
	}
	
	public function downloadlampiran2($id)
	{
		//$sid = Crypt::decrypt($id);
		$syid = Surat::with(['user','dept'])->findOrfail($id);
		$path = public_path('uploads/SuratKeluar/');
		$file=$path."/".$syid->dept_id."/".$syid->lampiran2;
		return response()->download($file);
	}

    public function detail($id)
    {
        $_dec = Crypt::decrypt($id);
        $data = [
            'title' => 'Detail Pengaduan',
            'laporan' => UsersRequest::with(['dept', 'user', 'layanan', 'staff'])->findOrfail($_dec),
        ];
        return view('backend.pages.pengaduan.detail', $data);
    }
}
