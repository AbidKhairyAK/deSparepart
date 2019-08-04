@extends('app')

@section('title', 'Barang')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Barang</h1>
	<p class="mb-4">Daftar data barang</p>
</div>

@include('components.barang.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
