<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar {{ $title }}</h6>
		<div>
			@if(auth()->user()->can('index-'.$main))
			<a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-form">
				<i class="fas fa-print"></i> <b>Cetak Stok {{ $title }}</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-info disabled">
				<i class="fas fa-plus"></i> <b>Cetak Stok {{ $title }}</b>
			</a>
			@endif

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

		<table id="table" class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<!-- <th>#</th> -->
					<th>Gambar</th>
					<th>kode</th>
					<th width="300">Identitas</th>
					<th>Jumlah</th>
					<th>Harga</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
