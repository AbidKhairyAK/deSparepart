<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Pembelian</h6>
		<div>
			<a href="#" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Penjualan</b>
			</a>
			<a href="#" class="btn btn-sm btn-warning">
				<i class="fas fa-coins"></i> <b>Daftar Piutang</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>No Faktur</th>
					<th>Tanggal</th>
					<th>Ttl Bayar</th>
					<th>Dibayarkan</th>
					<th>Kasir</th>
					<th>Karyawan</th>
					<th>Keterangan</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td>
						<div class="d-flex justify-content-between flex-row-reverse">
							<span class="text-right">
								<div><b>139</b></div>
								<div><b>SI12NJ3</b></div>
								<div><b>Umum</b></div>
							</span>
							<span>
								<div>No Faktur</div>
								<div>No Nota</div>
								<div>Pembeli</div>
							</span>
						</div>
					</td>
					<td>
						<div class="d-flex justify-content-between flex-row-reverse">
							<span class="text-right">
								<div>: 2019-02-01</div>
								<div>: 2019-02-16</div>
							</span>
							<span>
								<div>Tanggal Jual</div>
								<div>Jatuh Tempo</div>
							</span>
						</div></td>
					<td>Rp 20.000.000</td>
					<td>Rp 21.000.000</td>
					<td>Bambang</td>
					<td>Sutrisno</td>
					<td>Ini Keterangan ...</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Detail</a>
								<a class="dropdown-item" href="#">Hapus</a>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="d-flex justify-content-between flex-row-reverse">
							<span class="text-right">
								<div><b>182</b></div>
								<div><b>A9S8DHK</b></div>
								<div><b>CV. Bengkel Jaya</b></div>
							</span>
							<span>
								<div>No Faktur</div>
								<div>No Nota</div>
								<div>Pembeli</div>
							</span>
						</div>
					</td>
					<td>
						<div class="d-flex justify-content-between flex-row-reverse">
							<span class="text-right">
								<div>: 2019-03-04</div>
								<div>: 2019-04-19</div>
							</span>
							<span>
								<div>Tanggal Jual</div>
								<div>Jatuh Tempo</div>
							</span>
						</div></td>
					<td>Rp 10.000.000</td>
					<td>Rp 11.000.000</td>
					<td>Kareem</td>
					<td>Sulthon</td>
					<td>Ini bukan Keterangan ...</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
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