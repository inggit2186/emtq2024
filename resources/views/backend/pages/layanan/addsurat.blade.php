@extends('backend.layout.app')
@section('content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Surat Keluar</h3>
                <p class="text-subtitle text-muted">The Latest Update</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Surat Keluar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
				<a href="{{ route('print.laporan') }}" class="btn btn-primary"><i class="fas fa-print"></i></a>
                <a href="#" onclick="showModal()" class="btn btn-primary" id="tambah"> <i class="fas fa-file-medical"></i>&nbsp;Tambah</a>
                @if (session('status'))
                    <div class="alert alert-success mt-1">
                        {{ session('status') }}
                    </div>
                @endif
				@if ($errors->any())
					<br />
					<br />
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					<br />
					<br />
				@endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. Surat</th>
                            <th>Department</th>
                            <th>Tujuan</th>
                            <th>Perihal</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surat as $item)
                        <tr>
                            <td>{{ $item->no_surat }}</td>
                            <td>{{ $item->dept->nama }}</td>
                            <td>{{ $item->penerima }}</td>
                            <td>{{ $item->perihal }}</td>
                            <td>{{ $item->created_at }}</td>
							
							<td style="display:none;">{{ $item->user->name }}</td>
							<td style="display:none;">{{ $item->user_id }}</td>
							<td style="display:none;">{{ $item->dept_id }}</td>
							<td style="display:none;">{{ $item->keterangan }}</td>
							<td style="display:none;">{{ $item->surat }}</td>
							<td style="display:none;">{{ $item->lampiran1 }}</td>
							<td style="display:none;">{{ $item->lampiran2 }}</td>
							<td style="display:none;">{{ $item->id }}</td>
                            
							
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
		
		<!-- MODAL NEW ENTRY -->
		<div id="suratModal" class="modal fade" role="dialog" style="max-height: 100%;max-width:100%; overflow-y: auto; overflow-x: auto;">
          <div class="modal-dialog">
            <div class="modal-content" style="width:550px;">
			  <!-- Modal header -->
              <div id="name" class="modal-header" style="justify-content: center;text-align:center;" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div id="ModalBody" class="modal-body"></div>
				<table class="table table-striped">
				<form action={{ route('store.surat') }} method='POST' enctype="multipart/form-data">
				@csrf
                @method('POST')
					<thead>
					<tr>
						<td colspan=3><p><h5><u> Detail Surat Keluar </u></h5></p></td>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><strong>No. Surat</strong></td>
						<td> : </td>
						<td><input type="text" name="no_surat" style="width:100%;" value="{{ old('no_surat') }}" required></input></td>
					</tr>
					<tr>
						<td><strong>Tujuan / Penerima</strong></td>
						<td> : </td>
						<td><input type="text" name="penerima" style="width:100%;" value="{{ old('penerima') }}" required></input></td>
					</tr>
					<tr>
						<td><strong>Perihal</strong></td>
						<td> : </td>
						<td><input type="text" name="perihal" style="width:100%;" value="{{ old('perihal') }}" required></input></td>
					</tr>
					<tr>
						<td><strong>Keterangan</strong></td>
						<td> : </td>
						<td><textarea type="text" name="keterangan" style="height:90px;width:100%;"></textarea></td>
					</tr>
					<tr>
						<td><strong>Scan File Surat</strong></td>
						<td> : </td>
						<td><input type="file" accept=".pdf,.jpg,.jpeg,.png,.bmp" name="filesurat" id="files"
							class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" required /></td>
					</tr>
					<tr>
						<td><strong>Lampiran 1</strong></td>
						<td> : </td>
						<td><input type="file" accept=".pdf,.jpg,.jpeg,.png,.bmp,.rar,.zip,.7z" name="lampiran1" id="files"
							class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" /></td>
					</tr>
					<tr>
						<td><strong>Lampiran 2</strong></td>
						<td> : </td>
						<td><input type="file" accept=".pdf,.jpg,.jpeg,.png,.bmp,.rar,.zip,.7z" name="lampiran2" id="files"
							class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" /></td>
					</tr>
					</tbody>
					<tr>
						<td colspan=3><center><button class="badge bg-primary" type="SUBMIT" name="action" value="setuju">SUBMIT</button></center></td>
					</tr>
				</table>
			  
              <!-- Modal footer -->
			  <div class="modal-footer">
			  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
		
		<!-- MODAL NEW ENTRY -->
		<div id="descSurat" class="modal fade" role="dialog" style="max-height: 100%;max-width:100%; overflow-y: auto; overflow-x: auto;">
          <div class="modal-dialog">
            <div class="modal-content" style="width:450px;">
			   <!-- Modal header -->
              <div id="namex" class="modal-header" style="justify-content: center;text-align:center;" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
			  
              <!-- Modal body -->
              <div id="Detailsurat" class="modal-body"></div>
				
			  
              <!-- Modal footer -->
			  <div class="modal-footer">
			  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

    </section>
