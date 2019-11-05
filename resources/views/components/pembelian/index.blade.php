@extends('app')

@section('title', 'Pembelian')

@section('content')

@include('components.pembelian.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
