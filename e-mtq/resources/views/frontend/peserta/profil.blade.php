<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

{{-- Input Pengaduan --}}
@extends('frontend.layout.app')
@section('title','Request Layanan | Kantor Kemenag Tanah Datar')
@section('content')

<style>
.profile-pic__container,
.profile-pic__foreground {
  line-height: 300px;
  text-align: center;
}

.profile-pic__container {
  overflow: hidden;
  position: relative;
  border: 3px solid #333;
  width: 30%;
  height: 400px;
  background-size: cover;
  background-position: center;
}

.profile-pic__foreground {
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  color: transparent;
  cursor: pointer;
  transition: color 0.2s, background-color 0.2s;
}

.profile-pic__foreground img{
	top: 0;
  width: 100%;
  height: 100%;
}

#file {
  border-collapse: collapse;
  width: 100%;
  text-align:center;
}

#file td, #file th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align:center;
}

#file tr:nth-child(even){background-color: #f2f2f2;}

#file tr:hover {background-color: #ddd;}

#file th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #04AA6D;
  color: white;
}

</style>
<section class="w-full px-8 py-20 bg-gray-100 xl:px-8">
    <div class="max-w-5xl mt-20  mx-auto">
        <div class="flex flex-col justify-between items-center md:flex-row">
            <div class="w-full mt-16 md:mt-0 ">
                <form action="{{route('store.peserta')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div
                        class="w-full h-auto p-10 py-10 overflow-hidden bg-white border-b-2 border-gray-300 rounded-lg shadow-2xl px-7">
                        <h3 class="mb-6 text-2xl font-medium text-center">Form <strong>Profil Peserta</strong>
                        </h3>
                        @error('jenis_pengaduan')
                        <div class="text-red-600 mb-4">{{ $message }}</div>
                       @enderror
					   <center><label for="" class="text-gray-600"><strong>:: FOTO PROFIL ::</strong></label><br />
					     <input id="js-file-uploader" class="hidden" name="profile-picture" type="file" accept="image/png, image/jpeg" />
						 <div id="js-profile-pic" class="profile-pic__container">Upload Profile Pic
							<div id="js-profile-trigger" class="profile-pic__foreground"><img src="{{ asset('uploads/BerkasPeserta/'.Auth::user()->nomor_induk.'/'.$files->foto) }}" /></div>
						  </div>
						  <br />
						  <h3 class="mb-6 text-2xl font-medium text-center"><strong>{{Auth::user()->gmtq->cmtq->kategori}}</strong><br />{{Auth::user()->gmtq->golongan}}</h3>
						 </center>
						 <br />
						 <br />
                        <label for="" class="text-gray-600"><strong>Nomor Identitas (NIK / KK)</strong></label>
                        <div class="block mb-4 border border-gray-200 rounded-lg">
                            <input type="number" name="user_id" id="nis"
                                class="block w-full @error('nomor_induk') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"  value="{{auth()->user()->nomor_induk}}"
                                placeholder="Nomor Induk">
                        </div>
                        @error('nomor_induk')
                        <div class="text-red-600 mb-4">{{ $message }}</div>
                       @enderror
                        <label for="" class="text-gray-600"><strong>Nama</strong></label>
                        <div class="block mb-4 border @error('nama') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <input type="Nama" name="nama" id="Nama"
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
                                readonly value="{{auth()->user()->name}}">
                        </div>
                        @error('nama')
                        <div class="text-red-600 mb-4">{{ $message }}</div>
                       @enderror
					   <label for="" class="text-gray-600"><strong>Jenis Kelamin</strong></label>
                        <div class="block mb-4 border @error('jk') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <select id="jk" name="jk" class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none">
								<option value="Putra">Laki-Laki</option>
								<option value="Putri">Perempuan</option>
							</select>
						</div>
                        @error('nama')
                        <div class="text-red-600 mb-4">{{ $message }}</div>
                       @enderror
					   <label for="" class="text-gray-600"><strong>Tempat/Tanggal Lahir</strong></label>
                        <div class="block mb-4 border @error('ttl') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <table><tr><td><input type="text" name="ttl1" id="ttl1"
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
                                width="100px"  value="{{auth()->user()->tempat_lahir}}" /></td><td>&nbsp;/&nbsp;</td>
								<td><input type="date" name="ttl2" id="ttl2"
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
								width="120px" value="{{auth()->user()->tanggal_lahir}}" /></td></tr></table>
                        </div>
                        @error('email')
                        <div class="text-red-600 mb-4">{{ $message }}</div>
                       @enderror
                        <label for="" class="text-gray-600"><strong>Nomor Kontak</strong></label>
                        <div class="block mb-4 border @error('no_telp') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <input type="text" name="no_telp" id="no_telp"
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" 
								value="{{auth()->user()->telp}} ">
                        </div>
                        @error('no_telp')
                        <div class="text-red-600 mb-4">{{ $message }}</div>
                       @enderror
					    <label for="" class="text-gray-600"><strong>Email*</strong></label>
                        <div class="block mb-4 border @error('email') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <input type="email" name="email" id="email"
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
                                value="{{auth()->user()->email}}">
                        </div>
                        @error('email')
                        <div class="text-red-600 mb-4">{{ $message }}</div>
                       @enderror
					   <label for="" class="text-gray-600"><strong>Pekerjaan*</strong></label>
                        <div class="block mb-4 border @error('pekerjaan') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <input type="pekerjaan" name="pekerjaan" id="pekerjaan"
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"  
								value="{{auth()->user()->pekerjaan}} ">
                        </div>
                        @error('pekerjaan')
                        <div class="text-red-600 mb-4">{{ $message }}</div>
                       @enderror
                        <label for="" class="text-gray-600"><strong>Alamat</strong></label>
                        <div class="block mb-4 border @error('alamat') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <textarea type="alamat" name="alamat" id="alamat" cols="30" rows="5"
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"  
								value="{{auth()->user()->alamat}} "></textarea>
                        </div>
                        @error('alamat')
                        <div class="text-red-600 mb-4">{{ $message }}</div>
                       @enderror
					   <br />
					   <label for="" class="text-gray-600"><i><u><strong>*)Kosongkan jika belum punya/tidak ada</strong></u></i></label>
					  </div>
					  <br />
					
					<!--- FILE-FILE PESERTA -->
					  <div class="w-full h-auto p-10 py-10 overflow-hidden bg-white border-b-2 border-gray-300 rounded-lg shadow-2xl px-7">
						<h3 class="mb-6 text-2xl font-medium text-center">Form Upload <strong>Berkas Peserta</strong>
                        </h3>
						<table id="file">
						<tr>
							<th width="60%">BERKAS</td>
							<th width="50%">STATUS</th>
							<th width="10%">UPLOAD</th>
						</tr>
						<tr>
							<td><b>Pasphoto / Foto Peserta</b></td>
							<td>@if($files->foto == NULL)<i>&#9587; Belum Diupload</i> @else <a target=_blank href="{{ asset('uploads/BerkasPeserta/'.Auth::user()->nomor_induk.'/'.$files->foto) }}"><i>&#10004; Cek File</i> @endif</a></td>
							<td><input type="file" name="foto"  accept=".jpg,.jpeg,.png,.bmp" /></td>
						</tr>
						<tr>
							<td><b>Kartu Keluarga(KK)</b></td>
							<td>@if($files->kk == NULL)<i>&#9587; Belum Diupload</i> @else <a target=_blank href="{{ asset('uploads/BerkasPeserta/'.Auth::user()->nomor_induk.'/'.$files->kk) }}"><i>&#10004; Cek File</i> @endif</a></td>
							<td><input type="file" name="kk"  accept=".pdf,.jpg,.jpeg,.png,.bmp" /></td>
						</tr>
						<tr>
							<td><b>Kartu Tanda Penduduk(KTP)</b></td>
							<td>@if($files->ktp == NULL)<i>&#9587; Belum Diupload</i> @else <a target=_blank href="{{ asset('uploads/BerkasPeserta/'.Auth::user()->nomor_induk.'/'.$files->ktp) }}"><i>&#10004; Cek File</i> @endif</a></td>
							<td><input type="file" name="ktp"  accept=".pdf,.jpg,.jpeg,.png,.bmp" /></td>
						</tr>
						<tr>
							<td><b>Akta Kelahiran</b></td>
							<td>@if($files->akta == NULL)<i>&#9587; Belum Diupload</i> @else <a target=_blank href="{{ asset('uploads/BerkasPeserta/'.Auth::user()->nomor_induk.'/'.$files->akta) }}"><i>&#10004; Cek File</i> @endif</a></td>
							<td><input type="file" name="akta"  accept=".pdf,.jpg,.jpeg,.png,.bmp" /></td>
						</tr>
						<tr>
							<td><b>Ijazah Terakhir</b></td>
							<td>@if($files->ijazah == NULL)<i>&#9587; Belum Diupload</i> @else <a target=_blank href="{{ asset('uploads/BerkasPeserta/'.Auth::user()->nomor_induk.'/'.$files->ijazah) }}"><i>&#10004; Cek File</i> @endif</a></td>
							<td><input type="file" name="ijazah"  accept=".pdf,.jpg,.jpeg,.png,.bmp" /></td>
						</tr>
						<tr>
							<td><b>Sertifikat</b></td>
							<td>@if($files->sertifikat == NULL)<i>&#9587; Belum Diupload</i> @else <a target=_blank href="{{ asset('uploads/BerkasPeserta/'.Auth::user()->nomor_induk.'/'.$files->sertifikat) }}"><i>&#10004; Cek File</i> @endif</a></td>
							<td><input type="file" name="s1"  accept=".pdf,.jpg,.jpeg,.png,.bmp" /></td>
						</tr>
						<tr>
							<td><b>Data Pendukung Tambahan</b></td>
							<td>@if($files->tambahan == NULL)<i>&#9587; Belum Diupload</i> @else <a target=_blank href="{{ asset('uploads/BerkasPeserta/'.Auth::user()->nomor_induk.'/'.$files->tambahan) }}"><i>&#10004; Cek File</i> @endif</a></td>
							<td><input type="file" name="dp"  accept=".pdf,.jpg,.jpeg,.png,.bmp" /></td>
						</tr>
						</table>
						<br />
						<label for="" class="text-gray-600"><i><u><strong>*) Silahkan Klik di <i>"&#10004; Cek File"</i> untuk melihat berkas yang telah diupload :D</strong></u></i></label>
					  </div>
					<!--- END FILE -->
					
					  <br />
					  <br />
							<div class="block">
								<button id="click" type="submit" target=_blank
								class="w-full px-3 py-4 font-medium font-semibold font-medium text-white bg-blue-600 rounded-lg">Kirim</button>
							</div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection

<script>
const messageElement = document.querySelector('#js-message');

// Image elements
const fileUpload        = document.querySelector('#js-file-uploader');
const profileTrigger    = document.querySelector('#js-profile-trigger');
const profileBackground = document.querySelector('#js-profile-pic');

// Trigger the file upload to set the profile picture
profileTrigger.addEventListener('click', function(event) {
  event.preventDefault();
  fileUpload.click();
});

// new profile pic added, display it
fileUpload.addEventListener("change", function(event) {
  if (fileUpload.files && fileUpload.files[0]) {
    let reader = new FileReader();
    reader.onload = function(event) {
      // Remove the initial 'set picture image' text
      profileBackground.childNodes[0].nodeValue = "";
      // Set the new image src as the background
      profileBackground.style.backgroundImage = "url('" + event.target.result + "')";
    }
    reader.readAsDataURL(fileUpload.files[0]);
  }
});
</script>