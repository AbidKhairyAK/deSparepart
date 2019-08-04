<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Nota Pelunasan Hutang</h6>
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
					<th>Tanggal</th>
					<th>Hutang</th>
					<th>Kasir</th>
					<th>Tgl Lunas</th>
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
								<div><b>PT. Barang Jaya</b></div>
							</span>
							<span>
								<div>No Faktur</div>
								<div>Nota Lunas</div>
								<div>Kreditur</div>
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
								<div>Tanggal Beli</div>
								<div>Jatuh Tempo</div>
							</span>
						</div></td>
					<td>Rp 8.000.000</td>
					<td>Bambang</td>
					<td>2019-04-26</td>
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
								<div><b>184</b></div>
								<div><b>KL98ASDK</b></div>
								<div><b>PT. Motor Selalu</b></div>
							</span>
							<span>
								<div>No Faktur</div>
								<div>No Nota</div>
								<div>Kreditur</div>
							</span>
						</div>
					</td>
					<td>
						<div class="d-flex justify-content-between flex-row-reverse">
							<span class="text-right">
								<div>: 2019-03-01</div>
								<div>: 2019-04-16</div>
							</span>
							<span>
								<div>Tanggal Beli</div>
								<div>Jatuh Tempo</div>
							</span>
						</div></td>
					<td>Rp 3.000.000</td>
					<td>Sutrisno</td>
					<td>2019-08-17</td>
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