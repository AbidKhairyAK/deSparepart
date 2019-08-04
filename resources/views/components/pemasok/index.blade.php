@extends('app')

@section('title', 'Pemasok')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Pemasok</h1>
	<p class="mb-4">Daftar data Pemasok</p>
</div>

@include('components.pemasok.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
