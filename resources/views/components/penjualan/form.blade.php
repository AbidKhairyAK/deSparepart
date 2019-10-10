@extends('app')

@php $e = isset($m); @endphp

@section('title', 'Penjualan Barang')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Penjualan Barang</h1>
	<p class="mb-4">form untuk mendata penjualan barang</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Form Penjualan Barang</h6>
		<div>
			<a href="{{ url('penjualan') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-clipboard-list"></i> <b>Daftar Penjualan</b>
			</a>
			<a href="{{ url('barang') }}" class="btn btn-sm btn-warning">
				<i class="fas fa-cubes"></i> <b>Daftar Barang</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		<form id="form-penjualan" action="{{ $action }}" method="post">
			@csrf {{ $e ? method_field('PUT') : '' }}

			<div class="d-flex justify-content-between mb-3">
				<label>
					<b>NO FAKTUR : </b>
					<input name="no_faktur" type="text" class="form-control d-inline-block" style="width: auto;" value="{{ $e ? $m->no_faktur : $no_faktur }}" required>
				</label>

				<label>
					<b>NO PO : </b>
					<input name="no_po" type="text" class="form-control d-inline-block" style="width: auto;" value="{{ $e ? $m->no_po : '' }}">
				</label>

				<label>
					<b>TGL TRANSAKSI : {{ $e ? $m->created_at : date('Y-m-d H:i:s') }}</b>
				</label>
			</div>

			<div class="row">
				<div class="col-md-8">

					<table class="table border border-secondary">
						<thead class="thead-dark">
							<tr>
								<th width="150">Qty</th>
								<th width="150">Diskon %</th>
								<th>Harga Satuan</th>
								<th>Subtotal</th>
								<th>*</th>
							</tr>
						</thead>
						<tbody class="wrapper-barang">

							@php
								$d = $e ? $m->penjualan_detail()->get() : [];
								$l = $e ? count($d) : 1;
							@endphp
							@for($i=0; $i<$l; $i++)
							<tr class="barang{{ $i+1 }}">
								<td colspan="4">
									<select id="barang_id{{ $i+1 }}" name="barang_id[]" class="form-control select-barang barang_id" required>
										@if($e) 
											<option selected value="{{ $d[$i]->barang_id }}">
												{{ $d[$i]->part_no }} - {{ $d[$i]->nama }}
											</option>
										@endif
									</select>
								</td>
								<td style="vertical-align: middle;"><i class="fas fa-times" style="cursor: pointer;" onclick="remove_barang('.barang{{ $i+1 }}')"></i></td>
							</tr>
							<tr class="barang{{ $i+1 }}">
								<td><input id="qty{{ $i+1 }}" name="qty[]" type="number" value="{{ $e ? $d[$i]->qty : 1 }}" class="form-control form-control-sm qty" required></td>
								<td><input id="diskon{{ $i+1 }}" name="diskon[]" type="number" value="{{ $e ? $d[$i]->diskon : 0 }}" class="form-control form-control-sm diskon" required></td>
								<td><input id="harga{{ $i+1 }}" name="harga[]" type="text" value="{{ $e ? $d[$i]->harga : 0 }}" class="form-control form-control-sm maskin" readonly required></td>
								<td><input id="subtotal{{ $i+1 }}" name="subtotal[]" type="text" value="{{ $e ? $d[$i]->subtotal : 0 }}" class="form-control form-control-sm subtotal maskin" readonly required></td>
								<td></td>
							</tr>
							@endfor

							<tr class="last-barang">
								<td colspan="5">
									<button type="button" id="add-barang" class="btn btn-sm btn-block btn-light"><i class="fas fa-plus"></i> Tambah Baris</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<div class="custom-control custom-radio custom-control-inline">
						    <input type="radio" class="custom-control-input" id="p1" name="p" value="p1" checked>
						    <label class="custom-control-label" for="p1">Customer Lama</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="p0" name="p" value="p0">
							<label class="custom-control-label" for="p0">Customer Baru</label>
						</div>
					</div>

					<div class="p1">
						<div class="row mb-3">
							<span class="col-sm-3"><b>Customer:</b></span>
							<span class="col-sm-9">
								<select name="customer_id" class="p1 form-control select-customer" required>
									@if($e) 
										<option value="{{ $m->customer_id }}">
											{{ $m->customer->kode }} - {{ $m->customer->nama }}
										</option>
									@endif
								</select>
							</span>
						</div>
						<div class="row mb-3">
							<span class="col-sm-3"><b>Toko:</b></span>
							<span id="p-toko" class="col-sm-9">{{ $e ? $m->customer->toko : '-'}}</span>
						</div>
						<div class="row mb-3">
							<span class="col-sm-3"><b>Alamat:</b></span>
							<span id="p-alamat" class="col-sm-9">{{ $e ? $m->customer->alamat : '-'}}</span>
						</div>
						<div class="row mb-3">
							<span class="col-sm-3"><b>Kontak:</b></span>
							<span id="p-kontak" class="col-sm-9">{{ $e ? $m->customer->kontak_customer()->first()->kontak : '-'}}</span>
						</div>
					</div>

					<div class="p0">
						<div class="row mb-3">
							<span class="col-sm-3"><b>Nama:</b></span>
							<span class="col-sm-9"><input name="customer_nama" type="text" class="p0 form-control form-control-sm" required></span>
						</div>
						<div class="row mb-3">
							<span class="col-sm-3"><b>Toko:</b></span>
							<span class="col-sm-9"><input name="customer_toko" type="text" class="p0 form-control form-control-sm" required></span>
						</div>
						<div class="row mb-3">
							<span class="col-sm-3"><b>Alamat:</b></span>
							<span class="col-sm-9"><input name="customer_alamat" type="text" class="p0 form-control form-control-sm" required></span>
						</div>
						<div class="row mb-3">
							<span class="col-sm-3"><b>No HP:</b></span>
							<span class="col-sm-9"><input name="customer_hp" type="text" class="p0 form-control form-control-sm" required></span>
						</div>
					</div>

				</div>

				<div class="col-md-12"><hr></div>

				<div class="col-md-6">
					<div class="form-group">
						<label><b>TOTAL:</b></label>
						<input id="total" type="text" name="total" class="p-3 border border-primary text-primary w-100 maskin" value="{{ $e ? $m->total : 0 }}" style="font-size: 40px !important; font-weight: bold;" readonly required>
					</div>
					<div class="form-group">
						<label><b>KETERANGAN:</b></label>
						<textarea name="keterangan" class="form-control" rows="4">{{ $e ? $m->keterangan : '' }}</textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group d-flex align-items-center justify-content-between">
						<b>PEMBAYARAN:</b>
						<select name="pembayaran" class="form-control form-control-lg" style="width: 80%;" required>
							<option {{ $e && $m->pembayaran == 'tunai' ? 'selected' : ''}} value="tunai">TUNAI</option>
							<option {{ $e && $m->pembayaran == 'kredit' ? 'selected' : ''}} value="kredit">KREDIT (30 HARI)</option>
							<option {{ $e && $m->pembayaran == 'giro' ? 'selected' : ''}}  value="giro">GIRO</option>
							<option {{ $e && $m->pembayaran == 'transfer' ? 'selected' : ''}}  value="transfer">TRANSFER</option>
						</select>
					</div>
					<div id="pembayaran_giro" class="{{ $e && $m->pembayaran == 'giro' ? 'd-flex' : 'd-none' }} form-group align-items-center justify-content-between">
						<b>NO GIRO:</b>
						<input type="text" 
							name="pembayaran_detail" 
							class="form-control form-control-lg"
							style="width: 80%;"
							value="{{ $e && $m->pembayaran_detail ? $m->pembayaran_detail : '' }}" 
						>
					</div>
					<div class="form-group d-flex align-items-center justify-content-between">
						<b>DIBAYARKAN:</b>
						<input id="dibayarkan" name="dibayarkan" type="text" class="form-control form-control-lg maskin" style="width: 80%;" required value="{{ $e ? $m->dibayarkan : '' }}">
					</div>
					<div class="form-group d-flex align-items-center justify-content-between">
						<b>KEMBALIAN:</b>
						<input id="kembalian" type="text" class="form-control form-control-lg maskin" style="width: 80%;" readonly value="{{ $e && !($m->hutang > 0) ? $m->dibayarkan - $m->total : 0 }}">
					</div>
					<div class="form-group d-flex align-items-center justify-content-between">
						<b>HUTANG:</b>
						<input id="hutang" name="hutang" type="text" class="form-control form-control-lg maskin" style="width: 80%;" readonly value="{{ $e ? $m->hutang : 0 }}">
					</div>
					<div class="form-group d-flex align-items-center justify-content-between">
						<b>JATUH TEMPO:</b>
						<input name="jatuh_tempo" class="datepicker form-control form-control-lg" style="width: 80%;" value="{{ $e ? $m->jatuh_tempo : '' }}">
					</div>
				</div>

				<div class="col-sm-12">
					<div class="float-right">
						<a href="{{ $url }}" class="px-5 btn btn-danger">
							<i class="fas fa-times"></i> Batal
						</a>
						<button type="button" id="draft" class="px-5 btn btn-warning">
							<i class="fas fa-archive"></i> Draft
						</button>
						<button class="px-5 btn btn-primary">
							<i class="fas fa-save"></i> Simpan - Publish {{ !$e ? '- Cetak' : '' }}
						</button>
					</div>
				</div>

			</div>
			
			<input type="hidden" name="publish" value="1">
		</form>
	</div>
