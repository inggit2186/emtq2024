<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CMTQ;
use App\Models\GMTQ;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DataBidangController extends Controller
{
    public function index($id)
    {
		$cid = Crypt::decrypt($id);
        $data = [
            'title' => 'Data Bidang Penilaian',
            'cid' => $cid,
			'gmtq' => GMTQ::findOrfail($cid),
            'bidang' => Bidang::where('cat_id',$cid)->get(),
        ];
        return view('backend.pages.DataBidang.index', $data);
    }

    public function create($id)
    {
		$gid = Crypt::decrypt($id);
        $data = [
            'title' => 'Tambah Bidang Penilaian',
			'gmtq' => GMTQ::findOrfail($gid),
        ];
        return view('backend.pages.DataBidang.create', $data);
    }

    public function store(Request $req)
    {	
		
        $req->validate([
            'golongan' => 'required',
            'bidang' => 'required',
            'nilai' => 'required',
            'hakim' => 'required',
        ]);
        Bidang::create([
            'nama' => $req->bidang,
            'cat_id' => $req->golongan,
            'nilai' => $req->nilai,
            'hakim' => $req->hakim,
        ]);
		
		$gid = Crypt::Encrypt($req->golongan);
        return redirect(route('data.bidang',$gid))->with('status', 'Data Bidang Penilaian Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $_dec = Crypt::decrypt($id);
        $cid = Bidang::where('id',$_dec)->first();
		
        $data = [
            'title' => 'Edit Golongan',
            'gmtq' => GMTQ::where('id',$cid->cat_id)->first(),
			'bidang' => $cid,
        ];
        return view('backend.pages.DataBidang.edit', $data);
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'golongan' => 'required',
            'bidang' => 'required',
            'nilai' => 'required',
            'hakim' => 'required',
        ]);
		
        Bidang::where(['id' => $id])->update([
            'nama' => $req->bidang,
            'cat_id' => $req->golongan,
            'nilai' => $req->nilai,
            'hakim' => $req->hakim,
        ]);
		
        $gid = Crypt::Encrypt($req->golongan);
        return redirect(route('data.bidang',$gid))->with('status', 'Data Bidang Penilaian Berhasil Diubah');

    }

    public function destroy($id)
    {
        $_dec = Crypt::decrypt($id);
		$xgid = Bidang::where('id',$_dec)->first();
		$gid = Crypt::Encrypt($xgid->cat_id);
        Bidang::destroy($_dec);
        return redirect(route('data.bidang',$gid))->with('status', 'Data Bidang Penilaian Berhasil Dihapus');
    }
}
