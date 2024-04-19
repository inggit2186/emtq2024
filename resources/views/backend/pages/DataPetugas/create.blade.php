@extends('backend.layout.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Petugas</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Petugas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form class="form form-horizontal" action="{{ route('store.petugas') }}" method="post">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="Name">
                                @error('name')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>No Induk</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control @error('nomor_induk') is-invalid @enderror" value="{{ old('nomor_induk') }}" name="nomor_induk" placeholder="Nomor Induk">
                                @error('nomor_induk')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>E-Mail</label>
                            </div>
							<div class="col-md-8 form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="E-mail">
                                @error('email')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Jabatan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}" name="pekerjaan" placeholder="Jabatan">
                                @error('pekerjaan')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>Nomor Kontak</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp') }}" name="telp" placeholder="Nomor Kontak">
                                @error('telp')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Role</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control" name="role" value="admin" placeholder="Staff" readonly>
                            </div>
                            <!-- <div class="col-md-4">
                                <label>Password</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                                @error('password')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> -->
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