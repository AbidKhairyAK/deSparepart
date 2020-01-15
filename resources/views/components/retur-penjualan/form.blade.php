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

						<div class="form-group col-sm-12" id="no_faktur">
							<label>No Faktur Penjualan:</label>
							<select name="penjualan_id" class="form-control" placeholder="Cari..." required>
								@if(isset($m))
								<option value="{{ $m->id }}">{{ $m->no_faktur }}</option>
								@endif
							</select>
						</div>

						<div id="vue-wrapper" class="col-sm-12">
							<div v-if="penjualan" class="row">

								<div class="form-group col-sm-12" id="preview">
									<label>No Faktur Penjualan:</label>
									<p><b>@{{ penjualan.no_faktur }}</b></p>
								</div>

								<div class="form-group col-sm-12" id="preview">
									<label>No Retur:</label>
									<input type="text" name="no_retur" class="form-control" value="{{ $e ? $model->no_retur : $no_retur }}">
								</div>

								<div class="form-group col-sm-12">
									<label>Daftar Barang:</label>
									<table class="table table-bordered table-sm my-3" style="position: relative;">
										<thead>
											<tr class="text-center">
												<th>No</th>
												<th>Part No</th>
												<th>Nama Barang</th>
												<th>Qty</th>
												<th width="100">Retur</th>
												<th width="200">Biaya</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(detail, key) in penjualan.penjualan_detail" :key="key">
												<td>@{{ key + 1 }}</td>
												<td>@{{ detail.part_no }}</td>
												<td>@{{ detail.nama }}</td>
												<td class="text-right">@{{ detail.qty }} @{{ detail.satuan }}</td>
												<td>
													<input type="number" :name="'qty['+detail.id+']'" v-model="retur[detail.id]" @input="getBiaya(detail.id)" placeholder="0" class="form-control form-control-sm w-100 qty" min="0" :max="detail.qty">
													<input type="hidden" :name="'barang_id['+detail.id+']'" :value="detail.barang_id">
												</td>
												<td>
													<input type="text" :name="'biaya['+detail.id+']'" :value="biaya[detail.id] | nf" placeholder="0" class="form-control form-control-sm w-100" readonly>

													<table class="mt-2 table-borderless" v-if="retur[detail.id] > 0">
														<tr><td><input placeholder="Keterangan..." type="text" :name="'keterangan['+detail.id+']'" v-model="keterangan[detail.id]" class="form-control form-control-sm" style="position: absolute; left: 0; width: 100%; transform: scaleX(0.985);" maxlength="254"></td></tr>
														<tr><td><input type="text" class="form-control form-control-sm w-100" style="opacity: 0;"></td></tr>
													</table>

												</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="form-group col-sm-6">
									<label>Pembayaran</label>
									<select v-model="pembayaran" name="pembayaran" class="form-control" required>
										<option value="tunai">TUNAI</option>
										<option value="kredit">KREDIT</option>
										<option value="giro">GIRO</option>
										<option value="transfer">TRANSFER</option>
									</select>
									<br>
									<input v-if="pembayaran == 'giro'" name="pembayaran_detail" type="text" class="form-control" placeholder="No Giro..." value="{{ $model->pembayaran_detail }}" required>
								</div>

								<div class="form-group col-sm-6">
									<label>Total Dikembalikan</label>
									<input name="dikembalikan" :value="total | nf" type="text" class="form-control" readonly>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>

<script type="text/javascript">

	var vm = new Vue({
		el: '#vue-wrapper',
		data: {
			penjualan: false,
			pembayaran: null,
			total: null,
			retur: [],
			biaya: [],
			keterangan: [],
		},
		methods: {
			getData(id){
				var self = this;
				axios.get(`/penjualan/api/full?id=${id}`).then(function(res) {
					self.penjualan = res.data;
				});
			},
			getTotal() {
				var x = this.biaya;
				var res;

				if (x.length > 0) {
					res = x.reduce(function(prev, cur) {
						return parseInt(prev) + parseInt(cur);
					});
				}
				this.total =  res;
			},
			getBiaya(id) {
				var harga = this.penjualan.penjualan_detail.filter(function(d) {
					return d.id == id;
				})[0].harga;

				this.biaya[id] = parseInt(this.retur[id]) * parseInt(harga);
				this.getTotal();
			}
		},
		filters: {
		  	nf(x) {
		  		if (!x) return '';
			    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			}
		},
		mounted() {
			@if($e)
				this.total = `{{ $model->dikembalikan + $model->dilunaskan }}`
				this.pembayaran = `{{ $model->pembayaran }}`;
				console.log('{{ $model->penjualan->no_faktur }}')
				@foreach($model->retur_penjualan_detail()->get() as $d)
					this.retur[{{ $d->penjualan_detail_id }}] = '{{ $d->qty }}';
					this.biaya[{{ $d->penjualan_detail_id }}] = '{{ $d->biaya }}';
					this.keterangan[{{ $d->penjualan_detail_id }}] = '{{ $d->keterangan }}';
				@endforeach
			@endif
		}
	});

	$('select[name=penjualan_id]').select2({
	  // minimumInputLength: 3,
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
		$('#no_faktur').hide();
		$('#preview').show();
	});

	$('form').submit(function(e) {

		var check = $('.qty').toArray().some(function(x) {
			return x.value > 0;
		});

		if (!check) {
			alert('Silahkan isi salah satu kolom retur!');
			e.preventDefault();
		}

	})

	@if(isset($m))
	vm.getData('{{ $m->id }}');
	$('select[name=penjualan_id]').trigger('change');
	@endif
</script>
@endsection