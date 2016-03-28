<?php
use frontend\components\widgets\assets\WidgetUploadAsset;

Yii::$app->assetManager->forceCopy = true;

WidgetUploadAsset::register($this);
?>
<?if(!$popup_hidden){?>
	<div class="upload_overlay"></div>
	<div class="upload_popup" style="min-height: 103px; position: fixed;">
		<a class="upload_close_popup" onclick="popup_close();" title="Закрыть"></a>
		<div id="no_crop">
			<div class="upload_order" style="font-weight: 300; color: rgb(88, 89, 91); padding-top: 11px;">Чтение файла</div>
			<div class="upload_comment_msg">
				<div id="progress-div">
					<div id="progress-bar">
						<span id="progress-status"></span>
					</div>
				</div>
				<div id="progress-bytes"></div>
			</div>
			<div id="progress-error"></div>
		</div>
		<div id="yes_crop" style="display: none;">
			<div class="selected_area">Выберите область для отображения на странице</div>
			<div class="target">
				<img src="#" id="target" />
			</div>
			<input type="button" class="orange-button save_logo" value="Сохранить"/>
			<input type="hidden" id="id_file_x" name="id_file_x"/>
			<input type="hidden" id="id_file_y" name="id_file_y"/>
			<input type="hidden" id="id_file_w" name="id_file_w" value="<?=$width?>px"/>
			<input type="hidden" id="id_file_h" name="id_file_h" value="<?=$height?>px"/>
		</div>
	</div>
<?}?>
<?if($jcrop){?>
	<style>
		.target>img{
			max-width: <?=$jcrop['width']?>px;
		}
	</style>
<?}?>
<script>
<?if($input_name){?>
	input_name = new Array();
	<?foreach($input_name as $key => $val){?>
		input_name['<?=$key?>'] = '<?=$val?>';
<?	}
}?>
<?if($name_old_file){?>
	name_old_file = new Array();
	<?foreach($name_old_file as $key => $val){?>
		name_old_file['<?=$key?>'] = '<?=$val?>';
<?	}
}?>
<?if($selector_file){?>
	selector_file = new Array();
	<?foreach($selector_file as $key => $val){?>
		selector_file['<?=$key?>'] = '<?=$val?>';
	<?}?>
<?}?>

create = new Array();
var arr_ext, btnUpload, xsize, ysize, jcrop_api, boundx, boundy, required_width, required_height, img_org_width, img_org_height, photo;
var upload_buttons_cnt = 0;

function registerNewButton(id) {
	$('#'+id).click(function(){
		btnUpload = id;
		upload_buttons_cnt++;
		$('.preview_video').css({background: '#77dcfc'});
		if(!create[upload_buttons_cnt]){
			$('body').append('<div id="upload_'+id+'" style="position: absolute;top: -1000000px;left: -1000000px;"></div>');
			create[upload_buttons_cnt] = true;
		}
		$('#upload_'+id+'').html('<input type="file" name="upl_file_'+id+'" id="upl_file_'+id+'" /><input type="submit" onclick="return false;">');
		document.getElementById('upl_file_'+id).click();
		document.getElementById('upl_file_'+id).addEventListener('change', UploadFiles, false);
	});
}
//для формы
$(document).ready(function() {
	<?if($jcrop){?>
		required_width = '<?=$jcrop['width']?>';
		required_height = '<?=$jcrop['height']?>';
	<?}?>
	/////////////////////////////
	<?for($i=0;$i<count($upload_button);$i++){?>
		$('#<?=$upload_button[$i]?>').click(function(){
			btnUpload = '<?=$upload_button[$i]?>';
			if(!create[<?=$i?>]){
				$('body').append('<div id="upload_<?=$upload_button[$i]?>" style="position: absolute;top: -1000000px;left: -1000000px;"></div>');
				create[<?=$i?>] = true;
			}
			$('#upload_<?=$upload_button[$i]?>').html('<input type="file" name="upl_file_<?=$upload_button[$i]?>" id="upl_file_<?=$upload_button[$i]?>"?>/><input type="submit" onclick="return false;">');
			document.getElementById('upl_file_<?=$upload_button[$i]?>').click();
			document.getElementById('upl_file_<?=$upload_button[$i]?>').addEventListener('change', UploadFiles, false);
		});
	<?}?>
	upload_buttons_cnt = <?=count($upload_button)?>;
	
	$(document).on('click', '.save_logo', function(){
		$('.upload_popup, .upload_overlay').hide();
		$('.upload_popup').css({width: 504, position: 'fixed'});
		$('#no_crop').show();
		$('#yes_crop').hide();
		$('.jcrop-holder, .jcrop-tracker, .popup img, .jcrop-holder img').css({
			width: '',
			height: ''
		});
		
		new_x = $('#id_file_x').val().split('px');
		new_y = $('#id_file_y').val().split('px');
		
		parent = $('#'+selector_file[btnUpload]).parent('div');
		selector_w = Math.round(parseInt(parent.css('width')) * required_width / xsize);
		selector_h = Math.round(parseInt(parent.css('height')) * required_height / ysize);
		selector_x = Math.round(new_x[0] * parseInt(parent.css('width')) / required_width);
		selector_y = Math.round(new_y[0] * parseInt(parent.css('height')) / required_height);
		
		if(btnUpload != undefined){
			$('#'+selector_file[btnUpload]).css({
				'width': selector_w,
				'margin-left': selector_x,
				'margin-top': selector_y
			}).show();
		}
	});
});

