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
	        ajax: '{!!$ajax!!}',
            order: [[4,'asc']],
	        columns: [
	            { data: 'id', searchable: false, orderable: false },
                { data: 'user_id' },
                { data: 'auditable_type' },
            	{ data: 'event' },
	            { data: 'created_at' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
		        columnDefs: [{
		          "targets": 0,
		          "searchable": false,
		          "orderable": false,
		          "data": null,
		          // "title": 'No.',
		          "render": function (data, type, full, meta) {
		              return meta.settings._iDisplayStart + meta.row + 1;
		          }
		        }],
	    });
	});
</script>
@include('components.modal.filter_history')
@endsection
