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
                <form class="form form-horizontal" action="{{ route('store.golongan') }}" method="post">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Kategori</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror" value="{{$cmtq->kategori}}" readonly>
                                <input type="hidden" class="form-control @error('kategori') is-invalid @enderror" value="{{$cmtq->id}}" name="kategori" readonly>
                                @error('kategori')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>Nama Golongan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="Nama Golongan">
                                @error('name')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>Jumlah Max Peserta Putra</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" class="form-control @error('jmlp') is-invalid @enderror" value="{{ old('jmlp')}}" name="jmlp" placeholder="Jumlah Putera">
                                @error('jmlp')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>Jumlah Max Peserta Putri</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" class="form-control @error('jmlw') is-invalid @enderror" value="{{ old('jmlw')}}" name="jmlw" placeholder="Jumlah Puteri">
                                @error('jmlw')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>Kode Cabang</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode')}}" name="kode" placeholder="Kode">
                                @error('kode')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>No Loot(MIN)</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" class="form-control @error('min') is-invalid @enderror" value="{{ old('min')}}" name="min" placeholder="No Loot (MIN)">
                                @error('min')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>No Loot (MAX)</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" class="form-control @error('max') is-invalid @enderror" value="{{ old('max')}}" name="max" placeholder="No Loot (MAX)">
                                @error('max')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>Operator</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-control @error('operator') is-invalid @enderror" value="{{ old('operator') }}" name="operator" >
								<option value="0" selected
                                    class="block w-full px-4 py-3 border-2 border-transparent text-gray-500 rounded-lg focus:border-blue-500 focus:outline-none">
                                    --Silahkan Pilih Operator--</option>
								@foreach($user as $user)
								<option value="{{$user->id}}"
                                    class="block w-full px-4 py-3 border-2 border-transparent text-gray-800 rounded-lg focus:border-blue-500 focus:outline-none">
                                    {{$user->name}}</option>
								@endforeach
								</select>
								
                                @error('operator')
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