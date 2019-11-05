<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
	<link href="https://fonts.googleapis.com/css?family=Inconsolata&display=swap" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
		body {
			font-size: 21px;
			font-family: 'Inconsolata', monospace;
		}
		.list-barang {
			font-size: 19px;
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
		.list-barang tr td:nth-child(5),
		.list-barang tr td:nth-child(6),
		.list-barang tr td:nth-child(7),
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
			top: -20px;
		}
		.right-head td {
			line-height: 20px;
		}
		td.right-head:last-child {
			width: 30%;
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
			font-size: 16px;
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
		$page_count = ceil($model->penjualan_detail()->count() / 10);
	@endphp

	@for($p=0; $p<$page_count; $p++)

	@if($p>0) <div class="page-break"></div> @endif

	<div class="container">
		<p class="page">Hal: {{ $p+1 }}/{{ $page_count }}</p>

		<h2><span class="c">FAKTUR PENJUALAN</span></h2>

		<table class="head">
			<tr>
				<td class="left-head">
					<p><span><b>PERUSAHAAN ANDA</b><br>Jl. Alamat Anda, Kota Anda</span></p>
					<p><span>Kepada Yth.<br>{{ $model->customer->nama }}</span></p>
				</td>
				<td class="right-head">
					<p>
						<table>
							<tr>
								<td><span>NO FAKTUR</td>
								<td><span>:</span></td>
								<td><span>{{ $model->no_faktur }}</span></td>
							</tr>
							<tr>
								<td><span>TANGGAL</td>
								<td><span>:</span></td>
								<td><span>{{ date('Y-m-d', strtotime($model->created_at)) }}</span></td>
							</tr>
							<tr><td></td><td></td><td></td></tr>
							<tr><td></td><td></td><td></td></tr>
							<tr>
								<td><span>NO PO</span></td>
								<td><span>:</span></td>
								<td><span>{{ $model->no_po }}</span></td>
							</tr>
							<tr>
								<td><span>TGL PO</span></td>
								<td><span>:</span></td>
								<td></td>
							</tr>
							<tr>
								<td><span>JT TEMPO</span></td>
								<td><span>:</span></td>
								<td><span>{{ $model->jatuh_tempo }}</span></td>
							</tr>
							<tr>
								<td><span>NO MOBIL</span></td>
								<td><span>:</span></td>
								<td></td>
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
					<td width="80"><span class="c">PART NO</span></td>
					<td width="220"><span class="c">NAMA BARANG</span></td>
					<td><span class="c">QTY</span></td>
					<td><span class="c">HARGA</span></td>
					<td width="50"><span class="c">DISKON</span></td>
					<td><span class="c">JUMLAH</span></td>
				</tr>
			</thead>
			<tbody>
				@php $no = isset($no) ? $no : 1; @endphp
				@foreach($model->penjualan_detail()->offset($p * 10)->limit(10)->get() as $detail)
				<tr>
					<td><span>{{ $no++ }}</span></td>
					<td><span>{{ $detail->part_no }}</span></td>
					<td><span>{{ $detail->nama }}</span></td>
					<td><span class="r">{{ $detail->qty }} {{ $detail->satuan }}</span></td>
					<td><span class="r">{{ number_format($detail->harga, 0, '', '.')}}</span></td>
					<td><span class="r">{{ $detail->diskon }}%</span></td>
					<td><span class="r">{{ number_format($detail->subtotal, 0, '', '.')}}</span></td>
				</tr>
				@endforeach
				
				@if(($p+1) == $page_count)
					@php $placeholder = 10 - (($no-1)%10); @endphp
					@for($i=0; $i<$placeholder; $i++)
						<tr>
							<td>.</td>
							<td></td>
							<td></td>
							<td></td>
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
					<td colspan="5">
						<div class="terbilang"><span>TERBILANG: FITUR "TERBILANG" BELUM BEKERJA DENGAN OPTIMAL</span></div>
					</td>
					<td style="text-align: center;"><span class="c">TOTAL</span></td>
					<td><span class="r">{{ number_format($model->total, 0, '', '.')}}</span></td>
				</tr>
			</tfoot>
			@endif
		</table>

		@if(($p+1) == $page_count)
		<table class="footer">
			<tr>
				<td><span>DITERIMA OLEH:</span></td>
				<td><span>DIPERIKSA OLEH:</span></td>
				<td><span>DIBUAT OLEH:</span></td>
				<td><span>HORMAT KAMI,</span></td>
			</tr>
			<tr>
				<td><span>(............)</span></td>
				<td><span>(............)</span></td>
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