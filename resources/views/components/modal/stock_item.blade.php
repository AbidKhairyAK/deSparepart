@php
	$stockItem = Modal::item();
@endphp
<script type="text/javascript">
$(window).on('load',function(){
	@if ($stockItem)
		$('#myModal').modal({backdrop: 'static', keyboard: false, show:true});
	@endif
});
</script>
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Stok Barang</h4>
				<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="box-body">
						<table class="table table-striped">
							<thead class="thead-dark">
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Merk</th>
									<th>Stok</th>
                                    <th>Limit</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@if ($stockItem)
									@foreach ($stockItem as $key => $value)
										<tr>
											<td>{{$no++}}</td>
											<td>{{$value->nama}}</td>
											<td>{{$value->merk}}</td>
											<td>{{$value->stok}}</td>
											<td>{{$value->limit}}</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
</div>
