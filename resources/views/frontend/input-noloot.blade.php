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
</style>
<section class="w-full px-8 py-20 bg-gray-100 xl:px-8">
    <div class="max-w-5xl mt-20  mx-auto">
        <div class="flex flex-col justify-between items-center md:flex-row">
            <div class="w-full mt-16 md:mt-0 ">
                <form action="{{route('store.noloot', $cmtq->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
					@if (session('error'))
                        <div class="container mx-auto">
                            <div class="w-full my-4 rounded-md bg-red-500 text-white">
                                <div class="flex justify-between items-center container mx-auto py-4 px-6">
                                    <div class="flex">
                                        <svg viewBox="0 0 40 40" class="h-6 w-6 fill-current">
                                            <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"></path>
                                        </svg>

                                        <p class="mx-3">{{ session('error') }}</</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (session('status'))     
                        <div class="w-full my-4 rounded-md bg-green-500 text-white">
                            <div class="flex justify-between items-center container mx-auto py-4 px-6">
                                <div class="flex">
                                    <svg viewBox="0 0 40 40" class="h-6 w-6 fill-current">
                                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"></path>
                                    </svg>
                    
                                    <p class="mx-3">{{ session('status') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    <div
                        class="w-full h-auto p-10 py-10 overflow-hidden bg-white border-b-2 border-gray-300 rounded-lg shadow-2xl px-7">
                        <h3 class="mb-6 text-2xl font-medium text-center">Pengambilan <strong>Nomor Loot</strong>
                        </h3>
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
                            <input type="text" name="peserta" id="peserta" required
                                class="block w-full @error('peserta') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
                                 value="{{old('peserta')}}" placeholder="Nama Peserta" >
                        </div>
                        @error('peserta')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
					   <label for="" class="text-gray-600">Nomor Identitas</label>
                        <div class="block mb-4 border border-gray-200 rounded-lg">
                            <input type="text" name="nik" id="nik" required
                                class="block w-full @error('nik') border border-red-500 @enderror px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
                                 value="{{old('nik')}}" placeholder="Nomor Identitas" >
                        </div>
                        @error('nik')
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
                        <label for="" class="text-gray-600">Asal Peserta / Kontingen</label>
                        <div class="block mb-4 border @error('asal') border border-red-500 @enderror border-gray-200 rounded-lg">
                            <input type="text" name="asal" id="asal"
                                value="{{old('asal')}}" class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" />
                        </div>
                        @error('asal')
                        <div class="text-red-600 mb-4" style="background-color: yellow;">{{ $message }}</div>
                       @enderror
						<br /><br />
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
