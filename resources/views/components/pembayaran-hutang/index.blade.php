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
	        columns: [
	            { data: 'id', searchable: false, orderable: false },
            	{ data: 'nomor' },
            	{ data: 'supplier' },
            	{ data: 'tanggal' },
	            { data: 'hutang' },
	            { data: 'status' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	    });

	});
</script>
@endsection