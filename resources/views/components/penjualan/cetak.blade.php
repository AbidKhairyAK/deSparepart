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
			font-size: 20px;
			font-family: 'Inconsolata', monospace;
		}
		.list-barang {
			font-size: 16px;
			width: 100%;
			border: 1px dashed black;
		}
		.list-barang thead tr td {
			border-bottom: 1px dashed black;
		}
		.list-barang tfoot tr td {
			border-top: 1px dashed black;
		}
		.list-barang tfoot tr td:first-child div {
			position: absolute;
			z-index: 1;
			background: white;
			height: 40px;width: 105%;
			transform: translate(-20px);
		}
		.list-barang tr td {
			border-left: 1px dashed black;
			padding: 2px 10px 0;
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
		}
		td.right-head:last-child {
			width: 30%;
		}
		.footer {
			width: 100%;
			margin-top: 20px;
		}
		.footer tr:first-child td {
			padding-bottom: 50px;
		}
		.page {
			display: block;
			position: absolute;
			top: -10px; right: 0;
			font-size: 16px;
		}
		.page-break {
		    page-break-after: always;
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

		<h2>FAKTUR PENJUALAN</h2>

		<table class="head">
			<tr>
				<td>
					<p><b>PERUSAHAAN ANDA</b><br>Jl. Alamat Anda, Kota Anda</p>
					<p>Kepada Yth.<br>{{ $model->customer->nama }}</p>
				</td>
				<td class="right-head">
					<p>
						<table>
							<tr>
								<td>NO FAKTUR</td><td>:</td><td>{{ $model->no_faktur }}</td>
							</tr>
							<tr>
								<td>TANGGAL</td><td>:</td><td>{{ date('Y-m-d', strtotime($model->created_at)) }}</td>
							</tr>

							<tr>
								<td>NO PO</td><td>:</td><td>{{ $model->no_po }}</td>
							</tr>
							<tr>
								<td>TGL PO</td><td>:</td><td></td>
							</tr>
							<tr>
								<td>JT TEMPO</td><td>:</td><td>{{ $model->jatuh_tempo }}</td>
							</tr>
							<tr>
								<td>NO MOBIL</td><td>:</td><td></td>
							</tr>
						</table>
					</p>
				</td>
			</tr>
		</table>

		<table class="list-barang">
			<thead>
				<tr>
					<td width="10"><b>#</b></td>
					<td width="70"><b>PART NO</b></td>
					<td><b>NAMA BARANG</b></td>
					<td width="60"><b>QTY</b></td>
					<td width="50"><b>DISKON</b></td>
					<td width="60"><b>HARGA</b></td>
					<td width="90"><b>SUBTOTAL</b></td>
				</tr>
			</thead>
			<tbody>
				@php $no = isset($no) ? $no : 1; @endphp
				@foreach($model->penjualan_detail()->offset($p * 10)->limit(10)->get() as $detail)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $detail->part_no }}</td>
					<td>{{ $detail->nama }}</td>
					<td>{{ $detail->qty }} {{ $detail->satuan }}</td>
					<td>{{ $detail->diskon }}%</td>
					<td>{{ number_format($detail->harga, 0, '', '.')}}</td>
					<td>{{ number_format($detail->subtotal, 0, '', '.')}}</td>
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
						<div></div>
					</td>
					<td><b>TOTAL</b></td>
					<td>{{ number_format($model->total, 0, '', '.')}}</td>
				</tr>
			</tfoot>
			@endif
		</table>

		@if(($p+1) == $page_count)
		<table class="footer">
			<tr>
				<td>DITERIMA OLEH</td>
				<td>DIPERIKSA OLEH</td>
				<td>DIBUAT OLEH</td>
				<td><b>HORMAT KAMI,</b></td>
			</tr>
			<tr>
				<td>(............)</td>
				<td>(............)</td>
				<td>(............)</td>
				<td>(............)</td>
			</tr>
		</table>
		@else
		<p>(BERSAMBUNG)</p>
		@endif

	</div>
	@endfor

</body>
</html>