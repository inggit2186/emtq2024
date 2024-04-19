<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

{{-- Input Pengaduan --}}
@extends('frontend.layout.app')
@section('title','Request Layanan | Kantor Kemenag Tanah Datar')
@section('content')

<style>
label {
	font-size: 18px;
	font-weight: 500;
}

table, tr, td {
  border: 1px solid white;
  border-collapse: collapse;
}
tr, td {
  background-color: #96D4D4;
}
/* The container */
.gid {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 16px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.gid input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.gid:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.gid input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.gid input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.gid .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}

h2{
  font-weight: 500;
  font-size: 20pt;
  line-height: 1.3em;
  margin: 15px 0;
  font-family: FontAwesome;
}

div h3 {
	text-align:left;
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
<section class="w-full px-8 py-20 bg-gray-100 xl:px-8">
<div class="information message" align="center" style="font-family:Roboto;" >
	<h2><p><b>**WARNING**</b></p></h2>
	<h3><p>1. Aplikasi tidak dapat Menginput Data dengan <b><i>Nama Peserta yang Sama lebih dari Sekali</i></b>, Harap <i>Dicek kembali</i> sebelum menginput data</p></h3>
	<h3><p>2. Patokan dari Jumlah Hakim/Penilaian adalah <b>Nama Hakim</b>, jadi jika ada kolom nilai yang berlebih (semisal Hakim untuk MTQ seharusnya 2 tetapi di kolom Aplikasi ada 3) <b>(Wajib)</b>kosongkan kolom Nama Hakim dan Nilai yang ke3 (yang tidak dipakai).</p></h3>
	<h3><p>3. Untuk nilai <b><i>Berkoma</i></b>, Gunakan tanda <i>titik (.)</i></p></h3>
	<h3><p>4. Jika ada kekurangan / kesalahan (*ex Jml form nilai kurang, nilai max salah, cabang penilaian salah/berubah, dll) <b>Segera Laporkan</b> kepada Admin</i></p></h3>
</div>
    <div class="max-w-5xl mt-20  mx-auto">
        <div class="flex flex-col justify-between items-center md:flex-row">
            <div class="w-full mt-16 md:mt-0 ">
                <form action="{{route('pengaduan.store', $cmtq->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div
                        class="w-full h-auto p-10 py-10 overflow-hidden bg-white border-b-2 border-gray-300 rounded-lg shadow-2xl px-7">
                        <h3 class="mb-6 text-2xl font-medium text-center">Input <strong>Penilaian</strong>
                        </h3>
						<label for="" class="text-gray-600">Sesi/Babak</label>
						 <div class="block mb-4 border @error('jenis_pengaduan') border border-red-500 @enderror border-gray-200 rounded-lg">
						<label class="gid">Penyisihan
						  <input type="radio" name="gid" value="0">
						  <span class="checkmark"></span>
						</label><label class="gid">Final
						  <input type="radio" name="gid" value="2" checked="checked">
						  <span class="checkmark"></span>
						</label>
						</div>
						@error('gid')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
						<br />
						<br />
						<label for="" class="text-gray-600">Jenis Golongan</label>
                        <div class="block mb-4 border @error('jenis_pengaduan') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <select name="jlayanan" id="Nama" required
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none">
                                <option value="Pilihdulu" disabled selected
                                    class="block w-full px-4 py-3 border-2 border-transparent text-gray-400 rounded-lg focus:border-blue-500 focus:outline-none">
                                    ---- Silahkan Pilih Jenis Golongan ------</option>
								@foreach($gmtq as $item)
                                <option value='{{ $item->id }}' 
                                    class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" 
									@if(count($gmtq)==1) selected @endif >
                                    {{ $item->golongan }}</option>
								@endforeach
                            </select>
                        </div>
                        @error('jlayanan')
                        <div class="text-red-600 mb-4" style="background-color: yellow;" >{{ $message }}</div>
                       @enderror
					   
                        <label for="" class="text-gray-600">Nama Peserta / Grup</label>
                        <div class="block mb-4 border border-gray-200 rounded-lg">
                            <input type="text" name="nama" id="nama" required
                                class="block w-full @error('nama') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
                                 value="{{old('nama')}}" placeholder="Nama Peserta" >
                        </div>
                        @error('nama')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
                       <label for="" class="text-gray-600">Utusan / Kontingen</label>
                        <div class="block mb-4 border border-gray-200 rounded-lg">
                            <input type="text" name="utusan" id="utusan" required
                                class="block w-full @error('utusan') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
                                 value="{{old('utusan')}}" placeholder="Utusan/Kontingen Peserta" >
                        </div>
                        @error('nama')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
                        <label for="" class="text-gray-600">Jenis Kelamin</label>
                        <div class="block mb-4 border border-gray-200 rounded-lg">
                            <select name="jk" id="jk" required
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none">
                                <option value="Pilihdulu" disabled selected
                                    class="block w-full px-4 py-3 border-2 border-transparent text-gray-400 rounded-lg focus:border-blue-500 focus:outline-none">
                                    ---- Silahkan Pilih Jenis Kelamin ------</option>
								<option value="Putra"class="block w-full px-4 py-3 border-2 border-transparent text-gray-800 rounded-lg focus:border-blue-500 focus:outline-none">
                                    Putera / Laki-Laki</option>
								<option value="Putri"class="block w-full px-4 py-3 border-2 border-transparent text-gray-800 rounded-lg focus:border-blue-500 focus:outline-none">
                                    Puteri / Perempuan</option>
							</select>
                        </div>
                        @error('jk')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
                        <label for="" class="text-gray-600">Nomor Loot</label>
                        <div class="block mb-4 border @error('nomor') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <input type="text" name="nomor" id="nomor"
                                value="{{old('nomor')}}" class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" />
                        </div>
                        @error('nomor')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
						<br /><br />
						@if($cmtq->penanya == 1)
						<label for="" class="text-gray-600">Hakim Penanya</label>
                        <div class="block mb-4 border @error('penanya') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <input type="text" name="penanya" id="penanya"
                                value="{{old('penanya')}}" class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" />
                        </div>
                        @error('penanya')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
					   @endif
					   <br />
						@php $a=0; @endphp
						@foreach($nilai as $nilai)
						@php $i=0; @endphp
							<table>
							<thead>
								<tr><td colspan=3><label for="" class="text-gray-600">&nbsp;&nbsp;<b>{{$nilai->nama}}</b></label></td></tr>
							</thead>
							<tbody>
							@for($i==0;$i < $nilai->hakim;$i++)
								<tr>
								<td style="width:80%;"><input list="hakim" type="text" name="hakim{{$nilai->id}}-{{$i}}" id="nilai" 
                                value="{{old('hakim'.$nilai->id.'-'.$i)}}" class="block w-full @error('nhakim1') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" autocomplete="off" placeholder="Nama Hakim {{$i+1}}" />
    							<datalist id="hakim">
    							    @php $lhakim = App\Models\Nilai::where('kategori_id',$cmtq->id)->groupBy('hakim')->get();
    							    @endphp
    							    @foreach ($lhakim as $lhakim)
    							        <option value="{{$lhakim->hakim}}" />
    							    @endforeach
    							</datalist>
                                </td>
								<td><input type="number" step="any" name="nilai{{$nilai->id}}-{{$i}}" id="xnilai"
                                class="block w-full @error('nilai{{$nilai->id}}-{{$i}}') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" 
                                value="{{old('nilai'.$nilai->id.'-'.$i)}}" placeholder="Nilai" /></td>
								</tr>
							@endfor
							</tbody>
							</table>
							<br /><br />
							@php $a++; @endphp
						@endforeach
					   
					   <br />
					   <br />

							<div class="block">
								<button type="submit"
								class="w-full px-3 py-4 font-medium font-semibold font-medium text-white bg-blue-600 rounded-lg">Kirim</button>
							</div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection

<script>

jQuery(document).ready(function(){
  $("#Nama").change(function() {
		var layanan = $(this).val();
		var name = "layanan"+layanan;
		
      if(( layanan == "999") || ( layanan == "888")){
          $("#judul").css('display', 'block');
		  $(".layanan").css('display', 'none');
      }else{
          $("#judul").css('display', 'none');
		  var syarat = document.getElementById(name).getAttribute("id");
		  console.log(syarat);
		  $("#"+name).css('display', 'block');
		  $('.layanan').not('#' + name).css('display', 'none');
      }
	   
  });
    
});

</script>