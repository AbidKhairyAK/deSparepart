@extends('app')

@section('title', $title)

@section('content')

@include('components.'.$main.'.table')
{{-- @include('layouts.multi') --}}

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
	            // { data: 'id', searchable: false, orderable: false },
            	{ data: 'username' },
	            { data: 'email' },
	            { data: 'role' },
	            { data: 'status' },
	            { data: 'last_login' },
	            { data: 'created_at' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	    });
	});
</script>
@endsection
