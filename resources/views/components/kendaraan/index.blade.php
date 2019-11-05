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
	        ajax: '{{$ajax}}',
            order: [[1,'asc']],
	        columns: [
	            { data: 'id', searchable: false, orderable: false },
            	{ data: 'kode' },
            	{ data: 'merk' },
            	{ data: 'pabrikan' },
            	{ data: 'tipe' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	    });
	});
</script>
@endsection
