@extends('app')

@section('title', 'Hutang')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar Hutang</h1>
	<p class="mb-4">Daftar data hutang</p>
</div>

@include('components.hutang.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
