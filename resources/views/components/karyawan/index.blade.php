@extends('app')

@section('title', 'Karyawan')

@section('content')

@include('components.karyawan.table')
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
				{ data: 'nama', searchable: false, orderable: false },
				{ data: 'jabatan_id', searchable: false, orderable: false },
				{ data: 'foto', searchable: false, orderable: false },
				{ data: 'phone', searchable: false, orderable: false },
				{ data: 'gaji', searchable: false, orderable: false },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	    });

	});
</script>
@endsection
