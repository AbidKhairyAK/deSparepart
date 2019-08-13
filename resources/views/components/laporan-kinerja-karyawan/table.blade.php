<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Laporan Kinerja Karyawan</h6>
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
					<th>Foto</th>
					<th>Kode</th>
					<th>Nama Karyawan</th>
					<th>Alamat</th>
					<th>HP 1</th>
					<th>HP 2</th>
					<th>Status Nikah</th>
					<th>Total Nota</th>
					<th>Penjualan</th>
					<th>Keuntungan</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=5;$i++)
				<tr>
					<td><a target="_blank" href="https://imgx.gridoto.com/crop/0x0:0x0/700x465/photo/gridoto/2017/11/03/2961387798.jpg"><img width="50" src="https://imgx.gridoto.com/crop/0x0:0x0/700x465/photo/gridoto/2017/11/03/2961387798.jpg"></a></td>
					<td>JSC21</td>
					<td>Jefri Sugiharto</td>
					<td>Jl. Pahlawan, Sleman</td>
					<td>+62893 7281 3289</td>
					<td>+62832 7584 6127</td>
					<td>Menikah</td>
					<td>12</td>
					<td>Rp 2.102.883</td>
					<td>Rp 2.102.883</td>
				</tr>
				@endfor
			</tbody>
		</table>
	</div>
</div>