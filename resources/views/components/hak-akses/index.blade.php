@extends('app')

@section('title', 'Hak Akses')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Hak Akses</h1>
	<p class="mb-4">Daftar data hak akses</p>
</div>

@include('components.hak-akses.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection