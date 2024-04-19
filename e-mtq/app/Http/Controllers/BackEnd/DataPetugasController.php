<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DataPetugasController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Petugas',
            'petugas' => User::where(['role' => 'admin'])->get(),
        ];
        return view('backend.pages.DataPetugas.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Petugas',
        ];
        return view('backend.pages.DataPetugas.create', $data);
    }

    public function store(Request $req)
    {	
		
        $req->validate([
            'name' => 'required',
            'nomor_induk' => 'required|unique:users',
            'email' => 'required|unique:users',
            'pekerjaan' => 'required',
            'role' => 'required',
        ]);
        User::create([
            'name' => $req->name,
			'username' => $req->nomor_induk,
            'email' => $req->email,
            'role' => $req->role,
            'password' => bcrypt("12345"),
            'nomor_induk' => $req->nomor_induk,
            'pekerjaan' => $req->pekerjaan,
            'telp' => $req->telp,
			'dept_id' => "1",
        ]);
        return redirect(route('data.petugas'))->with('status', 'Data Petugas Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $_dec = Crypt::decrypt($id);
        $data = [
            'title' => 'Edit Petugas',
            'petugas' => User::findOrfail($_dec),
        ];
        return view('backend.pages.DataPetugas.edit', $data);
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'name' => 'required',
            'nomor_induk' => 'required',
            'email' => 'required',
            'pekerjaan' => 'required',
            'role' => 'required',
        ]);
		
        User::where(['id' => $id])->update([
            'name' => $req->name,
            'email' => $req->email,
            'role' => $req->role,
            'pekerjaan' => $req->pekerjaan,
            'telp' => $req->telp,
            'password' => bcrypt("12345"),
            'nomor_induk' => $req->nomor_induk,
        ]);
        return redirect(route('data.petugas'))->with('status', 'Data Petugas Berhasil Diubah');

    }

    public function destroy($id)
    {
        $_dec = Crypt::decrypt($id);
        User::destroy($_dec);
        return redirect(route('data.petugas'))->with('status', 'Data Petugas Berhasil Dihapus');
    }
}
