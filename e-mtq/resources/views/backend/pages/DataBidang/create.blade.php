@extends('backend.layout.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Golongan</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Golongan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form class="form form-horizontal" action="{{ route('store.bidang') }}" method="post">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Golongan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control @error('golongan') is-invalid @enderror" value="{{$gmtq->golongan}}" readonly>
                                <input type="hidden" class="form-control @error('golongan') is-invalid @enderror" value="{{$gmtq->id}}" name="golongan" readonly>
                                @error('golongan')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>Nama Bidang Penilaian</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control @error('bidang') is-invalid @enderror" value="{{ old('bidang') }}" name="bidang" placeholder="Nama Bidang">
                                @error('bidang')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>Maksimal Nilai</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" class="form-control @error('nilai') is-invalid @enderror" value="{{ old('nilai') }}" name="nilai" placeholder="Max Nilai">
                                @error('nilai')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Jumlah Hakim</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" class="form-control @error('hakim') is-invalid @enderror" value="{{ old('hakim') }}" name="hakim" placeholder="Jumlah Hakim">
                                @error('hakim')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>

@endsection