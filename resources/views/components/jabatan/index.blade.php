@extends('app')

@section('title', 'Jabatan')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Jabatan</h1>
	<p class="mb-4">Daftar data jabatan</p>
</div>

@include('components.jabatan.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection