@extends('app')

@section('title', 'Laporan Penjualan')

@section('style')
<style type="text/css">
	.table td {
		text-align: right;
	}
	.table tr td:first-child {
		text-align: left;
	}
</style>
@endsection

@section('content')

<form>
	tipe: <select style="width: 150px;" 
				name="tipe"
				class="form-control form-control-sm d-inline-block" 
				value="{{ request()->get('tipe') }}"
			>
				<option>perbulan</option>
				<option>pertahun</option>
			</select>
	waktu: <input style="width: 150px;" 
				name="waktu"
				class="monthpicker picker form-control form-control-sm d-inline-block"
				value="{{ request()->get('waktu') }}"
			>
			<input style="width: 150px;" 
				name="ignore" 
				class="yearpicker picker form-control form-control-sm d-none"
				value="{{ date('Y') }}" 
			>
	<button class="btn btn-sm btn-primary">submit</button>
</form>

<hr>

<div class="row">
	<div class="col-md-6">@include('components.laporan-laba-rugi.table')</div>
	<div class="col-md-6">@include('components.laporan-laba-rugi.chart')</div>
</div>

@endsection

@section('script')
@include('components.laporan-laba-rugi.chart-js')
<script type="text/javascript">
	$('select[name=tipe]').change(function() {
		var val = $(this).val();
		if (val == 'pertahun') {
			$('.monthpicker').removeClass('d-inline-block').addClass('d-none').attr('name', 'ignore');
			$('.yearpicker').removeClass('d-none').addClass('d-inline-block').attr('name', 'waktu');
		} else {
			$('.monthpicker').removeClass('d-none').addClass('d-inline-block').attr('name', 'waktu');
			$('.yearpicker').removeClass('d-inline-block').addClass('d-none').attr('name', 'ignore');
		}
	})
</script>
@endsection
