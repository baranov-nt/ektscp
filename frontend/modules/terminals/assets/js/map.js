/*map.js*/
var map;
var markers = [];
var m_infoBox = null;

var map_icons = [ ['/images/icons/terminal-active.png', '/images/icons/terminal-active-feature.png', '/images/icons/terminal-feature.png'],
					[ '/images/icons/css-outdoor.png', '/images/icons/css-outdoor.png', '/images/icons/css-outdoor.png' ],
					[ '/images/icons/CST_on.png', '/images/icons/CST_on.png', '/images/icons/CST_on.png' ]
				];
var domain = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port : '');

$(document).ready(function() {  
	$("#rating .r-items").niceScroll({
		cursorcolor: "#808285", // change cursor color in hex
		cursorwidth: "3px", // cursor width in pixel (you can also write "5px")
		cursorborder: "", // css definition for cursor border
		cursorborderradius: "", // border radius in pixel for cursor
		autohidemode: false,         
		background: "url(/images/v-scroll-bg.png)" // change css for rail background
	});
});

function initMap() {
	var mapDiv = document.getElementById('map');
	map = new google.maps.Map(mapDiv, {
      center: {lat: 57.911973, lng: 59.988096},
      zoom: 14
    });
	setMapSize();
	$(window).resize(setMapSize);
	initInfoBox();
	$("#map-city").change(map_city_change).change();
	//$("#rating .like-buttons div").on('click', social_click);
}

function setMapSize() {
	if($("body").width() > 700) {
		m_h = Math.max($("html").height() - $("#map").position().top - $(".footer").outerHeight(), 300);
		$("#map").height(m_h);
		$("#rating").css("margin-top", - m_h + 20);
		$("#rating").css("width", "300px");
		$(".r-items").css("max-height", m_h - 20 - 40 - 112);
	} else {
		$("#rating").css("margin-top", 20);
		$("#rating").css("width", "100%");
		$(".r-items").css("max-height", 400);
	}
}

function map_city_change() {
	//ajax_server_error_hide();
	$.ajax({ 
		type: 'GET',       // Use the GET method.
		url: '/terminals/get_terminals_by_city/' + $("#map-city").val(),
		async: false,
		dataType: 'json',
		data: {	},
		error: function (data) { /*ajax_server_error(data);*/ setTimeout(3000, map_city_change); },
		success: function (data) {
			removeMarkers();
			addMarkers(data);			
		}
	});
}

function addMarkers(data) {
	var bounds = new google.maps.LatLngBounds();
	var f_cnt = 0;
	$("#rating").hide();
	var nice = $("#rating .r-items").getNiceScroll();
	$("#rating .r-items").html("");
	nice.resize();
	for(i in data) {
		var c = data[i].coordinates.split(",");
		
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(parseFloat(c[0]), parseFloat(c[1])),
			map: map,
			icon: data[i].status ? map_icons[map_type][0] : data[i].install_date ? map_icons[map_type][1] : map_icons[map_type][2],
			content: '<div id="terminal-'+data[i].id_terminal+'" class="terminal-info' + (!data[i].status && data[i].install_date ? ' install' : '') + '"><div class="main-text-dep">' + data[i].place + '</div><div class="main-text-2">' + data[i].address + (data[i].status ? '' : (data[i].install_date ? '<br />' + data[i].install_date : '</div><div class="like-buttons"><div class="fb-like" data-href="'+domain+'/terminals/map?id='+data[i].id_terminal+'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div><div id="vk_like_map-' + data[i].id_terminal + '" class="vk-like"></div>')) + '</div></div>',
			eval_code: data[i].status ? '' : 'if(FB) FB.XFBML.parse(document.getElementById("terminal-'+data[i].id_terminal+'")); VK.Widgets.Like("vk_like_map-' + data[i].id_terminal + '", {type: "mini"}, ' + data[i].id_terminal + ');',
			classes: data[i].status ? 'active' : 'feature',
			offsetVertical: data[i].status ? -146 : -177
		});
		markers.push(marker);
		//extend the bounds to include each marker's position
		bounds.extend(marker.position);
		marker.addListener('click', function(e){
			if(m_infoBox) m_infoBox.setMap(null);
			m_infoBox = new InfoBox({
				latlng: this.getPosition(),
				map: map,
				content: this.content,
				eval_code: this.eval_code,
				classes: this.classes,
				offsetVertical: this.offsetVertical,
				offsetHorizontal: -14
			});//alert(this.content);
			// $(".infobox").append('<script type="text/javascript">alert(1);</script>');
		});
		if(map_type == "0" && !data[i].status) {
			f_cnt++;
			$("#rating .r-items").append('<div class="r-item"><div class="teminal-info main-text-dep">' + data[i].place + '</div><div class="terminal-address main-text-2">' + data[i].address + '</div>' +
			'<div class="like-buttons clearfix" rel="' + data[i].id_terminal + '"><div class="fb-like" data-href="'+domain+'/map?id='+data[i].id_terminal+'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div><div id="vk_like-'+data[i].id_terminal+'" class="vk"></div></div></div>');
			VK.Widgets.Like("vk_like-" + data[i].id_terminal, {type: "mini"}, data[i].id_terminal);
		}
	}
	if(f_cnt) {
		if(FB) FB.XFBML.parse(document.getElementById("rating"));
		nice.resize();
		$("#rating").show();
	}
	//now fit the map to the newly inclusive bounds
	map.fitBounds(bounds);
	var listener = google.maps.event.addListener(map, "idle", function() { 
	  if (map.getZoom() > 16) map.setZoom(16); 
	  google.maps.event.removeListener(listener); 
	});
	//setTimeout(social_get_counts, 1000);
}

