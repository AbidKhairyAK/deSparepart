@extends('app')

@section('title', $title)

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar {{ $title }}</h1>
	<p class="mb-4">Daftar data {{ $title }}</p>
</div>

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
            	{ data: 'debitur' },
            	{ data: 'total_piutang' },
            	{ data: 'jatuh_tempo_terdekat' },
	            { data: 'transaksi' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	    });
	});
</script>
@endsection