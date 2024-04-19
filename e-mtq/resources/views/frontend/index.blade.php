@extends('frontend.layout.app')

@section('title', 'e-MTQ | Kementerian Agama Kab.Tanah Datar')

@section('content')
   <!-- hero section -->
   <section class="py-20 bg-gray-50">
    <div class="container mt-10 items-center max-w-10xl px-4 px-10 mx-auto sm:px-20 md:px-32 lg:px-16">
      <div class="flex flex-wrap items-center -mx-3">
        <div class="order-1 w-full px-3 lg:w-1/2 lg:order-0">
          <div class="w-full lg:max-w-md">
            <h2
              class="mb-4 text-2xl  font-bold leading-tight tracking-tight   lg:text-left md:text-center font-heading">
              Selamat Datang di Sistem e-MTQ Kementerian Agama Kab.Tanah Datar</h2>
              <p class="mb-4 font-medium tracking-tight text-gray-400 lg:text-left md:text-center  xl:mb-6">Silahkan
			  Lengkapi data Peserta untuk mengikuti MTQ Nasional cabang Kabupaten Tanah Datar.</p>
              <div class="relative flex flex-col sm:flex-row  sm:space-x-4">
               <a href="#"
                  class="flex items-center px-6 py-3  text-md mt-2 text-gray-500 bg-gray-200 rounded-md hover:bg-gray-200 hover:text-gray-600">
                  Pelajari Selengkapnya
                </a>
				@guest
				<a href="{{url('site/subbagian')}}"
                  class="flex items-center w-full  px-6 py-3 mt-2 mb-3 text-md text-white bg-indigo-600 rounded-md sm:mb-0 hover:bg-indigo-700 sm:w-auto">
                  LOGIN
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-arrow-right">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </a>
				@endguest
				@auth
				@if(Auth::user()->role == 'user')
                <a href="{{route('cmtq')}}"
                  class="flex items-center w-full  px-6 py-3 mt-2 mb-3 text-md text-white bg-indigo-600 rounded-md sm:mb-0 hover:bg-indigo-700 sm:w-auto">
                  Dashboard
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-arrow-right">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </a>
				@elseif(Auth::user()->role == 'peserta')
				<a href="{{route('profil')}}"
                  class="flex items-center w-full  px-6 py-3 mt-2 mb-3 text-md text-white bg-indigo-600 rounded-md sm:mb-0 hover:bg-indigo-700 sm:w-auto">
                  Lengkapi Profil
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-arrow-right">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </a>
				@else
				<a href="{{route('dashboard')}}"
                  class="flex items-center w-full  px-6 py-3 mt-2 mb-3 text-md text-white bg-indigo-600 rounded-md sm:mb-0 hover:bg-indigo-700 sm:w-auto">
                  Dashboard
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-arrow-right">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </a>
				@endif
				@endauth
              </div>
          </div>
        </div>
        <div class="w-full px-3 mb-12 lg:w-1/2 order-0 lg:order-1 lg:mb-0"><img
            class="mx-auto sm:max-w-sm lg:max-w-full" src="{{asset('assets/feature-graphic.png')}}" alt="feature image"></div>
      </div>
    </div>
  </section>
  <!-- end hero section -->

  <!-- about -->
  <section class="relative py-20 bg-white min-w-screen animation-fade animation-delay" id="about">
    <div class="container px-0 px-8 mx-auto sm:px-12 xl:px-5">
      <p
        class="text-xs font-bold md:mt-10 text-left text-pink-500 uppercase sm:mx-6 sm:text-center sm:text-normal sm:font-bold">
        Selayang Pandang</p>
      <h4
        class="mt-1 text-md font-bold text-left text-gray-800 sm:mx-6 sm:text-3xl md:text-md lg:text-mdl sm:text-center sm:mx-0">
        Sekilas Mengenai Aplikasi PTSP Kantor Kementerian Agama Kab.Tanah Datar</h4>

      <div
        class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
        <h3 class="text-lg font-bold text-purple-500 sm:text-xl md:text-2xl">Untuk Apa sistem ini di buat?</h3>
        <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">ini dibuat untuk menampung permintaan layanan dan konsultasi dari semua warga Kab.Tanah Datar. Diharapkan dengan sistem ini semua warga sekolah dapat lebih mudah untuk melaporkan pengaduan & aspirasi untuk sekolah.
        </p>
      </div>
    </div>
  </section>
  <!-- end about -->
  <!-- Flow content -->
  <section class="relative py-16 bg-white min-w-screen animation-fade animation-delay" id="flow">
    <div class="container px-0 px-8 mx-auto sm:px-12 xl:px-5">
      <p
        class="text-xs font-bold  md:mt-20 text-left text-pink-500 uppercase sm:mx-6 sm:text-center sm:text-normal sm:font-bold">
        Alur Request</p>
      <h4
        class="mt-1 text-md font-bold text-left text-gray-800 sm:mx-6 sm:text-3xl md:text-md lg:text-mdl sm:text-center sm:mx-0">
        Bagaimana Alur Request </h4>

      <div class="grid grid-cols-4 gap-8 mt-10 sm:grid-cols-8 lg:grid-cols-12 sm:px-8 xl:px-0">

        <div
          class="relative flex flex-col items-center justify-between col-span-4 px-8 py-12 space-y-4 overflow-hidden bg-gray-100 sm:rounded-xl">
          <div class="p-3 text-white bg-blue-500 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 " viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M14 3v4a1 1 0 0 0 1 1h4" />
              <path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5" />
              <circle cx="6" cy="14" r="3" />
              <path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5" />
            </svg>
          </div>
          <h4 class="text-xl font-medium text-gray-700">1. Masuk/Login</h4>
          <p class="text-base text-center text-gray-500">Masuk ke sistem ini dengan email dan password yang sudah terdaftar. </p>
        </div>

        <div
          class="flex flex-col items-center justify-between col-span-4 px-8 py-12 space-y-4 bg-gray-100 sm:rounded-xl">
          <div class="p-3 text-white bg-blue-500 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 " viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M18 8a3 3 0 0 1 0 6" />
              <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5" />
              <path
                d="M12 8h0l4.524 -3.77a0.9 .9 0 0 1 1.476 .692v12.156a0.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8" />
            </svg>
          </div>
          <h4 class="text-xl font-medium text-gray-700">2. Buat Permintaan</h4>
          <p class="text-base text-center text-gray-500">Klik tombol "Buat Permintaan" yang tersedia di halaman ini.</p>
        </div>

        <div
          class="flex flex-col items-center justify-between col-span-4 px-8 py-12 space-y-4 bg-gray-100 sm:rounded-xl">
          <div class="p-3 text-white bg-blue-500 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 " viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M18 8a3 3 0 0 1 0 6" />
              <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5" />
              <path
                d="M12 8h0l4.524 -3.77a0.9 .9 0 0 1 1.476 .692v12.156a0.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8" />
            </svg>
          </div>
          <h4 class="text-xl font-medium text-gray-700">3. Lengkapi Form </h4>
          <p class="text-base text-center text-gray-500">Isi semua form sesuai tempat yang sudah disediakan dengan data yang benar.</p>
        </div>

        <div
          class="flex flex-col items-center justify-between col-span-4 px-8 py-12 space-y-4 bg-gray-100 sm:rounded-xl">
          <div class="p-3 text-white bg-blue-500 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 " viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M18 8a3 3 0 0 1 0 6" />
              <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5" />
              <path
                d="M12 8h0l4.524 -3.77a0.9 .9 0 0 1 1.476 .692v12.156a0.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8" />
            </svg>
          </div>
          <h4 class="text-xl text-center font-medium text-gray-700">4. Tambahkan Berkas Pendukung (Jika Ada)</h4>
          <p class="text-base text-center text-gray-500">Tambahkan berkas pendukung jika perlu, agar laporan bisa lebih jelas dan mudah dipahami.</p>
        </div>

        <div
          class="flex flex-col items-center justify-between col-span-4 px-8 py-12 space-y-4 bg-gray-100 sm:rounded-xl">
          <div class="p-3 text-white bg-blue-500 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 " viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M18 8a3 3 0 0 1 0 6" />
              <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5" />
              <path
                d="M12 8h0l4.524 -3.77a0.9 .9 0 0 1 1.476 .692v12.156a0.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8" />
            </svg>
          </div>
          <h4 class="text-xl font-medium text-gray-700">Kirim Permintaan</h4>
          <p class="text-base text-center text-gray-500">Kirim permintaan agar nantinya bisa dicek oleh petugas dari kantor.</p>
        </div>

        <div
          class="flex flex-col items-center justify-between col-span-4 px-8 py-12 space-y-4 bg-gray-100 sm:rounded-xl">
          <div class="p-3 text-white bg-blue-500 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 " viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M18 8a3 3 0 0 1 0 6" />
              <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5" />
              <path
                d="M12 8h0l4.524 -3.77a0.9 .9 0 0 1 1.476 .692v12.156a0.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8" />
            </svg>
          </div>
          <h4 class="text-xl font-medium text-gray-700">Tunggu Konfirmasi</h4>
          <p class="text-base text-center text-gray-500">Jika laporan sudah diterima dan ditanggapi, pemberitahuan akan dikirimkan melalui email yang digunakan.</p>
        </div>

      </div>
    </div>
  </section>
  <!-- flow content -->
  <!-- FAQ -->
  <section class="relative py-16 bg-gray-100 min-w-screen animation-fade animation-delay" id="faq">
    <div class="container px-0 px-8 mx-auto sm:px-12 xl:px-5">
      <p
        class="text-xs md:mt-10 font-bold text-left text-pink-500 uppercase sm:mx-6 sm:text-center sm:text-normal sm:font-bold">
        FAQ</p>
      <h4
        class="mt-1 text-md font-bold text-left text-gray-800 sm:mx-6 sm:text-3xl md:text-md lg:text-mdl sm:text-center sm:mx-0">
        Pertanyaan yang sering muncul</h4>

      <div
        class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
        <h3 class="text-lg font-bold text-purple-500 sm:text-xl md:text-2xl">Apakah Aplikasi Pengaduan SMKN 2
          Karanganyar ini ?</h3>
        <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">Seperti yang sudah dijelaskan diatas tadi, aplikasi ini dibuat untuk menampung pengaduan & aspirasi dari semua warga SMKN2 Karanganyar.</p>
      </div>
      <div
        class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
        <h3 class="text-lg font-bold text-purple-500 sm:text-xl md:text-2xl">Apakah bentuk respon yang diberikan
          kepada
          pelapor atas pengaduan yang disampaikan?</h3>
        <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">Respon akan diberikan dalam bentuk tanggapan dan konfirmasi dari petugas apakan laporan akan diterima atau ditolak.</p>
      </div>
      <div
      class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
      <h3 class="text-lg font-bold text-purple-500 sm:text-xl md:text-2xl">Apakah saya bisa mengubah laporan yang sudah saya kirimkan ?</h3>
      <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">Tentu. Laporan dapat kamu ubah jika belum direspon atau masih dalam status "pending".</p>
    </div>
      <div
        class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
        <h3 class="text-lg font-bold text-purple-500 sm:text-xl md:text-2xl">Berapa lama respon atas pengaduan yang
          disampaikan diberikan kepada pelapor?
        </h3>
        <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">Kecepatan respon tergantung pada banyaknya orang yang mengirim laporan. Tapi, jangan khawatir jika sudah direspon maka pemberitahuan akan kami kirimkan ke email kamu.</p>
      </div>
      <div
        class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
        <h3 class="text-lg font-bold text-purple-500 sm:text-xl md:text-2xl">Apakah pengaduan yang saya berikan akan
          selalu mendapatkan respon?</h3>
        <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">Tentu saja. Pasti akan selalu mendapatkan respon.</p>
      </div>
      <div
        class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
        <h3 class="text-lg font-bold text-purple-500 sm:text-xl md:text-2xl">Bagaimana jika saya belum paham tentang sistem ini dan ingin bertanya lebih lanjut ?</h3>
        <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">Kamu bisa kirim pertanyaan ke email kami : rpla.smkn2kra@gmail.com</p>
      </div>
    </div>
  </section>
  <!-- end FAQ --> 
@endsection