</div>
@endsection

@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha256-jO7D3fIsAq+jB8Xt3NI5vBf3k4tvtHwzp8ISLQG4UWU=" crossorigin="anonymous" />
<style type="text/css">
	.wrapper-barang tr:nth-child(even) td{
		border-top: 0;
	}
</style>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script type="text/javascript">
	function get_customer(index) {
		var detailcustomer = [];
		$.get(`/customer/api?id=${index}`)
		.done(function(data) {
			detailcustomer['toko'] = data.toko ? data.toko : '-';
			detailcustomer['alamat'] = data.alamat ? data.alamat : '-';
			detailcustomer['kontak'] = data.kontak_customer.length ? data.kontak_customer[0].kontak : '-';

			$('#p-toko').text(detailcustomer['toko']);
			$('#p-alamat').text(detailcustomer['alamat']);
			$('#p-kontak').text(detailcustomer['kontak']);
		});
	}
	function remove_barang(tag) {
		$(tag).remove();
		count_total();
		payin();
	}
	function select2_init() {
	    $('.select-barang').select2(select_barang).on('select2-open', function() { dropdown() });
	    $('.select-customer').select2(select_customer).on('select2-open', function() { dropdown() });
	}
	function check_p() {
    	var decision = $('input[name=p]:checked').val();
    	if (decision == "p0") {
    		$('.p1').hide();
    		$('select.p1').attr('disabled', 'true');
    		$('.p0').show();
    		$('input.p0').removeAttr('disabled');
    	} else {
    		$('.p1').show();
    		$('select.p1').removeAttr('disabled');
    		$('.p0').hide();
    		$('input.p0').attr('disabled', 'true');
    	}
    }
    function count_pay() {
    	$('.barang_id, .qty, .diskon').change(function() {
    		var id = $(this).attr('id').substr(-1);
    		var barang_id = $('#barang_id'+id).val();
    		var qty = $('#qty'+id).val();
    		var diskon = $('#diskon'+id).val();
    		var harga = listHarga[barang_id];
    		var harga_diskon = harga - (harga * diskon / 100);
    		var subtotal = harga_diskon * qty;

    		$('#harga'+id).val(harga_diskon);
    		$('#subtotal'+id).val(subtotal);
			
    		count_total();
			payin();
    	});
    }
    function payin() {
    		var dibayarkan = parseInt($('#dibayarkan').cleanVal());
    		var total = parseInt($('#total').cleanVal());

    		if (dibayarkan > total) {
    			var kembalian = dibayarkan - total;
    			var hutang = 0;
    		} else {
    			var kembalian = 0;
    			var hutang = total - dibayarkan;
    		}

    		$('#hutang').val(hutang);
    		$('#kembalian').val(kembalian);
    		$('.maskin').trigger('input');
    }
    function maskin() {
		$('.maskin').mask('0.000.000.000.000.000', {reverse: true});
		$('.diskon').mask('00', {reverse: true});
    }
    function count_total() {
    	var total=0;
		$('.subtotal').each(function(){
		    total += parseInt($(this).cleanVal());
		});
		$('#total').val(total);
		$('.maskin').trigger('input');
    }
	
	var listHarga = [];
	$.get('{{ route("barang.api") }}')
	.done(function(data) {
		$.map(data, function(item) {
			listHarga[item.id] = item.harga_jual;
		});
	});

	var select_barang = {
	  ajax: {
	    url: '{{ route("barang.api") }}',
	    data: function (params) {
	      return {
	        search: params.term,
	      }
	    },
	    processResults: function (data) {
	      return {
	        results: $.map(data, function (item) {
                return {
                    text: item.name,
                    id: item.id
                }
            })
	      };
	    }
	  }
	}
	var select_customer = {
	  ajax: {
	    url: '{{ route("customer.api") }}',
	    data: function (params) {
	      return {
	        search: params.term,
	      }
	    },
	    processResults: function (data) {
	      return {
	        results: $.map(data, function (item) {
                return {
                    text: item.name,
                    id: item.id
                }
            })
	      };
	    }
	  }
	}

	$(document).ready(function() {
		select2_init();
		count_pay();
		maskin();

		$('#draft').click(function() {
			$('input[name=publish]').val('0');
			$('#form-penjualan').submit();
		});
		
		$('#dibayarkan').keyup(function() {
			payin();
		});

		$('select[name=pembayaran]').change(function() {
			var newVal = "";
			if (this.value == 'kredit') {
				newVal = "{{ date('Y-m-d', strtotime(' + 30 days')) }}";
			}
			$('input[name=jatuh_tempo]').val(newVal);

			if (this.value == 'giro') {
				$('#pembayaran_giro').removeClass('d-none').addClass('d-flex');
			} else {
				$('#pembayaran_giro').removeClass('d-flex').addClass('d-none');
			}
		});

		$('.select-customer').change(function() { get_customer(this.value) });

	    $('.datepicker').datepicker({
	    	format: 'yyyy-mm-dd',
	    });

	    check_p();
	    $('input[name=p]').change(function() {
	    	check_p();
	    });

	    var no = 2;
	    $('#add-barang').click(function(){
			$(".last-barang").before(`
				<tr class="barang${no}">
					<td colspan="4">
						<select id="barang_id${no}" name="barang_id[]" class="form-control select-barang barang_id" required>
						</select>
					</td>
					<td><i class="fas fa-times" style="cursor: pointer;" onclick="remove_barang('.barang${no}')"></i></td>
				</tr>
				<tr class="barang${no}">
					<td><input id="qty${no}" name="qty[]" type="number" value="1" class="form-control form-control-sm qty" required></td>
					<td><input id="diskon${no}" name="diskon[]" type="number" value="0" class="form-control form-control-sm diskon maskin" required></td>
					<td><input id="harga${no}" name="harga[]" type="text" value="0" class="form-control form-control-sm maskin" readonly></td>
					<td><input id="subtotal${no}" name="subtotal[]" type="text" value="0" class="form-control form-control-sm subtotal maskin" readonly></td>
					<td></td>
				</tr>
			`);
			no++;
	    	select2_init();
	    	count_pay();
			maskin();
		});

	});
</script>
@endsection