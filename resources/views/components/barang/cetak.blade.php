<!DOCTYPE html>
<html>
<head>
	<title>print stok barang</title>
	<link href="https://fonts.googleapis.com/css?family=Inconsolata&display=swap" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
		body {
			font-size: 20px;
			font-family: 'Inconsolata', monospace;
		}
		.list-barang {
			font-size: 20px;
			width: 100%;
			border: 1px dashed black;
		}
		.list-barang thead tr td {
			border-bottom: 1px dashed black;
			text-align: center;
		}
		.list-barang tfoot tr td {
			border-top: 1px dashed black;
		}
		.list-barang tfoot tr td:first-child div {
			position: absolute;
			z-index: 1;
			background: white;
			height: 40px;width: 103%;
			transform: translate(-20px);
			padding: 10px 0 0 10px;
		}
		.list-barang tr td {
			border-left: 1px dashed black;
			padding: 0px 10px 0;
		}
		.list-barang tr:last-child td {
			padding-bottom: 2px;
		}
		.list-barang tr td:first-child {
			border-left: 0;
		}
		.list-barang tr td:nth-child(4),
		.list-barang tfoot tr td:last-child {
			text-align: right;
		}
		h2 {
			text-align: center;
			position: absolute;
			left: 0; right: 0;
		}
		.head {
			width: 100%;
			position: relative;
			top: -15px;
		}
		.left-head p {
			line-height: 25px;
			position: relative;
			/*top: -20px;*/
		}
		.right-head td {
			line-height: 20px;
		}
		td.right-head:last-child {
			width: 25%;
		}
		.footer {
			width: 100%;
			margin-top: 30px;
		}
		.footer tr:first-child td {
			padding-bottom: 120px;
		}
		.page {
			display: block;
			position: absolute;
			top: -25px; right: 0;
			font-size: 15px;
		}
		.page-break {
		    page-break-after: always;
		}
		span {
			display: block;
			transform: scaleX(0.85);
			transform-origin: left;
		}
		span.r {
			transform-origin: right;
		}
		span.c {
			transform-origin: 50% 50%;
		}
	</style>
</head>
<body>

	@php
		$page_count = ceil($test->count() / 20);
	@endphp

	@for($p=0; $p<$page_count; $p++)

	@if($p>0) <div class="page-break"></div> @endif

	<div class="container">
		<p class="page">Hal: {{ $p+1 }}/{{ $page_count }}</p>

		<h2><span class="c">DAFTAR STOK BARANG</span></h2>

		<table class="head">
			<tr>
				<td class="left-head">
					<p><span><b>PERUSAHAAN ANDA</b><br>Jl. Alamat Anda, Kota Anda</span></p>
				</td>
				<td class="right-head">
					<p>
						<table>
							<tr>
								<td><span>TANGGAL</td>
								<td><span>:</span></td>
								<td><span>{{ date('Y-m-d', strtotime($tanggal)) }}</span></td>
							</tr>
						</table>
					</p>
				</td>
			</tr>
		</table>

		<table class="list-barang">
			<thead>
				<tr>
					<td width="5"><span class="c">NO</span></td>
					<td width="100"><span class="c">PART NO</span></td>
					<td><span class="c">NAMA BARANG</span></td>
					<td width="50"><span class="c">QTY</span></td>
					<td width="70"><span class="c">SATUAN</span></td>
				</tr>
			</thead>
			<tbody>
				@php $no = isset($no) ? $no : 1; @endphp
				@foreach($test->offset($p * 20)->limit(20)->get() as $detail)
				<tr>
					<td><span>{{ $no++ }}</span></td>
					<td><span>{{ $detail->part_no }}</span></td>
					<td><span>{{ $detail->nama }}</span></td>
					<td>
						<span class="r">
							{{ 
								$detail->inventaris()
									->where('tanggal', '<', $tanggal.' 23:59:59')
									->latest('tanggal')
									->first()
									->inventaris_detail()
									->sum('inv_stok')
							}}
						</span>
					</td>
					<td><span>{{ $detail->satuan->nama }}</span></td>
				</tr>
				@endforeach

				@if(($p+1) == $page_count)
					@php $placeholder = 20 - (($no-1)%20); @endphp
					@for($i=0; $i<$placeholder; $i++)
						<tr>
							<td>.</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					@endfor
				@endif

			</tbody>
		</table>

		@if(($p+1) != $page_count)
		<p><span>(BERSAMBUNG)</span></p>
		@endif

		<br>
		<p style="font-size: 15px;"><span><i>Catatan: stok yang ditamplikan merupakan sisa stok akhir pada tanggal yang tertera</i></span></p>

	</div>
	@endfor

</body>
</html>