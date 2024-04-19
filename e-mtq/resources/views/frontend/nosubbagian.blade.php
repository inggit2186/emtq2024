{{-- Sub-bagian --}}
@extends('frontend.layout.app')
@section('title', 'Sub-Bagian | Kantor KEMENAG Tanah Datar')
@section('content')


<style>
@import url('https://fonts.googleapis.com/css?family=Kanit|Lobster');

html {
  font-family: 'Kanit', sans-serif;
}

.body2 {
  padding-top: 120px;
  background-color: #fff;
  color: #000;
  display: flex;
  align-items: center;
  min-height: 100vh;
}

.container {
  width: 90%;
  margin: 0 auto;
}

.container > h1, .title {
  font-family: 'Lobster', cursive;
  letter-spacing: 1px;
  font-size: 35px;
}

.container > h1, .container > p {
    text-align: center;
 }

.services {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: 40px;
}

.service {
  margin: 10px;
  overflow: hidden;
  padding: 35px 15px;
  position: relative;
  text-align: center;
  transition: background-color 0.3s ease-in,
              transform .3s ease-in;
  width: 200px;
}

.service:hover {
  background-color: #8e44ad;
  transform: translateY(-3px);
}

.service::before {
  content: '';
  border-width: 20px;
  border-style: solid;
  border-color: #222f3e #222f3e rgba(1,1,1,0.4) rgba(0,0,0,0.4);
  position: absolute;
  right: -40px;
  top: -40px;
  transition: right 0.3s ease-out,
                top 0.3s ease-out;
}

.service:hover::before {
  right: 0;
  top: 0;
}

.service > i {
  display: block;
  color: #8e44ad;
  font-size: 4rem;
  margin-bottom: 0.9rem;
  transition: color 0.3s ease-out;
}

.service > .title {
  font-weight: 900;
  font-size: 1.2rem;
  line-height: 1.56rem;
  margin-bottom: 1rem;
  text-transform: capitalize;
  transition: color 0.3s ease-out;
}

.service > .description {
  line-height: 1.56rem;
  margin: 0;
  transition: color 0.3s ease-out;
}

.service:hover > i,
.service:hover > .title,
.service:hover > .description {
  color: #FFF;
}
</style>
<html>

<div class="body2">
<div class="container">
  <h1>Pengambilan Nomor Loot <br/> Kategori MTQ</h1>
  <p>Selamat Datang Bpk/Ibu. <b>{{Auth::user()->name}}</b><br/>
  </p>
  <div class="services">
    
	@foreach ($gmtq as $item)
	<a href="{{route('buat.noloot', Crypt::Encrypt($item->cmtq->id))}}">
	<div class="service">
     <img src="{{asset('assets/logomtq.png')}}" />
      <h4 class="title">{{ $item->cmtq->kategori }}</h4>
      <p class="description">
			 Kategori MTQ Kab.Tanah Datar
      </p>
    </div>
	</a>
	@endforeach
	
  </div>
</div>
</div>
</html>
@endsection
