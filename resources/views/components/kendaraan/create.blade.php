@extends('app')

@section('title', 'Form Kendaraan')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Form Kendaraan</h1>
	<p class="mb-4">form yang digunakan untuk input data kendaraan</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form Kendaraan</h6>
	</div>
	<div class="card-body">
		
		<div class="row">
			<div class="col-sm-8">
				<div class="row">

					<div class="form-group col-sm-12">
						<label>Tipe:</label>
						<br>
						<label class="pr-3 d-inline-flex align-items-center">
							<input type="radio" name="pkp">
							Mobil
						</label>
						<label class="pr-3 d-inline-flex align-items-center">
							<input type="radio" name="pkp">
							Motor
						</label>
						<label class="pr-3 d-inline-flex align-items-center">
							<input type="radio" name="pkp">
							Sepeda
						</label>
					</div>

					<div class="form-group col-sm-6">
						<label>Merk:</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group col-sm-6">
						<label>Pabrikan:</label>
						<input type="text" class="form-control">
					</div>

					<div class="form-group col-sm-12">
						<label>Silinder:</label>
						<input type="number" class="form-control">
					</div>

					<div class="form-group col-sm-12">
						<label>Bahan Bakar:</label>
						<select class="form-control">
							<option></option>
							<option>Bensin</option>
							<option>Solar</option>
							<option>Pertamax</option>
							<option>Avtur</option>
							<option>Yg Lain 1</option>
							<option>Yg Lain 2</option>
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