<!DOCTYPE html>
<style>
.page-break {
    page-break-after: always;
}
</style>

<html>
<head>
	<title>Laporan Hasil Rekap Penilaian MTQ ke-41 Kab.Tanah Datar</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
	table {
          border-collapse: collapse;
        }
		table tr td,
		table tr th{
			font-size: 9pt;
			text-align:center;
			vertical-align: center;
		}
	</style>
	<center>
		<h4>Laporan Hasil Rekap Penilaian MTQ ke-41 Kab.Tanah Datar</h4>
	</center>
	<br />
	<br />
	@php $nox=1; @endphp
	@foreach($gmtq as $gmtq)
	<p><strong><i>{{$nox}}.{{$gmtq->golongan}}</i></strong></p>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>NoLoot</th>
				<th>JK</th>
				<th>Peserta</th>
				<th>Utusan</th>
				<th>Nilai</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$peserta = App\Models\Peserta::with(['cmtq','gmtq'])->where('golongan_id',$gmtq->id)->orderBy('total', 'DESC')->orderBy('id', 'ASC')->get();
				$i=1;
			@endphp
			@php 
				$peserta2 = App\Models\Peserta::with(['cmtq','gmtq'])->where('golongan_id',$gmtq->id)->orderBy('total', 'DESC')->orderBy('id', 'ASC')->get();
				$w=1;
			@endphp
			@foreach($peserta as $peserta)
			@if($peserta->jk == "Putra")
			@if($i < 4)
			<tr>
				<td>{{$i}}</td>
				<td>{{$peserta->nomor}}</td>
				<td>{{$peserta->jk}}</td>
				<td>{{$peserta->nama}}</td>
				<td>{{$peserta->utusan}}</td>
				<td>{{$peserta->total}}</td>
			@php $i++; @endphp
			</tr>
			@endif
			@endif
			@endforeach
			
			@foreach($peserta2 as $peserta2)
			@if($peserta2->jk == "Putri")
			@if($w < 4)
			<tr style="background-color:#2DFFFF;">
				<td>{{$w}}</td>
				<td>{{$peserta2->nomor}}</td>
				<td>{{$peserta2->jk}}</td>
				<td>{{$peserta2->nama}}</td>
				<td>{{$peserta2->utusan}}</td>
				<td>{{$peserta2->total}}</td>
			@php $w++; @endphp
			</tr>
			@endif
			@endif
			@endforeach
		</tbody>
	</table>
	<br />
	@php $nox++; @endphp
	@endforeach
</body>
</html>