@extends('app')

@section('title', 'Form Pengguna')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Form Pengguna</h1>
	<p class="mb-4">form yang digunakan untuk input data pengguna</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form Pengguna</h6>
	</div>
	<div class="card-body">
		
		<div class="row">
			<div class="col-sm-8">
				<div class="row">

					<div class="form-group col-sm-12">
						<label>Username:</label>
						<input type="text" class="form-control">
					</div>

					<div class="form-group col-sm-12">
						<label>Email:</label>
						<input type="text" class="form-control">
					</div>

					<div class="form-group col-sm-6">
						<label>Password:</label>
						<input type="password" class="form-control">
					</div>
					<div class="form-group col-sm-6">
						<label>Ulangi Password:</label>
						<input type="password" class="form-control">
					</div>

					<div class="form-group col-sm-12">
						<label>Role:</label>
						<select class="form-control">
							<option></option>
							<option>Admin</option>
							<option>Kasir</option>
							<option>Gudang</option>
							<option>Karyawan</option>
						</select>
					</div>

					<div class="form-group col-sm-4">
						<label>Status:</label>
						<br>
						<label class="pr-3 d-inline-flex align-items-center">
							<input type="radio" name="pkp">
							Aktif
						</label>
						<label class="pr-3 d-inline-flex align-items-center">
							<input type="radio" name="pkp">
							Nonaktif
						</label>
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