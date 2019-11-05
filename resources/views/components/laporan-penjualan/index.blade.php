@extends('app')

@section('title', 'Laporan Penjualan')

@section('content')

@include('components.laporan-penjualan.table')
@include('components.laporan-penjualan.chart')

@endsection

@section('script')
@include('components.laporan-penjualan.chart-js')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
