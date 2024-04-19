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

.col-md-12 h2 {
	font-size: 40px;
	font-weight:600;
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
<title>::: NOMOR URUT :::</title>
<div class="container">
  <div class="row">
    <div class="col-md-12" >
      <h1><div id="number">@if(!empty($peserta->noloot)) {{$peserta->noloot}} @else 000 @endif</div></h1>
      <h3>Nomor Urut</h3>
      <i class="fa fa-user"><span class="nama">&nbsp;&nbsp;{{$peserta->peserta}} // {{$peserta->gmtq->golongan}} </span></i>
    </div>
	<br />
	<br />
	<br />
	<br />
	<br />
	<div class="col-md-12" >
      <h2 id="statusx"
	  @if(!empty($peserta->noloot)) style="display:none" 
		@else style="display:block" @endif >Tekan ENTER Untuk Mengambil Nomor</h2>
      <h2 id="statusy" 
		@if(!empty($peserta->noloot)) style="display:block" 
		@else style="display:none" @endif ><a href="{{route('buat.noloot', Crypt::Encrypt($peserta->cmtq_id))}}" class="btn btn-sm btn-danger" style="font-size:30px;font-weight:600;">KEMBALI</a></h2>
    </div>
  </div>
   <input type="hidden" id="noloot" value="">
	
</div>
</html>

<script>

var nloot = {!! json_encode($peserta->noloot) !!};
var jk = {!! json_encode($peserta->jk) !!};

var x = 0;

function generateRandom(min, max, exclude) {
  let random;
  while (!random) {
	if(jk == 'Putra'){  
		x = (Math.floor(Math.random() * (max - min + 1)/2) + min/2)*2+1;
	}else{
		x = (Math.floor(Math.random() * (max - min + 1)/2) + min/2)*2;
	}
	
    if (exclude.indexOf(x) === -1) random = x;
  }
  return random;
}


if(nloot == 0){
	var st = 1;
}else{
	var st = 0;
}
	
$(document).keypress(function(e) {
	var noloot =0;
 if(st == 1){
  if(e.which == 13) {
  var max = {!! json_encode($noloot->kode) !!};
  var max = {!! json_encode($noloot->max) !!};
  var min = {!! json_encode($noloot->min) !!};
  var idp = {!! json_encode($peserta->id) !!};
  var excludeArray = [
	@foreach($exlude as $item)
		{{$item->noloot}},
	@endforeach
  ];
	
  var result = generateRandom(min, max, excludeArray);
	
        $('#number').html('<span class="counterBig" style="display: none;">'+ String(result).padStart(3, '0') + '</span>');
        $('#number span:last').fadeIn(4000);
	}
	
	document.getElementById('statusx').style.display = 'none';
	document.getElementById('statusy').style.display = 'block';
	st = 0;
	
	var url = "{{route('update.noloot', '')}}" + "/" + idp;
	  
	  $.ajax({
	   type:'POST',
	   url:url,
	   data:{
			"_token": "{{ csrf_token() }}",
			noloot: result,
	   },
	   dataType: "json",
	   success:function(data){
			$('#sy1').html(data);
	   }});
	
};
});

</script>