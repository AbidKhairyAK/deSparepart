@extends('app')

@section('title', 'Hutang')

@section('content')

@include('components.hutang.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
