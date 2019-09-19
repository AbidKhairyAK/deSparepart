<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Barang</h6>
		<div>
			<a href="{{ url('barang/create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Barang</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Gambar</th>
					<th>Part No</th>
					<th>Merk</th>
					<th>Type Kendaraan</th>
					<th>Jml Stock</th>
					<th>Satuan</th>
					<th>Stock Limit</th>
					<th>Hrg Beli</th>
					<th>Hrg Jual</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td><a target="_blank" href="https://imgx.gridoto.com/crop/0x0:0x0/700x465/photo/gridoto/2017/11/03/2961387798.jpg"><img width="50" src="https://imgx.gridoto.com/crop/0x0:0x0/700x465/photo/gridoto/2017/11/03/2961387798.jpg"></a></td>
					<td>92034-2930492</td>
					<td>V-Gen</td>
					<td>SupraFit XX</td>
					<td>30</td>
					<td>Buah</td>
					<td>5</td>
					<td><span class="badge badge-success">SAABULYHVWPP</span></td>
					<td><span class="badge badge-primary">IUABYWOVCWYC</span></td>
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
					<td><a target="_blank" href="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/medium//90/MTA-1940029/dny_head-lamp-avanza-2008--kanan-_full02.jpg"><img width="50" src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/medium//90/MTA-1940029/dny_head-lamp-avanza-2008--kanan-_full02.jpg"></a></td>
					<td>92034-2930492</td>
					<td>V-Gen</td>
					<td>Honda CRV</td>
					<td>10</td>
					<td>Buah</td>
					<td>2</td>
					<td><span class="badge badge-success">MISADIOIOIOI</span></td>
					<td><span class="badge badge-primary">APOPRIOIOIOI</span></td>
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