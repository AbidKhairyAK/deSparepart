@extends('app')

@section('title', 'Beranda')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Beranda</h1>
	<p class="mb-4">Ringkasan data sistem</p>
</div>

<form>
	tampilkan data dari tanggal: <input style="width: 150px;" 
				name="range_from"
				class="datepicker form-control form-control-sm d-inline-block" 
				value="{{ request()->get('range_from') }}"
			>
	sampai tanggal: <input style="width: 150px;" 
				name="range_to" 
				class="datepicker form-control form-control-sm d-inline-block" 
				value="{{ request()->get('range_to') }}"
			>
	<button class="btn btn-sm btn-primary">submit</button>
</form>
<hr>

@include('components.beranda.card')
@include('components.beranda.chart')
<hr>
@include('components.beranda.table')

@endsection

@section('script')
@include('components.beranda.chart-js')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
