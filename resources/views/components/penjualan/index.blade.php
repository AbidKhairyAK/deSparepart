@extends('app')

@section('title', 'Penjualan')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Penjualan</h1>
	<p class="mb-4">Daftar data riwayat penjualan</p>
</div>

@include('components.penjualan.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