function UploadFiles(event){
	$('.upload_overlay').show();
	$('.upload_popup').css({width: 535});
	$('.upload_popup').show();
	
	file = event.target.files[0];
	arr_ext = file.name.split('.');
	
	$("#progress-bar").width('0%');
	$("#progress-status").css('color', '#000');
	$("#progress-status").text('0%');
	$("#progress-bytes").text('');
	$('#progress-error').html('');
	$('.upload_popup .upload_order').text('Чтение файла');
	
	regu = /^(<?=$extensions?>)$/i;
	
	if (!(arr_ext[arr_ext.length-1] && regu.test(arr_ext[arr_ext.length-1]))){
		$('#progress-error').html('Вы выбрали запрещённый файл!');
		return false;
	}

	fr = new FileReader();
	fr.onprogress = updateProgress;
 	fr.onload = function (e) {
		img = new Image();       
		img.src = e.target.result;
		//Ниже для Jcrop
		img_org_width = img.width;
		img_org_height = img.height;
	};
	fr.onloadend = function(){
		$('.upload_popup .upload_order').text('Файл загружается');
		
		formData = new FormData();
		formData.append('ext', arr_ext[arr_ext.length-1]);
		formData.append('upl_file', file);

		var xhr = new XMLHttpRequest();
		xhr.open('POST', '/site/uploadfiles', true);
		xhr.upload.onprogress = onProgress;
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4) {
				if(xhr.status == 200) {
					response = xhr.responseText;
					arr_resp = $.parseJSON(response);
					if(arr_resp['id_file']){
						<?if($selector_file){?>
							$('#'+selector_file[btnUpload]).attr('src', arr_resp['file']);
							$('#'+selector_file[btnUpload]).show();
						<?}?>
						<?if($input_name){?>
							if(!$('input[name="'+input_name[btnUpload]+'"]').length){
								$('#'+btnUpload).after('<input type="hidden" name="'+input_name[btnUpload]+'" value="'+arr_resp['id_file']+'"/>');				
							} else {
								$('input[name="'+input_name[btnUpload]+'"]').val(arr_resp['id_file']);
							}
						<?}?>
						
						<?if ($image_terminal) {?>
							checkattachid();
						<?}?>
						
						//Для вставки оригинального названия файла
						<?if ($name_old_file) {?>
							$('input[name="'+name_old_file[btnUpload]+'"]').val(document.getElementById('upl_file_'+btnUpload).files[0].name);
						<?}?>
						
						setTimeout(function(){
							regu_img = /^(gif|jpg|jpeg|png)$/i;
							regu_video = /^(mp4|wmv|mov|avi)$/i;
							if(regu_img.test(arr_ext[arr_ext.length-1])) {
								<?if ($jcrop) {?>
									<?if ($different_loading) {?>
										parent = $('#'+selector_file[btnUpload]).parent('div');
										$('#'+selector_file[btnUpload]).remove();
										parent.append('<img id="'+selector_file[btnUpload]+'" src="'+arr_resp['file']+'"/>');
									<?}?>
									$('.upload_popup').css({width: parseInt(required_width) + 35, position: 'absolute'});
									$('.target>img').css({width: required_width});
									$('#target').attr('src', arr_resp['file']).show();
									$('#no_crop').hide();
									$('#yes_crop').show();
									
									image_jcrop();
								<?} else {?>
									<?if ($different_loading) {?>
										parent = $('#'+selector_file[btnUpload]).parent('div');
										$('#'+selector_file[btnUpload]).remove();
										parent.append('<img id="'+selector_file[btnUpload]+'" src="'+arr_resp['file']+'"/>');
									<?}?>
									$('.upload_overlay').hide();
									$('.upload_popup').hide();
								<?}?>
							} else if (regu_video.test(arr_ext[arr_ext.length-1])) {
								<?if ($different_loading) {?>
							console.log(arr_ext[arr_ext.length-1]);
									parent = $('#'+selector_file[btnUpload]).parent('div');
									$('#'+selector_file[btnUpload]).remove();
									parent.append('<video src="'+arr_resp['file']+'" id="'+selector_file[btnUpload]+'" style="width: '+parent.width()+'px;" onclick="play_and_stop(this, $(this));"></video>');
								<?}?>
								$('.upload_overlay').hide();
								$('.upload_popup').hide();
							} else {
								$('.upload_overlay').hide();
								$('.upload_popup').hide();
							}
							$("#progress-bar").width('0%');
							$("#progress-status").css('color', '#000');
							$("#progress-status").text('0%');
							$("#progress-bytes").text('');
							$("#progress-error").html('');
						}, 1000);
					}else{
						var errors = '';
						for(err in arr_resp['errors']){
							errors += arr_resp['errors'][err]+'<br>';
						}
						$('#progress-error').html('Файл не сохранен!<br>');
						$('#progress-error').append(errors);
						d_err = false;
					}
				}
			}
		};
		xhr.send(formData);  // multipart/form-data
	};
	fr.readAsDataURL(file);
}

