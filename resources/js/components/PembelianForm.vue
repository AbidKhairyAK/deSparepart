<template>
<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Form Pembelian Barang</h6>
		<div>
			<a href="#" class="btn btn-sm btn-primary">
				<i class="fas fa-clipboard-list"></i> <b>Daftar Pembelian</b>
			</a>
			<a href="#" class="btn btn-sm btn-warning">
				<i class="fas fa-cubes"></i> <b>Daftar Barang</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		<form :action="form_api" method="post">

			<slot></slot>

			<div class="d-flex justify-content-between mb-3">
				<label>
					<b>NO FAKTUR :</b>
					<input name="no_faktur" type="text" class="form-control d-inline-block" v-model="form.no_faktur" style="width: auto;" required>
				</label>

				<label>
					<b>NO PO :</b>
					<input name="no_po" type="text" class="form-control d-inline-block" v-model="form.no_po" style="width: auto;">
				</label>

				<label>
					<b>TGL TRANSAKSI : {{ date ? date : form.date }}</b>
				</label>
			</div>

			<div class="row">
				<div class="col-md-8">

					<table class="table border border-secondary">
						<thead class="thead-dark">
							<tr>
								<th width="150">Qty</th>
								<th width="120">Diskon %</th>
								<th width="120">PPN %</th>
								<th>Harga Satuan</th>
								<th>Jumlah</th>
								<th>*</th>
							</tr>
						</thead>
						<tbody class="wrapper-barang">
							
							<template v-for="(barang, i) in form.barang">
								<tr class="barang">
									<td colspan="5">
										<select-custom
										  name="barang_id[]"
										  :api="barang_api"
										  v-model="barang.id"
										  @input="(id) => changeBarang(i, id)"
										  :pre_value="barang.name ? barang.id : false"
										  :pre_text="barang.name ? barang.name : false"
											:class="'select-wrapper ' + i"
										  onclick="onOpenSelect(this)"
										>
										</select-custom>
									</td>
									<td style="vertical-align: middle;"><i class="fas fa-times" style="cursor: pointer;" @click="removeBarang(i)"></i></td>
								</tr>
								<tr class="barang">
									<td>
										<input @input="changeDetailBarang(i)" v-model="barang.qty" name="qty[]" type="number" class="form-control form-control-sm" required>
									</td>
									<td>
										<input @input="changeDetailBarang(i)" v-model="barang.diskon" name="diskon[]" type="number" class="form-control form-control-sm" required>
									</td>
									<td>
										<input @input="changeDetailBarang(i)" v-model="barang.ppn" name="ppn[]" type="number" class="form-control form-control-sm" required>
									</td>
									<td @dblclick="barang.readonly = false">
										<money v-bind="moneyconf" onkeyup="changeHargaBarang(this)" v-model="barang.harga" name="harga[]" type="text" :class="'form-control form-control-sm ' + i" :readonly="barang.readonly" required></money>
										<input v-model="barang.harga_asli" name="harga_asli[]" type="hidden" required>
									</td>
									<td>
										<money v-bind="moneyconf" v-model="barang.subtotal" name="subtotal[]" type="text" class="form-control form-control-sm" readonly required></money>
									</td>
									<td></td>
								</tr>
							</template>
							

							<tr class="last-barang">
								<td colspan="5">
									<button type="button" class="btn btn-sm btn-block btn-light" @click="addBarang"><i class="fas fa-plus"></i> Tambah Baris</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<div class="custom-control custom-radio custom-control-inline">
							<input v-model="form.custype" type="radio" class="custom-control-input" id="p1" name="p" value="p1" checked>
							<label class="custom-control-label" for="p1">supplier Lama</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input v-model="form.custype" type="radio" class="custom-control-input" id="p0" name="p" value="p0">
							<label class="custom-control-label" for="p0">supplier Baru</label>
						</div>
					</div>

					<div v-if="form.custype == 'p1'">
						<div class="row mb-3">
							<span class="col-sm-3"><b>supplier:</b></span>
							<span class="col-sm-9">
							  <select-custom
							  	v-if="form.cusready"
							    name="supplier_id"
							    :api="supplier_api"
							    @input="changeSupplier"
							    :pre_value="form.supplier ? form.supplier.id : false"
							    :pre_text="form.supplier ? form.supplier.kode+' - '+form.supplier.perusahaan : false"
							  ></select-custom>
							</span>
						</div>
						<div class="row mb-3">
							<span class="col-sm-3"><b>Alamat:</b></span>
							<span class="col-sm-9">{{ form.supplier ? form.supplier.alamat : '-' }}</span>
						</div>
						<div class="row mb-3">
							<span class="col-sm-3"><b>Kontak:</b></span>
							<span class="col-sm-9">{{ form.supplier ? (form.supplier.kontak_supplier.find(c => c.tipe == 'hp') ? form.supplier.kontak_supplier.find(c => c.tipe == 'hp').kontak : '') : '-' }}</span>
						</div>
					</div>

					<div v-if="form.custype == 'p0'">
						<div class="row mb-3">
							<span class="col-sm-3"><b>Nama:</b></span>
							<span class="col-sm-9"><input name="supplier_nama" type="text" class="form-control form-control-sm" required></span>
						</div>
						<div class="row mb-3">
							<span class="col-sm-3"><b>Alamat:</b></span>
							<span class="col-sm-9"><input name="supplier_alamat" type="text" class="form-control form-control-sm"></span>
						</div>
						<div class="row mb-3">
							<span class="col-sm-3"><b>No HP:</b></span>
							<span class="col-sm-9"><input name="supplier_hp" type="text" class="form-control form-control-sm"></span>
						</div>
					</div>

				</div>

				<div class="col-md-12"><hr></div>

				<div class="col-md-6">
					<div class="form-group">
						<label><b>TOTAL:</b></label>
						<money v-bind="moneyconf" v-model="form.total" type="text" name="total" class="p-3 border border-primary text-primary w-100 maskin" style="font-size: 40px !important; font-weight: bold;" readonly required></money>
					</div>
					<div class="form-group">
						<label><b>KETERANGAN:</b></label>
						<textarea name="keterangan" class="form-control" rows="4">-</textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group d-flex align-items-center justify-content-between">
						<b>PEMBAYARAN:</b>
						<select name="pembayaran" v-model="form.pembayaran" class="form-control form-control-lg" style="width: 80%;" required @change="changePembayaran()">
							<option value="tunai">TUNAI</option>
							<option value="kredit">KREDIT (30 HARI)</option>
							<option value="giro">GIRO</option>
							<option value="transfer">TRANSFER</option>
						</select>
					</div>
					<div v-if="form.pembayaran == 'giro'" class="d-flex form-group align-items-center justify-content-between">
						<b>NO GIRO:</b>
						<input type="text" 
							name="pembayaran_detail" 
							class="form-control form-control-lg"
							style="width: 80%;"
						>
					</div>
					<div class="form-group d-flex align-items-center justify-content-between">
						<b>DIBAYARKAN:</b>
						<money v-bind="moneyconf" v-model="form.dibayarkan" id="dibayarkan" name="dibayarkan" type="text" class="form-control form-control-lg" style="width: 80%;"></money>
					</div>
					<div class="form-group d-flex align-items-center justify-content-between">
						<b>KEMBALIAN:</b>
						<money v-bind="moneyconf" v-model="form.kembalian" id="kembalian" type="text" class="form-control form-control-lg" style="width: 80%;" readonly></money>
					</div>
					<div class="form-group d-flex align-items-center justify-content-between">
						<b>HUTANG:</b>
						<money v-bind="moneyconf" v-model="form.hutang" id="hutang" name="hutang" type="text" class="form-control form-control-lg" style="width: 80%;" readonly></money>
					</div>
					<div class="form-group d-flex align-items-center justify-content-between">
						<b>JATUH TEMPO:</b>
						<date-picker :input-attr="{name:'jatuh_tempo'}" v-model="form.jatuh_tempo" :default-value="form.jatuh_tempo" style="width: 80%;"></date-picker>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="float-right">
						<a href="#" class="px-5 btn btn-danger">
							<i class="fas fa-times"></i> Batal
						</a>
						<button @click="submitMode(0)" class="px-5 btn btn-warning">
							<i class="fas fa-archive"></i> Draft
						</button>
						<button @click="submitMode(1)" class="px-5 btn btn-primary">
							<i class="fas fa-save"></i> Simpan - Publish
						</button>
					</div>
				</div>

			</div>
			
			<input type="hidden" name="publish" v-model="mode">
		</form>
	</div>
