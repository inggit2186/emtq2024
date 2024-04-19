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
                @if (session('status'))
                    <div class="alert alert-success mt-1">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Aktivitas</th>
                            <th>Target</th>
                            <th>Lokasi</th>
                            <th>IP</th>
                            <th>UserAgent</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activity as $item)
                        <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->aktifitas }}</td>
                            <td>{{ $item->target }}</td>
                            <td>{{ $item->location }}</td>
                            <td>{{ $item->ip }}</td>
                            <td>{{ $item->useragent }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@endsection