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
	        ajax: '{{ route($main.".data", $type) }}',
            order: [[1,'asc']],
			
			@if($type == 'barang')
	        columns: [
	            { data: 'id', searchable: false, orderable: false },
            	{ data: 'identitas' },
	            { data: 'qty' },
	            { data: 'biaya' },
	            { data: 'pembayaran' },
	            { data: 'created_at' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	        @elseif($type == 'penjualan')
	        columns: [
	            { data: 'id', searchable: false, orderable: false },
            	{ data: 'no_faktur' },
	            { data: 'barang' },
	            { data: 'biaya' },
	            { data: 'total' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	        @endif
	    });
	});
</script>
@endsection
