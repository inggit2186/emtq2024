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
                        <li class="breadcrumb-item active" aria-current="page">Tambah Cabang</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form class="form form-horizontal" action="{{ route('store.cabang') }}" method="post">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama Kategori</label>
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
                                <label>Hakim Penanya</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-control @error('penanya') is-invalid @enderror" value="{{ old('penanya') }}" name="penanya" required>
								<option value="0" selected
                                    class="block w-full px-4 py-3 border-2 border-transparent text-gray-800 rounded-lg focus:border-blue-500 focus:outline-none">
                                    Tidak Ada</option>
								<option value="1"
                                    class="block w-full px-4 py-3 border-2 border-transparent text-gray-800 rounded-lg focus:border-blue-500 focus:outline-none">
                                    Ada</option>
								</select>
                                @error('penanya')
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