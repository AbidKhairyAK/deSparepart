@extends('app')

@section('not found')

@section('content')
<!-- 404 Error Text -->
<div class="text-center">
	<div class="error mx-auto" data-text="401">401</div>
	<p class="lead text-gray-800 mb-5">Unauthorized Access</p>
	<p class="text-gray-500 mb-0">Maaf, anda tidak memiliki hak untuk mengakses halaman ini...</p>
	<a href="{{ url('/') }}">&larr; ke beranda</a>
</div>


@endsection