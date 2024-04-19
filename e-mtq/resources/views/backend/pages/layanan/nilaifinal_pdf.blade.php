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
	@foreach($gmtq as $gmtq)
	<center>
		<h5>{{$gmtq->golongan}} (FINAL)</h5>
	</center>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th rowspan=2>No</th>
				<th rowspan=2>NoLoot</th>
				<th rowspan=2>Peserta</th>
				@if($cmtq->id == 7)
				  <th rowspan=2>Nomor Tampil</th>
				@endif
				@if($cmtq->penanya == 1)
				<th rowspan=2>Hakim Penanya</th>
				@endif
				@php $bidang = App\Models\Bidang::with('cmtq')->where('cat_id',$cmtq->id)->get(); @endphp
				@foreach($bidang as $bidang)
					<th colspan={{$bidang->hakim}}>{{$bidang->nama}}</th>
				@endforeach
				<th rowspan=2>Nilai</th>
				<th rowspan=2>Operator</th>
			</tr>
			<tr>
				@php $bidang2 = App\Models\Bidang::with('cmtq')->where('cat_id',$cmtq->id)->get(); @endphp
				@foreach($bidang2 as $bidang2)
				@for($a=1 ; $a<= $bidang->hakim ; $a++)
					<th>Hakim {{$a}}</th>
				@endfor
				@endforeach
			</tr>
		</thead>
		<tbody>
			@php 
				$peserta = App\Models\PesertaFinal::with(['cmtq','gmtq'])->where('golongan_id',$gmtq->id)->orderBy('total', 'DESC')->orderBy('id', 'ASC')->get();
				$i=1;
			@endphp
			@php 
				$peserta2 = App\Models\PesertaFinal::with(['cmtq','gmtq'])->where('golongan_id',$gmtq->id)->orderBy('total', 'DESC')->orderBy('id', 'ASC')->get();
				$w=1;
			@endphp
			@foreach($peserta as $peserta)
			@if($peserta->jk == "Putra")
			<tr>
				<td>{{$i}}</td>
				<td>{{$peserta->nomor}}</td>
				<td>{{$peserta->nama}}</td>
				@if($cmtq->id == 7)
				<td style="text-align: center;">{{$peserta->nomor}}</td>
				@endif
				@if($cmtq->penanya == 1)
					@php $penanya = App\Models\Nilai::where(['peserta' => $peserta->nama, 'status' => 2])->first(); @endphp
					@if(!empty($penanya))
					<td>{{$penanya->penanya}}</td>
					@endif
				@endif
				
				@php $bidang3 = App\Models\Bidang::with('cmtq')->where('cat_id',$cmtq->id)->get(); @endphp
				@foreach($bidang3 as $bidang3)
					@php $nilai = App\Models\Nilai::with(['cmtq','gmtq','bidang','peserta'])->where(['peserta' => $peserta->nama,'status' => 2, 'bidang_id' => $bidang3->id])->get(); @endphp
					@foreach($nilai as $nilai)
					@if($nilai->nilai != NULL)
					<td>({{$nilai->nilai}})<br />{{$nilai->hakim}}</td>
					@else
					<td><i>-</i></td>
					@endif
					@endforeach
				@endforeach
				<td>{{$peserta->total}}</td>
				<td>{{$peserta->operator}}</td>
			@php $i++; @endphp
			</tr>
			@endif
			@endforeach
			@foreach($peserta2 as $peserta2)
			@if($peserta2->jk == "Putri")
			<tr style="background-color:#00F2F2">
				<td>{{$w}}</td>
				<td>{{$peserta2->nomor}}</td>
				<td>{{$peserta2->nama}}</td>
				@if($cmtq->id == 7)
				<td style="text-align: center;">{{$peserta2->nomor}}</td>
				@endif
				@if($cmtq->penanya == 1)
					@php $penanya = App\Models\Nilai::where(['peserta' => $peserta->nama, 'status' => 2])->first(); @endphp
					@if(!empty($penanya))
					<td>{{$penanya->penanya}}</td>
					@endif
				@endif
				
				@php $bidang3 = App\Models\Bidang::with('cmtq')->where('cat_id',$cmtq->id)->get(); @endphp
				@foreach($bidang3 as $bidang3)
					@php $nilai2 = App\Models\Nilai::with(['cmtq','gmtq','bidang','peserta'])->where(['peserta' => $peserta2->nama, 'status' => 2, 'bidang_id' => $bidang3->id])->get(); @endphp
					@foreach($nilai2 as $nilai2)
					@if($nilai2->nilai != NULL)
					<td>({{$nilai2->nilai}})<br />{{$nilai2->hakim}}</td>
					@else
					<td><i>-</i></td>
					@endif
					@endforeach
				@endforeach
				<td>{{$peserta2->total}}</td>
				<td>{{$peserta2->operator}}</td>
			@php $w++; @endphp
			</tr>
			@endif
			@endforeach
		</tbody>
	</table>
	<br />
	<br />
	<div class="page-break"></div>
	@endforeach

</body>
</html>