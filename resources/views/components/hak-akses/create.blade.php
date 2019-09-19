@extends('app')

@section('title', 'Form Hak Akses')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Form Hak Akses</h1>
	<p class="mb-4">form yang digunakan untuk input data hak akses</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form Hak Akses</h6>
	</div>
	<div class="card-body">
		
		<div class="row">
			<div class="col-sm-8">
				<div class="row">

					<div class="form-group col-sm-12">
						<label>Nama Hak Akses:</label>
						<input type="text" class="form-control">
					</div>

					<p class="col-sm-12">Kemampuan:</p>
					
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pembelian-lihat">
						<label class="custom-control-label" for="pembelian-lihat">lihat pembelian</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pembelian-tambah">
						<label class="custom-control-label" for="pembelian-tambah">tambah pembelian</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pembelian-edit">
						<label class="custom-control-label" for="pembelian-edit">edit pembelian</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pembelian-hapus">
						<label class="custom-control-label" for="pembelian-hapus">hapus pembelian</label>
					</div>
					
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="penjualan-lihat">
						<label class="custom-control-label" for="penjualan-lihat">lihat penjualan</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="penjualan-tambah">
						<label class="custom-control-label" for="penjualan-tambah">tambah penjualan</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="penjualan-edit">
						<label class="custom-control-label" for="penjualan-edit">edit penjualan</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="penjualan-hapus">
						<label class="custom-control-label" for="penjualan-hapus">hapus penjualan</label>
					</div>
					
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pemasok-lihat">
						<label class="custom-control-label" for="pemasok-lihat">lihat pemasok</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pemasok-tambah">
						<label class="custom-control-label" for="pemasok-tambah">tambah pemasok</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pemasok-edit">
						<label class="custom-control-label" for="pemasok-edit">edit pemasok</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pemasok-hapus">
						<label class="custom-control-label" for="pemasok-hapus">hapus pemasok</label>
					</div>
					
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pelanggan-lihat">
						<label class="custom-control-label" for="pelanggan-lihat">lihat pelanggan</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pelanggan-tambah">
						<label class="custom-control-label" for="pelanggan-tambah">tambah pelanggan</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pelanggan-edit">
						<label class="custom-control-label" for="pelanggan-edit">edit pelanggan</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3 mb-2">
						<input type="checkbox" class="custom-control-input" id="pelanggan-hapus">
						<label class="custom-control-label" for="pelanggan-hapus">hapus pelanggan</label>
					</div>
					
					<div class="custom-control custom-checkbox col-sm-3">
						<input type="checkbox" class="custom-control-input" id="dst-lihat">
						<label class="custom-control-label" for="dst-lihat">dst...</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3">
						<input type="checkbox" class="custom-control-input" id="dst-tambah">
						<label class="custom-control-label" for="dst-tambah">dst...</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3">
						<input type="checkbox" class="custom-control-input" id="dst-edit">
						<label class="custom-control-label" for="dst-edit">dst...</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3">
						<input type="checkbox" class="custom-control-input" id="dst-hapus">
						<label class="custom-control-label" for="dst-hapus">dst...</label>
					</div>
					
					<div class="custom-control custom-checkbox col-sm-3">
						<input type="checkbox" class="custom-control-input" id="dst-lihat">
						<label class="custom-control-label" for="dst-lihat">dst...</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3">
						<input type="checkbox" class="custom-control-input" id="dst-tambah">
						<label class="custom-control-label" for="dst-tambah">dst...</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3">
						<input type="checkbox" class="custom-control-input" id="dst-edit">
						<label class="custom-control-label" for="dst-edit">dst...</label>
					</div>
					<div class="custom-control custom-checkbox col-sm-3">
						<input type="checkbox" class="custom-control-input" id="dst-hapus">
						<label class="custom-control-label" for="dst-hapus">dst...</label>
					</div>

				</div>

				<div class="float-right mt-4">
					<button type="submit" class="btn btn-sm btn-secondary px-5">Cancel</button>
					<button type="submit" class="btn btn-sm btn-primary px-5">Submit</button>
				</div>

			</div>
		</div>

	</div>
</div>
@endsection