@extends('app')

@section('title', 'Form Supplier')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Form Supplier</h1>
	<p class="mb-4">form yang digunakan untuk input data Supplier</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form Supplier</h6>
	</div>
	<div class="card-body">
		
		<div class="row">
			<div class="col-sm-8">
				<div class="row">

					<div class="form-group col-sm-12">
						<label>Nama Perusahaan:</label>
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

					<div class="form-group col-sm-8">
						<label>NPWP:</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group col-sm-4">
						<label>PKP:</label>
						<br>
						<label class="pr-3 d-inline-flex align-items-center">
							<input type="radio" name="pkp">
							Ya
						</label>
						<label class="pr-3 d-inline-flex align-items-center">
							<input type="radio" name="pkp">
							Tidak
						</label>
					</div>

					<div class="form-group col-sm-12">
						<label>Tempo Kredit:</label>
						<input type="text" class="form-control">
					</div>

					<div class="form-group col-sm-12">
						<label>Kategori:</label>
						<select class="form-control">
							<option></option>
							<option>Importir</option>
							<option>Kategori 2</option>
							<option>Kategori 3</option>
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