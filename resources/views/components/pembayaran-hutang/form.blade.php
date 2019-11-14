@extends('app')

@section('title', 'Form '.$title)

@php $e = isset($model); @endphp

@section('content')

<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Form {{ $title }}</h6>
	</div>
	<div class="card-body">
		<form action="{{ $action }}" method="post">
			@csrf
			@if($e) @method('PUT') @endif
			<div class="row">
				<div class="col-sm-8">
					<div class="row">

						<div class="form-group col-sm-6 {{ $e ? 'd-none' : 'd-block' }} ">
							<label>No Faktur Pembelian:</label>
							<select name="pembelian_id" class="form-control" placeholder="Cari..." required>
								@if(isset($m))
								<option value="{{ $m->id }}">{{ $m->no_faktur }}</option>
								@endif
							</select>
						</div>
						<div class="form-group col-sm-6 {{ $e ? 'd-block' : 'd-none' }} ">
							<label>No Faktur Pembelian:</label>
							<p><b>{{ isset($m) ? $m->no_faktur : '' }}</b></p>
						</div>

						<div class="form-group col-sm-6">
							<label>No Pelunasan:</label>
							<input type="text" name="no_pelunasan" class="form-control" value="{{ $e ? $model->no_pelunasan : $no_pelunasan }}">
						</div>

						<div id="vue-wrapper" class="col-sm-12">
							<div  v-if="pembelian" class="row">
								<div class="form-group col-sm-12">
									<label>Detail Transaksi:</label>
									<div class="p-2 border border-secondary">
										<div class="row">
											
											<div class="col-sm-12">
												<table class="table table-bordered table-sm my-3">
													<thead>
														<tr>
															<th>No</th>
															<th>Part No</th>
															<th>Nama Barang</th>
															<th>Qty</th>
															<th>Diskon</th>
															<th>PPN</th>
															<th>Harga</th>
															<th>Subtotal</th>
														</tr>
													</thead>
													<tbody>
														<tr v-for="(detail, key) in pembelian.pembelian_detail" :key="key">
															<td>@{{ key + 1 }}</td>
															<td>@{{ detail.part_no }}</td>
															<td>@{{ detail.nama }}</td>
															<td class="text-right">@{{ detail.qty }}</td>
															<td class="text-right">@{{ detail.diskon }}%</td>
															<td class="text-right">@{{ detail.ppn }}%</td>
															<td class="text-right">@{{ detail.harga | nf }}</td>
															<td class="text-right">@{{ detail.subtotal | nf }}</td>
														</tr>
													</tbody>
													<tfoot>
														<tr>
															<th colspan="6">TOTAL :</th>
															<th class="text-right">@{{ pembelian.total | nf }}</th>
														</tr>
													</tfoot>
												</table>
											</div>

											<div class="col-sm-4 pb-2">
												<b>No Faktur:</b> @{{ pembelian.no_faktur }}
											</div>
											<div class="col-sm-4 pb-2">
												<b>No PO:</b> @{{ pembelian.no_po }}
											</div>
											<div class="col-sm-4 pb-2">
												<b>Pembayaran:</b> @{{ pembelian.pembayaran.toUpperCase() }}
											</div>
											<div class="col-sm-4 pb-2">
												<b>Supplier:</b> @{{ pembelian.supplier.nama }}
											</div>
											<div class="col-sm-4 pb-2">
												<b>Tanggal Transaksi:</b> @{{ pembelian.created_at.substr(0, 10) }}
											</div>
											<div class="col-sm-4 pb-2">
												<b>Jatuh Tempo:</b> @{{ pembelian.jatuh_tempo }}
											</div>
											<div class="col-sm-4 pb-2">
												<b>Dibayarkan:</b> Rp @{{ pembelian.dibayarkan | nf }}
											</div>

										</div>
									</div>
								</div>

								<div class="form-group col-sm-3">
									<label>Hutang</label>
									<input name="hutang" type="text" class="form-control" :value="hutang | nf" readonly>
								</div>
								<div class="form-group col-sm-3">
									<label>Dibayarkan</label>
									<input id="dibayarkan" name="dibayarkan" v-mask v-model="dibayarkan" type="text" class="form-control">
								</div>
								<div class="form-group col-sm-2">
									<label>Pembayaran</label>
									<select v-model="pembayaran" name="pembayaran" class="form-control">
										<option value="tunai">TUNAI</option>
										<option value="kredit">KREDIT</option>
										<option value="giro">GIRO</option>
										<option value="transfer">TRANSFER</option>
									</select>
									<br>
									<input v-if="pembayaran == 'giro'" name="pembayaran_detail" type="text" class="form-control" placeholder="No Giro..." value="{{ $e ? $model->pembayaran_detail : '' }}">
								</div>
								<div class="form-group col-sm-2">
									<label>Kembalian</label>
									<input :value="kembalian | nf" type="text" class="form-control" readonly>
								</div>
								<div class="form-group col-sm-2">
									<label>Sisa hutang</label>
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
			pembelian: false,
			dibayarkan: null,
			pembayaran: null,
		},
		computed: {
			kembalian() {
				if (this.dibayarkan) {
					var res = this.dibayarkan.replace(/\./g, '') - this.hutang;
					if (res > 0) return res;
				}
				return '0';
			},
			sisa() {
				if (this.dibayarkan) {
					var res = this.hutang - this.dibayarkan.replace(/\./g, '');
					if (res > 0) return res;
				}
				return '0';
			},
			hutang() {
				@if($e)
				return `{{ $model->hutang }}`;
				@endif

				var x = this.pembelian.pembayaran_hutang;
				if (x.length > 0) {
					return x[x.length - 1].sisa;
				}
				return this.pembelian.hutang;
			}
		},
		methods: {
			getData(id){
				var self = this;
				axios.get(`/pembelian/api/full?id=${id}`).then(function(res) {
					self.pembelian = res.data;
				});
			},
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
				},
				inserted: function(el) {
					var val = el.value.toString().replace(/\./g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
					el.value = val;
				},
			}
		},
		mounted() {
			@if($e)
			this.dibayarkan = `{{ $model->dibayarkan }}`;
			this.pembayaran = `{{ $model->pembayaran }}`;
			@endif
		}
	});

	$('select[name=pembelian_id]').select2({
	  ajax: {
	    url: '{{ url("pembelian/api/select?hutang=true") }}',
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
	vm.getData(`{{ $m->id }}`);

	@endif
</script>
@endsection