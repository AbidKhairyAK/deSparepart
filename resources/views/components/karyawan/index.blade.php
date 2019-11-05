@extends('app')

@section('title', 'Karyawan')

@section('content')

@include('components.karyawan.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
