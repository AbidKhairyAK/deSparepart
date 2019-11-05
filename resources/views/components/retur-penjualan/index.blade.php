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
	$(function() {
	    table = $('.table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{ route($main.".data") }}',
            order: [[1,'asc']],
			
	        columns: [
	            { data: 'id', searchable: false, orderable: false },
            	{ data: 'no_faktur' },
	            { data: 'barang' },
	            { data: 'biaya' },
	            { data: 'pembayaran' },
	            { data: 'created_at' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	    });
	});
</script>
@endsection
