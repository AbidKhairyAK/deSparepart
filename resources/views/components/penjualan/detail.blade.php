@extends('app')

@section('title', $title)

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Detail {{ $title }}</h1>
	<p class="mb-4">Detail data {{ $title }}</p>
</div>

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

			@if(auth()->user()->can('index-piutang'))
			<a href="{{ route('piutang.index') }}" class="btn btn-sm btn-warning">
				<i class="fas fa-list"></i> <b>Detail Piutang</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-warning disabled">
				<i class="fas fa-list"></i> <b>Detail Piutang</b>
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
					<span class="col-4">No Nota</span>
					<span class="col-8">: <b>{{ $model->no_nota }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Jatuh Tempo</span>
					<span class="col-8">: <b>{{ $model->jatuh_tempo }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Tanggal Jual</span>
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
					<span class="col-8">: <b>{{ $model->pembayaran }}</b></span>
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
					<span class="col-8">: <b>{{ $model->status_hutang ? 'Lunas' : 'Belum Lunas' }}</b></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row pb-2">
					<span class="col-4">Pembeli</span>
					<span class="col-8">: <b>{{ $model->pelanggan->kode }} - {{ $model->pelanggan->nama }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Kasir</span>
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
					<th>Harga</th>
					<th>Subtotal</th>
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