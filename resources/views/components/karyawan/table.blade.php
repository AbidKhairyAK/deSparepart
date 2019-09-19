<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Karyawan</h6>
		<div>
			<a href="{{ url('karyawan/create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Karyawan</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Foto</th>
					<th>Identitas</th>
					<th>Alamat</th>
					<th>Kontak</th>
					<th>Status</th>
					<th>Tgl Masuk</th>
					<th>Tgl Resign</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td>
						<a target="_blank" href="https://content3.jdmagicbox.com/comp/pune/q6/020pxx20.xx20.140319143036.m3q6/catalogue/foto-house-kothrud-pune-photo-studios-8gmd2.jpg">
							<img width="50" src="https://content3.jdmagicbox.com/comp/pune/q6/020pxx20.xx20.140319143036.m3q6/catalogue/foto-house-kothrud-pune-photo-studios-8gmd2.jpg">
						</a>
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
								<div><b>AYRS</b></div>
								<div><b>Ahmad Yasir</b></div>
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
					<td><span class="badge badge-primary">Aktif</span></td>
					<td>02-05-2000</td>
					<td>-</td>
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
						<a target="_blank" href="https://cdn.idntimes.com/content-images/community/2019/07/65618223-758699687879274-467442218932946315-n-3e1ecfd84d09ea41874150832d725f41.jpg">
							<img width="50" src="https://cdn.idntimes.com/content-images/community/2019/07/65618223-758699687879274-467442218932946315-n-3e1ecfd84d09ea41874150832d725f41.jpg">
						</a>
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
								<div><b>KJ78</b></div>
								<div><b>Kanda Juanda</b></div>
							</span>
						</div>
					</td>
					<td>
						<div>Jl. Serampai No.29</div>	
						<div>Kel. Cekarang</div>	
						<div>Kec. Binsal</div>	
						<div>Kab. Tegal</div>
					</td>
					<td>
						<div><i class="fas fa-mobile-alt mr-1"></i> +6281 8932 7832</div>
						<div><i class="fas fa-phone mr-1"></i> 021 89134</div>
						<div><i class="fas fa-fax mr-1"></i> 021 98234789</div>
					</td>
					<td><span class="badge badge-warning">Nonaktif</span></td>
					<td>31-06-2008</td>
					<td>12-12-2012</td>
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