@extends('backend.layout.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Nomor Loot Peserta</h3>
                <p class="text-subtitle text-muted"><b>Restricted Access</b></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Loot</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form class="form form-horizontal" action="{{route('cek.loot')}}" method="get">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            
							<div class="col-md-4">
                                <label>Pilih Kategori</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="cmtq" class="form-control @error('cmtq') is-invalid @enderror" value="{{ old('cmtq') }}" name="cmtq" >
								<option value="Pilihdulu" disabled selected
                                    class="block w-full px-4 py-3 border-2 border-transparent text-gray-400 rounded-lg focus:border-blue-500 focus:outline-none">
                                    ---- Pilih Kategori ------</option>
								@foreach($cmtq as $cmtq)
								<option value="{{$cmtq->id}}"
                                    class="block w-full px-4 py-3 border-2 border-transparent text-gray-800 rounded-lg focus:border-blue-500 focus:outline-none">
                                    {{$cmtq->kategori}}</option>
								@endforeach
								</select>
								
                                @error('cmtq')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="col-md-4">
                                <label>Pilih Cabang</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="gmtq" class="form-control @error('cmtq') is-invalid @enderror" value="{{ old('gmtq') }}" name="gmtq" >
								
								</select>
								
                                @error('gmtq')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Cek Loot</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>

<script>
jQuery(document).ready(function(){
  $("#cmtq").change(function() {
	 var cmtq = $(this).val();
		
      var url = "{{route('cekno.cabang', '')}}" + "/" + cmtq;
	  console.log(url);
	  
	  $.ajax({
	   type:'GET',
	   url:url,
	   data:{"_token": "{{ csrf_token() }}"},
	   dataType: "json",
	   success:function(data){ 
                $('#gmtq').empty();
                $("#gmtq").append('<option>--Pilih Cabang--</option>');
                if(data)
                {
                    $.each(data,function(key,value){
                        $('#gmtq').append($("<option/>", {
                           value: value.id,
                           text: value.golongan
                        }));
                    });
                }
	   }});
	   
  });
    
});
</script>
@endsection