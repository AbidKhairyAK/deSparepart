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
		.text-white {
			color: white;
		}
	</style>
</head>
<body>

	@php
		$page_count = ceil($model->count() / 13);
	@endphp

	@for($p=0; $p<$page_count; $p++)

	@if($p>0) <div class="page-break"></div> @endif

	<div class="container">
		<p class="page">Hal: {{ $p+1 }}/{{ $page_count }}</p>

		<h2><span class="c">TANDA TERIMA</span></h2>

		<table class="head">
			<tr>
				<td class="left-head">
					<p><span><b>PERUSAHAAN ANDA</b><br>Jl. Alamat Anda, Kota Anda</span></p>
					<p><span>Kepada Yth.<br>{{ $customer->nama }}</span></p>
				</td>
				<td class="right-head">
					<p>
						<table>
							<tr>
								<td><span>TANGGAL</td>
								<td><span>:</span></td>
								<td><span>{{ date('Y-m-d') }}</span></td>
							</tr>
							<tr>
								<td><span>NOTA</td>
								<td><span>:</span></td>
								<td><span>{{ $model->count() }}</span></td>
							</tr>
							<tr class="text-white"><td>.</td></tr>
							<tr class="text-white"><td>.</td></tr>
						</table>
					</p>
				</td>
			</tr>
		</table>

		<table class="list-barang">
			<thead>
				<tr>
					<td width="5"><span class="c">NO</span></td>
					<td><span class="c">TANGGAL</span></td>
					<td><span class="c">NO FAKTUR</span></td>
					<td width="150"><span class="c">JUMLAH</span></td>
				</tr>
			</thead>
			<tbody>
				@php $no = isset($no) ? $no : 1; @endphp
				@foreach($model->offset($p * 13)->limit(13)->get() as $detail)
				<tr>
					<td><span>{{ $no++ }}</span></td>
					<td><span>{{ $detail->created_at }}</span></td>
					<td><span>{{ $detail->no_faktur }}</span></td>
					<td><span class="r">{{ rupiah($detail->total) }}</span></td>
				</tr>
				@endforeach

				@if(($p+1) == $page_count)
					@php $placeholder = 13 - (($no-1)%13); @endphp
					@for($i=0; $i<$placeholder; $i++)
						<tr>
							<td>.</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					@endfor
				@endif

			</tbody>

			@if(($p+1) == $page_count)
			<tfoot>
				<tr>
					<td colspan="3"><span class="c">TOTAL</span></td>
					<td><span class="r">{{ rupiah($model->sum('total')) }}</span></td>
				</tr>
			</tfoot>
			@endif

		</table>

		@if(($p+1) == $page_count)

		<p class="terbilang"><span>TERBILANG: {{ strtoupper(terbilang($model->sum('total'))) }}</span></p>

		<table class="footer">
			<tr>
				<td width="530"><span>DITERIMA OLEH:</span></td>
				<td><span>HORMAT KAMI,</span></td>
			</tr>
			<tr>
				<td><span>(............)</span></td>
				<td><span>(............)</span></td>
			</tr>
		</table>
		@else
		<p><span>(BERSAMBUNG)</span></p>
		@endif

	</div>
	@endfor

</body>
</html>