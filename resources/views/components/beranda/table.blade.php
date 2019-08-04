<div class="row">
	<div class="col-md-6">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-secondary">Piutang Bulan Ini</h6>
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
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-secondary">Hutang Bulan Ini</h6>
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
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-secondary">Detail Daftar Stok Limit</h6>
			</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th>Gambar</th>
							<th>Kode</th>
							<th>Mobil</th>
							<th>Stok</th>
							<th>Satuan</th>
							<th>Kondisi</th>
							<th>Kualitas</th>
							<th>Harga Beli</th>
							<th>Harga Jual</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@for($i=0;$i<=2;$i++)
						<tr>
							<td><a target="_blank" href="https://imgx.gridoto.com/crop/0x0:0x0/700x465/photo/gridoto/2017/11/03/2961387798.jpg"><img width="50" src="https://imgx.gridoto.com/crop/0x0:0x0/700x465/photo/gridoto/2017/11/03/2961387798.jpg"></a></td>
							<td>
								<b>32HJ1239</b><br>Rem Kaki
							</td>
							<td>Toyota Kijang</td>
							<td>10</td>
							<td>Buah</td>
							<td><span class="badge badge-primary">BAIK</span></td>
							<td>Original</td>
							<td><span class="badge badge-success">MISADIOIOIOI</span></td>
							<td>
								<div class="row">
									<span class="col-5">Harga</span><span class="col-1">:</span><span class="col-5 text-right">Rp 2.000.000</span>
								</div>
								<div class="row">
									<span class="col-5">Rekomendasi</span><span class="col-1">:</span><span class="col-5 text-right">Rp 2.200.000</span>
								</div>
							</td>
							<td>
								<div class="dropdown no-arrow">
									<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
										<i class="fas fa-cogs"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right shadow">
										<a class="dropdown-item" href="#">Detail</a>
										<a class="dropdown-item" href="#">Hapus</a>
										<a class="dropdown-item" href="#">Action</a>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td><a target="_blank" href="https://ecs7.tokopedia.net/img/cache/700/product-1/2019/2/19/21249751/21249751_290e775e-ca8d-414e-a73b-7b8648be43d8_476_451.jpg"><img width="50" src="https://ecs7.tokopedia.net/img/cache/700/product-1/2019/2/19/21249751/21249751_290e775e-ca8d-414e-a73b-7b8648be43d8_476_451.jpg"></a></td>
							<td>
								<b>89SDF67D</b><br>Pelek Ban
							</td>
							<td>Honda CRV</td>
							<td>5</td>
							<td>Set</td>
							<td><span class="badge badge-primary">BAIK</span></td>
							<td>KW 5</td>
							<td><span class="badge badge-success">JAKDJFLAKLKK</span></td>
							<td>
								<div class="row">
									<span class="col-5">Harga</span><span class="col-1">:</span><span class="col-5 text-right">Rp 1.500.000</span>
								</div>
								<div class="row">
									<span class="col-5">Rekomendasi</span><span class="col-1">:</span><span class="col-5 text-right">Rp 1.200.000</span>
								</div>
							</td>
							<td>
								<div class="dropdown no-arrow">
									<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
										<i class="fas fa-cogs"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right shadow">
										<a class="dropdown-item" href="#">Detail</a>
										<a class="dropdown-item" href="#">Hapus</a>
										<a class="dropdown-item" href="#">Action</a>
									</div>
								</div>
							</td>
						</tr>
						@endfor
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>