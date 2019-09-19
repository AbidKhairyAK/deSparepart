@extends('app')

@section('title', 'Form Barang')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Form Barang</h1>
	<p class="mb-4">form yang digunakan untuk input data barang</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form Barang</h6>
	</div>
	<div class="card-body">
		
		<div class="row">
			<div class="col-sm-8">
				<div class="row">

					<div class="form-group col-sm-6">
						<label>Komponen / Part:</label>
						<select class="form-control select2">
							<option></option>
							<option>90KJDS - Pelek Ulti</option>
							<option>KLA876 - Ban Super</option>
							<option>67ADOI - Spion Wadidaw</option>
							<option>178JDK - Setir Eleleh</option>
						</select>
					</div>
					<div class="form-group col-sm-6">
						<label>Merk:</label>
						<select class="form-control select2">
							<option></option>
							<option>V-Gen</option>
							<option>Kingston</option>
							<option>Sandisk</option>
							<option>Toshiba</option>
							<option>HP</option>
						</select>
					</div>

					<div class="form-group col-sm-12">
						<label>Tipe Kendaraan:</label>
						<select class="form-control select2">
							<option></option>
							<option>Honda SupraFit XX 2011</option>
							<option>Honda CRV 2015</option>
							<option>Daihatsu Ayla 2013</option>
							<option>Polygon Ambyarr 2001</option>
							<option>Yamaha Rossi46 2019</option>
						</select>
					</div>

					<div class="form-group col-sm-4">
						<label>Jumlah Stock:</label>
						<input type="number" class="form-control">
					</div>
					<div class="form-group col-sm-4">
						<label>Satuan:</label>
						<select class="form-control select2">
							<option></option>
							<option>Batang</option>
							<option>Buah</option>
							<option>Box</option>
							<option>Sachet</option>
							<option>Liter</option>
							<option>Meter</option>
						</select>
					</div>
					<div class="form-group col-sm-4">
						<label>Stock Limit:</label>
						<input type="number" class="form-control">
					</div>

					<div class="form-group col-sm-6">
						<label>Harga Beli:</label>
						<input type="number" class="form-control">
					</div>
					<div class="form-group col-sm-6">
						<label>Harga Jual:</label>
						<input type="number" class="form-control">
					</div>

					<div class="form-group col-sm-12">
						<label>Keterangan:</label>
						<textarea class="form-control" rows="4"></textarea>
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