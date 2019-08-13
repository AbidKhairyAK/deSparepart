@extends('app')

@section('not found')

@section('content')
<!-- 404 Error Text -->
<div class="text-center">
	<div class="error mx-auto" data-text="404">404</div>
	<p class="lead text-gray-800 mb-5">Page Not Found</p>
	<p class="text-gray-500 mb-0">Maaf, halaman tidak ditemukan...</p>
	<a href="{{ url('/') }}">&larr; ke beranda</a>
</div>
@endsection