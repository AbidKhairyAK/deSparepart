@extends('app')

@section('title', 'Laporan Pembelian')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Laporan Pembelian</h1>
	<p class="mb-4">Laporan pembelian selama periode yang ditentukan</p>
</div>

@include('components.laporan-pembelian.table')
@include('components.laporan-pembelian.chart')

@endsection

@section('script')
@include('components.laporan-pembelian.chart-js')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
