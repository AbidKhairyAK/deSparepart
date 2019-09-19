<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Hutang</h6>
		<div>
			<a href="{{ url('pembelian/create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Pembelian</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Kreditur</th>
					<th>Total Hutang</th>
					<th>Jatuh Tempo Terdekat</th>
					<th>Pembelian</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div class="d-flex">
							<span>
								<div>Kode</div>
								<div>Nama</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>PJY</b></div>
								<div><b>PT. Jaya Yaelah</b></div>
							</span>
						</div>
					</td>
					<td><b>Rp. 12.000.000</b></td>
					<td>
						<div class="d-flex">
							<span>
								<div>Tgl Tempo</div>
								<div>No Nota</div>
								<div>Hutang</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>12-9-2019</b></div>
								<div><b>78JHDS</b></div>
								<div><b>Rp. 6.000.000</b></div>
							</span>
						</div>
					</td>
					<td>
						<div class="d-flex">
							<span>
								<div>Lunas</div>
								<div>Belum Lunas</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>490 Transaksi</b></div>
								<div><b>4 Transaksi</b></div>
							</span>
						</div>
					</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Detail</a>
								<a class="dropdown-item" href="#">Lunasi</a>
							</div>
						</div>
					</td>
				</tr>

				<tr>
					<td>
						<div class="d-flex">
							<span>
								<div>Kode</div>
								<div>Nama</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>PMB</b></div>
								<div><b>PT. Mobil Bekas</b></div>
							</span>
						</div>
					</td>
					<td><b>Rp. 20.000.000</b></td>
					<td>
						<div class="d-flex">
							<span>
								<div>Tgl Tempo</div>
								<div>No Nota</div>
								<div>Hutang</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>20-10-2019</b></div>
								<div><b>AS89HF</b></div>
								<div><b>Rp. 2.000.000</b></div>
							</span>
						</div>
					</td>
					<td>
						<div class="d-flex">
							<span>
								<div>Lunas</div>
								<div>Belum Lunas</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>230 Transaksi</b></div>
								<div><b>10 Transaksi</b></div>
							</span>
						</div>
					</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Detail</a>
								<a class="dropdown-item" href="#">Lunasi</a>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>