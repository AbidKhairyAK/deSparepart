@extends('app')

@section('title', "Form $title")

@section('content')

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form {{ $title }}</h6>
	</div>
	<div class="card-body">

		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		
		{!! form_start($form) !!}
		<div class="row">
			<div class="col-sm-8">

				<div class="row">
				{!! form_row($form->nama) !!}
				{!! form_row($form->toko) !!}
				{!! form_row($form->alamat) !!}

				<label class="col-sm-12">Kontak:</label>
				<div id="multi-contact" class="col-sm-12">

					@if(isset($tbl))
						@foreach($tbl->kontak_customer as $con)
							<div class="row">
								<div class="form-group col-sm-3">
									<select class="form-control" name="tipe[]" required>
										<option {{ $con->tipe == 'hp' ? 'selected' : '' }} value="hp">No Handphone</option>
										<option {{ $con->tipe == 'telepon' ? 'selected' : '' }} value="telepon">Telepon</option>
										<option {{ $con->tipe == 'email' ? 'selected' : '' }} value="email">Email</option>
										<option {{ $con->tipe == 'web' ? 'selected' : '' }} value="web">Web</option>
										<option {{ $con->tipe == 'sosmed' ? 'selected' : '' }} value="sosmed">Sosmed</option>
										<option {{ $con->tipe == 'fax' ? 'selected' : '' }} value="fax">Fax</option>
									</select>
								</div>
								<div class="form-group col-sm-9" >
									<input type="text" class="form-control" name="kontak[]" required value="{{ $con->kontak }}">
								</div>
							</div>
						@endforeach
					@else
						<div class="row">
								<div class="form-group col-sm-3">
									<select class="form-control" name="tipe[]" required>
										<option value="hp">No Handphone</option>
										<option value="telepon">Telepon</option>
										<option value="email">Email</option>
										<option value="web">Web</option>
										<option value="sosmed">Sosmed</option>
										<option value="fax">Fax</option>
									</select>
								</div>
								<div class="form-group col-sm-9" >
									<input type="text" class="form-control" name="kontak[]" required>
								</div>
							</div>
					@endif

				</div>
				<div class="col-sm-12 mb-3">
					<button type="button" id="add-contact" class="btn btn-sm btn-block text-right"><i class="fas fa-plus"></i> Tambah Kontak</button>
				</div>

				{!! form_row($form->kategori) !!}
				</div>

				<div class="float-right">
					<a href="{{ $url }}" class="btn btn-sm btn-secondary px-5">Cancel</a>
					<button type="submit" class="btn btn-sm btn-primary px-5">Submit</button>
				</div>

			</div>
		</div>
		{!! form_end($form) !!}

	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){

		$('#add-contact').click(function(){
			$("#multi-contact").append(`
				<div class="row">
					<div class="form-group col-sm-3">
						<select class="form-control" name="tipe[]" required>
							<option value="hp">No Handphone</option>
							<option value="telepon">Telepon</option>
							<option value="email">Email</option>
							<option value="web">Web</option>
							<option value="sosmed">Sosmed</option>
							<option value="fax">Fax</option>
						</select>
					</div>
					<div class="form-group col-sm-9" >
						<input type="text" class="form-control" name="kontak[]" required>
					</div>
				</div>
			`)
		});
	});
</script>
@endsection