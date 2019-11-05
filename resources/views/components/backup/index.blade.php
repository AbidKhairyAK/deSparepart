@extends('app')

@section('title', 'Backup')

@section('content')

@include('components.backup.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection