@extends('app')

@section('title', 'Pembelian')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Pembelian</h1>
	<p class="mb-4">Daftar data riwayat pembelian</p>
</div>

@include('components.pembelian.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
