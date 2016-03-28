var MoneySlider, id_city;
var css = false, cst = false, csp = false;
var click_play;
var work_time_12 = false, work_time_24 = false;
var selectInfo = 0;
$(document).ready(function(){
	$('.slider').slick({
		dots: true,
		slidesToShow: 1,
		slidesToScroll: 1,
	});

	currentSlide = $('.slider').slick('slickCurrentSlide');
	templateHeader = $('div[data-slick-index="' + currentSlide + '"]>span').attr('data-text');
	$('.template-header').text(templateHeader);
		
	$('.slider').on('afterChange', function(event, slick, currentSlide){
		currentSlide = $('.slider').slick('slickCurrentSlide');
		templateHeader = $('div[data-slick-index="' + currentSlide + '"]>span').attr('data-text');
		$('.template-header').text(templateHeader);
		//$('#order-block-1 div:nth-child(8)').html(templateHeader);
	});
	/////////////////////
	/////////////////////
	/////////////////////
	$('.period-button div').on('click', function(){
		$('.period-button div').each(function(i, element){
			if ($(element).hasClass('button-panel-active')) {
				$(element).removeClass('button-panel-active');
				$(element).addClass('button-panel-noactive');
			}
		});
		$(this).removeClass('button-panel-noactive');
		$(this).addClass('button-panel-active');
		if ($('.period-picker').val()) {
			select_date($('.period-picker'));
		}
	});
	
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

function checkboxPanel(element, number_element) {
	$('.last-block .check').each(function(i, el){
		if ($(el).hasClass('checkbox-panel-active')) {
			$(el).find('input').prop('checked', false);
			$(el).removeClass('checkbox-panel-active');
			$(el).addClass('checkbox-panel-noactive');
		}
	});
	if (number_element == 1 || number_element == 2) {
		if ($(element).find('input').prop('checked')) {
			$(element).find('input').prop('checked', false);
			if (number_element == 1) {
				$(element).removeClass('checkbox-panel-active');
				$(element).addClass('checkbox-panel-noactive');
			} else if (number_element == 2) {
				$(element).parent('.check').removeClass('checkbox-panel-active');
				$(element).parent('.check').addClass('checkbox-panel-noactive');
			}
		} else {
			$(element).find('input').prop('checked', true);
			if (number_element == 1) {
				$(element).removeClass('checkbox-panel-noactive');
				$(element).addClass('checkbox-panel-active');
			} else if (number_element == 2) {
				$(element).parent('.check').removeClass('checkbox-panel-noactive');
				$(element).parent('.check').addClass('checkbox-panel-active');
			}
		}
	} else if (number_element == 3) {
		if ($(element).prop('checked')) {
			$(element).prop('checked', false);
		} else {
			$(element).prop('checked', true);
		}
	}
}

function selectTime(value) {
	$('#atime').val(value);
	return false;
}

function select_date(element) {
	if (element.val()) {
		period_button = $('.button-panel-active').parent('.period-button');
		if (period_button.attr('data-time') != undefined) {
			$.ajax({
				url: '/adv/getdate',
				method: "POST",
				data: {date: element.val(), date_time: period_button.attr('data-time')},
				dataType: "json",
				complete: function (data) {
					if (data.responseJSON['result'] == true) {
						$('.last-date').html(data.responseJSON['date']);
						$('#order-block-1 div:nth-child(8)').html(period_button.find('.main-text').text()
							+ '(' + element.val() + ' - ' + data.responseJSON['date'] + ')');
						periodDate = element.val() + ' - ' + data.responseJSON['date'];
						$('#adate').val(periodDate);
					}
				}
			});
		}
	}
}

function timesHover(element, result) {
	if (result) {
		$(element).addClass('text-danger');
		$(element).removeClass('text-default');
	} else {
		$(element).addClass('text-default');
		$(element).removeClass('text-danger');
	}
}

function addPlace(id_ref, value) {
	$('#category_place li a[data-id="'+id_ref+'"]').hide();
	$('#places').append('<span class="place" data-id="'+id_ref+'">'+value+' <span class="fa fa-times-circle fa-lg text-default times" onmouseover="timesHover($(this), true);" onmouseout="timesHover($(this), false);" onclick="placeDelete($(this))">&nbsp;</span></span>');
	
	ajax_getTermianl();
	return false;
}

function placeDelete(element) {
	id_ref = $(element).parent('.place').attr('data-id');
	$('#category_place li a[data-id="'+id_ref+'"]').show();
	$('#places span[data-id="'+id_ref+'"]').remove();
	
	ajax_getTermianl();
}

function format_change(value) {
	if (value) {
		$.ajax({
			url: '/adv/changeformat',
			method: "POST",
			data: {action: value},
			dataType: "html",
			complete: function (data) {
				console.log(data);
				$('.format-update').html(data.responseText);
			}
		});
	}
}

function city_change(value) {
	if (value) {
		id_city = value;
		$.ajax({
			url: '/adv/terminalarea',
			method: "POST",
			data: {id_city: id_city},
			dataType: "json",
			complete: function (data) {
				if (data.responseJSON['result'] == true) {
					ajax_getTermianl();
				}
			}
		});
	}
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
	districts = new Array();
	$('#districts>div:nth-child(1)>span').each(function(i, element){
		districts[i] = $(this).attr('data-id');
	});
	
	places = new Array();
	$('#places>span').each(function(i, element){
		places[i] = $(this).attr('data-id');
	});
	
	$.ajax({
		url: '/adv/getterminal',
		method: "POST",
		data: {
			id_city: id_city,
			districts: districts,
			css: css,
			cst: cst,
			csp: csp,
			places: places,
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
							'<div>'+data.responseJSON['array_terminal'][i]['place']+'</div>'+
							'<div>'+data.responseJSON['array_terminal'][i]['name']+'</div>'+
							'<div>'+data.responseJSON['array_terminal'][i]['address']+'</div>'+
						'</td>'+
						'<td class="main-text">'+
							'<div>'+data.responseJSON['array_terminal'][i]['num']+'</div>'+
						'</td>'+
						'<td></td>'+
						'<td class="main-text">'+
							'<div>'+data.responseJSON['array_terminal'][i]['worktime']+'</div>'+
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