var currentButton;

$(document).ready(function() {
	
	$('a#backToList, a#view').button();
	$('input[type="number"]').focus(function() {
		if ($(this).val() == '0') {
			$(this).val('');
		}
	});

	$('ul#photosSections').sortable({
		placeholder: 'ui-state-highlight',
		forcePlaceholderSize: true
    });
    $('ul#photosSections li span.delete').button({
    	icons: {
    		primary: 'ui-icon-close'
    	},
    	text: false
    }).click(function(event) {
    	var id = $(event.target).parent().attr('id').split('-')[1];
    	$('ul#photosSections li#photosSectionsRow-' + id).remove();
    	photosRowsToJson();
    });
    $('ul#photosSections li:last').hide();
    $('div#addPhotosSection').button().click(addPhotosRow);	
    $('div#addPhotosSectionGetImages').button().click(function(event) {
    	event.preventDefault();
    	$.ajax({
    		url: $('input#imageServerUrl').val() + 'getimages.php',
    		dataType: 'jsonp',
    		data: {
    			id: $('input#wheelId').val()
    		}
    	}).done(function(data) {
    		// TODO: Clear out existing rows first
    		for (var i = 0; i < data.length; i++) {
    			addPhotosRow(null, data[i][0], data[i][1], data[i][2]);
    		}
    	});
    });

    
    if ($('#photos_array').length > 0 && $('#photos_array').val().length > 0) {
    	photosJsonToRows();
    }
    
    $('#soldSingles').accordion({
		collapsible: true,
		active: false
	});
    
    $('#sections h3').click(function(event) {
    	$(this).next().toggle();
    });
    $('#sections h3 a').click(function(event) {
    	event.preventDefault();
    });
    
	$('#bought_date, #sold_date').datepicker({
		dateFormat: 'yy-mm-dd'
	});
	
	$('input#staggeredFalse').click(function() {
		$('tr.rear').hide();
	});
	$('input#staggeredTrue').click(function() {
		$('tr.rear').show();
	});
	$('input#hasTiresFalse').click(function() {
		$('tr.tires').hide();
	});
	$('input#hasTiresTrue').click(function() {
		$('tr.tires').show();
	});
	
	$('#addSold').button().click(function() {
		$('#addSoldDialog').dialog('open');
	});
	$('#addSoldDialog').dialog({
		autoOpen: false,
		draggable: false,
		resizable: false,
		modal: true,
		buttons: {
			Ok: function() {
				$(this).dialog('close');
			}
		}
	});
	$('select[id^="sold_sale_type"]').change(function() {
		var saleType = $(this).val();
		var id = $(this).attr('id').split('-')[1];
		if (saleType == 3 || saleType == 7) { // eBay
			$('tr.soldeBayRow-'+id).show();
		} else {
			$('tr.soldeBayRow-'+id).hide();
		}
	});
	
	$('div.saveButton > input').button().click(function() {
		var currentButton = $(this);
		var section = $(this).attr('id').replace('save','');
		if (section == 'Info') {
			photosRowsToJson();
		}
		toggleSaving(currentButton);
		$.ajax({
			type: 'post',
			url: $('#postUrl').val(),
			data: getValues(section),
			dataType: 'json',
			success: function(data) {
				if (data.errorcode === undefined) {
					alert('errorcode is undefined');
				} else {
					if (data.errorcode != 0) {
						alert('errorcode: ' + data.errorcode);
					}
					toggleSaving(currentButton);
				}
			}
		});
		
	});
	
	$('select[id^="sold_sale_type"]').change();
	
});


function addPhotosRow(event, label, filename, count) {
	label = (typeof label === 'undefined') ? '' : label;
	filename = (typeof filename === 'undefined') ? '' : filename;
	count = (typeof count === 'undefined') ? '' : count;
	var newRow = $('ul#photosSections li:last').clone(true).show();
	var newRowId = $('ul#photosSections li:visible').length;
	newRow.attr('id', 'photosSectionsRow-' + newRowId)
	newRow.find('input.label').val(label);
	newRow.find('input.filename').val(filename);
	newRow.find('input.count').val(count);
	newRow.find('span.delete').attr('id', 'delete-' + newRowId);
	$('ul#photosSections li:last').before(newRow);
}

