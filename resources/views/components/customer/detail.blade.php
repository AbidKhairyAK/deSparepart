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
		</div>
	</div>
	<div class="card-body">

		<div class="row">
			<div class="col-sm-4">
				<div class="row pb-2">
					<span class="col-4">Kode</span>
					<span class="col-8">: <b>{{ $model->kode }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Nama</span>
					<span class="col-8">: <b>{{ $model->nama }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Toko</span>
					<span class="col-8">: <b>{{ $model->toko }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Kategori</span>
					<span class="col-8">: <b>{{ $model->kategori }}</b></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row pb-2">
					<span class="col-4">Alamat</span>
					<span class="col-8">: <b>{{ $model->alamat }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Kontak</span>
					<span class="col-8">
						@foreach($model->kontak_customer()->get() as $k)
						<div>&bull; {{ $k->tipe }} - <b>{{ $k->kontak }}</b></div>
						@endforeach
					</span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row pb-2">
					<span class="col-4">Pembuat Data</span>
					<span class="col-8">: <b>{{ $model->user->username }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Tanggal Dibuat</span>
					<span class="col-8">: <b>{{ $model->created_at }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Tanggal Diupdate</span>
					<span class="col-8">: <b>{{ $model->updated_at }}</b></span>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="row">

	<div class="col-md-8">
		<div class="card shadow mb-4">
			<div class="card-header">
				<h6 class="m-0 font-weight-bold text-secondary">Barang Terbanyak Terjual</h6>
			</div>
			<div class="card-body">

				<div class="d-flex justify-content-between align-items-center">
					<form>
						<div class="input-group mb-3 w-75">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-calendar-alt text-muted"></i></span>
							</div>
							<input type="text" class="form-control datepicker" name="range_from" placeholder="Dari" value="{{ request()->get('range_from') }}">
							<input type="text" class="form-control datepicker" name="range_to" placeholder="Sampai" value="{{ request()->get('range_to') }}">
							<div class="input-group-append">
								<button class="btn btn-sm btn-outline-primary" type="submit">submit</button>
							</div>
						</div>
					</form>

					{{ $barang->appends([
						'range_from' => request()->get('range_from'),
						'range_to' => request()->get('range_to'),
					])->links() }}
				</div>

				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th>Part NO</th>
							<th>Nama Barang</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						@foreach($barang as $b)
						<tr>
							<td>{{ $b->part_no }}</td>
							<td>{{ $b->nama }}</td>
							<td>{{ $b->jumlah }} {{ $b->satuan }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		</div>
	</div>

	<div class="col-md-4">
		
		<div class="card border-bottom-secondary shadow py-2 mb-4">
		  <div class="card-body">
		    <div class="row no-gutters align-items-center">
		      <div class="col mr-2">
		        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Jumlah Penjualan</div>
		        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $model->penjualan()->count() }} kali</div>
		      </div>
		      <div class="col-auto">
		        <i class="fas fa-sign-out-alt fa-2x text-gray-300"></i>
		      </div>
		    </div>
		  </div>
		</div>
		
		<div class="card border-bottom-primary shadow py-2 mb-4">
		  <div class="card-body">
		    <div class="row no-gutters align-items-center">
		      <div class="col mr-2">
		        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Uang Masuk</div>
		        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ rupiah($model->penjualan()->sum('total'), true) }}</div>
		      </div>
		      <div class="col-auto">
		        <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
		      </div>
		    </div>
		  </div>
		</div>
		
		<div class="card border-bottom-warning shadow py-2 mb-4">
		  <div class="card-body">
		    <div class="row no-gutters align-items-center">
		      <div class="col mr-2">
		        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Piutang Belum Lunas</div>
		        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ rupiah($model->penjualan()->where('status_lunas', '0')->sum('hutang'), true) }}</div>
		      </div>
		      <div class="col-auto">
		        <i class="fas fa-coins fa-2x text-gray-300"></i>
		      </div>
		    </div>
		  </div>
		</div>

	</div>

</div>

@endsection