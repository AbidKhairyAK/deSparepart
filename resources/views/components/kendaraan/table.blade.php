<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Kendaraan</h6>
		<div>
			<a href="{{ url('kendaraan/create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Kendaraan</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Kode</th>
					<th>Tipe</th>
					<th>Merk</th>
					<th>Pabrikan</th>
					<th>Silinder</th>
					<th>Bahan Bakar</th>
					<th>Tahun</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td>J1K23</td>
					<td>Mobil</td>
					<td>Avanza WT1</td>
					<td>Toyota</td>
					<td>4</td>
					<td>Solar</td>
					<td>2011</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Edit</a>
								<a class="dropdown-item" href="#">Hapus</a>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>56ASD</td>
					<td>Motor</td>
					<td>Supra Fit</td>
					<td>Honda</td>
					<td>2</td>
					<td>Bensin</td>
					<td>2007</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Edit</a>
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