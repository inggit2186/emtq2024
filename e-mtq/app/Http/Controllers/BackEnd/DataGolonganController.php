<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CMTQ;
use App\Models\GMTQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DataGolonganController extends Controller
{
    public function index($id)
    {
		$gid = Crypt::decrypt($id);
		$cmtq = CMTQ::findOrfail($gid);
        $data = [
            'title' => 'Data Cabang',
            'gid' => $gid,
            'kategori' => $cmtq,
            'cmtq' => GMTQ::where('cmtq_id',$gid)->get(),
        ];
        return view('backend.pages.DataGolongan.index', $data);
    }

    public function create($id)
    {
		$gid = Crypt::decrypt($id);
        $data = [
            'title' => 'Tambah Cabang',
			'cmtq' => CMTQ::findOrfail($gid),
			'user' => User::where('role',"user")->get(),
        ];
        return view('backend.pages.DataGolongan.create', $data);
    }

    public function store(Request $req)
    {	
		
        $req->validate([
            'name' => 'required',
            'operator' => 'required',
        ]);
        GMTQ::create([
            'golongan' => $req->name,
            'cmtq_id' => $req->kategori,
			'jml_p' => $req->jmlp,
            'jml_w' => $req->jmlw,
            'kode' => $req->kode,
            'min' => $req->min,
            'max' => $req->max,
            'user_id' => $req->operator,
        ]);
		
		$gid = Crypt::Encrypt($req->kategori);
        return redirect(route('data.golongan',$gid))->with('status', 'Data Golongan Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $_dec = Crypt::decrypt($id);
        $cid = GMTQ::where('id',$_dec)->first();
		
        $data = [
            'title' => 'Edit Golongan',
            'cmtq' => CMTQ::where('id',$cid->cmtq_id)->first(),
			'gmtq' => $cid,
			'user' => User::where('role',"user")->get(),
        ];
        return view('backend.pages.DataGolongan.edit', $data);
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'name' => 'required',
            'operator' => 'required',
        ]);
		
        GMTQ::where(['id' => $id])->update([
            'golongan' => $req->name,
            'cmtq_id' => $req->kategori,
            'jml_p' => $req->jmlp,
            'jml_w' => $req->jmlw,
            'kode' => $req->kode,
            'min' => $req->min,
            'max' => $req->max,
            'user_id' => $req->operator,
        ]);
		
        $gid = Crypt::Encrypt($req->kategori);
        return redirect(route('data.golongan',$gid))->with('status', 'Data Golongan Berhasil Diubah');

    }

    public function destroy($id)
    {
        $_dec = Crypt::decrypt($id);
		$xgid = GMTQ::where('id',$_dec)->first();
		$gid = Crypt::Encrypt($xgid->cmtq_id);
        GMTQ::destroy($_dec);
        return redirect(route('data.golongan',$gid))->with('status', 'Data Golongan Berhasil Dihapus');
    }
}
