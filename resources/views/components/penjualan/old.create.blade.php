@extends('app')

@section('title', 'Penjualan Barang')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Penjualan Barang</h1>
	<p class="mb-4">form untuk mendata penjualan barang</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Form Penjualan Barang</h6>
		<div>
			<a href="#" class="btn btn-sm btn-primary">
				<i class="fas fa-clipboard-list"></i> <b>Daftar Penjualan</b>
			</a>
			<a href="#" class="btn btn-sm btn-warning">
				<i class="fas fa-cubes"></i> <b>Daftar Barang</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		<div class="d-flex justify-content-between mb-3">
			<label>
				<b>NO NOTA : </b>
				<input type="text" class="form-control d-inline-block" style="width: auto;" value="BJ343NLK">
			</label>
			<label>
				<b>TGL TRANSAKSI : </b>
				<input type="date" class="form-control d-inline-block" style="width: auto;" value="2019-12-30">
			</label>
		</div>
		<div class="row">
			<div class="col-md-6">
				<h5>Data Pelanggan</h5>
				<hr>
				<div class="input-group mb-3">
				  <input type="text" class="form-control" placeholder="Cari Pelanggan...">
				  <div class="input-group-append">
				    <button class="btn btn-primary btn-sm" type="submit">
				    	<i class="fas fa-search"></i>
				    </button> 
				  </div>
				</div>
				<label class="row">
					<span class="col-sm-4">Nama Pelanggan</span>
					<span class="col-sm-8"><input type="text" class="form-control" value="UMUM"></span>
				</label>
				<label class="row">
					<span class="col-sm-4">Alamat</span>
					<span class="col-sm-8"><input type="text" class="form-control" value="UMUM"></span>
				</label>
				<label class="row">
					<span class="col-sm-4">Telp</span>
					<span class="col-sm-8"><input type="text" class="form-control" value="UMUM"></span>
				</label>
			</div>
			<div class="col-md-6">
				<h5>Pembayaran</h5>
				<hr>
				<label class="row">
					<span class="col-sm-4">Jenis Pembayaran</span>
					<span class="col-sm-8">
						<select class="form-control">
							<option>Tunai</option>
							<option>Kredit</option>
							<option>Giro</option>
						</select>
					</span>
				</label>
				<label class="row">
					<span class="col-sm-4">Total Pembayaran</span>
					<span class="col-sm-8">
						<h1 class="text-primary">Rp. 7.600.000</h1>
					</span>
				</label>
			</div>
			<div class="col-md-12 mt-3">
				<h5>List Barang</h5>
				<hr>

				<div class="row mb-3">
					<div class="input-group col-sm-8">
					  <input type="text" class="form-control form-control-lg border-primary" placeholder="Cari Barang...">
					  <div class="input-group-append">
					    <button class="btn btn-primary btn-sm px-5" type="submit">
					    	<i class="fas fa-search"></i>
					    </button>
					  </div>
					</div>

					<div class="col-sm-4">
						<a href="#" class="btn btn-primary btn-block">
							<i class="fas fa-plus"></i> Tambah Barang
						</a>
					</div>
				</div>

				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th>Kode</th>
							<th>Nama Barang</th>
							<th>KD Mobil</th>
							<th>KD Pemasok</th>
							<th>Kualitas</th>
							<th>Qty</th>
							<th>Harga Modal</th>
							<th>Harga Jual</th>
							<th>Subtotal</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>AS7D8</td>
							<td>Rem Kaki</td>
							<td>AS787D</td>
							<td>LK789FD</td>
							<td>Original</td>
							<td>200</td>
							<td>Rp 30.000</td>
							<td>Rp 35.000</td>
							<td>6.000.000</td>
							<td>
								<div class="dropdown no-arrow">
									<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
										<i class="fas fa-cogs"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right shadow">
										<a class="dropdown-item" href="#">Batal</a>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>9D123K</td>
							<td>Lampu Depan</td>
							<td>89FSDF</td>
							<td>12SJKDHF</td>
							<td>Original</td>
							<td>40</td>
							<td>Rp 40.000</td>
							<td>Rp 55.000</td>
							<td>1.600.000</td>
							<td>
								<div class="dropdown no-arrow">
									<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
										<i class="fas fa-cogs"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right shadow">
										<a class="dropdown-item" href="#">Batal</a>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>

				<hr>

				<div class="row">
					<div class="col-sm-3 form-group">
						<label>Total</label>
						<input type="text" name="total" class="form-control" value="7.600.000" readonly>
					</div>
					<div class="col-sm-3 form-group">
						<label>Dibayarkan</label>
						<input type="number" name="total" class="form-control">
					</div>
					<div class="col-sm-3 form-group">
						<label>Kembalian</label>
						<input type="number" name="total" class="form-control" readonly>
					</div>
					<div class="col-sm-3 form-group">
						<label>Hutang</label>
						<input type="number" name="total" class="form-control" readonly>
					</div>
				</div>

				<div class="float-right">
					<button class="btn btn-danger">
						<i class="fas fa-times"></i> Batal
					</button>
					<button class="btn btn-warning">
						<i class="fas fa-archive"></i> Draft
					</button>
					<button class="btn btn-primary">
						<i class="fas fa-save"></i> Simpan
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection