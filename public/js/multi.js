function test(){
	var pos = $('.checkbox:checked').length > 0 ? '50px' : '-100px';
	$('#multi').animate({bottom: pos}, 'fast', 'swing');
}

$(document).on('click','.delete',function(e){
	e.preventDefault();
	var CSRF_TOKEN = $('input[name="_token"]').attr('value');
	var METHOD = $('input[name="_method"]').attr('value');
	var url = $(this).closest('form').attr('action');;
	if(confirm('Are you sure want to delete ?')) {
	  $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	  });
	  $.ajax({
	    url: url,
	    type: 'post',
	    dataType: 'json',
	    data: {
	        _method: 'DELETE',
	        submit: true
	    },
	    success : function(data){
	    if(data.msg) {
	        // table.draw(false);
	        table.ajax.reload();
	      }
	    }
	  }).always(function(data) {
	      // $('#dataTableBuilder').DataTable().draw(false);
	  });

	} else {

	}
});
