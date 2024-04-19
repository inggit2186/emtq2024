@extends('backend.layout.app')
@section('content')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<html>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>PTSP</h3>
                <p class="text-subtitle text-muted">Daftar Permintaan yang Masuk</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Request</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('print.laporan') }}" class="btn btn-primary"><i class="fas fa-print"></i></a>
                @if (session('status'))
                    <div class="alert alert-success mt-1">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No.Registrasi</th>
                            <th>Departemen</th>
                            <th>Layanan / Judul</th>
                            <th>Tgl.Masuk</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groupItem as $item)
						@if(Auth::user()->dept_id === $item->dept_id || '101' || '102')
						
                        <tr>
						<!-- DATA USER YANG REQUEST -->
							<td style="display:none;">{{ $item->user->id }}</td>
							<td style="display:none;">{{ $item->user->name }}</td>
							<td style="display:none;">{{ $item->user->email }}</td>
							<td style="display:none;">{{ $item->user->telp }}</td>
							<td style="display:none;">{{ $item->user->pekerjaan }}</td>
							<td style="display:none;">{{ $item->user->alamat }}</td>
							
						<!-- DATA REQUEST -->
                            <td>{{ $item->no_req }}</td>
                            <td>{{ $item->dept->nama }}</td>
							@if(!empty($item->judul))
								<td>{{ $item->judul }}</td>
							@else
								<td>{{ $item->layanan->nama }}</td>
							@endif
							<td>
								{{ $item->created_at->format('d/m/Y') }}
							</td>
							<td style="display:none;">{{ $item->deskripsi}}</td>
                            <td>
                                 @if ($item->status === 'PENDING')
                                    <span class="badge bg-warning">{{ $item->status }}</span>
                                @elseif($item->status === 'DITOLAK')
                                    <span class="badge bg-danger">{{ $item->status }}</span>
                                @elseif($item->status === 'SUKSES')
                                    <span class="badge bg-primary">{{ $item->status }}</span>
                                @elseif($item->status === 'BATAL')
                                    <span class="badge bg-dark">{{ $item->status }}</span>
								@elseif($item->status === 'DITERIMA')
									<span class="badge bg-secondary">{{ $item->status }}</span>
								@elseif($item->status === 'DIPROSES')
									<span class="badge bg-success">{{ $item->status }}</span>
								@endif
                            </td>
                            <td>
                                <a href="#" class="badge bg-info">DETAIL</a>
                            </td>
							
							<!-- DATA TAMBAHAN (YANG TERLUPAKAN) -->
							<td style="display:none;">{{ $item->dept_id }}</td>
							<td style="display:none;">Status : @if ($item->status === 'PENDING')
                                    {{ $item->status }}
                                @elseif($item->status === 'DITOLAK')
                                    {{ $item->status }} oleh auth()->user()->role
                                @elseif($item->status === 'SUKSES')
                                    {{ $item->status }} 
                                @elseif($item->status === 'BATAL')
                                    {{ $item->status }} 
								@elseif($item->status === 'DITERIMA')
									@if($item->staff->role == 'kasi') 
										{{ $item->status }} oleh {{ $item->staff->pekerjaan }}
									@elseif($item->staff->role == 'petugas')
										DITUGASKAN kepada {{ $item->staff->name }} ( {{ $item->staff->pekerjaan }} )
									@else
										{{ $item->status }} oleh {{ $item->staff->pekerjaan }}
									@endif
								@elseif($item->status === 'DIPROSES')
									DIPROSES oleh oleh {{ $item->staff->name }} ( {{ $item->staff->pekerjaan }} )
								@endif</td>
							<td style="display:none;">Last Update {{ $item->updated_at->format('d/m/Y-H:i:s') }}</td>
							<td style="display:none;">{{ $item->status }}</td>
							<td style="display:none;">{{ $item->staff_id }}</td>
							<td style="display:none;">{{ Auth::user()->id }}</td>
							
                        </tr>
						@endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
