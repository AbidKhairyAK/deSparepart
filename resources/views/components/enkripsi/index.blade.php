@extends('app')

@section('title', 'Enkripsi')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Enkripsi Angka</h1>
	<p class="mb-4">Daftar data enkripsi angka</p>
</div>

@include('components.enkripsi.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection