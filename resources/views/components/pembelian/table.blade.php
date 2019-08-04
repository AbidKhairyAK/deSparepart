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
					<th>No Faktur</th>
					<th>Tgl Beli</th>
					<th>Tgl Masuk</th>
					<th>Tgl Tempo</th>
					<th>Ttl Bayar</th>
					<th>Ttl Hutang</th>
					<th>Status</th>
					<th>Bayar</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td>
						<div class="d-flex justify-content-between flex-row-reverse">
							<span>81</span>
							<span><b>ASD67ASD7</b><br>PT. Abadi Jaya</span>
						</div>
					</td>
					<td>2019-03-12</td>
					<td>2019-03-14</td>
					<td>2019-03-20</td>
					<td>Rp 20.000.000</td>
					<td>Rp 0</td>
					<td>Lunas<br><span class="badge badge-primary">Publish</span></td>
					<td>Tunai</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Retur</a>
								<a class="dropdown-item" href="#">Detail</a>
								<a class="dropdown-item" href="#">Hapus</a>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="d-flex justify-content-between flex-row-reverse">
							<span>81</span>
							<span><b>KJDKOOASD</b><br>PT. Sumber Berkah</span>
						</div>
					</td>
					<td>2019-04-12</td>
					<td>2019-04-14</td>
					<td>2019-04-20</td>
					<td>Rp 12.000.000</td>
					<td>Rp 2.000.000</td>
					<td>Belum Lunas<br><span class="badge badge-warning">Draft</span></td>
					<td>Kredit</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Retur</a>
								<a class="dropdown-item" href="#">Detail</a>
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