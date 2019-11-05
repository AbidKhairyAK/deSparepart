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
		$('input[name=password]').val(null);
	});
</script>
@endsection