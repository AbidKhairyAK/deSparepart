@extends('app')

@section('title', $title)

@section('content')

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Detail {{ $title }}</h6>
		<div>
			@if(auth()->user()->can('create-'.$main))
			<a href="{{ route($main.'.index') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-list"></i> <b>Daftar {{ $title }}</b>
			</a>
			<a href="{{ route($main.'.create') }}" class="btn btn-sm btn-warning">
				<i class="fas fa-plus"></i> <b>Tambah {{ $title }}</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-primary disabled">
				<i class="fas fa-list"></i> <b>Daftar {{ $title }}</b>
			</a>
			<a href="#" class="btn btn-sm btn-warning disabled">
				<i class="fas fa-plus"></i> <b>Tambah {{ $title }}</b>
			</a>
			@endif
		</div>
	</div>
	<div class="card-body">

		<div class="row">
			<div class="col-sm-4">
				<div class="row pb-2">
					<span class="col-4">Part NO</span>
					<span class="col-8">: <b>{{ $model->part_no }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Nama Barang</span>
					<span class="col-8">: <b>{{ $model->nama }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Merk</span>
					<span class="col-8">: <b>{{ $model->merk }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Komponen</span>
					<span class="col-8">: <b>{{ $model->komponen->nama }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Kendaraan</span>
					<span class="col-8">: <b>{{ $model->kendaraan->merk }} - {{ $model->kendaraan->pabrikan }}</b></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row pb-2">
					<span class="col-4">Satuan</span>
					<span class="col-8">: <b>{{ $model->satuan->nama }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Stok</span>
					<span class="col-8">: <b>{{ number_format($model->stok, 0, '', '.') }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">limit</span>
					<span class="col-8">: <b>{{ number_format($model->limit, 0, '', '.') }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Hrg Beli Standar</span>
					<span class="col-8">: <b>Rp {{ number_format($model->harga_beli, 0, '', '.') }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Hrg Jual Standar</span>
					<span class="col-8">: <b>Rp {{ number_format($model->harga_jual, 0, '', '.') }}</b></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row pb-2">
					<span class="col-4">Keterangan</span>
					<span class="col-8">: <b>{{ $model->keterangan }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Gambar</span>
					<span class="col-8">: <a href="/img/{{ $model->gambar }}" target="_blank"><img src="/img/{{ $model->gambar }}" class="w-50 border"></a></span>
				</div>
			</div>
		</div>
		
		
	</div>
</div>


<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-secondary">Detail Stok</h6>
	</div>
	<div class="card-body">

		@php 
			$pds1 = $model->pembelian_detail()->where('stok', '>', 0)->get();
			$pds0 = $model->pembelian_detail()->where('stok', '=', 0)->get();
		@endphp

		<div class="row">
			<div class="col-md-6">
				<h6><b>Stok Masih Ada</b></h6>

				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th>No Faktur</th>
							<th>Tgl Beli</th>
							<th title="Harga beli satuan, sudah termasuk ppn dan diskon">Hrg Beli <sup>?</sup></th>
							<th>Qty</th>
							<th>Stok</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pds1 as $pd)
						<tr>
							<td><a href="{{ route('pembelian.show', $pd->pembelian_id) }}">
								{{ $pd->pembelian->no_faktur }}
							</a></td>
							<td>{{ substr($pd->created_at, 0, 10) }}</td>
							<td>{{ number_format($pd->harga, 0, '', '.') }}</td>
							<td>{{ $pd->qty }}</td>
							<td>{{ $pd->stok }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-md-6">
				<h6><b>Stok Sudah Habis</b></h6>

				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th>No Faktur</th>
							<th>Tgl Beli</th>
							<th title="Harga beli satuan, sudah termasuk ppn dan diskon">Hrg Beli <sup>?</sup></th>
							<th>Qty</th>
							<th>Stok</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pds0 as $pd)
						<tr>
							<td><a href="{{ route('pembelian.show', $pd->pembelian_id) }}">
								{{ $pd->pembelian->no_faktur }}
							</a></td>
							<td>{{ substr($pd->created_at, 0, 10) }}</td>
							<td>{{ number_format($pd->harga, 0, '', '.') }}</td>
							<td>{{ $pd->qty }}</td>
							<td>{{ $pd->stok }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@include('layouts.multi')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable({
        "order": [[ 1, "asc" ]]
    });
</script>
@endsection