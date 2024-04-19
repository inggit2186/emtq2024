<link rel="icon" href="{{asset('assets/favicon.png')}}">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);


body {
  background-image: url(https://cdna.artstation.com/p/assets/images/images/005/152/718/large/nikita-kozlov-123.jpg?1488878117);
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover;
  
}

.container-fluid {
    width: 90%;
}
.title {
    font-size: 5vw;
    text-align: center;
    padding: 30px;
}
td {
    cursor: pointer;
    text-align: center;
}
img.pp {
  border-radius: 50%;
  width: 90px;
  height: 90px;
}
img.pp2 {
  border-radius: 50%;
  padding: 10px;
  width: 160px;
  height: 160px;
}
img.web {
  padding: 10px;
  width: 60px;
  height: 60px;
}


.table:hover tbody tr:hover td {
    background-color: grey;
}



* {
  font-family: Roboto;
}

h2{
  font-weight: 100;
  font-size: 30pt;
  line-height: 1.3em;
  margin: 15px 0;
}

div.message {
  position: relative;
  padding: 10px;
  padding-left: 35px;
  margin: 30px 10px;
  box-shadow:0 2px 5px rgba(0,0,0,.3);
  background: #BBB;
  color: #FFF;
  
  -webkit-transition: all .5s ease;
     -moz-transition: all .5s ease;
      -ms-transition: all .5s ease;
       -o-transition: all .5s ease;
          transition: all .5s ease;
}
div.message:hover{
  box-shadow: 0 15px 20px rgba(10,0,10,.3);
  -webkit-filter: brightness(110%);
}

div.message:before{
  content: '';
  font-family: FontAwesome;
  position: absolute;
  display: block;
  top: -21px;
  left: 50%;
  margin:0 -21px;
  font-size: 20px;
  line-height: 24px;
  text-align: center;
  width: 24px;
  padding:10px;
  background: inherit;
  box-shadow:0 5px 10px rgba(0,0,0,.25);
  color: rgba(255,255,255,.75);
  border-radius:50%;
  border: 2px solid transparent;
  z-index: 2;
}

div.message.information:before{content:'\f129';}
div.message.announcement:before{content:'\f0f3';}
div.message.success:before{content:'\f00c';}
div.message.warning:before{content:'\f12a';}
div.message.error:before{content:'\f00d';}

div.message.information{background: #39B;}
div.message.warning{background: #E74;}
div.message.success{background: #5A6;}
div.message.announcement{background: #EA0;}


/* Style the tab */
.tab {
  overflow: hidden;
  text-align:center;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: #ddd;
  float: center;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 19px;
  font-weight:800;
  font-family: Roboto;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ccc;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: yellow;
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
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<body>
<!DOCTYPE html>
<html>
<head>
    <title>Rekap MTQ ke-41 Kab.Tanah Datar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
  
<body>
  <div class="container">
    
    <div class="information message" align="center">
		<h1>Informasi</h1>
		<h3><p>Daftar Rekap Hasil MTQ Nasional ke-41 Kab.Tanah Datar</h3> </p>
		<h3><p>Kategori {{$cmtq->kategori}} (FINAL)</p></h3> 
	</div>
	
    @if (session('error'))
	<div class="information message" align="center">
		<h3>{{ session('error') }}</h3>		
	</div>
	@endif
	@if (session('status'))
	<div class="information message" align="center">
		<h3>{{ session('status') }}</h3>		
	</div>
	@endif
	
	<div class="tab">
	@foreach($gmtq as $gmtq)
		<button class="tablinks" onclick="openCity(event, '{{$gmtq->id}}')">{{$gmtq->golongan}}</button>
	@endforeach
	</div>
	
	<?php $a=0; ?>
	@foreach($gmtq2 as $gmtq2)
	@php
		$i=1;
		if($cmtq->id == 7){
		$peserta = App\Models\PesertaFinal::with(['cmtq','gmtq'])->where('golongan_id',$gmtq2->id)->orderBy('total','DESC')->get()->sortBy('nomor');
		}else{
		$peserta = App\Models\PesertaFinal::with(['cmtq','gmtq'])->where('golongan_id',$gmtq2->id)->orderBy('total', 'DESC')->get();
		}
		$bidang = App\Models\Bidang::with(['cmtq'])->where('cat_id',$cmtq->id)->get();
	@endphp
	@php
		$a=1;
		if($cmtq->id == 7){
		$peserta2 = App\Models\PesertaFinal::with(['cmtq','gmtq'])->where('golongan_id',$gmtq2->id)->orderBy('total','DESC')->get()->sortBy('nomor');
		}else{
		$peserta2 = App\Models\PesertaFinal::with(['cmtq','gmtq'])->where('golongan_id',$gmtq2->id)->orderBy('total', 'DESC')->get();
		}
		$bidang2 = App\Models\Bidang::with(['cmtq'])->where('cat_id',$cmtq->id)->get();
	@endphp
	<div id="{{$gmtq2->id}}" class="tabcontent" @if ($a==0) style="display:block;" @endif>
		<h3>{{$gmtq2->golongan}}</h3>
		<div class="row">
      <div class="col-md-12 col-xs-12">
          
        <table id="table1" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th style="text-align: center;">Rank</th>
              <th style="text-align: center;">NoLoot</th>
              <th style="text-align: center;">Nama Peserta</th>
              <th style="text-align: center;">Utusan</th>
              <th style="text-align: center;">JK</th>
			  @if($cmtq->id == 7)
			  <th style="text-align: center;">Nomor Loot</th>
			  @endif
			  @foreach($bidang as $bidang)
              <th style="text-align: center;">{{$bidang->nama}}</th>
			  @endforeach
              <th style="text-align: center;">Total Nilai</th>
              <th style="text-align: center;">Opsi</th>
            </tr>
          </thead>
          <tbody>
			@foreach($peserta as $peserta)
			@php 
				$nilai = App\Models\Nilai::with(['cmtq','gmtq','bidang','peserta'])->where(['peserta' => $peserta->nama, 'status' => 2])->get();
			@endphp
			@if($peserta->jk == "Putra")
			<tr>
				<td>{{$i}}</td>
				<td>{{$peserta->nomor}}</td>
				<td>{{$peserta->nama}}</td>
				<td>{{$peserta->utusan}}</td>
				<td>{{$peserta->jk}}</td>
				@if($cmtq->id == 7)
				<td style="text-align: center;">{{$peserta->nomor}}</td>
				@endif
				@foreach($nilai as $nilai)
				@if($nilai->total != NULL)
					<td>{{$nilai->total}}</td>
				@endif
				@endforeach
				<td>{{$peserta->total}}</td>
				<td><a href="{{route('edit.rankfinal', Crypt::Encrypt($peserta->id))}}" class="badge bg-warning" style="font-size: 15px; color:black;" onclick="modal()">EDIT</a> &nbsp; <a href="{{route('delete.rankfinal', Crypt::Encrypt($peserta->id))}}" class="badge bg-danger" onclick="return confirm('Anda Yakin Untuk Menghapus?')" style="font-size: 15px; color:black;">DELETE</a></td>
			<?php $i++; ?>
			</tr>
			@endif
			@endforeach
			@foreach($peserta2 as $peserta2)
			@php 
				$nilai2 = App\Models\Nilai::with(['cmtq','gmtq','bidang','peserta'])->where(['peserta' => $peserta2->nama, 'status' => 2])->get();
			@endphp
			@if($peserta2->jk == "Putri")
			<tr style="background-color:#00B6B6">
				<td>{{$a}}</td>
				<td>{{$peserta2->nomor}}</td>
				<td>{{$peserta2->nama}}</td>
				<td>{{$peserta2->utusan}}</td>
				<td>{{$peserta2->jk}}</td>
				@if($cmtq->id == 7)
				<td style="text-align: center;">{{$peserta2->nomor}}</td>
				@endif
				@foreach($nilai2 as $nilai2)
				@if($nilai2->total != NULL)
					<td>{{$nilai2->total}}</td>
				@endif
				@endforeach
				<td>{{$peserta2->total}}</td>
				<td><a href="{{route('edit.rankfinal', Crypt::Encrypt($peserta2->id))}}" class="badge bg-warning" style="font-size: 15px; color:black;" onclick="modal()">EDIT</a> &nbsp; <a href="{{route('delete.rankfinal', Crypt::Encrypt($peserta2->id))}}" class="badge bg-danger" onclick="return confirm('Anda Yakin Untuk Menghapus?')" style="font-size: 15px; color:black;">DELETE</a></td>
			<?php $a++; ?>
			</tr>
			@endif
			@endforeach
          </tbody>       
        </table>
      </div>   
    </div>  
	</div>
	<?php $a++; ?>
    @endforeach
	
  </div>

</html>
</body>
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
