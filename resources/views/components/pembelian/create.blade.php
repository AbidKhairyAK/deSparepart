@extends('app')

@section('title', 'Pembelian Barang')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Pembelian Barang</h1>
	<p class="mb-4">form untuk mendata Pembelian barang</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Form Pembelian Barang</h6>
		<div>
			<a href="{{ url('pembelian') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-clipboard-list"></i> <b>Daftar Pembelian</b>
			</a>
			<a href="{{ url('barang') }}" class="btn btn-sm btn-warning">
				<i class="fas fa-cubes"></i> <b>Daftar Barang</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		<div class="d-flex justify-content-between mb-3">
			<label>
				<b>NO FAKTUR : </b>
				<input type="text" class="form-control d-inline-block" style="width: auto;">
			</label>
			<label>
				<b>EKSPEDISI : </b>
				<input type="text" class="form-control d-inline-block" style="width: auto;">
			</label>
			<label>
				<b>TGL TRANSAKSI : </b>
				<input type="date" class="form-control d-inline-block" style="width: auto;">
			</label>
		</div>
		<div class="row">
			<div class="col-md-8">
				<table class="table border border-secondary">
					<thead class="thead-dark">
						<tr>
							<th>Kode - Nama Barang</th>
							<th width="100">Qty</th>
							<th width="200">Harga</th>
							<th width="200">Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<select class="form-control select2">
									<option></option>
									<option>A7987 - Pelek Super V-gen</option>
									<option selected>B9817 - Lampu Depan Sandisk</option>
									<option>CJKLS - Rantai Toshiba</option>
									<option>D98HJ - Ban Ultra Kingston</option>
									<option>E90AS - Setir Mobil Samsung</option>
								</select>
							</td>
							<td><input type="number" value="2" class="form-control form-control-sm"></td>
							<td><input type="number" value="100.000" class="form-control form-control-sm" readonly></td>
							<td><input type="number" value="200.000" class="form-control form-control-sm" readonly></td>
						</tr>
						<tr>
							<td>
								<select class="form-control select2">
									<option></option>
									<option>A7987 - Pelek Super V-gen</option>
									<option>B9817 - Lampu Depan Sandisk</option>
									<option>CJKLS - Rantai Toshiba</option>
									<option selected>D98HJ - Ban Ultra Kingston</option>
									<option>E90AS - Setir Mobil Samsung</option>
								</select>
							</td>
							<td><input type="number" value="8" class="form-control form-control-sm"></td>
							<td><input type="number" value="50.000" class="form-control form-control-sm" readonly></td>
							<td><input type="number" value="400.000" class="form-control form-control-sm" readonly></td>
						</tr>
						<tr>
							<td>
								<select class="form-control select2">
									<option></option>
									<option>A7987 - Pelek Super V-gen</option>
									<option>B9817 - Lampu Depan Sandisk</option>
									<option>CJKLS - Rantai Toshiba</option>
									<option>D98HJ - Ban Ultra Kingston</option>
									<option>E90AS - Setir Mobil Samsung</option>
								</select>
							</td>
							<td><input type="number" value="0" class="form-control form-control-sm"></td>
							<td><input type="number" value="0" class="form-control form-control-sm" readonly></td>
							<td><input type="number" value="0" class="form-control form-control-sm" readonly></td>
						</tr>
						<tr>
							<td colspan="3">
								<button class="btn btn-sm btn-block btn-light"><i class="fas fa-plus"></i> Tambah Baris</button>
							</td>
							<td colspan="1">
								<button class="btn btn-sm btn-block btn-primary"><i class="fas fa-plus"></i> Tambah Barang</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<div class="custom-control custom-radio custom-control-inline">
					    <input type="radio" class="custom-control-input" id="p1" name="p" value="p1" checked>
					    <label class="custom-control-label" for="p1">Supplier Lama</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" class="custom-control-input" id="p0" name="p" value="p0">
						<label class="custom-control-label" for="p0">Supplier Baru</label>
					</div>
				</div>

				<div class="p1">
					<div class="row mb-3">
						<span class="col-sm-3"><b>Perusahaan:</b></span>
						<span class="col-sm-9">
							<select class="form-control select2">
								<option></option>
								<option>PT. Gas Part</option>
								<option selected>PT. Vendur Motor</option>
								<option>PT. Mesin Surya</option>
							</select>
						</span>
					</div>
					<div class="row mb-3">
						<span class="col-sm-3"><b>Alamat:</b></span>
						<span class="col-sm-9">Jl. Kemerdekaan KM.12, Jakarta Selatan, DKI Jakarta</span>
					</div>
					<div class="row mb-3">
						<span class="col-sm-3"><b>No HP:</b></span>
						<span class="col-sm-9">0823 8234 0912</span>
					</div>
					<div class="row mb-3">
						<span class="col-sm-3"><b>FAX:</b></span>
						<span class="col-sm-9">021 82423</span>
					</div>
					<div class="row mb-3">
						<span class="col-sm-3"><b>Email:</b></span>
						<span class="col-sm-9">vendur@motor.com</span>
					</div>
				</div>

				<div class="p0">
					<div class="row mb-3">
						<span class="col-sm-3"><b>Perusahaan:</b></span>
						<span class="col-sm-9"><input type="text" class="form-control form-control-sm"></span>
					</div>
					<div class="row mb-3">
						<span class="col-sm-3"><b>Alamat:</b></span>
						<span class="col-sm-9"><input type="text" class="form-control form-control-sm"></span>
					</div>
					<div class="row mb-3">
						<span class="col-sm-3"><b>No HP:</b></span>
						<span class="col-sm-9"><input type="number" class="form-control form-control-sm"></span>
					</div>
					<div class="row mb-3">
						<span class="col-sm-3"><b>FAX:</b></span>
						<span class="col-sm-9"><input type="number" class="form-control form-control-sm"></span>
					</div>
					<div class="row mb-3">
						<span class="col-sm-3"><b>Email:</b></span>
						<span class="col-sm-9"><input type="email" class="form-control form-control-sm"></span>
					</div>
				</div>

			</div>

			<div class="col-md-12"><hr></div>

			<div class="col-md-6">
				<div class="form-group">
					<label><b>TOTAL:</b></label>
					<h1 class="p-3 border border-primary text-primary"><b>Rp 600.000,-</b></h1>
				</div>
				<div class="form-group">
					<label><b>KETERANGAN:</b></label>
					<textarea class="form-control" rows="4"></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group d-flex align-items-center justify-content-between">
					<b>PEMBAYARAN:</b>
					<select id="pembayaran" class="form-control form-control-lg" style="width: 80%;">
						<option value="tunai">TUNAI</option>
						<option value="kredit">KREDIT (30 HARI)</option>
						<option value="giro">GIRO</option>
						<option value="transfer">TRANSFER</option>
					</select>
				</div>
				<div id="pembayaran_giro" class="form-group d-none align-items-center justify-content-between">
					<b>NO GIRO:</b>
					<input type="text" class="form-control form-control-lg" style="width: 80%;">
				</div>
				<div class="form-group d-flex align-items-center justify-content-between">
					<b>DIBAYARKAN:</b>
					<input type="number" class="form-control form-control-lg" style="width: 80%;">
				</div>
				<div class="form-group d-flex align-items-center justify-content-between">
					<b>HUTANG:</b>
					<input type="number" class="form-control form-control-lg" style="width: 80%;" readonly>
				</div>
				<div class="form-group d-flex align-items-center justify-content-between">
					<b>JATUH TEMPO:</b>
					<input name="jatuh_tempo" type="date" class="form-control form-control-lg" style="width: 80%;">
				</div>
			</div>

			<div class="col-sm-12">
				<div class="float-right">
					<button class="px-5 btn btn-danger">
						<i class="fas fa-times"></i> Batal
					</button>
					<button class="px-5 btn btn-warning">
						<i class="fas fa-archive"></i> Draft
					</button>
					<button class="px-5 btn btn-primary">
						<i class="fas fa-save"></i> Simpan
					</button>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection

@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    $('.select2').select2();

	    function check_p() {
	    	var decision = $('input[name=p]:checked').val();
	    	if (decision == "p0") {
	    		$('.p1').hide();
	    		$('.p0').show();
	    	} else {
	    		$('.p0').hide();
	    		$('.p1').show();
	    	}
	    }

	    check_p();
	    $('input[name=p]').change(function() {
	    	check_p();
	    });

	    $('#pembayaran').change(function() {
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
	});
</script>
@endsection