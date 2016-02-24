$(document).ready(function() {
	
	/*
	$('a#toggleSold').button().click(function(event) {
		$('tr.status-6').toggle();
		event.preventDefault();
	});
	*/
	
	$('select#filterStatus').change(function(event) {
		var status = $(this).val();
		if (status == 'all') {
			$('#wheelList tr').show();
		} else if (status == 'needswork') {
			$('#wheelList tr').hide();
			$('#wheelList tr.needsWork-1').show();
		} else {
			$('#wheelList tr').hide();
			var statusArray = status.split(',');
			console.log(statusArray);
			for (var i = 0; i < statusArray.length; i++) {
				$('#wheelList tr.status-'+statusArray[i]).show();
			}
		}
	});

	/*
	$('input#filterNeedsWork').click(function(event) {
		if ($(this).is(':checked')) {
			console.log('checked');
		} else {
			console.log('unchecked');
		}
	});
	*/
	
	$('a#new').button().click(function(event) {
		$('#dialogNew').dialog('open');
		event.preventDefault();
	});
	
	$('#dialogNew').dialog({
		autoOpen: false,
		draggable: false,
		resizable: false,
		modal: true,
		width: 400,
		buttons: {
			"Add": function() {
				postAddNew('');
			},
			"Add & Edit": function() {
				postAddNew('edit');
			}
		}
	});

});

function postAddNew(action) {
	$.ajax({
		type: 'post',
		url: $('#new').attr('href'),
		data: {
			name: $('#newName').val(),
			bought_date: $('#newDate').val(),
			bought_price: $('#newPrice').val()
		},
		dataType: 'json',
		success: function(data) {
			if (data.errorcode === undefined) {
				alert('errorcode is undefined');
			} else {
				if (data.errorcode != 0) {
					alert('errorcode = ' + data.errorcode);
				} else {
					if (action == 'edit') {
						window.location = $('#editUrl').val() + '/id/' + data.id;
					} else {
						window.location.reload();	
					}
				}
			}
		}
	});	
}