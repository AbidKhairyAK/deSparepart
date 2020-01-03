@extends('app')

@section('title', 'Jabatan')

@section('content')

@include('components.jabatan.table')
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
            order: [],
	        columns: [
            	{ data: 'id'},
            	{ data: 'nama', searchable: true, orderable: true },
	            { data: 'deskripsi', searchable: false, orderable: false },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	    });

	});
</script>
@endsection
