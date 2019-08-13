<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Penjual</h6>
		<div>
			<a href="#" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Penjual</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Kontak</th>
					<th>Pemasok</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td>
						<div><b>AKLSDJ</b></div>
						<div><b>Ahmad Bambang</b></div>
					</td>
					<td>
						<div>Jl. Kampung Jangka</div>
						<div>Bulukumba</div>
						<div>Sulawesi Selatan</div>
					</td>
					<td>
						<div><i class="fas fa-mobile-alt mr-1"></i> +62832 7812 1982</div>
						<div><i class="fas fa-mobile-alt mr-1"></i> +62893 8392 4783</div>
					</td>
					<td>
						<div>SBYUAD</div>
						<div>PT Mobil Gerek</div>
					</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Edit</a>
								<a class="dropdown-item" href="#">Nonaktifkan</a>
								<a class="dropdown-item" href="#">Hapus</a>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div><b>OUWIER</b></div>
						<div><b>Sebas Tian</b></div>
					</td>
					<td>
						<div>Jl. Sultan Bambang</div>
						<div>Sleman</div>
						<div>DIY</div>
					</td>
					<td>
						<div><i class="fas fa-mobile-alt mr-1"></i> +62129 1839 7485</div>
						<div><i class="fas fa-mobile-alt mr-1"></i> +62378 2934 4829</div>
					</td>
					<td>
						<div>ZXCNKJ</div>
						<div>PT Mesin Bambang</div>
					</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Edit</a>
								<a class="dropdown-item" href="#">Nonaktifkan</a>
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