@extends('app')

@section('title', 'Enkripsi')

@section('content')

@include('components.enkripsi.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection