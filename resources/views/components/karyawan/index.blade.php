@extends('app')

@section('title', 'Karyawan')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Karyawan</h1>
	<p class="mb-4">Daftar data karyawan</p>
</div>

@include('components.karyawan.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