function photosJsonToRows() {
	var photosSections = $.parseJSON($('#photos_array').val());
	for (var i = 0; i < photosSections.length; i++) {
		addPhotosRow(null, photosSections[i][0], photosSections[i][1], photosSections[i][2]);
	}
}

function photosRowsToJson() {
	var photosSections = [];
	$('ul#photosSections li:visible').each(function(index) {
		photosSections.push([$(this).find('input.label').val(), $(this).find('input.filename').val(), parseInt($(this).find('input.count').val())]);
	});
	var result = JSON.stringify(photosSections);
	$('#photos_array').val(result);
}

function getValues(section) {
	if (section == 'Info') {
		return {
			name: $('#name').val(),
			status: $('#status').val(),
			needs_work: $('input[name="needs_work"]:checked').val(),
			title: $('#title').val(),
			subtitle: $('#subtitle').val(),
			folder: $('#folder').val(),
			photos: $('#photos').val(),
			photos_array: $('#photos_array').val(),
			notes: $('#notes').val()
		}
	} else if (section == 'Detail') {
		return {
			front_diameter: $('#front_diameter').val(),
			front_width: $('#front_width').val(),
			front_offset: $('#front_offset').val(),
			front_tire_width: $('#front_tire_width').val(),
			front_tire_sidewall: $('#front_tire_sidewall').val(),
			front_tire_depth: $('#front_tire_depth').val(),
			front_tire_depth_percent: $('#front_tire_depth_percent').val(),
			rear_diameter: $('#rear_diameter').val(),
			rear_width: $('#rear_width').val(),
			rear_offset: $('#rear_offset').val(),
			rear_tire_width: $('#rear_tire_width').val(),
			rear_tire_sidewall: $('#rear_tire_sidewall').val(),
			rear_tire_depth: $('#rear_tire_depth').val(),
			rear_tire_depth_percent: $('#rear_tire_depth_percent').val(),
			tire_description: $('#tire_description').val(),
			tire_production_dates: $('#tire_production_dates').val(),
			mileage: $('#mileage').val(),
			bolt_pattern: $('#bolt_pattern').val(),
			part_number: $('#part_number').val(),
			part_number_rear: $('#part_number_rear').val(),
			part_number_hollander: $('#part_number_hollander').val(),
			part_number_hollander_rear: $('#part_number_hollander_rear').val(),
			tpms: $('input[name="tpms"]:checked').val(),
			center_caps: $('input[name="center_caps"]:checked').val()
		}
	} else if (section == 'Description') {
		return {
			description: $('#description').val()
		}
	} else if (section == 'Bought') {
		return {
			bought_date: $('#bought_date').val(),
			bought_price: $('#bought_price').val(),
			bought_name: $('#bought_name').val(),
			bought_email: $('#bought_email').val(),
			bought_address: $('#bought_address').val(),
			bought_phone: $('#bought_phone').val(),
		}
	} else if (section == 'Ship') {
		return {
			ship_weight: $('#ship_weight').val(),
			ship_length: $('#ship_length').val(),
			ship_width: $('#ship_width').val(),
			ship_height: $('#ship_height').val(),
		}
	}
}

function toggleSaving(el) {
	var spinnerImg = $(el).next();
	if ($(el).hasClass('ui-state-disabled')) {
		enableButton(el);
		spinnerImg.attr('src', $('input#imagesUrl').val() + 'ajax-loader-hidden.gif');
	} else {
		disableButton(el);
		spinnerImg.attr('src', $('input#imagesUrl').val() + 'ajax-loader.gif');
	}
}