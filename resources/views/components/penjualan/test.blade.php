@extends('app')

@section('title', 'Penjualan Barang')

@section('content')

<div id="app-vue">
	<penjualan-form 
		barang_api="{{ route('barang.api') }}"
		customer_api="{{ route('customer.api') }}"
	></penjualan-form>
</div>

@endsection