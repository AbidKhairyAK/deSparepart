<template>
		<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex justify-content-between align-items-center">
				<h6 class="m-0 font-weight-bold text-secondary">Form Penjualan Barang</h6>
				<div>
						<a href="#" class="btn btn-sm btn-primary">
								<i class="fas fa-clipboard-list"></i> <b>Daftar Penjualan</b>
						</a>
						<a href="#" class="btn btn-sm btn-warning">
								<i class="fas fa-cubes"></i> <b>Daftar Barang</b>
						</a>
				</div>
		</div>
		<div class="card-body">
				<form id="form-penjualan" method="post">

						<div class="d-flex justify-content-between mb-3">
								<label>
										<b>NO FAKTUR : </b>
										<input name="no_faktur" type="text" class="form-control d-inline-block" style="width: auto;" required>
								</label>

								<label>
										<b>NO PO : </b>
										<input name="no_po" type="text" class="form-control d-inline-block" style="width: auto;">
								</label>

								<label>
										<b>TGL TRANSAKSI : ?</b>
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
																<th>Jumlah</th>
																<th>*</th>
														</tr>
												</thead>
												<tbody class="wrapper-barang">

														<tr class="barang">
																<td colspan="4">
																		<vue-select name="barang_id[]" 
																			v-model="barang.value"
																			:settings="barang.setting" 
																			required 
																		></vue-select>
																</td>
																<td style="vertical-align: middle;"><i class="fas fa-times" style="cursor: pointer;"></i></td>
														</tr>
														<tr class="barang">
																<td><input id="qty" name="qty[]" type="number" class="form-control form-control-sm qty" required></td>
																<td><input id="diskon" name="diskon[]" type="number" class="form-control form-control-sm diskon" required></td>
																<td><input id="harga" name="harga[]" type="text" class="form-control form-control-sm maskin" readonly required></td>
																<td><input id="subtotal" name="subtotal[]" type="text" class="form-control form-control-sm subtotal maskin" readonly required></td>
																<td></td>
														</tr>

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
															<vue-select name="customer_id[]" 
																v-model="customer.value"
																:settings="customer.setting" 
																required 
															></vue-select>
														</span>
												</div>
												<div class="row mb-3">
														<span class="col-sm-3"><b>Alamat:</b></span>
														<span id="p-alamat" class="col-sm-9">-</span>
												</div>
												<div class="row mb-3">
														<span class="col-sm-3"><b>Kontak:</b></span>
														<span id="p-kontak" class="col-sm-9">-</span>
												</div>
										</div>

										<div class="p0">
												<div class="row mb-3">
														<span class="col-sm-3"><b>Nama:</b></span>
														<span class="col-sm-9"><input name="customer_nama" type="text" class="p0 form-control form-control-sm" required></span>
												</div>
												<div class="row mb-3">
														<span class="col-sm-3"><b>Alamat:</b></span>
														<span class="col-sm-9"><input name="customer_alamat" type="text" class="p0 form-control form-control-sm"></span>
												</div>
												<div class="row mb-3">
														<span class="col-sm-3"><b>No HP:</b></span>
														<span class="col-sm-9"><input name="customer_hp" type="text" class="p0 form-control form-control-sm"></span>
												</div>
										</div>

								</div>

								<div class="col-md-12"><hr></div>

								<div class="col-md-6">
										<div class="form-group">
												<label><b>TOTAL:</b></label>
												<input id="total" type="text" name="total" class="p-3 border border-primary text-primary w-100 maskin" style="font-size: 40px !important; font-weight: bold;" readonly required>
										</div>
										<div class="form-group">
												<label><b>KETERANGAN:</b></label>
												<textarea name="keterangan" class="form-control" rows="4">-</textarea>
										</div>
								</div>
								<div class="col-md-6">
										<div class="form-group d-flex align-items-center justify-content-between">
												<b>PEMBAYARAN:</b>
												<select name="pembayaran" class="form-control form-control-lg" style="width: 80%;" required>
														<option value="tunai">TUNAI</option>
														<option value="kredit">KREDIT (30 HARI)</option>
														<option value="giro">GIRO</option>
														<option value="transfer">TRANSFER</option>
												</select>
										</div>
										<div id="pembayaran_giro" class="d-flex form-group align-items-center justify-content-between">
												<b>NO GIRO:</b>
												<input type="text" 
														name="pembayaran_detail" 
														class="form-control form-control-lg"
														style="width: 80%;"
												>
										</div>
										<div class="form-group d-flex align-items-center justify-content-between">
												<b>DIBAYARKAN:</b>
												<input id="dibayarkan" name="dibayarkan" type="text" class="form-control form-control-lg maskin" style="width: 80%;">
										</div>
										<div class="form-group d-flex align-items-center justify-content-between">
												<b>KEMBALIAN:</b>
												<input id="kembalian" type="text" class="form-control form-control-lg maskin" style="width: 80%;" readonly>
										</div>
										<div class="form-group d-flex align-items-center justify-content-between">
												<b>HUTANG:</b>
												<input id="hutang" name="hutang" type="text" class="form-control form-control-lg maskin" style="width: 80%;" readonly>
										</div>
										<div class="form-group d-flex align-items-center justify-content-between">
												<b>JATUH TEMPO:</b>
												<input name="jatuh_tempo" class="datepicker form-control form-control-lg" style="width: 80%;">
										</div>
								</div>

								<div class="col-sm-12">
										<div class="float-right">
												<a href="#" class="px-5 btn btn-danger">
														<i class="fas fa-times"></i> Batal
												</a>
												<button type="button" id="draft" class="px-5 btn btn-warning">
														<i class="fas fa-archive"></i> Draft
												</button>
												<button class="px-5 btn btn-primary">
														<i class="fas fa-save"></i> Simpan - Publish - Cetak
												</button>
										</div>
								</div>

						</div>
						
						<input type="hidden" name="publish" value="1">
				</form>
		</div>
</div>
</template>

<script>
		import VueSelect from 'v-select2-component';

		export default {
				components: {'vue-select': VueSelect},
				props: ['barang_api'],
				data: () => ({
						barang: {
							value: null,
							setting: null,
						},
						customer: {
							value: null,
							setting: null,
						},
				}),
				methods: {
					setSetting(api) {
						return {
							ajax: {
								url: api,
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
						}
					}
				},
				created() {
					this.barang.setting = this.setSetting(this.barang_api);
					this.customer.setting = this.setSetting(this.customer_api);
				}
		}
</script>
