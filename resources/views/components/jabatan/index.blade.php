@extends('app')

@section('title', 'Jabatan')

@section('content')

@include('components.jabatan.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection