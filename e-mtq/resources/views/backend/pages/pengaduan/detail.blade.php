@extends('backend.layout.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Request</h3>
                <p class="text-subtitle text-muted">Detail Request</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pengaduan') }}">Pengaduan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pengaduan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4>Informasi User</h4>
                    <table>
                        <tr>
                            <td width="180px">Nomor Induk</td>
                            <td>:</td>
                            <td>{{ $laporan->user->nomor_induk }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $laporan->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $laporan->user->email }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Telepon</td>
                            <td>:</td>
                            <td>{{ $laporan->user->no_telp }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $laporan->user->alamat }}</td>
                        </tr>
                    </table>
                </div>
                <div class="mt-4">
                    <h4>Laporan</h4>
                    <table>
                        <tr>
                            <td width="180px">No.Registrasi</td>
                            <td>:</td>
                            <td>{{ $laporan->no_req }}</td>
                        </tr>
                        <tr>
                            <td>Departemen</td>
                            <td>:</td>
                            <td>{{ $laporan->dept->nama }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Masuk</td>
                            <td>:</td>
                            <td>{{ $laporan->created_at->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td>Layanan / Judul</td>
                            <td>:</td>
                            @if(!empty($laporan->judul))
								<td>{{ $laporan->judul }}</td>
							@else
								<td>{{ $laporan->layanan->nama }}</td>
							@endif
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>:</td>
                            <td>{{ $laporan->deskripsi }}</td>
                        </tr>
                        <tr>
                            <td>Berkas Pendukung</td>
                            <td>:</td>
                            <td>
                                @if ($laporan->berkas_pendukung)
                                    {{ $laporan->berkas_pendukung }}
                                    <a href="{{ asset($laporan->berkas_pendukung) }}" download="{{$laporan->berkas_pendukung}}" class="btn btn-primary"><i class="fas fa-download"></i></a>
                                @else
                                Tidak ada berkas
                                @endif
                            </td>
                        </tr>
                    </table>
					<br />
					<p style="font-size:14px"><i> Status : @if ($laporan->status === 'PENDING')
                                    {{ $laporan->status }}
                                @elseif($laporan->status === 'DITOLAK')
                                    {{ $laporan->status }} oleh auth()->user()->role
                                @elseif($laporan->status === 'SUKSES')
                                    {{ $laporan->status }} 
                                @elseif($laporan->status === 'BATAL')
                                    {{ $laporan->status }} 
								@elseif($laporan->status === 'DITERIMA')
									@if($laporan->staff->role == 'kasi') 
										{{ $laporan->status }} oleh {{ $laporan->staff->pekerjaan }}
									@else
										{{ $laporan->status }} oleh {{ $laporan->staff->pekerjaan }}
									@endif
								@elseif($laporan->status === 'DIPROSES')
									DIPROSES oleh Staff {{$laporan->dept->nama}}
								@endif </i><br />
					<i> Last Update {{ $laporan->updated_at->format('d/m/Y-H:i:s') }} </i></p>
					
                </div>
				<br />
            <!--    <div class="mt-4">
                    <h4>Status</h4>
                    @if ($laporan->status === 'sukses')
                        <button class="btn btn-outline-success">Laporan Diterima</button>
                        <div class="mt-4">
                            Tanggapan : 
                            <p>{{ $laporan->tanggapan->tanggapan }}</p>{{ $laporan->tanggapan->user->name }}
                        </div>
                    @elseif($laporan->status === 'ditolak')
                        <button class="btn btn-outline-danger">Laporan Ditolak</button>
                        <div class="mt-4">
                            Tanggapan : 
                            <p>{{ $laporan->tanggapan->tanggapan }}</p>{{ $laporan->tanggapan->user->name }}
                        </div>
                    @else
                        <a href="{{ route('tanggapan',  Crypt::Encrypt($laporan->id)) }}" class="btn btn-primary">Tanggapi</a>
                    @endif
                </div>
			-->
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-12 col-md-6 order-md-1 order-last">
						<h3>Update Status</h3>
						<p class="text-subtitle text-muted">Form Tanggapan Staff</p>
					</div>
				</div>
			<section class="section">
				<div class="card">
					<div class="card-body">
					@if(Auth::user()->role == 'admin')
						<form action="{{ route('store.tanggapan', $laporan->id) }}" method="post">
							@csrf
							<div class="form-group mb-3">
								<label for="tanggapan" class="form-label">Tanggapan</label>
								<textarea class="form-control @error('tanggapan') is-invalid @enderror" name="tanggapan" id="tanggapan" rows="3"></textarea>
								@error('tanggapan')
									<div class="invalid-feedback">
										<i class="bx bx-radio-circle"></i>
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="DITERIMA">
								<label class="form-check-label text-success" for="inlineRadio1">Diterima</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="DIPROSES">
								<label class="form-check-label text-success" for="inlineRadio1">Diproses</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="SUKSES">
								<label class="form-check-label text-success" for="inlineRadio1">Selesei / Sukses</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="DITOLAK">
								<label class="form-check-label text-success" for="inlineRadio1">Ditolak</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="BATAL">
								<label class="form-check-label text-danger" for="inlineRadio2">Batal</label>
							</div>
							@error('status')
								<div class="text-danger">
									<i class="bx bx-radio-circle"></i>
									<span>{{ $message }}</span>
								</div>
							@enderror
							<div class="col-sm-12 d-flex justify-content-end">
								<button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
							</div>
						</form>
					@endif
					</div>
				</div>

			</section>
		</div>
		</div>
    </section>
</div>

@endsection