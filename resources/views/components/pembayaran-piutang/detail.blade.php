@extends('app')

@section('title', $title)

@section('content')

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Detail {{ $title }}</h6>
		<div>
			@if(auth()->user()->can('create-'.$main))
			<a href="{{ route('penjualan.create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Penjualan</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-primary disabled">
				<i class="fas fa-plus"></i> <b>Tambah {{ $title }}</b>
			</a>
			@endif

			@if(auth()->user()->can('index-piutang'))
			<a href="{{ route('piutang.index') }}" class="btn btn-sm btn-warning">
				<i class="fas fa-list"></i> <b>Daftar Piutang</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-warning disabled">
				<i class="fas fa-list"></i> <b>Daftar Piutang</b>
			</a>
			@endif
		</div>
	</div>
	<div class="card-body">

		<div class="row">
			<div class="col-sm-8">
				<div class="row">

					<div class="form-group col-sm-3">
						<span>No Pelunasan:</span>
						<p><b>{{ $model->no_pelunasan }}</b></p>
					</div>
					<div class="form-group col-sm-3">
						<span>Tgl Pelunasan:</span>
						<p><b>{{ $model->created_at }}</b></p>
					</div>
					<div class="form-group col-sm-3">
						<span>Kasir:</span>
						<p><b>{{ $model->user->username }}</b></p>
					</div>
					<div class="form-group col-sm-3">
						<span>Status:</span>
						<p><b>{{ $model->status_lunas ? 'Lunas' : 'Belum Lunas' }}</b></p>
					</div>

					<div class="form-group col-sm-3">
						<span>Piutang:</span>
						<p><b>Rp {{ number_format($model->piutang,0,'','.') }}</b></p>
					</div>
					<div class="form-group col-sm-3">
						<span>Dibayarkan:</span>
						<p><b>Rp {{ number_format($model->dibayarkan,0,'','.') }}</b></p>
					</div>
					<div class="form-group col-sm-3">
						<span>Sisa Piutang:</span>
						<p><b>Rp {{ number_format($model->sisa,0,'','.') }}</b></p>
					</div>
					<div class="form-group col-sm-3">
						<span>Pembayaran:</span>
						<p><b>{{ strtoupper($model->pembayaran) }}<br>{{ $model->pembayaran_detail ?: '' }}</b></p>
					</div>

					<div class="form-group col-sm-12">
						<label>Detail Transaksi:</label>
						<div class="p-2 border border-secondary">
							<div class="row">

								<div class="col-sm-12">
									<table class="table table-bordered table-sm my-3">
										<thead>
											<tr>
												<th>No</th>
												<th>Part No</th>
												<th>Nama Barang</th>
												<th>Qty</th>
												<th>Diskon %</th>
												<th>Harga</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody>
											@foreach($model->penjualan->penjualan_detail()->get() as $key => $detail)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $detail->part_no }}</td>
												<td>{{ $detail->nama }}</td>
												<td>{{ $detail->qty }}</td>
												<td>{{ $detail->diskon }}</td>
												<td>{{ number_format($detail->harga, 0, '', '.') }}</td>
												<td>{{ number_format($detail->subtotal, 0, '', '.') }}</td>
											</tr>
											@endforeach
										</tbody>
										<tfoot>
											<tr>
												<th colspan="6">TOTAL :</th>
												<th>{{ number_format($model->penjualan->total, 0, '', '.') }}</th>
											</tr>
										</tfoot>
									</table>
								</div>

								<div class="col-sm-4 pb-2">
									<b>No Faktur:</b> {{ $model->penjualan->no_faktur }}
								</div>
								<div class="col-sm-4 pb-2">
									<b>No PO:</b> {{ $model->penjualan->no_po }}
								</div>
								<div class="col-sm-4 pb-2">
									<b>Pembayaran:</b> {{ strtoupper($model->penjualan->pembayaran) }}
								</div>
								<div class="col-sm-4 pb-2">
									<b>Customer:</b> {{ $model->penjualan->customer->nama }}
								</div>
								<div class="col-sm-4 pb-2">
									<b>Tanggal Transaksi:</b> {{ substr($model->penjualan->created_at, 0, 10) }}
								</div>
								<div class="col-sm-4 pb-2">
									<b>Jatuh Tempo:</b> {{ $model->penjualan->jatuh_tempo }}
								</div>

							</div>
						</div>
					</div>

				</div>

			</div>
		</div>

	</div>
</div>

@endsection