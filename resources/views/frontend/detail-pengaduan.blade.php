@extends('frontend.layout.app')
@section('title', 'Detail Pengaduan | SMKN 2 Karanganyar')
@section('content')
<!---form -->
<section class="w-full px-8 py-20 bg-gray-100 xl:px-8">
    <div class="max-w-5xl mt-20  mx-auto">
        <div class="flex flex-col justify-between items-center md:flex-row">
            <div class="w-full mt-16 md:mt-0 ">
                <div
                    class="w-full h-auto p-10 py-10 overflow-hidden bg-white border-b-2 border-gray-300 rounded-lg shadow-2xl px-7">
                    <h3 class="mb-6 text-2xl font-medium text-center">Detail <strong>Request / Konsultasi / Pengaduan</strong> Anda
                    </h3>

                    <!-- card report -->
                    <div
                        class="w-full px-6  py-6 mx-auto mt-10 shadow-2xl bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow-2xl lg:w-5/6 xl:w-2/3">
                        <h3 class="text-lg font-bold text-gray-500 sm:text-xl md:text-2xl">
                            {{$groupItem->layanan->nama}}
                        </h3>
                        <hr class="bg-gray-400 my-4 rounded-md">
                        <p class="text-sm sm:text-md md:text-md">Nama Pelapor : <span
                                class="font-semibold  text-cyan-500">{{auth()->user()->name}}</span>
                        </p>

                        <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">
                            {{$groupItem->deskripsi}}</p>
						<br />
						
						<div>
						<h5><strong><u>Berkas Pendukung</u></strong></h5>
						</div>
						<tr>
                            <th>syarat</th>
                            <th>FILES</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
						<tr>
							<td>KTP</td>
							<td>Dowload</td>
							<td><input type="fle" name="updateberkas"></td>
							
						</tr>
						</table>
<!--
						@if (!$groupItem->berkas_pendukung)
                        <div class="flex justify-between items-center">
                            <p class="px-3 py-1 mx-2 bg-gray-600 text-gray-100 text-sm font-bold rounded hover:bg-gray-500">
                                Tidak ada berkas yang dilampirkan</p>
                        </div>
                        @else
                        <a href="{{ asset($groupItem->pengaduan->berkas_pendukung) }}" class="text-blue-400"
                            download="{{$groupItem->pengaduan->berkas_pendukung}}">Download Berkas</i></a>
                        @endif
-->
						<br />
                        @if ($groupItem->status === 'PENDING')
                        <div
                            class="bg-yellow-500 font-semibold text-center mt-4 text-white p-2 rounded  leading-none flex items-center">
                            Pending</span>
                        </div>
                        @elseif($groupItem->status === 'DITERIMA')
                        <div
                            class="bg-gray-400  font-semibold  text-center mt-4 text-white p-2 rounded  leading-none flex items-center">
										{{ $groupItem->status }} oleh {{ $groupItem->staff->pekerjaan }}
							</span>
                        </div>
						@elseif($groupItem->status === 'DIPROSES')
                        <div
                            class="bg-green-600  font-semibold  text-center mt-4 text-white p-2 rounded  leading-none flex items-center">
                            Sedang Dalam Proses</span>
                        </div>
						@elseif($groupItem->status === 'DITOLAK')
                        <div
                            class="bg-red-600  font-semibold  text-center mt-4 text-white p-2 rounded  leading-none flex items-center">
                            Request Ditolak</span>
                        </div>
						@elseif($groupItem->status === 'BATAL')
                        <div
                            class="bg-black  font-semibold  text-center mt-4 text-white p-2 rounded  leading-none flex items-center">
                            Request Batal</span>
                        </div>
                        @else
                        <div
                            class="bg-purple-600 font-semibold text-center mt-4 text-white p-2 rounded  leading-none flex items-center">
                            SUKSES </span>
                        </div>
                        @endif
                        <hr class="bg-gray-400 my-4 rounded-md py-1 px-1">
                        <h3 class="text-xl font-semibold  text-cyan-500 sm:text-md md:text-md">Tanggapan
                        </h3>
						
						@if (!empty($groupItem->tanggapan))
                        <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">{{$groupItem->tanggapan->tanggapan}}</p>
                        @endif
						<div class="block">
                            <a href="{{url('site/cek-pengaduan')}}"
                                class="inline-flex items-center w-full px-6 py-3 text-sm font-medium leading-4 text-white transition duration-150 ease-in-out bg-transparent bg-indigo-600 border border-transparent md:px-3 md:w-auto md:rounded-md mt-5 lg:px-5 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">kembali</a>
                        </div>
                    </div>
                    <!-- card report -->
                </div>
            </div>
</section>
@endsection
