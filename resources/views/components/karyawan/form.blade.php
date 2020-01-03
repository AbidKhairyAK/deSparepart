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
				{!! form_rest($form) !!}
				<div class="col-sm-12 fileinput fileinput-new" data-provides="fileinput">
				  <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
					<img src="{{ isset($oldImg) ? '/img_karyawan/'.$oldImg : 'https://via.placeholder.com/200x150.png?text=Pilih+Gambar' }}"  alt="...">
				  </div>
				  <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;"></div>
				  <div>
					<span class="btn btn-sm btn-outline-secondary btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="image" accept="image/*"></span>
					<a href="#" class="btn btn-sm btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
				  </div>
				</div>
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

@section('style')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script type="text/javascript">
	$('#gaji').mask('0.000.000.000.000.000', {reverse: true});
</script>
@endsection
