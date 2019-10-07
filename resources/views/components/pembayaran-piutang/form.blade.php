@extends('app')

@section('title', 'Form '.$title)

@section('content')
<div id="page-header">
	<h1 class="h3 mb-1 text-gray-800">Form {{ $title }}</h1>
	<p class="mb-4">form yang digunakan untuk input data {{ $title }}</p>
</div>

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form {{ $title }}</h6>
	</div>
	<div class="card-body">
		<form action="{{ $action }}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-8">
					<div class="row">

						<div class="form-group col-sm-12">
							<label>Cari No Faktur Penjualan:</label>
							<select type="text" name="penjualan_id" class="form-control" placeholder="Cari...">
								@if(isset($m))
								<option value="{{ $m->id }}">{{ $m->no_faktur }}</option>
								@endif
							</select>
						</div>

						<div id="vue-wrapper" class="col-sm-12">
							<div  v-if="penjualan" class="row">
								<div class="form-group col-sm-12">
									<label>Detail Transaksi:</label>
									<div class="p-2 border border-secondary">
										<div class="row">
											<div class="col-sm-4">
												<b>No Faktur:</b> @{{ penjualan.no_faktur }}
											</div>
											<div class="col-sm-5">
												<b>Tanggal Transaksi:</b> @{{ penjualan.created_at }}
											</div>
											<div class="col-sm-3">
												<b>Jatuh Tempo:</b> @{{ penjualan.jatuh_tempo }}
											</div>
											<div class="col-sm-12">
												<table class="table table-bordered table-sm my-3">
													<thead>
														<tr>
															<th>No</th>
															<th>Part No</th>
															<th>Nama Barang</th>
															<th>Qty</th>
															<th>Diskon</th>
															<th>Harga</th>
															<th>Subtotal</th>
														</tr>
													</thead>
													<tbody>
														<tr v-for="(detail, key) in penjualan.penjualan_detail" :key="key">
															<td>@{{ key + 1 }}</td>
															<td>@{{ detail.part_no }}</td>
															<td>@{{ detail.nama }}</td>
															<td class="text-right">@{{ detail.qty }}</td>
															<td class="text-right">@{{ detail.diskon }}%</td>
															<td class="text-right">@{{ detail.harga | nf }}</td>
															<td class="text-right">@{{ detail.subtotal | nf }}</td>
														</tr>
													</tbody>
													<tfoot>
														<tr>
															<th colspan="6">TOTAL :</th>
															<th class="text-right">@{{ penjualan.total | nf }}</th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="col-sm-4">
												<b>Debitur:</b> @{{ penjualan.pelanggan.nama }}
											</div>
											<div class="col-sm-4">
												<b>Dibayarkan:</b> @{{ penjualan.dibayarkan | nf }}
											</div>
											<div class="col-sm-4">
												<b>Pembayaran:</b> @{{ penjualan.pembayaran.toUpperCase() }}
											</div>

										</div>
									</div>
								</div>

								<div class="form-group col-sm-3">
									<label>Piutang</label>
									<input name="piutang" type="text" class="form-control" :value="piutang | nf" readonly>
								</div>
								<div class="form-group col-sm-3">
									<label>Dibayarkan</label>
									<input name="dibayarkan" v-mask v-model="dibayarkan" type="text" class="form-control">
								</div>
								<div class="form-group col-sm-2">
									<label>Pembayaran</label>
									<select name="pembayaran" class="form-control">
										<option value="tunai">TUNAI</option>
										<option value="kredit">KREDIT</option>
										<option value="giro">GIRO</option>
									</select>
								</div>
								<div class="form-group col-sm-2">
									<label>Kembalian</label>
									<input :value="kembalian | nf" type="text" class="form-control" readonly>
								</div>
								<div class="form-group col-sm-2">
									<label>Sisa Piutang</label>
									<input name="sisa" :value="sisa | nf" type="text" class="form-control" readonly>
								</div>
							</div>
						</div>

					</div>

					<div class="float-right">
						<button type="submit" class="btn btn-sm btn-secondary px-5">Cancel</button>
						<button type="submit" class="btn btn-sm btn-primary px-5">Submit</button>
					</div>

				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/v-mask/2.0.2/v-mask.min.js"></script> -->
<script type="text/javascript">

	var vm = new Vue({
		el: '#vue-wrapper',
		data: {
			penjualan: false,
			dibayarkan: null,
		},
		computed: {
			kembalian() {
				if (this.dibayarkan) {
					var res = this.dibayarkan.replace(/\./g, '') - this.piutang;
					if (res > 0) return res;
				}
				return '0';
			},
			sisa() {
				if (this.dibayarkan) {
					var res = this.piutang - this.dibayarkan.replace(/\./g, '');
					if (res > 0) return res;
				}
				return '0';
			},
			piutang() {
				var x = this.penjualan.pembayaran_piutang;
				if (x.length > 0) {
					return x[x.length - 1].sisa;
				}
				return this.penjualan.hutang;
			}
		},
		methods: {
			getData(id){
				var self = this;
				axios.get(`/penjualan/api/full?id=${id}`).then(function(res) {
					self.penjualan = res.data;
				});
			},
			lel(val) {
				alert(val);
			}
		},
		filters: {
		  	nf(x) {
		  		if (!x) return '';
			    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			}
		},
		directives: {
			mask: {
				update: function(el) {
					var val = el.value.toString().replace(/\./g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
					el.value = val;
				}
			}
		}
	});

	$('select[name=penjualan_id]').select2({
	  ajax: {
	    url: '{{ url("penjualan/api/select") }}',
	    data: function (params) {
	      return {
	        search: params.term,
	      }
	    },
	    processResults: function (data) {
	      return {
	        results: $.map(data, function (item) {
                return {
                    text: item.no_faktur,
                    id: item.id
                }
            })
	      };
	    }
	  }
	})
	.on('select2-open', function() { dropdown() })
	.on('change', function() {
		vm.getData(this.value);
	});

	@if(isset($m))
	vm.getData({{ $m->id }});
	@endif
</script>
@endsection