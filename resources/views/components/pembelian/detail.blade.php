@extends('app')

@section('title', $title)

@section('content')

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Detail {{ $title }}</h6>
		<div>
			@if(auth()->user()->can('create-'.$main))
			<a href="{{ route($main.'.create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah {{ $title }}</b>
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
			<div class="col-sm-4">
				<div class="row pb-2">
					<span class="col-4">No Faktur</span>
					<span class="col-8">: <b>{{ $model->no_faktur }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">No PO</span>
					<span class="col-8">: <b>{{ $model->no_po }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Jatuh Tempo</span>
					<span class="col-8">: <b>{{ $model->jatuh_tempo }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Tanggal Beli</span>
					<span class="col-8">: <b>{{ $model->created_at }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Update Data</span>
					<span class="col-8">: <b>{{ $model->updated_at }}</b></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row pb-2">
					<span class="col-4">Pembayaran</span>
					<span class="col-8">: <b>{{ strtoupper($model->pembayaran) }}{{ $model->pembayaran_detail ? ' - '.$model->pembayaran_detail : '' }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Total</span>
					<span class="col-8">: <b>Rp {{ number_format($model->total, 0, '', '.') }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Dibayarkan</span>
					<span class="col-8">: <b>Rp {{ number_format($model->dibayarkan, 0, '', '.') }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Hutang</span>
					<span class="col-8">: <b>Rp {{ number_format($model->hutang, 0, '', '.') }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Status Hutang</span>
					<span class="col-8">: <b>{{ $model->status_lunas ? 'Lunas' : 'Belum Lunas' }}</b></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row pb-2">
					<span class="col-4">Supplier</span>
					<span class="col-8">: <b>{{ $model->supplier->kode }} - {{ $model->supplier->nama }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Pembuat Data</span>
					<span class="col-8">: <b>{{ $model->user->username }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Status Upload</span>
					<span class="col-8">: <b>{{ $model->status_post ? 'Publish' : 'Draft' }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Keterangan</span>
					<span class="col-8">: <b>{{ $model->keterangan }}</b></span>
				</div>
			</div>
		</div>
		
		<hr>

		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Part No</th>
					<th>Nama Barang</th>
					<th>Qty</th>
					<th>Diskon</th>
					<th>PPN</th>
					<th>Harga</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				@php $no = 1; @endphp
				@foreach($model->pembelian_detail()->get() as $detail)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $detail->part_no }}</td>
					<td>{{ $detail->nama }}</td>
					<td>
						{{ $detail->qty }}
						@if($detail->retur > 0) <small>{{ "(retur {$detail->retur})" }}</small> @endif
					</td>
					<td>{{ $detail->diskon }}%</td>
					<td>{{ $detail->ppn }}%</td>
					<td>{{ number_format($detail->harga, 0, '', '.')}}</td>
					<td>{{ number_format($detail->subtotal, 0, '', '.')}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@include('layouts.multi')

@endsection