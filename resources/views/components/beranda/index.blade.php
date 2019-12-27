@extends('app')

@section('title', 'Beranda')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Beranda</h1>
	<p class="mb-4">Ringkasan data sistem</p>
</div>

@include('components.beranda.card')
@include('components.beranda.chart')
@include('components.beranda.table')

@endsection

@section('script')
@include('components.beranda.chart-js')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@include('components.modal.stock_item')
@endsection
