@extends('backend.layout.app')
@section('content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<style>

/* Style the tab */
.tab {
  overflow: hidden;
  text-align:center;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: center;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  text-align:center;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>


<html>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>MTQ</h3>
                <p class="text-subtitle text-muted">Daftar Penilaian yang Masuk</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nilai</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <section class="section">
			<div class="card">
            <div class="card-body">
			<a href="{{ route('print.laporanfinal', Crypt::Encrypt($cmtq->id)) }}" target=_blank class="btn btn-primary"><i class="fas fa-print"></i> Nilai</a> &nbsp; &nbsp;
			<a href="{{ route('print.laporan2final', Crypt::Encrypt($cmtq->id)) }}" target=_blank class="btn btn-primary"><i class="fas fa-print"></i> Hasil </a> &nbsp; &nbsp;
                @if (session('status'))
                    <div class="alert alert-success mt-1">
                        {{ session('status') }}
                    </div>
                @endif
			<br />
			<br />
					<div class="tab">
					@foreach($gmtq as $gmtq)
						<button class="tablinks" onclick="openCity(event, '{{$gmtq->id}}')">{{$gmtq->golongan}}</button>
					@endforeach
					</div>
				@foreach($gmtq2 as $gmtq2)
				@php
					$i=1;
				
					$peserta = App\Models\PesertaFinal::with(['cmtq','gmtq'])->where('golongan_id',$gmtq2->id)->orderBy('total', 'DESC')->orderBy('id', 'ASC')->get();
					
					$bidang = App\Models\Bidang::with(['cmtq'])->where('cat_id',$cmtq->id)->get();
				@endphp
				@php
					$w=1;
				
					$peserta2 = App\Models\PesertaFinal::with(['cmtq','gmtq'])->where('golongan_id',$gmtq2->id)->orderBy('total', 'DESC')->orderBy('id', 'ASC')->get();
					
					$bidang2 = App\Models\Bidang::with(['cmtq'])->where('cat_id',$cmtq->id)->get();
				@endphp
				<div id="{{$gmtq2->id}}" class="tabcontent">
					<h3>{{$gmtq2->golongan}}</h3>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Rank</th>
                            <th style="text-align: center;">NoLoot</th>
							  <th style="text-align: center;">Nama Peserta</th>
							  @if($cmtq->id == 7)
							  <th style="text-align: center;">Nomor Tampil</th>
							  @endif
							  @foreach($bidang as $bidang)
							  <th style="text-align: center;">{{$bidang->nama}}</th>
							  @endforeach
							  <th style="text-align: center;">Total Nilai</th>
                        </tr>
                    </thead>
                    <tbody>	
							@foreach($peserta as $peserta)
							@if($peserta->jk == "Putra")
							@php 
								$nilai = App\Models\Nilai::with(['cmtq','gmtq','bidang','peserta'])->where(['peserta'=> $peserta->nama, 'status' => 2])->get();
							@endphp
							<tr>
								<td>{{$i}}</td>
								<td>{{$peserta->nomor}}</td>
								<td>{{$peserta->nama}}</td>
								@if($cmtq->id == 7)
								<td style="text-align: center;">{{$peserta->nomor}}</td>
								@endif
								@foreach($nilai as $nilai)
								@if($nilai->total != NULL)
									<td>{{$nilai->total}}</td>
								@endif
								@endforeach
								<td>{{$peserta->total}}</td>
							<?php $i++; ?>
							</tr>
							@endif
							@endforeach
					
							@foreach($peserta2 as $peserta2)
							@if($peserta2->jk == "Putri")
							@php 
								$nilai = App\Models\Nilai::with(['cmtq','gmtq','bidang','peserta'])->where(['peserta'=> $peserta2->nama, 'status' => 2])->get();
							@endphp
							<tr style="background-color:#00F2F2">
								<td>{{$w}}</td>
								<td>{{$peserta2->nomor}}</td>
								<td>{{$peserta2->nama}}</td>
								@if($cmtq->id == 7)
								<td style="text-align: center;">{{$peserta2->nomor}}</td>
								@endif
								@foreach($nilai as $nilai)
								@if($nilai->total != NULL)
									<td>{{$nilai->total}}</td>
								@endif
								@endforeach
								<td>{{$peserta2->total}}</td>
							<?php $w++; ?>
							</tr>
							@endif
							@endforeach
							
                    </tbody>
                </table>
				</div>
				@endforeach
            </div>
        </div>
    </section>
</div>

</html>

<script>
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

@endsection