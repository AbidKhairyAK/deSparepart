@extends('app')

@section('title', $title)

@section('content')

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Detail Hutang</h6>
		<div>
			@if(auth()->user()->can('create-pembelian'))
			<a href="{{ route('pembelian.create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Pembelian</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-primary disabled">
				<i class="fas fa-plus"></i> <b>Tambah Pembelian</b>
			</a>
			@endif

			@if(auth()->user()->can('index-pembayaran-hutang'))
			<a href="{{ route('pembayaran-hutang.index') }}" class="btn btn-sm btn-warning">
				<i class="fas fa-list"></i> <b>Daftar Nota Hutang</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-warning disabled">
				<i class="fas fa-list"></i> <b>Daftar Nota Hutang</b>
			</a>
			@endif
		</div>
	</div>
	<div class="card-body">

		<div class="row mb-3">
			<span class="col-sm-4">Nama Supplier : <b>{{ $parent->perusahaan }}</b></span>
			<span class="col-sm-4">Kode Supplier : <b>{{ $parent->kode }}</b></span>
			<span class="col-sm-4">Kontak Supplier : <b>{{ ($kontak = $parent->kontak_supplier()->where('tipe', 'hp')->first()) ? $kontak->kontak : '-' }}</b></span>
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
						<a href="{{ route('pembayaran-hutang.create', ['id'=>$m->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-money-bill-wave"></i> Lunasi</a>
						<a href="{{ route('pembelian.show', $m->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection