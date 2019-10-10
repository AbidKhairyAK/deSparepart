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
			font-size: 15px;
			font-family: 'Inconsolata', monospace;
		}
		#list-barang {
			width: 100%;
			border: 1px dashed black;
		}
		#list-barang thead tr td {
			border-bottom: 1px dashed black;
		}
		#list-barang tfoot tr td {
			border-top: 1px dashed black;
		}
		#list-barang tr td {
			border-left: 1px dashed black;
			padding: 3px 10px;
		}
		#list-barang tr td:first-child {
			border-left: 0;
		}
		#list-barang tr td:nth-child(4),
		#list-barang tr td:nth-child(5),
		#list-barang tr td:nth-child(6),
		#list-barang tr td:nth-child(7),
		#list-barang tfoot tr td:last-child {
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
	</style>
</head>
<body>

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
							<td>NO NOTA</td><td>:</td><td>{{ $model->no_nota }}</td>
						</tr>
						<tr>
							<td>TANGGAL</td><td>:</td><td>{{ date('Y-m-d', strtotime($model->created_at)) }}</td>
						</tr>
						<tr>
							<td>JATUH TEMPO</td><td>:</td><td>{{ $model->jatuh_tempo }}</td>
						</tr>
					</table>
				</p>
			</td>
		</tr>
	</table>

	<table id="list-barang">
		<thead>
			<tr>
				<td><b>#</b></td>
				<td><b>PART NO</b></td>
				<td><b>NAMA BARANG</b></td>
				<td><b>QTY</b></td>
				<td><b>DISKON</b></td>
				<td><b>HARGA</b></td>
				<td><b>SUBTOTAL</b></td>
			</tr>
		</thead>
		<tbody>
			@php $no = 1; @endphp
			@foreach($model->penjualan_detail()->get() as $detail)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $detail->part_no }}</td>
				<td>{{ $detail->nama }}</td>
				<td>{{ $detail->qty }}</td>
				<td>{{ $detail->diskon }}%</td>
				<td>{{ number_format($detail->harga, 0, '', '.')}}</td>
				<td>{{ number_format($detail->subtotal, 0, '', '.')}}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6"><b>TOTAL</b></td>
				<td><b>{{ number_format($model->total, 0, '', '.')}}</b></td>
			</tr>
		</tfoot>
	</table>

	<table class="footer">
		<tr>
			<td>DITERIMA OLEH</td>
			<td>DIPERIKSA OLEH</td>
			<td>DIBUAT OLEH</td>
			<td><b>HORMAT KAMI,</b></td>
		</tr>
	</table>

	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>