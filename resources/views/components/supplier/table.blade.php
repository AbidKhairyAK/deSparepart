<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Supplier</h6>
		<div>
			<a href="{{ url('supplier/create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah Supplier</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Logo</th>
					<th>Identitas</th>
					<th>Alamat</th>
					<th>Kontak</th>
					<th>Pajak</th>
					<th>Kategori</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<=2;$i++)
				<tr>
					<td><a target="_blank" href="https://s.kaskus.id/r480x480/images/fjb/2015/04/16/jasa_pembuatan_desain_logo_perusahaan_murah_tidak_murahan_1157447_1429123045.JPG"><img width="50" src="https://s.kaskus.id/r480x480/images/fjb/2015/04/16/jasa_pembuatan_desain_logo_perusahaan_murah_tidak_murahan_1157447_1429123045.JPG"></a></td>
					<td>
						<div class="d-flex">
							<span>
								<div>Kode</div>
								<div>Perusahaan</div>
								<div>Pemilik</div>
								<div>CP</div>
							</span>
							<span class="px-2">
								<div>:</div>
								<div>:</div>
								<div>:</div>
								<div>:</div>
							</span>
							<span>
								<div><b>PMB</b></div>
								<div><b>PT. Santara</b></div>
								<div><b>Mardigu Wowiek</b></div>
								<div><b>Arif Rezky</b></div>
							</span>
						</div>
					</td>
					<td>
						<div>Jl. Sesama No.29</div>
						<div>Kel. Wedomartani</div>
						<div>Kec. Ngemplak</div>
						<div>Kab. Sleman</div>
					</td>
					<td>
						<div><i class="fas fa-mobile-alt mr-1"></i> +62832 7812 1982</div>
						<div><i class="fas fa-phone mr-1"></i> 021 17236</div>
						<div><i class="fas fa-fax mr-1"></i> 021 29222999</div>
					</td>
					<td>
						<div><b>NPWP</b> 12KLJ289H</div>
						<div><b>PKP</b> <span class="badge badge-primary">IYA</span></div>
					</td>
					<td>Importir</td>
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