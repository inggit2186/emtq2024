@extends('backend.layout.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Cabang</h3>
                <p class="text-subtitle text-muted">For user to check cabang MTQ</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Cabang</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('create.cabang') }}" class="btn btn-primary">Tambah</a>
                @if (session('status'))
                    <div class="alert alert-success mt-1">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Penanya</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cmtq as $item)
                        <tr>
                            <td>{{ $item->kategori }}</td>
                            <td>@if($item->penanya == 0) No @else Yes @endif</td>
                            <td class="d-flex">
								<a href="{{ route('data.golongan', Crypt::Encrypt($item->id)) }}" class="btn btn-sm btn-success"><i class="fas fa-list"></i></a>
                                &nbsp;<a href="{{ route('edit.cabang', Crypt::Encrypt($item->id)) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                &nbsp;<form action="{{ route('destroy.cabang', Crypt::Encrypt($item->id)) }}" onclick="return confirm('Anda Yakin Untuk Menghapus?')" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@endsection