$(function(){

	function actualise(){
		if($(window).width() < 860 ){
			$('#buttonMenu').show();
			$('.submenu').css('display', 'none');
			$('#logo').css('width','60%');
			$('#logo').css('height','60%');
		} else {
			$('#buttonMenu').hide();
			$('.submenu').css('display', 'block');
			$('#logo').css('width','15%');
			$('#logo').css('height','15%');
		}	
	}

	actualise();

	$('#buttonMenu').click(function(){
		if($('.submenu').css('display') == 'none'){
			$('.submenu').css('display', 'block');
		} else {
			$('.submenu').css('display', 'none');
		}
	});
	
	$(window).resize(function(){
		actualise();
	});
});