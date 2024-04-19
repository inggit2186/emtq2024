<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use App\Models\UsersRequest;
use App\Models\UsersBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Mail;
use App\Mail\ConfirmMail;
use Barryvdh\DomPDF\Facade as PDF;
use Telegram\Bot\Laravel\Facades\Telegram;

class PengaduanController extends Controller
{
    public function index()
    {   
		return view('backend.pages.pengaduan.index', [
            'groupItem' => UsersRequest::with(['dept', 'user', 'layanan'])->latest()->get(),
            'syaratUser' => UsersBerkas::with(['user','request','syarat'])->latest()->get(),
			'Staff' => User::where(['role' => 'petugas', 'dept_id' => Auth::user()->dept_id])->get(),
			'title' => 'Daftar Request'
		]);		
	}
	
	public function getsyarat($id)
    {
        $syarat = UsersBerkas::with(['user','request','syarat'])->where('no_req',$id)->get();
		
		$tr = "";
			foreach($syarat as $sy){
			$sid = Crypt::encrypt($sy->id); 
			$fileurl = route('fileurl','')."/".$sid;
			$fileurl2 = route('fileurl2','')."/".$sid;
		$tr .="<tr><td>".$sy->syarat->syarat."</td><td>";
			if($sy->status == 1) {
		$tr .= "<a href=".$fileurl." target=_blank class='btn btn-sm btn-info'><i class='fas fa-eye'></i></a>&nbsp;<a href=".$fileurl2."  class='btn btn-sm btn-info'><i class='fas fa-download'></i></a></td></tr>";
			}else{
		$tr .= "<i>NONE</i></td></tr>";		
			}
			}
		$tr .="";
		
		return response()->json($tr);
    }
	
	public function fileurl($id)
	{
		$sid = Crypt::decrypt($id);
		$syid = UsersBerkas::with(['user','request','syarat'])->findOrfail($sid);
		$path = public_path('uploads/UsersBerkas/');
		$file=$path."/".$syid->user->nomor_induk."/".$syid->filename;
		return response()->file($file);
	}
	
