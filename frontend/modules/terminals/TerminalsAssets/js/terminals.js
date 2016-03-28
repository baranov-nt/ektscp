/*terminall.js*/
$(document).ready(function(){

	$('.giveinternet input').change(function(){
		if($(this).val() == '1'){
			$('.payinternet').show();
		}else{
			$('.payinternet').hide();
			$('.paysumminternet').hide();
			$('.payinternet input').prop('checked', false);
		}		
	});
	
	$('.payinternet input').change(function(){
		if($(this).val() == '1'){
			$('.paysumminternet').show();
		}else{
			$('.paysumminternet').hide();
		}		
	});		
	
	$('.rent input').change(function(){
		if($(this).val() == '1'){
			$('.rentsumm').show();
			$('.renttender').hide();
		}else if($(this).val() == '0'){
			$('.rentsumm').hide();
			$('.renttender').hide();
		}else if($(this).val() == '2'){
			$('.renttender').show();
			$('.rentsumm').hide();
		}				
	});

	$('.electricity input').change(function(){
		if($(this).val() == '1'){
			$('.electricitysumm').show();
		}else{
			$('.electricitysumm').hide();
		}		
	});	


	
});

function add_image_file(thisis){
	count = $('.some-image').length;	
	$('.image-block').append('<div class="some-image"><div><span class="count-image">'+(count + 1)+')</span><div class="attachfile"><input id="upload_image_'+(count + 1)+'" class="btn btn-default" onclick="return false;"><div>Прикрепить фотографию</div></div><span class="delete_image" onclick="delete_image_file($(this));">X</span></div><div><div class="media"><div class="upload_image"><img id="selector_image_'+(count + 1)+'"></div></div></div></div>');

	registerNewButton('upload_image_'+(count + 1));
	
	input_name['upload_image_'+(count + 1)] = 'id_file_image_'+(count + 1);
	
	selector_file['upload_image_'+(count + 1)] = 'selector_image_'+(count + 1);
}

function delete_image_file(thisis){
	thisis.parents('.some-image').remove();
}

function checkattachid(){
	if($('.attachfile').length == 1){
		attach = $('.attachfile').find('input[type=hidden]').val();
	}else if($('.attachfile').length > 1){
		var	attach_id = [];
		$('.attachfile').find('input[type=hidden]').each(function(i){
			attach_id[i] = $(this).val();		
		});		
		attach = attach_id.join(';');
	}
	
	$('.attached_file input').val(attach);
}

function addSelection(thisis, value, id) {
	
	thisis.parents('.dropdownselect').find('.selectionblock div').append('<span class="selectelement" data-id="'+id+'" data-value="'+value+'">'+value+' <span class="fa fa-times-circle fa-lg text-default times" onclick="districtDelete($(this))">&nbsp;</span></span>');
	
	if(thisis.parents('.dropdownselect').find('.selectelement').length == 1){
		elements = thisis.parents('.dropdownselect').find('.selectelement').attr('data-id');		
	}else if(thisis.parents('.dropdownselect').find('.selectelement').length > 1){
		var	element_id = [];
		thisis.parents('.dropdownselect').find('.selectelement').each(function(i){
			element_id[i] = $(this).attr('data-id');
		});		
		elements = element_id.join(';');
	}else if(thisis.parents('.dropdownselect').find('.selectelement').length < 1){
		elements = '';
	}
	
	thisis.parents('.dropdownselect').find('.selectioninput input').val(elements);		
		
	thisis.parent().remove();
	
	return false;
	
}

function districtDelete(element) {
	value = element.parent().attr('data-value');
	id = element.parent().attr('data-id');	
	
	element.parents('.dropdownselect').find('ul.dropdown-menu').append('<li data-id="'+id+'"><a href="#" onclick="addSelection($(this),  $(this).text(), '+id+'); return false;">'+value+'</a></li>');
	
	if(element.parents('.dropdownselect').find('.selectelement').length == 1){
		elements = element.parents('.dropdownselect').find('.selectelement').attr('data-id');		
	}else if(element.parents('.dropdownselect').find('.selectelement').length > 1){
		var	element_id = [];
		element.parents('.dropdownselect').find('.selectelement').each(function(i){
			element_id[i] = $(this).attr('data-id');
		});		
		elements = element_id.join(';');
	}else if(element.parents('.dropdownselect').find('.selectelement').length < 1){
		elements = '';
	}

	element.parents('.dropdownselect').find('.selectioninput input').val(elements);		

	element.parent().remove();
}