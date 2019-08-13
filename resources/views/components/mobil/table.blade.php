<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Mobil</h6>
		<div>
			<a href="#" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Mobil</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>ID Mobil</th>
					<th>Kode Mobil</th>
					<th>Kode Mesin</th>
					<th>Merk</th>
					<th>Pabrikan</th>
					<th>Silinder</th>
					<th>Sistem Pembakaran</th>
					<th>Bahan Bakar</th>
					<th>Tahun</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td>AS7D8</td>
					<td>J1K23</td>
					<td>812HJ</td>
					<td>Avanza WT1</td>
					<td>Toyota</td>
					<td>1300</td>
					<td>Ndak Tau</td>
					<td>Bensin</td>
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
					<td>KL984</td>
					<td>56ASD</td>
					<td>NM109</td>
					<td>CRV V2</td>
					<td>Honda</td>
					<td>2500</td>
					<td>Ndak Tau</td>
					<td>Solar</td>
					<td>2014</td>
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