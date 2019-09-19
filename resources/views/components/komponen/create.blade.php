@extends('app')

@section('title', 'Form Komponen')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Form Komponen</h1>
	<p class="mb-4">form yang digunakan untuk input data komponen</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form Komponen</h6>
	</div>
	<div class="card-body">
		
		<div class="row">
			<div class="col-sm-8">
				<div class="row">

					<div class="form-group col-sm-12">
						<label>Nama Komponen:</label>
						<input type="text" class="form-control">
					</div>

					<div class="form-group col-sm-12">
						<label>Untuk Tipe:</label>
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

					<div class="form-group col-sm-12">
						<label>Bagian:</label>
						<select class="form-control">
							<option></option>
							<option>Body</option>
							<option>Atap</option>
							<option>Dalam</option>
							<option>Bawah</option>
							<option>Ban</option>
							<option>Pintu</option>
							<option>Bagian Lain</option>
							<option>Bagian Lain</option>
							<option>Bagian Lain</option>
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