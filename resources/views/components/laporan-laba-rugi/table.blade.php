<div class="row">
	<div class="col-md-6">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex justify-content-between align-items-center">
				<h6 class="m-0 font-weight-bold text-secondary">Laporan Penjualan</h6>
				<div>
					<a href="#" class="btn btn-sm btn-primary">
						<i class="fas fa-print"></i> <b>Cetak</b>
					</a>
					<a href="#" class="btn btn-sm btn-warning">
						<i class="fas fa-eye"></i> <b>Lihat</b>
					</a>
				</div>
			</div>
			<div class="card-body">
				
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th>Tanggal</th>
							<th>Pembayaran</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						@for($i=0;$i<=2;$i++)
						<tr>
							<td>2019-07-23</td>
							<td>Kredit</td>
							<td>Rp 20.000.000</td>
						</tr>
						<tr>
							<td>2019-09-16</td>
							<td>Tunai</td>
							<td>Rp 12.000.000</td>
						</tr>
						@endfor
					</tbody>
					<tfoot class="table-secondary">
						<tr>
							<th>TOTAL</th>
							<th></th>
							<th>Rp 200.000.000</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex justify-content-between align-items-center">
				<h6 class="m-0 font-weight-bold text-secondary">Laporan Piutang</h6>
				<div>
					<a href="#" class="btn btn-sm btn-primary">
						<i class="fas fa-print"></i> <b>Cetak</b>
					</a>
					<a href="#" class="btn btn-sm btn-warning">
						<i class="fas fa-eye"></i> <b>Lihat</b>
					</a>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th>Tanggal</th>
							<th>Pembayaran</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						@for($i=0;$i<=2;$i++)
						<tr>
							<td>2019-07-23</td>
							<td>Kredit</td>
							<td>Rp 20.000.000</td>
						</tr>
						<tr>
							<td>2019-09-16</td>
							<td>Tunai</td>
							<td>Rp 12.000.000</td>
						</tr>
						@endfor
					</tbody>
					<tfoot class="table-secondary">
						<tr>
							<th>TOTAL</th>
							<th></th>
							<th>Rp 200.000.000</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>