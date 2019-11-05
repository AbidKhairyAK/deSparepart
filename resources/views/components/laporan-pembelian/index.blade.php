@extends('app')

@section('title', 'Laporan Pembelian')

@section('content')

@include('components.laporan-pembelian.table')
@include('components.laporan-pembelian.chart')

@endsection

@section('script')
@include('components.laporan-pembelian.chart-js')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
