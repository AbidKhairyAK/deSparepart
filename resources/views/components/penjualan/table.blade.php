<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar {{ $title }}</h6>
		<div>
			@if(auth()->user()->can('create-'.$main))
			<a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tanda-terima">
				<i class="fas fa-file-signature"></i> <b>Cetak Tanda Terima</b>
			</a>
			<a href="{{ route($main.'.create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah {{ $title }}</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-success">
				<i class="fas fa-file-signature"></i> <b>Cetak Tanda Terima</b>
			</a>
			<a href="#" class="btn btn-sm btn-primary disabled">
				<i class="fas fa-plus"></i> <b>Tambah {{ $title }}</b>
			</a>
			@endif

			@if(auth()->user()->can('index-piutang'))
			<a href="{{ route('piutang.index') }}" class="btn btn-sm btn-warning">
				<i class="fas fa-list"></i> <b>Daftar Piutang</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-warning disabled">
				<i class="fas fa-list"></i> <b>Daftar Piutang</b>
			</a>
			@endif
		</div>
	</div>
	<div class="card-body">

		<table id="table" class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<!-- <th>#</th> -->
					<th>Nomor</th>
					<th width="180">Customer</th>
					<th>Tanggal</th>
					<th>Biaya</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