<!-- Modal -->
       <div id="myModal" class="modal fade" role="dialog" style="max-height: 100%;max-width:100%; overflow-y: auto; overflow-x: auto;">
          <div class="modal-dialog">
            <div class="modal-content" style="width:450px;">
              <!-- Modal header -->
              <div id="name" class="modal-header" style="justify-content: center;text-align:center;" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div id="ModalBody" class="modal-body"></div>
				<center><tr colspan=2><td colspan=2> <button class="badge bg-primary" onclick="showSyarat()">CEK SYARAT-SYARAT BERKAS</button></td></tr></center>
			  
			  <div id="syaratUser" style="display:none;">
				<table class="table table-striped">
					<thead>
					<tr>
						<th>Syarat</th>
						<th>Opsi</th>
					</tr>
					</thead>
					<tbody id="sy1"></tbody>
				</table>
			  </div>
			  
			  <div class="modal-body" id="ModalEnding">
					<center><tr><td colspan=2><p><h5><u> Tanggapan </u></h5></p></td></tr>
					<form id="postman" action="" method='POST'>
					@csrf
                    @method('PUT')
						<input type="hidden" id="deptid" name="deptid" value="">
						<input type="hidden" id="deptname" name="deptname" value="">
						<input type="hidden" id="laynname" name="laynname" value="">
						<input type="hidden" id="noreq" name="noreq" value="">
						<input type="hidden" id="userid" name="userid" value="">
						<tr colspan=2><td colspan=2><textarea name="tanggapan" id="tanggapan" style="height:90px;width:100%;"></textarea></td></tr></center>
						@if(Auth::user()->role == 'kasi')
						<p style="font-size:12px"><i>SETUJU = Tanggapan akan dikirim ke Staff Selanjutnya<br />
						TOLAK = Tanggapan akan dikirim ke User/Pengguna yang mengajukan</i></p>
							<center><tr><td colspan=2><p><h6><u> Staff yang akan Ditugaskan </u></h6></p></td></tr>
							<select name="staff" id="staff"
                                class="block w-full px-2 py-2 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
								style="text-align:center; max-width:350px;" required>
                                <option value="" disabled selected
                                    class="block w-full px-2 py-2 border-2 border-transparent text-gray-400 rounded-lg focus:border-blue-500 focus:outline-none">
                                    ---- Silahkan Pilih Staff ------</option>
								@foreach($Staff as $staff)
                                <option value='{{ $staff->id }}' 
                                    class="block w-full px-2 py-2 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none">
                                    {{ $staff->name }}&nbsp;|&nbsp;{{ $staff->pekerjaan }}</option>
								</center>
								@endforeach
                            </select>
						<br />
						<br />
						<center><tr colspan=2><td colspan=2> <button class="badge bg-primary" type="SUBMIT" name="action" value="setuju">SETUJUI</button>&nbsp; &nbsp;<button class="badge bg-dark" type="SUBMIT" name="action" value="tolak">TOLAK</button></td></tr></center>
						
						@elseif(Auth::user()->role == 'petugas')
						<p style="font-size:12px"><i>Tanggapan akan dikirim ke User/Pengguna yang mengajukan</i></p>
						<center><tr colspan=2><td colspan=3> 
							<button class="badge bg-primary" type="SUBMIT" name="action" value="proses" id="bproses">DIPROSES</button>&nbsp;
							<button class="badge bg-warning" type="SUBMIT" name="action" value="sukses" id="bsukses">SUKSES</button>&nbsp;
							<button class="badge bg-dark" type="SUBMIT" name="action" value="tolak" id="btolak">TOLAK</button>&nbsp;
							<button class="badge bg-danger" type="SUBMIT" name="action" value="batal" id="bbatal">BATAL</button>&nbsp;
							</td></tr></center>
						
						@else
						<p style="font-size:12px"><i>SETUJU = Tanggapan akan dikirim ke Staff Selanjutnya<br />
						TOLAK = Tanggapan akan dikirim ke User/Pengguna yang mengajukan</i></p>
						<center><tr colspan=2><td colspan=2> <button class="badge bg-primary" type="SUBMIT" name="action" value="setuju">SETUJUI</button>&nbsp; &nbsp;<button class="badge bg-dark" type="SUBMIT" name="action" value="tolak">TOLAK</button></td></tr></center>	
						@endif
					</form>
			  </div>
              <!-- Modal footer -->
			  <div class="modal-footer">
			  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
</html>

<script>

