@extends('app')

@section('title', $title)

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar {{ $title }}</h1>
	<p class="mb-4">Detail data {{ $title }}</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Detail Piutang</h6>
		<div>
			@if(auth()->user()->can('create-penjualan'))
			<a href="{{ route('penjualan.create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Penjualan</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-primary disabled">
				<i class="fas fa-plus"></i> <b>Tambah Penjualan</b>
			</a>
			@endif

			@if(auth()->user()->can('index-pembayaran-piutang'))
			<a href="{{ route('pembayaran-piutang.index') }}" class="btn btn-sm btn-warning">
				<i class="fas fa-list"></i> <b>Daftar Nota Piutang</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-warning disabled">
				<i class="fas fa-list"></i> <b>Daftar Nota Piutang</b>
			</a>
			@endif
		</div>
	</div>
	<div class="card-body">

		<div class="row mb-3">
			<span class="col-sm-4">Nama Debitur : <b>{{ $parent->nama }}</b></span>
			<span class="col-sm-4">Kode Debitur : <b>{{ $parent->kode }}</b></span>
			<span class="col-sm-4">Kontak Debitur : <b>{{ ($kontak = $parent->kontak_pelanggan()->where('tipe', 'hp')->first()) ? $kontak->kontak : '-' }}</b></span>
		</div>
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>No Faktur</th>
					<th>Jatuh Tempo</th>
					<th>Jumlah Hutang</th>
					<th width="200">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model as $i => $m)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $m->no_faktur }}</td>
					<td>{{ $m->jatuh_tempo }}</td>
					<td>Rp {{ number_format($m->hutang, 0, '', '.') }}</td>
					<td>
						<a href="{{ route('pembayaran-piutang.create', ['id'=>$m->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-money-bill-wave"></i> Lunasi</a>
						<a href="{{ route('penjualan.show', $m->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection