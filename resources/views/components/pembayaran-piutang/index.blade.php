@extends('app')

@section('title', 'Nota Pelunasan Piutang')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Nota Pelunasan Piutang</h1>
	<p class="mb-4">Daftar data riwayat nota pelunasan piutang</p>
</div>

@include('components.pembayaran-piutang.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
