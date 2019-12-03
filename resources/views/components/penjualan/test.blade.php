@extends('app')

@section('title', 'Penjualan Barang')

@section('content')

<div id="app-vue">
	<penjualan-form 
		barang_api="{{ route('barang.api') }}"
		customer_api="{{ route('customer.api') }}"
		form_api="{{ $action }}"
		no_faktur="{{ $no_faktur }}"
		url="{{ url('') }}"
		date="{{ date('Y-m-d H:i:s') }}"
	>
		@csrf
	</penjualan-form>
</div>

@endsection