</div>

<script>

$(document).ready(function(){ 
  
  $("#tambah").click(function(){
    $("#suratModal").modal('show');
	$('#name').html('<h3 class="modal-title">New Entry</h3>');
  });
  
  $("#table1  tbody tr td").click(function(){
    $("#descSurat").modal('show');
	
	var getData = $(this).closest('tr');
	  var no_surat = getData.children()[0].textContent;
	  var dept = getData.children()[1].textContent;
	  var penerima  = getData.children()[2].textContent;
	  var perihal  = getData.children()[3].textContent;
	  var tanggal  = getData.children()[4].textContent;
	  var sender  = getData.children()[5].textContent;
	  var sender_id  = getData.children()[6].textContent;
	  var dept_id  = getData.children()[7].textContent;
	  var keterangan  = getData.children()[8].textContent;
	  var surat = getData.children()[9].textContent;
	  var lampiran1 = getData.children()[10].textContent;
	  var lampiran2 = getData.children()[11].textContent;
	  var id = getData.children()[12].textContent;
	  
	  var fsrute = "{{route('file.surat','')}}/"+ id;
	  var dsrute = "{{route('download.surat','')}}/"+ id;
	  var fl1rute = "{{route('file.lampiran1','')}}/"+ id;
	  var dl1rute = "{{route('download.lampiran1','')}}/"+ id;
	  var fl2rute = "{{route('file.lampiran2','')}}/"+ id;
	  var dl2rute = "{{route('download.lampiran2','')}}/"+ id;
	  
	$('#namex').html('<h3 class="modal-title">DETAIL</h3>');
    $('#Detailsurat').html(
	 "<table><tr><td colspan=3><p><h5><u> Detail Surat Keluar </u></h5></p></td></tr>" +
      "<tr><td> No.Surat </td><td>&nbsp;:&nbsp;</td><td> <b>" + no_surat + "</b> </td></tr>" +
      "<tr><td> Department </td><td>&nbsp;:&nbsp;</td><td> <b>" + dept + "</b> </td></tr>" +
      "<tr><td> Sender </td><td>&nbsp;:&nbsp;</td><td> <b>" + sender + "</b> </td></tr>" +
      "<tr><td> Tujuan </td><td>&nbsp;:&nbsp;</td><td> <b>" + penerima + "</b> </td></tr>" +
      "<tr><td> Perihal </td><td>&nbsp;:&nbsp;</td><td> <b>" + perihal + "</b> </td></tr>" +
      "<tr style='box-shadow:0px 0px 1px 0.2px;'><td> Deskripsi </td><td>&nbsp;:&nbsp;</td><td> <b>" + keterangan + "</b> </td></tr>" +
	  "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>" +
      "<tr><td> Tanggal </td><td>&nbsp;:&nbsp;</td><td> <b>" + tanggal + "</b> </td></tr></table><br />" +
	  
	  "<table class='table table-striped'><tr><td colspan=3><center><p><h5><u> Berkas Pendukung </u></h5></p></center></td></tr>" +
	  "<tr><td><center> <strong>File Surat</strong> </center></td><td>&nbsp;:&nbsp;</td><td>&nbsp;&nbsp;&nbsp;<a href="+ fsrute +" target=_blank class='btn btn-sm btn-info'><i class='fas fa-eye'></i></a> &nbsp;<a href="+ dsrute +"  class='btn btn-sm btn-info'><i class='fas fa-download'></i></a></td></tr>" +
	  "<tr><td><center> <strong>Lampiran 1</strong> </center></td><td>&nbsp;:&nbsp;</td><td>&nbsp;&nbsp;&nbsp;<a href="+ fl1rute +" target=_blank class='btn btn-sm btn-info'><i class='fas fa-eye'></i></a> &nbsp;<a href="+ dl1rute +"  class='btn btn-sm btn-info'><i class='fas fa-download'></i></a></td></tr>" +
	  "<tr><td><center> <strong>Lampiran 2</strong> </center></td><td>&nbsp;:&nbsp;</td><td>&nbsp;&nbsp;&nbsp;<a href="+ fl2rute +" target=_blank class='btn btn-sm btn-info'><i class='fas fa-eye'></i></a> &nbsp;<a href="+ dl2rute +"  class='btn btn-sm btn-info'><i class='fas fa-download'></i></a></td></tr>" +
	  "</table><br />"
	  );
	
  });
});
</script>
@endsection