@extends('app')

@section('title', 'Form Jabatan')

@section('content')

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form Jabatan</h6>
	</div>
	<div class="card-body">
		
		<div class="row">
			<div class="col-sm-8">
				<div class="row">

					<div class="form-group col-sm-12">
						<label>Nama Jabatan:</label>
						<input type="text" class="form-control">
					</div>

					<div class="form-group col-sm-12">
						<label>Deskripsi:</label>
						<textarea class="form-control" rows="5"></textarea>
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