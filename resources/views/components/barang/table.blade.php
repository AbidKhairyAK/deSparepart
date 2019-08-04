<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Barang</h6>
		<div>
			<a href="#" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Barang</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Gambar</th>
					<th>Kode</th>
					<th>Mobil</th>
					<th>Dimensi</th>
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
					<td>
						<div class="d-flex justify-content-between flex-row-reverse">
							<span class="text-right">
								<div><b>31</b></div>
								<div><b>AVZWTI</b></div>
								<div><b>Toyota Avanza WTI</b></div>
							</span>
							<span>
								<div>Id</div>
								<div>Kode</div>
								<div>Nama</div>
							</span>
						</div>
					</td>
					<td>
						<div><b>Bearing</b></div>
						<div>Dimensi A : 10</div>
						<div>Dimensi B : 20</div>
						<div>Dimensi C : 30</div>
						<div>Dimensi D : 40</div>
					</td>
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
				@endfor
			</tbody>
		</table>
	</div>
</div>

@section('style')
<style type="text/css">
	.table td, .table th {
		font-size: 12px !important;
	}
</style>
@endsection