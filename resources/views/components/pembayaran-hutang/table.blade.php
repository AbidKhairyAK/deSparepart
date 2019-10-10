<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Pembayaran Hutang</h6>
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
					<th>Supplier</th>
					<th>Tanggal</th>
					<th>Hutang</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td>
						<div class="d-flex">
							<span>
								<div>Faktur</div>
								<div>Pembayaran</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>KPK-19/01/0001</b></div>
								<div><b>BK-1900001</b></div>
							</span>
						</div>
					</td>
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
								<div><b>PTJ1982</b></div>
								<div><b>PT. Tegak Jaya</b></div>
							</span>
						</div>
					</td>
					<td>
						<div class="d-flex">
							<span>
								<div>Pembelian</div>
								<div>Tempo</div>
								<div>Pembayaran</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>2019-02-01</b></div>
								<div><b>2019-02-16</b></div>
								<div><b>2019-02-15</b></div>
							</span>
						</div>
					</td>
					<td>
						<div class="d-flex">
							<span>
								<div>Hutang</div>
								<div>Dibayarkan</div>
								<div>Sisa</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>Rp 8.000.000</b></div>
								<div><b>Rp 8.000.000</b></div>
								<div><b>Rp 0</b></div>
							</span>
						</div>
					</td>
					<td>Lunas</td>
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