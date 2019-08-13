@extends('app')

@section('title', 'Backup')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Backup</h1>
	<p class="mb-4">Daftar data backup</p>
</div>

@include('components.backup.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection