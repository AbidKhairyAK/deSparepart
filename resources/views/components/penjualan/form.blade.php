@extends('app')

@section('title', 'Penjualan Barang')

@section('content')

<div id="app-vue">
	<penjualan-form 
		barang_api="{{ route('barang.api') }}"
		customer_api="{{ route('customer.api') }}"
		form_api="{{ $action }}"
		no_faktur="{{ isset($id) ? null : $no_faktur }}"
		url="{{ url('') }}"
		date="{{ isset($id) ? null : date('Y-m-d H:i:s') }}"
		id="{{ isset($id) ? $id : 0 }}"
		next_tempo="{{ date('Y-m-d', strtotime(' + 30 days')) }}"
	>
		@csrf
		@if(isset($id)) @method('PUT') @endif
	</penjualan-form>
</div>

@endsection