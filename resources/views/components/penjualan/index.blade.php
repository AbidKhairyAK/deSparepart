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
	$(function() {
	    table = $('.table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{$ajax}}',
            order: [[1,'asc']],
	        columns: [
	            { data: 'id', searchable: false, orderable: false },
            	{ data: 'nomor' },
            	{ data: 'pembeli', name: 'pelanggan.nama'},
            	{ data: 'tanggal' },
	            { data: 'biaya' },
	            // { data: 'kasir' },
	            { data: 'status' },
	            // { data: 'pembayaran' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	    });
	});
</script>
@endsection