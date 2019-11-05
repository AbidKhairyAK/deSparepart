@extends('app')

@section('title', $title)

@section('content')

@include('components.'.$main.'.table')
@include('layouts.multi')

@endsection

@section('script')
<script src="/js/multi.js"></script>
<script type="text/javascript">

	var table;
	$(document).ready(function() {
		table = $('.table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{$ajax}}',
            order: [[1,'asc']],
	        columns: [
            	{ data: 'customer' },
            	{ data: 'total_piutang' },
            	{ data: 'jatuh_tempo_terdekat' },
	            { data: 'transaksi' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	    });
	});
</script>
@endsection