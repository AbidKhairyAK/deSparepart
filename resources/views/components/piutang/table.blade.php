<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Piutang</h6>
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
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Customer</th>
					<th>Total Piutang</th>
					<th>Jatuh Tempo Terdekat</th>
					<th>Transaksi</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>