// Sets the map on all markers in the array.
function removeMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  if(m_infoBox) m_infoBox.setMap(null);
}

function social_click() {
	switch($(this).attr("class")) {
		case "vk":
			window.open("http://vk.com/share.php?url=http%3A%2F%2Fscp.aliscom.ru%2Fterminals%2Fmap%3Fid%3D" + $(this).parent().attr("rel"),'displayWindow', 'width=700,height=400,left=200,top=100,location=no, directories=no,status=no,toolbar=no,menubar=no');
			break;
		case "ok":
			window.open("http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=http%3A%2F%2Fscp.aliscom.ru%2Fterminals%2Fmap%3Fid%3D" + $(this).parent().attr("rel"),'displayWindow', 'width=700,height=400,left=200,top=100,location=no, directories=no,status=no,toolbar=no,menubar=no');
			break;
		case "fb":
			window.open("http://www.facebook.com/sharer.php?u=http%3A%2F%2Fscp.aliscom.ru%2Fterminals%2Fmap%3Fid%3D" + $(this).parent().attr("rel"),'displayWindow', 'width=700,height=400,left=200,top=100,location=no, directories=no,status=no,toolbar=no,menubar=no');
			break;
		case "tw":
			window.open("http://twitter.com/share?url=http%3A%2F%2Fscp.aliscom.ru%2Fterminals%2Fmap%3Fid%3D" + $(this).parent().attr("rel"),'displayWindow', 'width=700,height=400,left=200,top=100,location=no, directories=no,status=no,toolbar=no,menubar=no');
			break;
	}
	$(this).text((parseInt($(this).text()) || 0)+1);
}

function social_get_counts() {
	$("#rating .like-buttons").each(function () {
		var m_this = $(this);
		/* facebook */
		$.getJSON("http://api.facebook.com/restserver.php?method=links.getStats&urls=http%3A%2F%2Fscp.aliscom.ru%2Fterminals%2Fmap%3Fid%3D" + $(this).attr("rel") + "&callback=?&format=json", function(data) {
		  m_this.find(".fb").text(data[0].like_count);
		});
		/* vk */
		VK = {};
        VK.Share = {};
        // объявляем callback метод
        VK.Share.count = function(index, count){
            // вставляем в DOM
           $("#rating .like-buttons[rel='"+index+"'] .vk").text(count);
        };
		$.getJSON("http://vk.com/share.php?act=count&index="+$(this).attr("rel")+"&url=http%3A%2F%2Fscp.aliscom.ru%2Fterminals%2Fmap%3Fid%3D" + $(this).attr("rel") + "&callback=?&format=json");
		/* ok */
		ODKL = {};
        ODKL.updateCount = function(index, count){
            // вставляем в DOM
           $("#rating .like-buttons[rel='"+index+"'] .ok").text(count);
        };
		$.getJSON("https://connect.ok.ru/dk?st.cmd=extLike&uid="+$(this).attr("rel")+"&ref=http%3A%2F%2Fscp.aliscom.ru%2Fterminals%2Fmap%3Fid%3D" + $(this).attr("rel") + "&callback=?&format=json");
	});
}
