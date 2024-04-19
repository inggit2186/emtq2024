@extends('backend.layout.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Golongan</h3>
                <p class="text-subtitle text-muted"><b>Restricted Access</b></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data No Loot</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
	<div class="card">
            <div class="card-body">
			<h5>Cabang : {{$gmtq->golongan}} (kode : {{$gmtq->kode}})</h5>
			<h5>Jumlah Peserta Putra {{$jmlp}} dari {{$gmtq->jml_p}}</h5>
			<h5>Jumlah Peserta Putri {{$jmlw}} dari {{$gmtq->jml_w}}</h5>
			<h5>Operator : {{$gmtq->user->name}}</h5>
			</div>
	</div>
        <div class="card">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success mt-1">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Peserta</th>
                            <th>Jenis Kelamin</th>
                            <th>No Loot</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peserta as $item)
						@php $loot = str_pad($item->noloot, 3, '0', STR_PAD_LEFT); @endphp
                        <tr>
                            <td>{{ $item->peserta }}</td>
                            <td>{{ $item->jk }}</td>
                            <td>{{ $gmtq->kode }}{{$loot}}</td>
                            <td class="d-flex">
								 <form action="{{ route('destroy.loot', Crypt::Encrypt($item->id)) }}" onclick="return confirm('Anda Yakin Untuk Menghapus?')" method="post">
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