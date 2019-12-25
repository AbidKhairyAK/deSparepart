@extends('app')

@section('title', $title)

@section('style')
<style type="text/css">
	table td {
	   text-align: right;
	   padding-right: 15px !important;
	}
	table td table td {
	   text-align: right;
	   padding-top: 0.3rem !important;
	   padding-bottom: 0.3rem !important;
	   padding-right: 15px !important;
	}
</style>
@endsection

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
		<h6 class="m-0 font-weight-bold text-secondary">Pelaporan Metode FIFO</h6>
	</div>
	<div class="card-body">
		<div class="d-flex justify-content-between align-items-center p-0">
			<div>
				<form>
					from: <input style="width: 150px;" 
								type="date" 
								name="range_from" 
								class="form-control form-control-sm d-inline-block" 
								value="{{ request()->get('range_from') }}"
							>
					to: <input style="width: 150px;" 
								type="date" 
								name="range_to" 
								class="form-control form-control-sm d-inline-block" 
								value="{{ request()->get('range_to') }}"
							>
					<button class="btn btn-sm btn-primary">submit</button>
				</form>
			</div>
			<div>{{ $invs->appends([
						'range_from' => request()->get('range_from'), 
						'range_to' => request()->get('range_to'), 
					])->onEachSide(1)->links() }}</div>
		</div>
		<hr class="mt-0">
		<table class="table table-bordered table-condesed table-sm">
			<thead>
				<tr>
					<th rowspan="2" class="bg-dark text-light" style="vertical-align: middle;">Tanggal</th>
					<th colspan="3" class="bg-primary text-light">Pembelian</th>
					<th colspan="3" class="bg-warning text-light">Penjualan</th>
					<th colspan="3" class="bg-dark text-light">Persediaan</th>
				</tr>
				<tr>
					<th class="bg-primary text-light">Unit</th>
					<th class="bg-primary text-light">Harga</th>
					<th style="border-right: 1px solid #e3e6f0" class="bg-primary text-light">Total</th>
					<th class="bg-warning text-light">Unit</th>
					<th class="bg-warning text-light">Harga</th>
					<th class="bg-warning text-light">Total</th>
					<th class="bg-dark text-light">Unit</th>
					<th class="bg-dark text-light">Harga</th>
					<th class="bg-dark text-light">Total</th>
				</tr>
			</thead>
			<tbody>
				@php $tanggal_prev = null; @endphp
				@foreach($invs as $inv)

				@if($inv->tanggal == $tanggal_prev) @php continue; @endphp @endif
				@php $tanggal_prev = $inv->tanggal; @endphp

				<tr>
					<td class="text-left" width="180">{{ date('d M Y - H:i', strtotime($inv->tanggal)) }}</td>

					@if($inv->pembelian_detail_id)
					<td>{{ number_format($inv->trx_qty, 0, '', '.') }}</td>
					<td>{{ number_format($inv->trx_harga, 0, '', '.') }}</td>
					<td>{{ number_format($inv->trx_total, 0, '', '.') }}</td>
					<td></td>
					<td></td>
					<td></td>

					@elseif($inv->penjualan_detail_id)

					@php 
						$pds = $model->inventaris()
									->where('penjualan_detail_id', $inv->penjualan_detail_id)
									->orderBy('id')
									->get();
					@endphp
					<td></td>
					<td></td>
					<td></td>
					<td class="p-0">
						<table class="table m-0">
							@foreach($pds as $pd)
							<tr>
								<td style="border: 0;">{{ number_format($pd->trx_qty, 0, '', '.') }}</td>
							</tr>
							@endforeach
						</table>
					</td>
					<td class="p-0">
						<table class="table m-0">
							@foreach($pds as $pd)
							<tr>
								<td style="border: 0;">{{ number_format($pd->trx_harga, 0, '', '.') }}</td>
							</tr>
							@endforeach
						</table>
					</td>
					<td class="p-0">
						<table class="table m-0">
							@foreach($pds as $pd)
							<tr>
								<td style="border: 0;">{{ number_format($pd->trx_total, 0, '', '.') }}</td>
							</tr>
							@endforeach
						</table>
					</td>

					@else
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					@endif

					@php 
						$ds = $inv->inventaris_detail()
									->orderBy('tanggal')
									->orderBy('id')
									->get(); 
					@endphp
					<td class="p-0">
						<table class="table m-0">
							@foreach($ds as $d)
							<tr>
								<td style="border: 0;">{{ number_format($d->inv_stok, 0, '', '.') }}</td>
							</tr>
							@endforeach
						</table>
					</td>
					<td class="p-0">
						<table class="table m-0">
							@foreach($ds as $d)
							<tr>
								<td style="border: 0;">{{ number_format($d->inv_harga, 0, '', '.') }}</td>
							</tr>
							@endforeach
						</table>
					</td>
					<td class="p-0">
						<table class="table m-0">
							@foreach($ds as $d)
							<tr>
								<td style="border: 0;">{{ number_format($d->inv_total, 0, '', '.') }}</td>
							</tr>
							@endforeach
						</table>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
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

				<table class="table table-striped stok">
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

				<table class="table table-striped stok text-center">
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
	$('.stok').DataTable({
        "order": [[ 1, "asc" ]]
    });
</script>
@endsection