@extends('app')

@section('title', $title)

@section('content')

@include('components.'.$main.'.table')
@include('components.'.$main.'.modal-form')
{{-- @include('layouts.multi') --}}

@endsection

@section('script')
<script src="/js/multi.js"></script>
<script type="text/javascript">
	var table;
	$(function() {
	    table = $('#table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{$ajax}}',
            order: [[2,'desc']],
	        columns: [
	            // { data: 'id', searchable: false, orderable: false },
            	{ data: 'gambar' },
            	{ data: 'nomor' },
            	{ data: 'identitas' },
            	{ data: 'jumlah' },
            	{ data: 'harga' },
	            { data: 'action', searchable: false, orderable: false }
	        ],
	    });

	    $('.select2').select2({
			ajax: {
				url: `{{ route('barang.api') }}`,
				data: function (params) {
					return {
						search: params.term,
					}
				},
				processResults: function (data) {
					return {
						results: data.map((item) => {
							return {
									text: item.name,
									id: item.id
							}
						})
					};
				}
			}
		});
	});
</script>
@include('components.modal.stock_item')
@endsection
