@extends('app')

@section('title', $title)

@section('content')
@if(session()->has('print'))
<a href="{{ session('print') }}" target="_blank" class="print">klik ini bila faktur tidak otomatis terprint</a>
@endif

@include('components.'.$main.'.table')
{{-- @include('layouts.multi') --}}

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
	        columns: [
	            // { data: 'id', searchable: false, orderable: false },
            	{ data: 'nomor' },
            	{ data: 'customer' },
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