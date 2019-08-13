<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Pembelian</h6>
		<div>
			<a href="#" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Pembelian</b>
			</a>
			<a href="#" class="btn btn-sm btn-warning">
				<i class="fas fa-coins"></i> <b>Daftar Hutang</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Username</th>
					<th>Nama</th>
					<th>Role</th>
					<th>Status</th>
					<th>Tgl Register</th>
					<th>Login Terakhir</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td>usmanbcl</td>
					<td>Usman BCL</td>
					<td>Admin</td>
					<td><span class="badge badge-primary">Aktif</span></td>
					<td>2019-02-16 20:42:12</td>
					<td>2019-06-19 12:41:52</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Edit</a>
								<a class="dropdown-item" href="#">Nonaktifkan</a>
								<a class="dropdown-item" href="#">Hapus</a>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>bambangkau</td>
					<td>Bambang Kau</td>
					<td>Gudang</td>
					<td><span class="badge badge-warning">Nonaktif</span></td>
					<td>2019-09-23 13:31:27</td>
					<td>2019-10-26 23:15:16</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Edit</a>
								<a class="dropdown-item" href="#">Nonaktifkan</a>
								<a class="dropdown-item" href="#">Hapus</a>
							</div>
						</div>
					</td>
				</tr>
				@endfor
			</tbody>
		</table>
	</div>
</div>