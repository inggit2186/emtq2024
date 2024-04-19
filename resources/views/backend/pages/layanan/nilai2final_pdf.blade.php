<!DOCTYPE html>
<style>
.page-break {
    page-break-after: always;
}
.xheader {
    font-size:22px;
    font-family: 'Monaco', monospace;
    text-align:center;
}
</style>

<html>
<head>
	<title>Rekap Hasil MTQ Nasional Ke-41 Cabang Kab.Tanah Datar</title>
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
		<p class="xheader"><strong>Lampiran Keputusan Koordinator Dewan Hakim</strong><br /><span style="font-size:15px;">No:<i>&nbsp;&nbsp;&nbsp;/KPTS/DH/MTQ/XLI/2022</i> Tanggal <i>24 Juni 2022</i> <br />Tentang Penetapan Juara I,II,III dan Harapan I,II,III <br/> MTQ Nasional <i>Ke-XLI</i> Tingkat Kabupaten Tanah Datar <br />Tahun 2022</span></p>
	</center>
	@php $nox=1; @endphp
	@foreach($gmtq as $gmtq)
	<p><strong><i>{{$nox}}.{{$gmtq->golongan}}</i></strong></p>
	<table class='table table-bordered'>
		<thead>
			<tr style="border-bottom:2pt solid black">
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
			    if($gmtq->id == 18){
			    $pesertap = App\Models\Peserta::with(['cmtq','gmtq'])->where(['golongan_id' => $gmtq->id,'jk' => "Putra"])->orderBy('total', 'DESC')->orderBy('id', 'ASC')->take(3)->get();
			    }else{
				$pesertap = App\Models\PesertaFinal::with(['cmtq','gmtq'])->where(['golongan_id' => $gmtq->id,'jk' => "Putra"])->orderBy('total', 'DESC')->orderBy('id', 'ASC')->take(3)->get();
				};
				$harapanp = App\Models\Peserta::with(['cmtq','gmtq'])->where(['golongan_id' => $gmtq->id,'jk' => "Putra"])->orderBy('total', 'DESC')->orderBy('id', 'ASC')->skip(3)->take(3)->get();
				$i=1;
			@endphp
			@php 
			    if($gmtq->id == 18){
			    $pesertaw = App\Models\Peserta::with(['cmtq','gmtq'])->where(['golongan_id' => $gmtq->id,'jk' => "Putri"])->orderBy('total', 'DESC')->orderBy('id', 'ASC')->take(3)->get();
			    }else{
				$pesertaw = App\Models\PesertaFinal::with(['cmtq','gmtq'])->where(['golongan_id' => $gmtq->id,'jk' => "Putri"])->orderBy('total', 'DESC')->orderBy('id', 'ASC')->take(3)->get();
				};
				$harapanw = App\Models\Peserta::with(['cmtq','gmtq'])->where(['golongan_id' => $gmtq->id,'jk' => "Putri"])->orderBy('total', 'DESC')->orderBy('id', 'ASC')->skip(3)->take(3)->get();
				$w=1;
			@endphp
			@foreach($pesertap as $pesertap)
			<tr style="border-bottom: 1pt solid black;">
				<td>Juara {{$i}}</td>
				<td>{{$pesertap->nomor}}</td>
				<td>{{$pesertap->jk}}</td>
				<td>{{$pesertap->nama}}</td>
				<td>{{$pesertap->utusan}}</td>
				<td>{{$pesertap->total}} (f)</td>
			@php $i++; @endphp
			</tr>
			@endforeach
			@php $i=1; @endphp
		    @foreach($harapanp as $harapanp)
			<tr style="background-color:#7AFFFF; @if($i==3)border-bottom: 2pt solid black; @else border-bottom: 1pt solid black; @endif" >
				<td>Harapan {{$i}}</td>
				<td>{{$harapanp->nomor}}</td>
				<td>{{$harapanp->jk}}</td>
				<td>{{$harapanp->nama}}</td>
				<td>{{$harapanp->utusan}}</td>
				<td>{{$harapanp->total}}</td>
			@php $i++; @endphp
			</tr>
			@endforeach
			
			@foreach($pesertaw as $pesertaw)
			<tr style="background-color:#2DFFFF;border-bottom:1pt solid black">
				<td>Juara {{$w}}</td>
				<td>{{$pesertaw->nomor}}</td>
				<td>{{$pesertaw->jk}}</td>
				<td>{{$pesertaw->nama}}</td>
				<td>{{$pesertaw->utusan}}</td>
				<td>{{$pesertaw->total}} (f)</td>
			@php $w++; @endphp
			</tr>
			@endforeach
			@php $w=1; @endphp
		    @foreach($harapanw as $harapanw)
			<tr style="background-color:#00E5E5; @if ($w==3)border-bottom: 2pt solid black; @else border-bottom: 1pt solid black; @endif">
				<td>Harapan {{$w}}</td>
				<td>{{$harapanw->nomor}}</td>
				<td>{{$harapanw->jk}}</td>
				<td>{{$harapanw->nama}}</td>
				<td>{{$harapanw->utusan}}</td>
				<td>{{$harapanw->total}}</td>
			@php $w++; @endphp
			</tr>
			@endforeach
		</tbody>
	</table>
	<br />
	@php $nox++; @endphp
	@endforeach
</body>
<br /><br />
<footer>
    <div>
         <img src="{{asset('assets/etc/ttd.png')}}" style="align:center;"/>
    </div>
</footer>
</html>