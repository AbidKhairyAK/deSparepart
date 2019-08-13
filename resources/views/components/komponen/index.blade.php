@extends('app')

@section('title', 'Komponen')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Komponen</h1>
	<p class="mb-4">Daftar data komponen</p>
</div>

@include('components.komponen.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection