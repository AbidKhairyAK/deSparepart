@extends('app')

@section('title', 'Penjual')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Penjual</h1>
	<p class="mb-4">Daftar data penjual</p>
</div>

@include('components.penjual.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection