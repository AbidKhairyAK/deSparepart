@extends('app')

@section('title', 'Pelanggan')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Pelanggan</h1>
	<p class="mb-4">Daftar data pelanggan</p>
</div>

@include('components.pelanggan.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