function onProgress(e) {
	var percent = Math.round((e.loaded / e.total) * 100);
	if(percent < 100){
		if(Math.round((e.loaded / 1024) / 1024) < 1){
			val1 = 'килобайт(а)';
			val2 = 'килобайт(а)';
			num_val = Math.round(e.loaded / 1024);
			num_val2 = Math.round(e.total / 1024);
			$("#progress-bytes").text('Загружено '+num_val+' '+val1+' из '+num_val2+' '+val2+'.');
		} else {
			val1 = 'мегабайт(а)';
			val2 = 'мегабайт(а)';
			num_val = Math.round((e.loaded / 1024) / 1024);
			num_val2 = Math.round((e.total / 1024) / 1024);
			$("#progress-bytes").text('Загружено '+num_val+' '+val1+' из '+num_val2+' '+val2+'.');
		}
	} else {
		if(Math.round((e.loaded / 1024) / 1024) < 1){
			val1 = 'килобайт(а)';
			val2 = 'килобайт(а)';
			num_val = Math.round(e.loaded / 1024);
			num_val2 = Math.round(e.total / 1024);
			$("#progress-bytes").text('Загружено '+num_val+' '+val1+' из '+num_val2+' '+val2+'.');
		} else {
			val1 = 'мегабайт(а)';
			val2 = 'мегабайт(а)';
			num_val = Math.round((e.total / 1024) / 1024);
			num_val2 = Math.round((e.total / 1024) / 1024);
			$("#progress-bytes").text('Загружено '+num_val+' '+val1+' из '+num_val2+' '+val2+'.');
		}
	}
	if(event.loaded >= (event.total / 2)) $("#progress-status").css('color', 'white');
	$("#progress-bar").width(percent+'%');
	$("#progress-bytes").text('Загружено '+num_val+' '+val1+' из '+num_val2+' '+val2+'.');
	$("#progress-status").text(percent+' %');
}

