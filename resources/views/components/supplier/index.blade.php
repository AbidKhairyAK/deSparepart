@extends('app')

@section('title', 'Supplier')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Supplier</h1>
	<p class="mb-4">Daftar data Supplier</p>
</div>

@include('components.supplier.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
