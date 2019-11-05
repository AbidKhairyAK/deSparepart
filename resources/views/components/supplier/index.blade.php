@extends('app')

@section('title', 'Supplier')

@section('content')

@include('components.supplier.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
