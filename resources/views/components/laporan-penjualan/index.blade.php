@extends('app')

@section('title', 'Laporan Penjualan')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Laporan Penjualan</h1>
	<p class="mb-4">Laporan penjualan selama periode yang ditentukan</p>
</div>

@include('components.laporan-penjualan.table')
@include('components.laporan-penjualan.chart')

@endsection

@section('script')
@include('components.laporan-penjualan.chart-js')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
