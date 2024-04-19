<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.counterup/1.0/jquery.counterup.min.js"></script>
<link rel="icon" href="{{asset('assets/favicon.png')}}">

<style>
@import url(//fonts.googleapis.com/css?family=Montserrat:400,700);

body, html {
  padding: 0;
  margin: 0;
  height:100%;
  font-family: 'Montserrat', sans-serif;
  font-weight: bold;
  padding-top: 30px;
  
  
  background-image: url("{{asset('assets/bg.png')}}");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.col-md-12 {
  text-align: center;
  padding-bottom: 30px;
}

.nama {
	font-family: 'Montserrat', sans-serif;
	font-weight: 500;
}


.col-md-12 h1 {
	font-size: 140px;
	font-weight:800;
	color: red;
}

.col-md-12 h3 {
	font-size: 50px;
	font-weight:600;
}

.col-md-4 {
  text-align: center;
  padding-bottom: 50px;
  border-right: 1px dashed black;
}


.col-md-4 h1 {
	font-weight:700;
	color: red;
}

.col-md-4 h3 {
	font-weight:700;
}

.col-md-4:last-child {
  border-right: 0px solid black;
}

.counterBig {
  animation-duration: 3s;
  animation-delay: 2s;
}

.counter {
  animation-duration: 1s;
  animation-delay: 0s;
  color: red;
  font-weight:bold;
}

i {
  font-size: 20px !Important;
}

@media (max-width: 991px) {
  .col-md-4 {
    border-right: 0px dashed black;
    border-bottom: 1px dashed black;
    width: 50%;
    margin: auto auto;
  }
  
  .col-md-4:last-child {
    border-bottom: 0px dashed black;
  }
}
</style>

<html>
<title>::: SCOREBOARD :::</title>
<div class="container">
  <div class="row">
    <div class="col-md-12" >
      <h1><span class="counterBig">{{$peserta->total}}</span></h1>
      <h3>TOTAL</h3>
      <i class="fa fa-user"><span class="nama">&nbsp;&nbsp;{{$peserta->nama}} // {{$peserta->nomor}} // {{$peserta->gmtq->golongan}}</span></i>
    </div>
	@foreach($nilai as $nilai)
	@if($nilai->total != 0 && $nilai->status == 2)
	<div class="col-md-4" >
      <h1><span class="counter">{{$nilai->total}}</span></h1>
      <h3>{{$nilai->bidang->nama}}</h3>
	  @php
		$xnilai = App\Models\Nilai::with(['cmtq','gmtq','bidang','peserta'])->where(['peserta' => $peserta->nama, 'bidang_id' => $nilai->bidang_id])->get();
	  @endphp
	  @foreach($xnilai as $xnilai)
	  @if(($xnilai->hakim != NULL) && ($xnilai->status == 2))
      <i class="fa fa-user-secret"><span class="nama">&nbsp;{{$xnilai->hakim}} ( <span class="counter">{{round($xnilai->nilai,2)}}</span> )</span></i><br />
	  @endif
	  @endforeach
	</div>
	@endif
	@endforeach
  </div>
</div>
</html>

<script>
$('.counterBig').counterUp({
  delay: 20,
  time: 3000
});
$('.counter').counterUp({
  delay: 10,
  time: 1500
});

$('.counterBig').addClass('animated fadeInDownBig');
$('.counter').addClass('animated fadeInDownBig');
$('h3').addClass('animated fadeIn');
</script>