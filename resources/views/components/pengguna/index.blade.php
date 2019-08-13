@extends('app')

@section('title', 'Pengguna')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Pengguna</h1>
	<p class="mb-4">Daftar data pengguna</p>
</div>

@include('components.pengguna.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
