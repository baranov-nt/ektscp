// Создание переменных (в этой области), чтобы держать API и размер изображения
var xsize, ysize, pimg, preview, pcnt, jcrop_api, boundx, boundy;
function community_logo_jcrop() {
	// Захватите некоторые сведения о панели предварительного просмотра
		preview = $('#preview-pane');
		pcnt = $('#preview-pane .preview-container');
		pimg = $('#preview-pane .preview-container img');
		ratio = $('#ratio').val();
		xsize = pcnt.width(),
		ysize = pcnt.height();
	if(jcrop_api) jcrop_api.destroy();
	$('#target').Jcrop({
		onChange: updatePreview,
		onSelect: updatePreview,
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
		preview.appendTo(jcrop_api.ui.holder);
		updatePreview(jcrop_api.tellSelect());
	});
}

function updatePreview(c){
	if (parseInt(c.w) > 0){
		rx = xsize / c.w;
		ry = ysize / c.h;
		$('#id_file_x').val('-' + Math.round(rx * c.x) + 'px');
		$('#id_file_y').val('-' + Math.round(ry * c.y) + 'px');
		$('#id_file_w').val(Math.round(rx * boundx) + 'px');
		$('#id_file_h').val(Math.round(ry * boundy) + 'px');
			
		pimg.css({
			width: Math.round(rx * boundx) + 'px',
			height: Math.round(ry * boundy) + 'px',
			marginLeft: '-' + Math.round(rx * c.x) + 'px',
			marginTop: '-' + Math.round(ry * c.y) + 'px'
		});
	}
};