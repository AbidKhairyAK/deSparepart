@extends('app')

@section('title', $title)

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Daftar {{ $title }}</h1>
	<p class="mb-4">Daftar data {{ $title }}</p>
</div>

@if(session()->has('print'))
<a href="{{ session('print') }}" target="_blank" class="print">klik ini bila faktur tidak otomatis terprint</a>
@endif

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
	            { data: 'id', searchable: false, orderable: false },
            	{ data: 'nomor' },
            	{ data: 'debitur' },
            	{ data: 'tanggal' },
	            { data: 'piutang' },
	            { data: 'status' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	    });

		@if(session()->has('print'))
	    $('.print')[0].click();
	    @endif
	    
	});
</script>
@endsection