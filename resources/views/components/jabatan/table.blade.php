<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Jabatan</h6>
		<div>
			<a href="{{ url('jabatan/create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Jabatan</b>
			</a>
		</div>
	</div>
	<div class="card-body">

		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Nama Jabatan</th>
					<th>Deskripsi</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
