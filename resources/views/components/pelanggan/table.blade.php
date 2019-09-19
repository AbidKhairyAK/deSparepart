<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Pelanggan</h6>
		<div>
			<a href="{{ url('pelanggan/create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Pelanggan</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Identitas</th>
					<th>Alamat</th>
					<th>Kontak</th>
					<th>Kategori</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td>
						<div class="d-flex">
							<span>
								<div>Kode</div>
								<div>Nama</div>
								<div>Toko</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>PMB</b></div>
								<div><b>Ahmad Yasir</b></div>
								<div><b>PT. Mobil Bekas</b></div>
							</span>
						</div>
					</td>
					<td>
						<div>Jl. Sesama No.29</div>	
						<div>Kel. Bimasa</div>	
						<div>Kec. Ruanda</div>	
						<div>Kota Semarang</div>
					</td>
					<td>
						<div><i class="fas fa-mobile-alt mr-1"></i> +62832 7812 1982</div>
						<div><i class="fas fa-phone mr-1"></i> 021 17236</div>
						<div><i class="fas fa-fax mr-1"></i> 021 29222999</div>
					</td>
					<td>Bengkel</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Edit</a>
								<a class="dropdown-item" href="#">Nonaktifkan</a>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="d-flex">
							<span>
								<div>Kode</div>
								<div>Nama</div>
								<div>Toko</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>PMB</b></div>
								<div><b>Risma Rumianti</b></div>
								<div><b>Toko Otoisma</b></div>
							</span>
						</div>
					</td>
					<td>
						<div>Jl. Sebeda No.29</div>	
						<div>Kel. Sabisa</div>	
						<div>Kec. Ngono</div>	
						<div>Kab. Mbantul</div>
					</td>
					<td>
						<div><i class="fas fa-mobile-alt mr-1"></i> +62812 1928 490</div>
						<div><i class="fas fa-phone mr-1"></i> -</div>
						<div><i class="fas fa-fax mr-1"></i> -</div>
					</td>
					<td>Toko</td>
					<td>
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Edit</a>
								<a class="dropdown-item" href="#">Nonaktifkan</a>
							</div>
						</div>
					</td>
				</tr>
				@endfor
			</tbody>
		</table>
	</div>
</div>