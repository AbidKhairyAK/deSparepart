function test(){
	var pos = $('.checkbox:checked').length > 0 ? '50px' : '-100px';
	$('#multi').animate({bottom: pos}, 'fast', 'swing');
}