@extends('app')

@section('title', 'Mobil')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Mobil</h1>
	<p class="mb-4">Daftar data mobil</p>
</div>

@include('components.mobil.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection