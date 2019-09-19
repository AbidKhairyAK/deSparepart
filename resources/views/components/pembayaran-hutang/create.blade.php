@extends('app')

@section('title', 'Form Pembayaran Hutang')

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Form Pembayaran Hutang</h1>
	<p class="mb-4">form yang digunakan untuk input data pembayaran hutang</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form Pembayaran Hutang</h6>
	</div>
	<div class="card-body">
		
		<div class="row">
			<div class="col-sm-8">
				<div class="row">

					<div class="form-group col-sm-12">
						<label>No Faktur Hutang:</label>
						<div class="input-group">
						  <input type="text" class="form-control" placeholder="Cari Berdasarkan No Faktur..." value="19ASD78">
						  <div class="input-group-append">
						    <button class="btn btn-primary btn-sm" type="submit">
						    	<i class="fas fa-search"></i>
						    </button> 
						  </div>
						</div>
					</div>

					<div class="form-group col-sm-12">
						<label>Detail Transaksi:</label>
						<div class="p-2 border border-secondary">
							<div class="row">
								<div class="col-sm-4">
									<b>No Faktur:</b> 19ASD78
								</div>
								<div class="col-sm-4">
									<b>Ekspedisi:</b> EKSPEDISI UWU
								</div>
								<div class="col-sm-4">
									<b>Tanggal Transaksi:</b> 02-05-2019
								</div>
								<div class="col-sm-12">
									<table class="table table-bordered table-sm my-3">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode</th>
												<th>Nama Barang</th>
												<th>Qty</th>
												<th>Harga</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>KJSD89A</td>
												<td>Pelek Sepeda Super</td>
												<td>20</td>
												<td>50.000</td>
												<td>1.000.000</td>
											</tr>
											<tr>
												<td>2</td>
												<td>89DSAKL</td>
												<td>Ultra Gusi XX</td>
												<td>30</td>
												<td>20.000</td>
												<td>600.000</td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="5">TOTAL :</th>
												<th>1.600.000</th>
											</tr>
										</tfoot>
									</table>
								</div>
								<div class="col-sm-4">
									<b>Kreditur:</b> PT. Kinetik Super
								</div>
								<div class="col-sm-4">
									<b>Kreditur:</b> PT. Kinetik Super
								</div>
								<div class="col-sm-4">
									<b>Pembayaran:</b> GIRO
								</div>

							</div>
						</div>
					</div>

					<div class="form-group col-sm-3">
						<label>Total Hutang</label>
						<input type="number" class="form-control" value="600.000" readonly>
					</div>
					<div class="form-group col-sm-3">
						<label>Dibayarkan</label>
						<input type="number" class="form-control" value="600.000">
					</div>
					<div class="form-group col-sm-3">
						<label>Pembayaran</label>
						<select class="form-control">
							<option>TUNAI</option>
							<option>KREDIT</option>
							<option>GIRO</option>
						</select>
					</div>
					<div class="form-group col-sm-3">
						<label>Sisa Hutang</label>
						<input type="number" class="form-control" value="0" readonly>
					</div>

				</div>

				<div class="float-right">
					<button type="submit" class="btn btn-sm btn-secondary px-5">Cancel</button>
					<button type="submit" class="btn btn-sm btn-primary px-5">Submit</button>
				</div>

			</div>
		</div>

	</div>
</div>
@endsection