function updateProgress(e) {
	if (e.lengthComputable) {
		val1 = '';
		val2 = '';
		percentLoad = Math.round((e.loaded / e.total) * 100);
		if(percentLoad < 100){
			if(Math.round((e.loaded / 1024) / 1024) < 1){
				val1 = 'килобайт(а)';
				val2 = 'килобайт(а)';
				num_val = Math.round(e.loaded / 1024);
				num_val2 = Math.round(e.total / 1024);
				$("#progress-bytes").text('Прочитано '+num_val+' '+val1+' из '+num_val2+' '+val2+'.');
			} else {
				val1 = 'мегабайт(а)';
				val2 = 'мегабайт(а)';
				num_val = Math.round((e.loaded / 1024) / 1024);
				num_val2 = Math.round((e.total / 1024) / 1024);
				$("#progress-bytes").text('Прочитано '+num_val+' '+val1+' из '+num_val2+' '+val2+'.');
			}
		} else {
			if(Math.round((e.loaded / 1024) / 1024) < 1){
				val1 = 'килобайт(а)';
				val2 = 'килобайт(а)';
				num_val = Math.round(event.total / 1024);
				num_val2 = Math.round(event.total / 1024);
				$("#progress-bytes").text('Прочитано '+num_val+' '+val1+' из '+num_val2+' '+val2+'.');
			} else {
				val1 = 'мегабайт(а)';
				val2 = 'мегабайт(а)';
				num_val = Math.round((event.total / 1024) / 1024);
				num_val2 = Math.round((event.total / 1024) / 1024);
				$("#progress-bytes").text('Прочитано '+num_val+' '+val1+' из '+num_val2+' '+val2+'.');
			}
		}
		if(event.loaded >= (event.total / 2)) $("#progress-status").css('color', 'white');
		$("#progress-bar").width(percentLoad+'%');
		$("#progress-status").text(percentLoad+' %');
	}
}

function popup_close(){
	$('.upload_popup, .upload_overlay').hide();
	$('.upload_popup').css({width: 504, position: 'fixed'});
	$('#no_crop').show();
	$('#yes_crop').hide();
	$('.jcrop-holder, .jcrop-tracker, .popup img, .jcrop-holder img').css({
		width: '',
		height: ''
	});
	
	$("#progress-bar").width('0%');
	$("#progress-status").css('color', '#000');
	$("#progress-status").text('0%');
	$("#progress-bytes").text('');
	$('#progress-error').html('');
	$('.upload_popup .upload_order').text('Чтение файла');
	if($('#upvd').length) document.getElementById('upvd').remove();
	d_err = false;
	<?if($name_old_file){?>
		$('input[name="'+name_old_file[btnUpload]+'"]').val('');
	<?}?>
}

//jcrop
function image_jcrop(){
	// Захватите некоторые сведения о панели предварительного просмотра
	xsize = required_width * required_width / img_org_width;
	ysize = required_height * required_width / img_org_width;

	if(jcrop_api) jcrop_api.destroy();
	$('#target').Jcrop({
		onChange: updateTarget,
		onSelect: updateTarget,
		minSize: [ xsize, ysize],
		setSelect: [ 0, 0, xsize, ysize ],
		aspectRatio: xsize / ysize
	},function(){
		// Используйте API, чтобы получить реальный размер изображения
		var bounds = this.getBounds();
		boundx = bounds[0];
		boundy = bounds[1];
		// Храните API в переменной jcrop_api
		jcrop_api = this;

		// Переместить окно предварительного просмотра в jcrop контейнер для CSS позиционирования
		updateTarget(jcrop_api.tellSelect());
	});
}

function updateTarget(c){
	if (parseInt(c.w) > 0){
		rx = required_width / c.w;
		ry = required_height / c.h;
		
		xsize = c.w;
		ysize = c.h;

		$('#id_file_x').val('-' + Math.round(rx * c.x) + 'px');
		$('#id_file_y').val('-' + Math.round(ry * c.y) + 'px');
		$('#id_file_w').val(Math.round(rx * boundx) + 'px');
		$('#id_file_h').val(Math.round(ry * boundy) + 'px');
	}
};
</script>
</script>