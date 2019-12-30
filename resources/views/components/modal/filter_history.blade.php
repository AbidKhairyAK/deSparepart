<script src="{{asset('sb-admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
$(window).on('load',function(){
    $(document).on('click', '.filter-history',function() {
        $('#myModal').modal({backdrop: 'static', keyboard: false, show:true});
    });
    $('.datepickers').datepicker({
        format:'yyyy-mm-dd',
        // startDate: '0d',
        autoclose: true
    });
});
</script>
<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Filter History</h4>
				<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
                <form class="" id="form1" action="" method="get">

    				<div class="box-body">
    					<div class="form-group col-sm-12">
    						<label>Pengguna</label>
    						<select name="user" class="form-control select2">
                                <option value="">- Semua Pengguna -</option>
                                @foreach ($user as $key => $value)
                                    <option value="{{$value->id}}" {{($selectedUser == $value->id) ? 'selected':''}}>{{$value->username}}</option>
                                @endforeach
                            </select>
    					</div>
    					<div class="form-group col-sm-12">
    						<label>Tabel</label>
    						<select name="tabel" class="form-control select2">
                                <option value="">- Semua Tabel -</option>
                                @foreach ($tabel as $key => $value)
                                    <option value="{{strtolower($value)}}" {{($selectedTabel == strtolower($value)) ? 'selected':''}}>{{$value}}</option>
                                @endforeach
                            </select>
    					</div>
    					<div class="form-group col-sm-12">
    						<label>Event</label>
    						<select name="event" class="form-control select2">
                                <option value="">- Semua Event -</option>
                                @foreach ($event as $key => $value)
                                    <option value="{{$value}}" {{($selectedEvent == $value) ? 'selected':''}}>{{ucfirst($value)}}</option>
                                @endforeach
                            </select>
    					</div>
    					<div class="form-group col-sm-12">
    						<label>Tanggal</label>
    						<input type="text" class="form-control datepickers" name="tanggal" value="{{($tanggal) ? $tanggal:''}}">
    					</div>
    				</div>
                </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="submit" form="form1" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div>
