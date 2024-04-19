@extends('backend.layout.app')
@section('content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<style>
#syaratUser tr {
	text-align: center;
}
#syaratUser td {
	text-align: center;
}
#syaratUser th{
	text-align: center;
	height: 40px;
	font-size: 20px;
}
}
</style>


<html>
<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Aktivitas User</h6>
                                    <h6 class="font-extrabold mb-0">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Data User</h6>
                                    <h6 class="font-extrabold mb-0">183.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Data Petugas</h6>
                                    <h6 class="font-extrabold mb-0">80.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Data Permintaan</h6>
                                    <h6 class="font-extrabold mb-0">112</h6>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <th>Nama Peserta</th>
                            <th>Golongan</th>
                            <th>Operator</th>
                            <th>Total Nilai</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peserta as $item)						
                        <tr>
							<td>{{$item->nama}}</td>
							<td>{{$item->gmtq->golongan}}</td>
							<td>{{$item->operator}}</td>
							<td>{{$item->total}}</td>
							<td>{{$item->created_at}}</td>
						</tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Admin & Staff</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="backend/images/faces/5.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Staff 1</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Congratulations on your graduation!</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="backend/images/faces/2.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Staff 2</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Wow amazing design! Can you make another
                                                    tutorial for
                                                    this design?</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="backend/images/faces/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                            <h6 class="text-muted mb-0">@ {{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Recent Messages</h4>
                </div>
                <div class="card-content pb-4">
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="backend/images/faces/4.jpg">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Staff 1</h5>
                            <h6 class="text-muted mb-0">@kemenagStaff1</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="backend/images/faces/5.jpg">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Staff 2</h5>
                            <h6 class="text-muted mb-0">@kemenagStaff2</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="backend/images/faces/1.jpg">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Staff 3</h5>
                            <h6 class="text-muted mb-0">@kemenagStaff3</h6>
                        </div>
                    </div>
                    <div class="px-4">
                        <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Start
                            Conversation</button>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</div>

</html>

<script>

@endsection