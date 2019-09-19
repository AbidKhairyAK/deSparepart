<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Pembelian</h6>
		<div>
			<a href="{{ url('pembelian/create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Pembelian</b>
			</a>
			<a href="{{ url('hutang') }}" class="btn btn-sm btn-warning">
				<i class="fas fa-coins"></i> <b>Daftar Hutang</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Nomor</th>
					<th>Pemasok</th>
					<th>Tanggal</th>
					<th>Biaya</th>
					<th>Status</th>
					<th>Pembayaran</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td>
						<div class="d-flex">
							<span>
								<div>No Faktur</div>
								<div>No Nota</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>SKLDF9</b></div>
								<div><b>ASD67ASD7</b></div>
							</span>
						</div>
					</td>
					<td>PAJ7813</td>
					<td>
						<div class="d-flex">
							<span>
								<div>Tgl Beli</div>
								<div>Tgl Masuk</div>
								<div>Tgl Tempo</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>2019-03-12</b></div>
								<div><b>2019-03-14</b></div>
								<div><b>2019-04-12</b></div>
							</span>
						</div>
					</td>
					<td>
						<div class="d-flex">
							<span>
								<div>Ttl Harga</div>
								<div>Ttl Bayar</div>
								<div>Ttl Hutang</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>Rp 20.000.000</b></div>
								<div><b>Rp 18.000.000</b></div>
								<div><b>Rp 2.000.000</b></div>
							</span>
						</div>
					</td>
					<td>Belum Lunas<br><span class="badge badge-primary">Publish</span></td>
					<td>Kredit (30 Hari)</td>
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