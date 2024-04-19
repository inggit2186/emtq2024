<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CMTQ;
use App\Models\GMTQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DataCabangController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Cabang',
            'cmtq' => CMTQ::all(),
        ];
        return view('backend.pages.DataCabang.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Cabang',
        ];
        return view('backend.pages.DataCabang.create', $data);
    }

    public function store(Request $req)
    {	
		
        $req->validate([
            'name' => 'required',
            'penanya' => 'required',
        ]);
        CMTQ::create([
            'kategori' => $req->name,
            'penanya' => $req->penanya,
        ]);
        return redirect(route('data.cabang'))->with('status', 'Data Cabang Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $_dec = Crypt::decrypt($id);
        $data = [
            'title' => 'Edit Petugas',
            'cmtq' => CMTQ::findOrfail($_dec),
        ];
        return view('backend.pages.DataCabang.edit', $data);
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'name' => 'required',
            'penanya' => 'required',
        ]);
		
        CMTQ::where(['id' => $id])->update([
            'kategori' => $req->name,
            'penanya' => $req->penanya,
        ]);
        return redirect(route('data.cabang'))->with('status', 'Data Cabang Berhasil Diubah');

    }

    public function destroy($id)
    {
        $_dec = Crypt::decrypt($id);
        CMTQ::destroy($_dec);
        return redirect(route('data.cabang'))->with('status', 'Data Cabang Berhasil Dihapus');
    }
}
