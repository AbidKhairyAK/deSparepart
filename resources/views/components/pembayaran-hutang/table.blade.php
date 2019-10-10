<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Nota Pelunasan Hutang</h6>
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
					<th>Nomor Pelunasan</th>
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
								<div>No Faktur</div>
								<div>Nota Lunas</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>139</b></div>
								<div><b>SI12NJ3</b></div>
							</span>
						</div>
						<hr class="my-2">
						<div class="d-flex">
							<span>
								<div>Nota Beli</div>
							</span>
							<span class="px-2">
								<div>:</div>
							</span>
							<span>
								<div><b>ST78123</b></div>
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
								<div><b>PTJ</b></div>
								<div><b>PT. Tegak Jaya</b></div>
							</span>
						</div>
					</td>
					<td>
						<div class="d-flex">
							<span>
								<div>Tanggal Beli</div>
								<div>Jatuh Tempo</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>2019-02-01</b></div>
								<div><b>2019-02-16</b></div>
							</span>
						</div>
					</td>
					<td>
						<div class="d-flex">
							<span>
								<div>Total Hutang</div>
								<div>Dibayarkan</div>
								<div>Sisa</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>Rp. 8.000.000</b></div>
								<div><b>Rp. 8.000.000</b></div>
								<div><b>Rp. 0</b></div>
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