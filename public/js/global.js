$(document).ready(function() {
	
	$('a#logout').button();
	
});

function disableButton(el) {
	el.attr('disabled','disabled').addClass('ui-state-disabled');
}

function enableButton(el) {
	el.removeAttr('disabled').removeClass('ui-state-disabled');
}