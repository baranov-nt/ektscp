var id_city, format, selectTime, selectModule, start_date, end_date, tadv_term;
var css = false, cst = false, csp = false;
var click_play;
var array_place = [];

function select_city(value) {
	if (value) {
		id_city = value;
		if (start_date) select_date($('#select-date').val());
	}
}

function select_format(value) {
	if (value) {
		format = value;
		$.ajax({
			url: '/adv/changeformat',
			method: 'POST',
			data: {action: value},
			dataType: "html",
			complete: function (data) {
				$('.format-update').html(data.responseText);
			}
		});
		if (start_date) select_date($('#select-date').val());
	}
}

function select_time(value) {
	if (value) {
		selectTime = value;
		if (start_date) select_date($('#select-date').val());
	}
}

function select_module(value) {
	if (value) {
		selectModule = value;
		if (start_date) select_date($('#select-date').val());
	}
}

function select_term(value) {
	if (value) {
		tadv_term = value;
		if (start_date) select_date($('#select-date').val());
	}
}

function select_date(value) {
	if (value) {
		if(validate_form())
		$.ajax({
			url: '/adv/getdate',
			method: 'POST',
			data: {date: value, date_time: tadv_term},
			dataType: "json",
			complete: function (data) {
				if (data.responseJSON['result'] == true) {
					$('.last-date').html(data.responseJSON['date']);
					start_date = value;
					end_date = data.responseJSON['date'];
					ajax_getTermianl();
				}
			}
		});
	}
}

function select_place(value) {
	if (value) {
		array_place = value;
		if (start_date) ajax_getTermianl();
	}
}

function select_platform() {
	css = $('input[data-id="css"]').prop('checked') ? true : false;
	cst = $('input[data-id="cst"]').prop('checked') ? true : false;
	csp = $('input[data-id="csp"]').prop('checked') ? true : false;

	if (start_date) ajax_getTermianl();
}

function ajax_getTermianl() {
	if(validate_form())
	$.ajax({
		url: '/adv/getterminal',
		method: 'POST',
		data: {
			id_city: id_city,
			format: format,
			selectTime: selectTime,
			start_date: start_date,
			end_date: end_date,
			array_place: array_place,
			css: css,
			cst: cst,
			csp: csp
		},
		dataType: 'json',
		complete: function (data) {
			$('.table tbody').html('');
			if (data.responseJSON['result']) {
				for (i in data.responseJSON['array_terminal']) {
					$('.table tbody').append('<tr>' +
						'<td class="main-text text-left">'+
							'<div>'+data.responseJSON['array_terminal'][i]['platforma']+'</div>'+
							'<div>'+
								data.responseJSON['array_terminal'][i]['place']+
								'<br>'+
								data.responseJSON['array_terminal'][i]['address']+
							'</div>'+
						'</td>'+
						'<td class="main-text text-left">'+
							'<div>'+data.responseJSON['array_terminal'][i]['date']+' дн.</div>'+
						'</td>'+
						'<td class="main-text text-center">'+
							'<div>'+data.responseJSON['array_terminal'][i]['price']+' руб.</div>'+
						'</td>'+
						'<td class="main-text text-center">'+
							'<div class="checkbox checkbox-info checkbox-inline">'+
								'<input id="terminal-'+data.responseJSON['array_terminal'][i]['id_terminal']+'" ' +
									'data-terminal-id="'+data.responseJSON['array_terminal'][i]['id_terminal']+'" '+
									'data-terminal-sale="'+data.responseJSON['array_terminal'][i]['sale']+'" ' +
									'type="checkbox" class="terminal-check" onclick="select_terminal($(this))" ' +
									'name="adv_terminal[]" value="'+data.responseJSON['array_terminal'][i]['id_terminal']+'">'+
								'<label for="terminal-'+data.responseJSON['array_terminal'][i]['id_terminal']+'"></label>'+
							'</div>'+
						'</td>'+
					'</tr>');
				}
			}
		}
	});
}

function show_input_info(element) {
	if ($(element).prop('checked')) {
		$('#showVizitki').attr('disabled', false).trigger("chosen:updated");
	} else {
		$('#showVizitki').attr('disabled', true).trigger("chosen:updated");
	}
}

function select_terminal(element) {
	count = 0;
	sale = 0;
	$('input[class="terminal-check"]').each(function(i, element) {
		if ($(this).prop('checked')) {
			count++;
			sale = sale + parseInt($(this).attr("data-terminal-sale"));
		}
	});
	$('#order-block-1 div:nth-child(2)').html(count);
	$('#order-block-2 div:nth-child(4)').html(sale + '%');
}

function validate_form() {
	if (!id_city) {
		$('#tadv_city_chosen').mousedown();
		console.log("id_city");
		return false;
	}
	if (!format) {
		$('#tadv_format_chosen').mousedown();
		console.log("format");
		return false;
	} else {
		if (!selectTime && (format == '_format_template' || format == '_format_video_banner')) {
			$('#showTime_chosen').mousedown();
			console.log("showTime_chosen");
			return false;
		} else if (!selectModule && (format == '_format_interactive_banner' || format == '_format_interactive_vizitka')) {
			$('#showModule_chosen').mousedown();
			console.log("showModule_chosen");
			return false;
		}
	}
	if (!tadv_term) {
		$('#tadv_term_chosen').mousedown();
		console.log("tadv_term");
		return false;
	}
	return true;
}

function open_edit() {
	$.ajax({
		url: '/adv/openedit',
		method: 'POST',
		dataType: "html",
		complete: function (data) {
			$('.slider').before('<div>'+data.responseText+'</div>');
		}
	});
	return false;
}

/*Воспроизведение видео*/
function play_and_stop(thisis, element){
	click_play++;
	if(click_play == 1){
		thisis.play();
		element.attr("controls", true);
	} else {
		click_play = 0;
		thisis.pause();
	}
}

function formSubmit() {
	if (!$('#catalogform-city').val()){
		$('body').scrollTop(140);
		alert('Выберите город!');
		return false;
	}

	$('form').submit();
	return false;
}