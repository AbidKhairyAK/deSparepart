@extends('app')

@section('title', 'Piutang')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Piutang</h1>
	<p class="mb-4">Daftar data riwayat piutang</p>
</div>

@include('components.piutang.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
