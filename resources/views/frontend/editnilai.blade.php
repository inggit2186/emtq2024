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
</style>
<section class="w-full px-8 py-20 bg-gray-100 xl:px-8">
    <div class="max-w-5xl mt-20  mx-auto">
        <div class="flex flex-col justify-between items-center md:flex-row">
            <div class="w-full mt-16 md:mt-0 ">
                <form action="{{route('edit.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div
                        class="w-full h-auto p-10 py-10 overflow-hidden bg-white border-b-2 border-gray-300 rounded-lg shadow-2xl px-7">
                        <h3 class="mb-6 text-2xl font-medium text-center">Edit <strong>Penilaian</strong>
                        </h3>
						<input type=hidden name="id" value="{{$peserta->id}}" />
						<input type=hidden name="cid" value="{{$peserta->kategori_id}}" />
						<input type=hidden name="gid" value="{{$peserta->golongan_id}}" />
						<input type=hidden name="dnama" value="{{$peserta->nama}}" />
						<label for="" class="text-gray-600">Sesi / Babak</label>
						<div class="block mb-4 border @error('jenis_pengaduan') border border-red-500 @enderror border-gray-200 rounded-lg">
							<input type="text" name="nama" id="nama" required
                                class="block w-full @error('nama') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" 
								value="Penyisihan"readonly />
                        </div>
						<br />
						<br />
						<label for="" class="text-gray-600">Jenis Golongan</label>
                        <div class="block mb-4 border @error('jenis_pengaduan') border border-red-500 @enderror border-gray-200 rounded-lg">
							<input type="text" name="nama" id="nama" required
                                class="block w-full @error('nama') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" 
								value="{{$peserta->gmtq->golongan}}" readonly />
                        </div>
                        @error('jlayanan')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
					   
                        <label for="" class="text-gray-600">Nama Peserta / Grup</label>
                        <div class="block mb-4 border border-gray-200 rounded-lg">
                            <input type="text" name="nama" id="nama" required
                                class="block w-full @error('nama') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
                                value="{{$peserta->nama}}" >
                        </div>
                        @error('nama')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
                       <label for="" class="text-gray-600">Utusan / Asal Kontingen</label>
                        <div class="block mb-4 border border-gray-200 rounded-lg">
                            <input type="text" name="utusan" id="utusan" required
                                class="block w-full @error('utusan') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
                                value="{{$peserta->utusan}}" >
                        </div>
                        @error('utusan')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
                       <label for="" class="text-gray-600">Jenis Kelamin</label>
                        <div class="block mb-4 border border-gray-200 rounded-lg">
                            <select name="jk" id="jk" required
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none">
                                <option value="Pilihdulu" disabled selected
                                    class="block w-full px-4 py-3 border-2 border-transparent text-gray-400 rounded-lg focus:border-blue-500 focus:outline-none">
                                    ---- Silahkan Pilih Jenis Kelamin ------</option>
								<option value="Putra"class="block w-full px-4 py-3 border-2 border-transparent text-gray-800 rounded-lg focus:border-blue-500 focus:outline-none" @if($peserta->jk == "Putra") selected @endif>
                                    Putera / Laki-Laki</option>
								<option value="Putri"class="block w-full px-4 py-3 border-2 border-transparent text-gray-800 rounded-lg focus:border-blue-500 focus:outline-none" @if($peserta->jk == "Putri") selected @endif>
                                    Puteri / Perempuan</option>
							</select>
                        </div>
                        @error('jk')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
                        <label for="" class="text-gray-600">Nomor Loot</label>
                        <div class="block mb-4 border @error('nomor') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <input type="text" name="nomor" id="nomor"
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" 
								value="{{$peserta->nomor}}" />
                        </div>
                        @error('nomor')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
						<br /><br />
						@if($peserta->cmtq->penanya == 1)
						@php
							$penanya = App\Models\Nilai::where('peserta',$peserta->nama)->whereNotNull('penanya')->groupBy('penanya')->first();
						@endphp
						<label for="" class="text-gray-600">Hakim Penanya</label>
                        <div class="block mb-4 border @error('penanya') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <input type="text" name="penanya" id="penanya"
                                value="{{$penanya->penanya}}" class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" />
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
								@php
									$value = App\Models\Nilai::where(['peserta' => $peserta->nama, 'bidang_id' => $nilai->id])->skip($i)->first();
								@endphp
								<tr>
								<td style="width:80%;"><input list="hakim" type="text" name="hakim{{$nilai->id}}-{{$i}}" id="nilai" 
                                class="block w-full @error('nhakim1') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" autocomplete="off" 
								value="@if(!empty($value->hakim)){{$value->hakim}}@endif" placeholder="Nama Hakim {{$i+1}}" />
    							<datalist id="hakim">
    							    @php $lhakim = App\Models\Nilai::where('kategori_id',$peserta->kategori_id)->groupBy('hakim')->get();
    							    @endphp
    							    @foreach ($lhakim as $lhakim)
    							        <option value="{{$lhakim->hakim}}" />
    							    @endforeach
    							</datalist>
                                </td>
								<td><input type="number" step="any" name="nilai{{$nilai->id}}-{{$i}}" id="xnilai"
                                class="block w-full @error('nilai{{$nilai->id}}-{{$i}}') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" 
                                value="@if(!empty($value->nilai)){{$value->nilai}}@endif" 
								placeholder="Nilai" /></td>
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