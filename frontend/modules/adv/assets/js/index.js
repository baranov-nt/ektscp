var id_city, format, selectTime, start_date, end_date;
var css = false, cst = false, csp = false;
var click_play;
var work_time_12 = false, work_time_24 = false;
var selectInfo = 0;

$(document).ready(function(){
	$('.last-block .check').on('click', function(){
		checkboxPanel($(this), 1);
	});
	
	$('.last-block .check label').on('click', function(){
		checkboxPanel($(this), 2);
	});
	
	$('.last-block .check input').on('click', function(){
		checkboxPanel($(this), 3);
	});
});

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

function select_date(element) {
	if (element.val()) {
		tadv_term = $('#tadv-term').val();
		id_city = $('#tadv-city').val();
		if (tadv_term != '') {
			$.ajax({
				url: '/adv/getdate',
				method: "POST",
				data: {date: element.val(), date_time: tadv_term},
				dataType: "json",
				complete: function (data) {
					if (data.responseJSON['result'] == true) {
						$('.last-date').html(data.responseJSON['date']);
						start_date = element.val();
						end_date = data.responseJSON['date'];
						selectTime = $('#showTime').val();
						ajax_getTermianl();
					}
				}
			});
		}
	}
}

function format_change(value) {
	if (value) {
		format = value;
		$.ajax({
			url: '/adv/changeformat',
			method: "POST",
			data: {action: value},
			dataType: "html",
			complete: function (data) {
				$('.format-update').html(data.responseText);
			}
		});
	}
}

function open_edit() {
	$.ajax({
		url: '/adv/openedit',
		method: "POST",
		dataType: "html",
		complete: function (data) {
			$('.slider').before('<div>'+data.responseText+'</div>');
		}
	});
	return false;
}

function filter_platform() {
	if ($('input[data-id="css"]').prop('checked')) {
		css = true;
	} else {
		css = false;
	}
	if ($('input[data-id="cst"]').prop('checked')) {
		cst = true;
	} else {
		cst = false;
	}
	if ($('input[data-id="csp"]').prop('checked')) {
		csp = true;
	} else {
		csp = false;
	}
	
	ajax_getTermianl();
}

function ajax_getTermianl() {
	$.ajax({
		url: '/adv/getterminal',
		method: "POST",
		data: {
			id_city: id_city,
			format: format,
			selectTime: selectTime,
			start_date: start_date,
			end_date: end_date,
			css: css,
			cst: cst,
			csp: csp,
			work_time_12: work_time_12,
			work_time_24: work_time_24,
		},
		dataType: "json",
		complete: function (data) {
			$('.table tbody').html('');
			if (data.responseJSON['result'] == true) {
				for (i = 0;i < data.responseJSON['array_terminal'].length;i++) {
					$('.table tbody').append('<tr>' +
						'<td class="main-text">'+
							'<div>'+data.responseJSON['array_terminal'][i]['platforma']+'</div>'+
							'<div>'+data.responseJSON['array_terminal'][i]['place']+'<br></div>'+
							'<div>'+data.responseJSON['array_terminal'][i]['name']+'</div>'+
							'<div>'+data.responseJSON['array_terminal'][i]['address']+'</div>'+
						'</td>'+
						'<td class="main-text">'+
							'<div>'+data.responseJSON['array_terminal'][i]['num']+'</div>'+
						'</td>'+
						'<td class="main-text">'+
							'<div>'+data.responseJSON['array_terminal'][i]['price']+'</div>'+
						'</td>'+
						'<td class="main-text">'+
							'<div class="checkbox checkbox-info checkbox-inline">'+
								'<input id="terminal-'+data.responseJSON['array_terminal'][i]['id_terminal']+'" data-terminal-id="'+data.responseJSON['array_terminal'][i]['id_terminal']+'" type="checkbox" class="terminal-check" onclick="select_terminal($(this))" name="adv_terminal[]" value="'+data.responseJSON['array_terminal'][i]['id_terminal']+'">'+
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
	$('input[class="terminal-check"]').each(function(i, element) {
		if ($(this).prop('checked')) {
			count++;
		}
	});
	$('#order-block-1 div:nth-child(2)').html(count);
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