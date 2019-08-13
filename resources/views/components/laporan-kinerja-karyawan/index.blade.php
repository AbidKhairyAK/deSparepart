@extends('app')

@section('title', 'Laporan Kinerja Karyawan')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Laporan Kinerja Karyawan</h1>
	<p class="mb-4">Laporan kinerja karyawan selama periode yang ditentukan</p>
</div>

@include('components.laporan-kinerja-karyawan.table')
@include('components.laporan-kinerja-karyawan.chart')

@endsection

@section('script')
@include('components.laporan-kinerja-karyawan.chart-js')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