</div>
</template>

<script>
	import SelectCustom from './SelectCustom.vue';
	import {Money} from 'v-money';
	import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';

	export default {
		components: {SelectCustom, Money, DatePicker},
		props: ['barang_api', 'supplier_api', 'form_api', 'url', 'date', 'id', 'next_tempo'],
		data: () => ({
			form: {
				barang: [],
				no_faktur: null,
				no_po: null,
				date: null,
				total: 0,
				pembayaran: null,
				dibayarkan: 0,
				kembalian: 0,
				hutang: 0,
				supplier: null,
				cusready: false,
				custype: 'p1',
				jatuh_tempo: Date.now()
			},
			mode: 1,
			barang: [],
			barangopt: [],
			moneyconf: {decimal: ',', thousands: '.', prefix: '', precision: 0, masked: false},
		}),
		computed: {
			kembalian() {
				let x = this.form.dibayarkan - this.form.total;
				return x > 0 ? x : 0;
			},
			hutang() {
				let x = this.form.total - this.form.dibayarkan;
				return x > 0 ? x : 0;
			},
			e() {
				return this.id > 0;
			}
		},
		methods: {
			submitMode(val) {
				this.mode = val;
			},
			changePembayaran() {
				if (this.form.pembayaran == 'kredit') {
					this.form.jatuh_tempo = new Date(this.next_tempo);
				}
			},
			addBarang() {
				this.form.barang.push(
					{ id: null, name: null, qty: 0, diskon: 0, ppn: 0, harga: 0, subtotal: 0, harga_asli: 0, readonly: true }
				);
			},
			removeBarang(i) {
				this.form.barang.splice(i, 1);
				this.countTotal();
			},
			getBarang() {
				axios.get(this.barang_api)
				.then((res) => {
					this.barang = res.data;
				});
			},
			changeSupplier(id) {
				axios.get(`${this.url}/supplier/api?id=${id}`)
				.then(res => {
					this.form.supplier = res.data;
					this.form.cusready = true;
				})
			},
			changeBarang(index, id) {
				let harga = this.barang.find(b => b.id == id).harga_beli;
				let barang = this.form.barang[index];
				barang.harga_asli = harga;
				barang.harga = harga;
				barang.name = this.barangopt.find(bopt => barang.id == bopt.id).name;
				this.changeDetailBarang(index);
			},
			changeDetailBarang(index) {
				let b = this.form.barang[index];
				let harga_ppn = b.harga_asli + (b.harga_asli * b.ppn / 100);
				b.harga = harga_ppn - (harga_ppn * b.diskon / 100);
				b.subtotal = b.harga * b.qty;
				this.countTotal();
			},
			changeHargaBarang(item) {
				let classList = item.classList;
				let index = classList[classList.length - 1];
				let b = this.form.barang[index];
				b.diskon = 0;
				b.ppn = 0;
				b.harga_asli = b.harga;
				this.changeDetailBarang(index);
			},
			countTotal() {
				this.form.total = this.form.barang.reduce((total, cur) => ({subtotal : total.subtotal + cur.subtotal})).subtotal;
			},
			onEditState() {
				axios.get(`${this.url}/pembelian/api/full?id=${this.id}`)
				.then((res) => {
					let data = res.data;
					this.form.no_faktur = data.no_faktur;
					this.form.no_po = data.no_po;
					this.form.date = data.created_at;
					this.form.pembayaran = data.pembayaran;
					this.form.dibayarkan = data.dibayarkan;
					this.form.jatuh_tempo = data.jatuh_tempo ? new Date(data.jatuh_tempo) : Date.now();
					this.form.barang.splice(0, 1);
					data.pembelian_detail.forEach((pd, i) => {
						this.form.barang.push({
							id: pd.barang_id,
							name: this.barangopt.find(bopt => pd.barang_id == bopt.id).name,
							qty: pd.qty,
							diskon: pd.diskon,
							ppn: pd.ppn,
							harga_asli: pd.harga_asli,
							harga: pd.harga,
							subtotal: pd.subtotal,
							readonly: true 
						});
						this.changeDetailBarang(i);
					});
					this.changeSupplier(data.supplier_id);
				});
			},
			onOpenSelect(item) {
				let classList = item.classList;
				let index = classList[classList.length - 1];
				let b = this.form.barang[index];
				b.name = null;
			},
		},
		watch: {
			kembalian(val) {
				this.form.kembalian = val;
			},
			hutang(val) {
				this.form.hutang = val;
			},
		},
		async created() {

			await axios.get(this.barang_api).then(res => { 
				this.barangopt = res.data; 
			});

			window.changeHargaBarang = this.changeHargaBarang;
			window.onOpenSelect = this.onOpenSelect;
			this.getBarang();
			if(this.e) {
				this.onEditState();
			} else {
				this.addBarang();
				this.form.cusready = true;
			}
		}
	}
</script>
