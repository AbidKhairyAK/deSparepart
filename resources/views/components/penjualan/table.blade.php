<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Pembelian</h6>
		<div>
			<a href="{{ url('penjualan/create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Penjualan</b>
			</a>
			<a href="{{ url('piutang') }}" class="btn btn-sm btn-warning">
				<i class="fas fa-coins"></i> <b>Daftar Piutang</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Nomor</th>
					<th>Pembeli</th>
					<th>Tanggal</th>
					<th>Biaya</th>
					<th>Kasir</th>
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
								<div><b>JHKS8</b></div>
								<div><b>SI12NJ3</b></div>
							</span>
						</div>
					</td>
					<td>KAS123</td>
					<td>
						<div class="d-flex">
							<span>
								<div>Tgl Jual</div>
								<div>Tgl Tempo</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>2019-02-01</b></div>
								<div><b>-</b></div>
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
								<div>:</div>
							</span>
							<span>
								<div><b>Rp 200.000</b></div>
								<div><b>Rp 200.000</b></div>
								<div><b>Rp 0</b></div>
							</span>
						</div>
					</td>
					<td>Sutrisno</td>

					<td>Lunas<br><span class="badge badge-primary">Publish</span></td>
					<td>Tunai</td>
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