$(document).ready(function(){ 
  $("#table1 tbody tr td").click(function(){
    $("#myModal").modal('show');
    document.getElementById('syaratUser').style.display = 'none';
	
	var getData = $(this).closest('tr');
	  var user_id = getData.children()[0].textContent;
	  var nama = getData.children()[1].textContent;
	  var email  = getData.children()[2].textContent;
	  var telp  = getData.children()[3].textContent;
	  var pekerjaan  = getData.children()[4].textContent;
	  var alamat  = getData.children()[5].textContent;
	  
	  var no_req = getData.children()[6].textContent;
	  var department = getData.children()[7].textContent;
	  var layanan  = getData.children()[8].textContent;
	  var tglmasuk  = getData.children()[9].textContent;
	  var deskripsi  = getData.children()[10].textContent;
	  
	  var deptid  = getData.children()[13].textContent;
	  var status  = getData.children()[14].textContent;
	  var lastupdate  = getData.children()[15].textContent;
	  var status2  = getData.children()[16].textContent;
	  var staff  = getData.children()[17].textContent;
	  var cstaff  = getData.children()[18].textContent;
	
	  var url = "{{route('update.layanan', '')}}" + "/" + no_req;
	  var url2 = "{{route('post_noreq', '')}}" + "/" + no_req;
	  
	  $.ajax({
		   type:'GET',
           url:url2,
           data:{"_token": "{{ csrf_token() }}"},
		   dataType: "json",
           success:function(data){
			    $('#sy1').html(data);
		   }});
	  
    $('#name').html('<h3 class="modal-title">DETAIL</h3>');
    $('#ModalBody').html(
      
	  "<table><tr><td colspan=3><p><h5><u> Detail User </u></h5></p></td></tr>" +
      "<tr><td> Nama </td><td>&nbsp;:&nbsp;</td><td> <b>" + nama + "</b> </td></tr>" +
      "<tr><td> E-mail </td><td>&nbsp;:&nbsp;</td><td> <b>" + email + "</b> </td></tr>" +
      "<tr><td> No.Telp </td><td>&nbsp;:&nbsp;</td><td> <b>" + telp + "</b> </td></tr>" +
      "<tr><td> Pekerjaan </td><td>&nbsp;:&nbsp;</td><td> <b>" + pekerjaan + "</b> </td></tr>" +
      "<tr><td> Alamat </td><td>&nbsp;:&nbsp;</td><td> <b>" + alamat + "</b> </td></tr>" +
	  
      "<tr><td colspan=3><p><h5><u> Detail Permintaan </u></h5></p></td></tr>" +
      "<tr><td> No Registrasi </td><td>&nbsp;:&nbsp;</td><td> <b>" + no_req + "</b> </td></tr>" +
      "<tr><td> Department </td><td>&nbsp;:&nbsp;</td><td> <b>" + department + "</b> </td></tr>" +
      "<tr><td> Layanan/Judul </td><td>&nbsp;:&nbsp;</td><td> <b>" + layanan + "</b> </td></tr>" +
      "<tr><td> Tgl Masuk </td><td>&nbsp;:&nbsp;</td><td> <b>" + tglmasuk + "</b> </td></tr>" +
      "<tr style='box-shadow:0px 0px 1px 0.2px;'><td> Deskripsi </td><td>&nbsp;:&nbsp;</td><td> <b>" + deskripsi + "</b> </td></tr></table><br />" +
	  "<br /><p style=font-size:13px><i>" +
	  status +
	  "<br />" +
	  lastupdate +"</i></p>"
	  );
	  
	document.getElementById('userid').value = user_id;
	document.getElementById('noreq').value = no_req;
	document.getElementById('deptid').value = deptid;
	document.getElementById('deptname').value = department;
	document.getElementById('laynname').value = layanan;
    document.getElementById('postman').action = url;
	
  if(cstaff != staff) {
	  document.getElementById('ModalEnding').style.display = 'none';
  }else{
	  document.getElementById('ModalEnding').style.display = 'block';
	  
	  if(status2 == "DIPROSES") {
		 document.getElementById('bproses').style.display = 'none';
	  }else{
		 document.getElementById('bproses').style.display = 'compact';
	  }
  }
  
  });
});

function showSyarat() {
  var x = document.getElementById("syaratUser");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
  
</script>
@endsection