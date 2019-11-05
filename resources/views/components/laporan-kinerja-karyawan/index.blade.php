@extends('app')

@section('title', 'Laporan Kinerja Karyawan')

@section('content')

@include('components.laporan-kinerja-karyawan.table')
@include('components.laporan-kinerja-karyawan.chart')

@endsection

@section('script')
@include('components.laporan-kinerja-karyawan.chart-js')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
