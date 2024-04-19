<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

<link rel="icon" href="{{asset('assets/favicon.png')}}">
<style>
/*custom font*/
@import url(https://fonts.googleapis.com/css?family=Montserrat);

body {
  font-family: montserrat, arial, verdana;
}

#fly-in {
  font-size: 3em;
  font-weight: 700;
  color: #fff;
  overflow: hidden;
  font-family: montserrat, sans-serif;
  text-align: center;
  margin: 2vh auto;
  height: 12vh; 
  text-transform: uppercase;
}

#fly-in span {
  display: block;
  font-size: .4em;
  opacity: .8;
}

#fly-in div {
 position: fixed; <!--codepen.io/h-kod/-->
  margin: 2vh 0;
  opacity: 0;
  left: 10vw;
  width: 80vw;
  animation: switch 32s linear infinite;
}

#fly-in div:nth-child(2) { animation-delay: 4s}
#fly-in div:nth-child(3) { animation-delay: 8s}
#fly-in div:nth-child(4) { animation-delay: 12s}
#fly-in div:nth-child(5) { animation-delay: 16s}
#fly-in div:nth-child(6) { animation-delay: 20s}
#fly-in div:nth-child(7) { animation-delay: 24s}
#fly-in div:nth-child(8) { animation-delay: 28s}

@keyframes switch {
    0% { opacity: 0;filter: blur(20px); transform:scale(12)}
    3% { opacity: 1;filter: blur(0); transform:scale(1)}
    10% { opacity: 1;filter: blur(0); transform:scale(.9)}
    13% { opacity: 0;filter: blur(10px); transform:scale(.1)}
    80% { opacity: 0}
    100% { opacity: 0}
}


/* ------------------------------------- */

.field-icon {
  float: right;
  margin-left: -25px;
  margin-right: 5px;
  margin-top: 15px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top:50px;
  margin: auto;
}

/*basic reset*/
* {margin: 0; padding: 0;}

html {
  height: 100%;
  /*Image only BG fallback*/
  
  /*background = gradient + image pattern combo*/
  background: 
    linear-gradient(rgba(196, 102, 0, 0.6), rgba(155, 89, 182, 0.6));
}

/*form styles*/
#msform {
  width: 400px;
  margin: 50px auto;
  text-align: center;
  position: relative;
}
#msform fieldset {
  background: white;
  border: 0 none;
  border-radius: 3px;
  box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
  padding: 20px 30px;
  box-sizing: border-box;
  width: 80%;
  margin: 0 10%;
  
  /*stacking fieldsets above each other*/
  position: relative;
}
/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
  display: none;
}
/*inputs*/
#msform input, #msform textarea {
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-bottom: 10px;
  width: 100%;
  box-sizing: border-box;
  font-family: montserrat;
  color: #2C3E50;
  font-size: 13px;
}
/*buttons*/
#msform .action-button {
  width: 100px;
  background: #27AE60;
  font-weight: bold;
  color: white;
  border: 0 none;
  border-radius: 1px;
  cursor: pointer;
  padding: 10px 5px;
  margin: 10px 5px;
}
#msform .action-button:hover, #msform .action-button:focus {
  box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
}
/*headings*/
.fs-title {
  font-size: 15px;
  text-transform: uppercase;
  color: #2C3E50;
  margin-bottom: 10px;
}
.fs-subtitle {
  font-weight: normal;
  font-size: 13px;
  color: #666;
  margin-bottom: 20px;
}
/*progressbar*/
#progressbar {
  margin-bottom: 30px;
  overflow: hidden;
  /*CSS counters to number the steps*/
  counter-reset: step;
}
#progressbar li {
  list-style-type: none;
  color: white;
  text-transform: uppercase;
  font-size: 9px;
  width: 33.33%;
  float: left;
  position: relative;
}
#progressbar li:before {
  content: counter(step);
  counter-increment: step;
  width: 20px;
  line-height: 20px;
  display: block;
  font-size: 10px;
  color: #333;
  background: white;
  border-radius: 3px;
  margin: 0 auto 5px auto;
}
/*progressbar connectors*/
#progressbar li:after {
  content: '';
  width: 100%;
  height: 2px;
  background: white;
  position: absolute;
  left: -50%;
  top: 9px;
  z-index: -1; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
  /*connector not needed before the first step*/
  content: none; 
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
  background: #27AE60;
  color: white;
}
</style>

<html>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="" />
 <title>REGISTER PTSP Kemenag Kab.Tanah Datar</title>
<div id="fly-in">  
<div><span>Selamat</span>Datang!</div>
<div><span>Di Website Resmi</span>PTSP Kantor Kementerian Agama Kab.Tanah Datar...!</div>
<div><span>Silahkan</span>Isi data-data dibawah terlebih dahulu ya...!</div>
</div>


<!-- multistep form -->
<form id="msform" action="{{route('proses.register')}}" method="post">
@csrf
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Data Akun</li>
    <li>Media Sosial</li>
    <li>Data Profil</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">DAFTAR AKUN</h2>
    <h3 class="fs-subtitle">*Akun untuk Login ke web PTSP</h3>
    <input type="text" id="username" name="username" placeholder="Username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required />
    @error('username')
	<div class="invalid-feedback">
		<i class="bx bx-radio-circle"></i>
		{{ $message }}
	</div>
	@enderror
	<input type="email" value="" id="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required >
	@error('email')
	<div class="invalid-feedback">
		<i class="bx bx-radio-circle"></i>
		{{ $message }}
	</div>
	@enderror
	<input type="password" class="form-control" id="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required />
	<span toggle="#password" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
    @error('password')
	<div class="invalid-feedback">
		<i class="bx bx-radio-circle"></i>
		{{ $message }}
	</div>
	@enderror
	<input type="password" id="cpassword" name="cpassword" placeholder="Konfirmasi Password" required />
	<span toggle="#cpassword" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
	<span id='emessage' STYLE="font-size:10.0pt"></span><br>
	<span id='message' STYLE="font-size:10.0pt"></span><br>
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">DATA PRIBADI</h2>
    <h3 class="fs-subtitle">*Data akan dijaga kerahasiaan</h3>
	<input type="number" id="nomor_induk" name="nomor_induk" placeholder="Nomor Identitas (NIK/NIP)" class="form-control @error('nomor_induk') is-invalid @enderror" value="{{ old('nomor_induk') }}" required />
    @error('nomor_induk')
	<div class="invalid-feedback">
		<i class="bx bx-radio-circle"></i>
		{{ $message }}
	</div>
	@enderror
	<input type="text" name="name" id="name" placeholder="Nama Lengkap" required />
    <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" />
    <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">DATA LAINNYA</h2>
    <h3 class="fs-subtitle">*Harap diisi dengan data sebenarnya</h3>
    <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" required />
    <input type="text" name="telp" id="telp" placeholder="Nomor Kontak" required />
    <textarea name="alamat" id="alamat" placeholder="Alamat Lengkap" required ></textarea>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Submit" />
  </fieldset>
</form>
</html>

<script>

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$('#password, #cpassword').on('keyup', function () {
  if ($('#password').val() == $('#cpassword').val()) {
    $('#message').html('Password Cocok').css('color', 'green');
  } else 
    $('#message').html('Password Tidak Cocok').css('color', 'red');
});

$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

</script>