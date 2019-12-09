@extends('app')

@section('title', 'Pembelian Barang')

@section('content')

<div id="app-vue">
	<pembelian-form 
		barang_api="{{ route('barang.api') }}"
		supplier_api="{{ route('supplier.api') }}"
		form_api="{{ $action }}"
		url="{{ url('') }}"
		date="{{ isset($id) ? null : date('Y-m-d H:i:s') }}"
		id="{{ isset($id) ? $id : 0 }}"
		next_tempo="{{ date('Y-m-d', strtotime(' + 30 days')) }}"
	>
		@csrf
		@if(isset($id)) @method('PUT') @endif
	</pembelian-form>
</div>

<?php

?>

@endsection