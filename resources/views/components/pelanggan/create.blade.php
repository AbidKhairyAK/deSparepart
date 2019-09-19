@extends('app')

@section('title', 'Form Pelanggan')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Form Pelanggan</h1>
	<p class="mb-4">form yang digunakan untuk input data pelanggan</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form Pelanggan</h6>
	</div>
	<div class="card-body">
		
		<div class="row">
			<div class="col-sm-8">
				<div class="row">

					<div class="form-group col-sm-12">
						<label>Nama Pelanggan:</label>
						<input type="text" class="form-control">
					</div>

					<div class="form-group col-sm-12">
						<label>Nama Toko <small>(optional)</small>:</label>
						<input type="text" class="form-control">
					</div>

					<div class="form-group col-sm-12">
						<label>Alamat:</label>
						<input type="text" class="form-control">
					</div>

					<label class="col-sm-12">Kontak:</label>
					<div class="form-group col-sm-3">
						<select class="form-control">
							<option>No Handphone</option>
							<option>Telepon</option>
							<option>Email</option>
							<option>Web</option>
							<option>Sosmed</option>
							<option>Fax</option>
						</select>
					</div>
					<div class="form-group col-sm-9">
						<input type="text" class="form-control">
					</div>
					<div class="form-group col-sm-3">
						<select class="form-control">
							<option>No Handphone</option>
							<option>Telepon</option>
							<option selected>Email</option>
							<option>Web</option>
							<option>Sosmed</option>
							<option>Fax</option>
						</select>
					</div>
					<div class="form-group col-sm-9">
						<input type="text" class="form-control">
					</div>
					<div class="col-sm-12 mb-3">
						<button class="btn btn-sm btn-block text-right"><i class="fas fa-plus"></i> Tambah Kontak</button>
					</div>

					<div class="form-group col-sm-12">
						<label>Kategori:</label>
						<select class="form-control">
							<option></option>
							<option>Bengkel</option>
							<option>Umum</option>
							<option>Toko</option>
							<option>Kategori 4</option>
							<option>Kategori 5</option>
						</select>
					</div>

				</div>

				<div class="float-right">
					<button type="submit" class="btn btn-sm btn-secondary px-5">Cancel</button>
					<button type="submit" class="btn btn-sm btn-primary px-5">Submit</button>
				</div>

			</div>
		</div>

	</div>
</div>
@endsection