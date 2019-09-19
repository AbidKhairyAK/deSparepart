@extends('app')

@section('title', 'Kendaraan')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Kendaraan</h1>
	<p class="mb-4">Daftar data kendaraan</p>
</div>

@include('components.kendaraan.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection