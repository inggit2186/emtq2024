<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use App\Models\CMTQ;
use App\Models\GMTQ;
use App\Models\NoPeserta;
use App\Models\NoLoot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DataLootController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Nomor Loot',
			'cmtq' => CMTQ::all(),
        ];
        return view('backend.pages.DataLoot.index', $data);
    }

    public function ceknocabang($id)
	{
		$data = GMTQ::where('cmtq_id',$id)->get();
		return response()->json($data);
	}
	
	public function cekaktivity()
	{
		$data = [
            'title' => 'Data Aktifitas',
			'activity' => Activity::latest()->get(),
        ];
        return view('backend.pages.DataLoot.cekaktivity', $data);
	}
	
	public function cekloot(Request $req)
	{
		$data = [
            'title' => 'Data Nomor Loot',
			'gmtq' => GMTQ::findOrfail($req->gmtq),
			'jmlp' => NoPeserta::where(['gmtq_id' => $req->gmtq, 'jk' => 'Putra'])->count(),
			'jmlw' => NoPeserta::where(['gmtq_id' => $req->gmtq, 'jk' => 'Putri'])->count(),
			'peserta' => NoPeserta::where('gmtq_id',$req->gmtq)->get(),
        ];
		return view('backend.pages.DataLoot.cekloot', $data);
	}
	
	public function destroy($id)
    {	
		$lid = Crypt::decrypt($id);
		NoPeserta::destroy($lid);
        return redirect()->back()->with('status', 'Data Loot berhasil dihapus :D');
    }
}
