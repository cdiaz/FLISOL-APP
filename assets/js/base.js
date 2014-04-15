$(function () {
	
	$('.subnavbar').find ('li').each (function (i) {
		var mod = i % 3;
		
		if (mod === 2) {
			$(this).addClass ('subnavbar-open-right');
		}
	
	});
	
	
	
});

var controllogin = false;
$('#navLogin').click (function() { 
	if (controllogin) {
		$('#loginform').hide();
	}
	else { 
		$('#loginform').show();
	}
	controllogin = !controllogin;
});




