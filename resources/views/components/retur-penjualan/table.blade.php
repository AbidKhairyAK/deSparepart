<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar {{ $title }}</h6>
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

		<ul class="nav nav-tabs mb-3">
			<li class="nav-item">
				<a class="nav-link {{ $type=='barang' ? 'active' : '' }}" href="?type=barang">Per Barang</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ $type=='penjualan' ? 'active' : '' }}" href="?type=penjualan">Per Penjualan</a>
			</li>
		</ul>
		
		<table class="table table-striped">
			@if($type == 'barang')
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Identitas</th>
					<th>Retur qty</th>
					<th>Dikembalikan</th>
					<th>Pembayaran</th>
					<th>Tanggal</th>
					<th>Aksi</th>
				</tr>
			</thead>
			@elseif($type == 'penjualan')
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>No Faktur</th>
					<th>Barang</th>
					<th>Dikembalikan</th>
					<th>Dari Total</th>
					<th width="120">Aksi</th>
				</tr>
			</thead>
			@endif
			<tbody></tbody>
		</table>
	</div>
</div>