	public function fileurl2($id)
	{
		$sid = Crypt::decrypt($id);
		$syid = UsersBerkas::with(['user','request','syarat'])->findOrfail($sid);
		$path = public_path('uploads/UsersBerkas/');
		$file=$path."/".$syid->user->nomor_induk."/".$syid->filename;
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

    // public function update(Request $req, $id)
    // {
    //     Pengaduan::where(['id' => $id])->update([
    //         'status' => $req->status,
    //     ]);
    //     return redirect(route('pengaduan'))->with('status', 'Data Pengaduan Berhasil Diubah');
    // }

    public function tanggapan($id)
    {
        $_dec = Crypt::decrypt($id);
        $data = [
            'title' => 'Tanggapan',
            'usersrequest' => UsersRequest::with(['dept', 'user', 'layanan'])->findOrfail($_dec),
        ];
        return view('backend.pages.tanggapan', $data);
    }
	
	public function update_kasubbag(Request $req, $id)
    {

		$req->validate([
            'deptid' => 'required'
        ]);
			
			
			if(Auth::user()->role == 'kasubbag'){
				$staff_id = 3;
				$status = "[*Status] <i>".Auth::user()->pekerjaan."</i> <b>ACCEPT</b> the Request.";
			}elseif(Auth::user()->role == 'kepala'){
				$staff_id = $req->deptid;
				$status = "[*Status] <i>".Auth::user()->pekerjaan."</i> <b>ACCEPT</b> the Request.";
			}elseif(Auth::user()->role == 'kasi'){
				$staff_id = $req->staff;
				$staffx = User::findOrfail($staff_id);
				$status = "[*Status] <i>".Auth::user()->pekerjaan."</i> <b>ACCEPT</b> the Request and <b>ASSIGNED</b> to <i>".$staffx->pekerjaan."</i>\n";
			}
		
		switch ($req->input('action')) {
			case 'setuju':
				if(!empty($req->tanggapan)){
					$tanggapan = $req->tanggapan;
					
					Tanggapan::create([
						'no_req' => $req->noreq,
						'user_id' => Auth::user()->id,
						'tanggapan' => $tanggapan,
						'to_user' => $staff_id,
					]);
				}
				
				UsersRequest::where(['no_req' => $id])->update([
					'staff_id' => $staff_id,
					'status' => 'DITERIMA',
				]);
			
			$text = "<b>:: New Update ::</b>\n"
			."No Request : ".$req->noreq."\n"
			."Department : ".$req->deptname."\n"
			."About : ".$req->laynname."\n\n"
			.$status;
		
			$channel = config('telegram.channel');
			
			Telegram::sendMessage([
				'chat_id' => $channel,
				'parse_mode' => 'HTML',
				'text' => $text
			]);
			
			return redirect(route('dashboard'))->with('status', 'Permintaan telah Disetujui');
            break;
			case 'tolak':
				if(!empty($req->tanggapan)){
					$tanggapan = $req->tanggapan;
					
					Tanggapan::create([
						'no_req' => $req->noreq,
						'user_id' => Auth::user()->id,
						'tanggapan' => $tanggapan,
						'to_user' => $req->userid
					]);
				}
				
				UsersRequest::where(['no_req' => $id])->update([
					'staff_id' => Auth::user()->id,
					'status' => 'DITOLAK',
				]);
				
			$text = "<b>:: New Update ::</b>\n"
			."No Request : ".$req->noreq."\n"
			."Department : ".$req->deptname."\n"
			."About : ".$req->laynname."\n\n"
			."[*Status] <i>".Auth::user()->pekerjaan."</i> <b>REJECT</b> the Request.";
		
			$channel = config('telegram.channel');
			
			Telegram::sendMessage([
				'chat_id' => $channel,
				'parse_mode' => 'HTML',
				'text' => $text
			]);
			
			return redirect(route('dashboard'))->with('status', 'Permintaan telah Ditolak');
			break;
			case 'proses':
				if(!empty($req->tanggapan)){
					$tanggapan = $req->tanggapan;
					
					Tanggapan::create([
						'no_req' => $req->noreq,
						'user_id' => Auth::user()->id,
						'tanggapan' => $tanggapan,
						'to_user' => $req->userid
					]);
				}
				
				UsersRequest::where(['no_req' => $id])->update([
					'staff_id' => Auth::user()->id,
					'status' => 'DIPROSES',
				]);
				
			$text = "<b>:: New Update ::</b>\n"
			."No Request : ".$req->noreq."\n"
			."Department : ".$req->deptname."\n"
			."About : ".$req->laynname."\n\n"
			."[*Status] <i>".Auth::user()->pekerjaan."</i> <b>PROCESSING</b> the Request.";
		
			$channel = config('telegram.channel');
			
			Telegram::sendMessage([
				'chat_id' => $channel,
				'parse_mode' => 'HTML',
				'text' => $text
			]);
				
			return redirect(route('dashboard'))->with('status', 'Permintaan sedang Diproses');
			break;
			case 'sukses':
				if(!empty($req->tanggapan)){
					$tanggapan = $req->tanggapan;
					
					Tanggapan::create([
						'no_req' => $req->noreq,
						'user_id' => Auth::user()->id,
						'tanggapan' => $tanggapan,
						'to_user' => $req->userid
					]);
				}
				
				UsersRequest::where(['no_req' => $id])->update([
					'staff_id' => Auth::user()->id,
					'status' => 'SUKSES',
				]);
				
			$text = "<b>:: New Update ::</b>\n"
			."No Request : ".$req->noreq."\n"
			."Department : ".$req->deptname."\n"
			."About : ".$req->laynname."\n\n"
			."[*Status] <i>".Auth::user()->pekerjaan."</i> <b>SUCCESS FINISHING</b> the Request.";
		
			$channel = config('telegram.channel');
			
			Telegram::sendMessage([
				'chat_id' => $channel,
				'parse_mode' => 'HTML',
				'text' => $text
			]);
			
			return redirect(route('dashboard'))->with('status', 'Permintaan telah Disetujui/Sukses');
			break;
			case 'batal':
				if(!empty($req->tanggapan)){
					$tanggapan = $req->tanggapan;
					
					Tanggapan::create([
						'no_req' => $req->noreq,
						'user_id' => Auth::user()->id,
						'tanggapan' => $tanggapan,
						'to_user' => $req->userid
					]);
				}
				
				UsersRequest::where(['no_req' => $id])->update([
					'staff_id' => Auth::user()->id,
					'status' => 'BATAL',
				]);
				
			$text = "<b>:: New Update ::</b>\n"
			."No Request : ".$req->noreq."\n"
			."Department : ".$req->deptname."\n"
			."About : ".$req->laynname."\n\n"
			."[*Status] <i>".Auth::user()->pekerjaan."</i> <b>DISMISS</b> the Request.";
		
			$channel = config('telegram.channel');
			
			Telegram::sendMessage([
				'chat_id' => $channel,
				'parse_mode' => 'HTML',
				'text' => $text
			]);
				
			return redirect(route('dashboard'))->with('status', 'Permintaan telah Dibatalkan');
			break;
		}
    }

    public function storeTanggapan(Request $req, $id)
    {
        $req->validate([
            'tanggapan' => 'required',
            'status' => 'required'
        ]);

        $usersrequest = UsersRequest::findOrfail($id);
        $usersrequest->update([
            'status' => $req->status,
        ]);

        Tanggapan::create([
            'req_id' => $id,
            'user_id' => Auth::User()->id,
            'tanggapan' => $req->tanggapan
        ]);
        // send mail to user
        Mail::to($usersrequest)->send(new ConfirmMail($usersrequest));
        return redirect(route('pengaduan'))->with('status', 'Data Pengaduan Berhasil Ditanggapi');
    }

    public function createPDF()
    {
        $pengaduan = Pengaduan::all();
        $pdf = PDF::loadView('backend.pages.pengaduan.pengaduan_pdf', ['pengaduan' => $pengaduan]);
        return $pdf->download('laporan-pengaduan.pdf');
    }
}
