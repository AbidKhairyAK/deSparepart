@extends('app')

@section('title', $title)

@section('content')

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Detail {{ $title }}</h6>
		<div>
			@if(auth()->user()->can('create-'.$main))
			<a href="{{ route('pembelian.create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Pembelian</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-primary disabled">
				<i class="fas fa-plus"></i> <b>Tambah {{ $title }}</b>
			</a>
			@endif

			@if(auth()->user()->can('index-hutang'))
			<a href="{{ route('hutang.index') }}" class="btn btn-sm btn-warning">
				<i class="fas fa-list"></i> <b>Daftar Hutang</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-warning disabled">
				<i class="fas fa-list"></i> <b>Daftar Hutang</b>
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
						<span>Hutang:</span>
						<p><b>Rp {{ number_format($model->hutang,0,'','.') }}</b></p>
					</div>
					<div class="form-group col-sm-3">
						<span>Dibayarkan:</span>
						<p><b>Rp {{ number_format($model->dibayarkan,0,'','.') }}</b></p>
					</div>
					<div class="form-group col-sm-3">
						<span>Sisa hutang:</span>
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
												<th>PPN %</th>
												<th>Harga</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody>
											@foreach($model->pembelian->pembelian_detail()->get() as $key => $detail)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $detail->part_no }}</td>
												<td>{{ $detail->nama }}</td>
												<td>{{ $detail->qty }}</td>
												<td>{{ $detail->diskon }}</td>
												<td>{{ $detail->ppn }}</td>
												<td>{{ number_format($detail->harga, 0, '', '.') }}</td>
												<td>{{ number_format($detail->subtotal, 0, '', '.') }}</td>
											</tr>
											@endforeach
										</tbody>
										<tfoot>
											<tr>
												<th colspan="6">TOTAL :</th>
												<th>{{ number_format($model->pembelian->total, 0, '', '.') }}</th>
											</tr>
										</tfoot>
									</table>
								</div>

								<div class="col-sm-4 pb-2">
									<b>No Faktur:</b> {{ $model->pembelian->no_faktur }}
								</div>
								<div class="col-sm-4 pb-2">
									<b>No PO:</b> {{ $model->pembelian->no_po }}
								</div>
								<div class="col-sm-4 pb-2">
									<b>Pembayaran:</b> {{ strtoupper($model->pembelian->pembayaran) }}
								</div>
								<div class="col-sm-4 pb-2">
									<b>Supplier:</b> {{ $model->pembelian->supplier->perusahaan }}
								</div>
								<div class="col-sm-4 pb-2">
									<b>Tanggal Transaksi:</b> {{ substr($model->pembelian->created_at, 0, 10) }}
								</div>
								<div class="col-sm-4 pb-2">
									<b>Jatuh Tempo:</b> {{ $model->pembelian->jatuh_tempo }}
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