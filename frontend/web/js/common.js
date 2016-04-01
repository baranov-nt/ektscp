/*common.js*/
$ = jQuery;
/*ajax*/
function ajax_server_error(data, err_type, is_dialog) {
	var m_ajax_error_messages = new Array();
	m_ajax_error_messages[1] = "Ошибка связи с сервером. Пожалуйста проверьте подключение к интернету и попробуйте ещё раз.";
	m_ajax_error_messages[2] = "Ошибка связи с сервером.";
	err_type = err_type || 1;
	if(data.status == 403) {
		alert(common_messages["forbidden"]);
	}
	else {
		alert(data.responseText);
		if(is_dialog) {
			var pos = $(".ui-dialog-titlebar").offset();
			var cssObj = { left: pos.left+5, top: pos.top+5 };
			$("#ajax-error-message").css(cssObj);
		} else {
			var cssObj = { left: 10, top: 10 };
			$("#ajax-error-message").css(cssObj);
		}
		$("#ajax-error-message").html(m_ajax_error_messages[err_type]).show();
	}
}

function ajax_server_error_hide() { $("#ajax-error-message").hide(); }

function ajax_add_css(css_array) {
	for(key in css_array) {
		//$('head').append('<link rel="stylesheet" href="'+css_array[key]+'?r='+Math.random()+'" type="text/css" class="dLoad" />');
		var hd = document.createElement("link");
		hd.type="text/css";
		hd.rel = "stylesheet";
		if(random_mode) hd.href= css_array[key]+'?r='+Math.random();
		else hd.href= css_array[key]+'?v='+version;
		$(hd).addClass("dLoad");
		document.getElementsByTagName('head')[0].appendChild(hd);
	}
}

function ajax_add_js(js_array) {
	var script;
	
	for(key in js_array) {
		script = document.createElement('script');
		script.type = 'text/javascript';
		if(random_mode) script.src = js_array[key]+'?r='+Math.random();
		else script.src = js_array[key]+'?v='+version;
		$(script).addClass("dLoad");
		document.getElementsByTagName('head')[0].appendChild(script);
	}
}

function load_content(data, selector) {
	$(selector).html(data['html']);
	ajax_add_css(data['css']);
	ajax_add_js(data['js']);
}