<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="icon" href="{{asset('assets/favicon.png')}}">

<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

body {
  margin: 100px;
  font-family: 'Cedarville Cursive', cursive;
  margin: 0 auto;
  background-image: url(https://cdna.artstation.com/p/assets/images/images/005/152/718/large/nikita-kozlov-123.jpg?1488878117);
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover;
}



.container {
    margin-right: auto;
    margin-left: auto;
    padding-right: 15px;
    padding-left: 15px;
    width: 100%;
    padding-top: 550px;
    font-family:Roboto;
    font-weight:bold;
}




div#background {
  height: 900px;
  width: 100%;
  padding-top: 20px;
}

div#gallery {
  width: 1200px;
  margin: auto;
}


#background img {
  height: 270px;
  margin: 0px;
}

#background figure {
  float: left;
  position: relative;
  background-color: white;
  text-align: center;
  font-size: 25px;
  padding: 10px;
  margin: 10px;
  box-shadow: 1px 2px 3px black;
}

figure.pic1 {
  -webkit-transform : rotate(-10deg);
  z-index: 1;
}

figure.pic2 {
  -webkit-transform : rotate(15deg);
  z-index: 2;
}

figure.pic3 {
  -webkit-transform : rotate(-25deg);
  z-index: 1;
}

figure.pic4 {
  -webkit-transform : rotate(15deg);
  z-index:1;
}

figure.pic5 {
  -webkit-transform : rotate(-7deg);
  z-index:1;
}

figure.pic6 {
  -webkit-transform : rotate(8deg);
  z-index:1;
}

figure.pic7 {
  -webkit-transform : rotate(4deg);
  z-index:1;
}

figure.pic8 {
  -webkit-transform : rotate(-13deg);
  z-index:1;
}

figure.pic9 {
  -webkit-transform : rotate(-7deg);
  z-index:1;
}

figure.pic10 {
  -webkit-transform : rotate(-8deg);
  z-index:1;
}
figure.pic11 {
  -webkit-transform : rotate(-13deg);
  z-index:1;
}
figure.pic12 {
  -webkit-transform : rotate(-11deg);
  z-index:1;
}
figure.pic13 {
  -webkit-transform : rotate(-4deg);
  z-index:1;
}
figure.pic14 {
  -webkit-transform : rotate(-5deg);
  z-index:1;
}
figure.pic15 {
  -webkit-transform : rotate(-13deg);
  z-index:1;
}


#background figure:hover {
  box-shadow: 5px 10px 100px black;
  -webkit-transform: scale(1.1,1.1);
  z-index: 20;
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

a {
	color: black;
	font-weight: 600;
   text-decoration: none;
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
div.message.error{background: #C43;}
</style>

<html style="width: 100%;">
<head>
<title>Rekap Hasil MTQ Nasional ke-41 Kabupaten Tanah Datar</title>

</head>

<body>

<div class="information message" align="center" style="font-family:Roboto;" >
  <h2>Rekap Hasil MTQ Nasional ke-41</h2>
	<h3><p>Kabupaten Tanah Datar</p></h3>
	<h3><p>Operator : {{Auth::user()->name}}</p></h3>
</div>

<link href='https://fonts.googleapis.com/css?family=Cedarville+Cursive' rel='stylesheet' type='text/css'>

<div id="background">
  <div id="gallery">
	<?php $i=1; ?>
    @foreach($cmtq as $cmtq)
    <figure class="pic<?= $i;?>">
      <a href="{{route('ranking.mtq', Crypt::Encrypt($cmtq->cmtq_id))}}"><img src="{{asset('assets/logomtq.png')}}" /><figcaption>#{{$cmtq->cmtq->kategori}}</figcaption></a>
    </figure>
    <figure class="pic<?= $i;?>">
      <a href="{{route('rankingfinal.mtq', Crypt::Encrypt($cmtq->cmtq_id))}}"><img src="{{asset('assets/logomtq.png')}}" /><figcaption>#{{$cmtq->cmtq->kategori}} (FINAL)</figcaption></a>
    </figure>
    <?php $i++;?>
	@endforeach
	<br />
  </div>
</div>
</body>
</html>


<script>
$(document).ready( function(){

    size_titles();

    $(window).resize(function() {
        size_titles();
    })


});



var $cc = $('.title-container');
var large_font, small_font;
var proportion = .47;


function size_titles(){

    //reset the height right away!
    $cc.css({'height': $cc.width() * proportion });

    console.log(proportion)

    small_font = $cc.height() * .31;
    large_font = $cc.height() * .77;

    $('#line-1').css({'font-size':small_font})
    $('#line-2').css({'font-size':large_font})

}
</script>