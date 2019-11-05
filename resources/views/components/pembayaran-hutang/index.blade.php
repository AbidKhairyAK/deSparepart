@extends('app')

@section('title', 'Pembayaran Hutang')

@section('content')

@include('components.pembayaran-hutang.table')

@endsection

@section('script')
<script type="text/javascript">
	$('.table').DataTable();
</script>
@endsection
