<?php

namespace App\Http\Controllers\BackEnd;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Peserta;
use App\Models\PesertaFinal;
use App\Models\CMTQ;
use App\Models\GMTQ;
use App\Models\Nilai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
			'cmtq' => CMtq::all(),
			'gmtq' => GMtq::all(),
			'peserta' => PesertaFinal::with(['cmtq', 'gmtq'])->latest()->get(),
        ];
        return view('backend.pages.dashboard', $data);
    }
	
}
