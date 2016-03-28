/*catalog-cars.js*/
$(document).ready(function () {
	$(".day.current").each(function () {
		$(".catalog-card .info-content").css({ position: "absolute", visibility: "hidden", display: "block" });
		$(this).css("border-radius", $(this).outerWidth()/2);
		$(this).css("width", $(this).outerWidth()+"px");
		$(this).css("line-height", $(this).outerWidth()+"px");
		$(this).css("margin-top", ((20 - $(this).outerWidth())/2)+"px");
		$(".catalog-card .info-content").css({ position: "", visibility: "", display: "" });
	});
	
	$(document).on("click", ".catalog-card .info-item .right", function () {
		if($(this).hasClass("up")) {
			$(this).removeClass("up");
			$(this).parent().next().slideUp();
		}
		else {
			$(this).addClass("up");
			$(this).parent().next().slideDown();
		}
	});

	$(document).on("click", ".open", function () {
		if($(this).hasClass("up")) {
			$(this).removeClass("up");
			$('.hide_filter').slideUp();
		}
		else {
			$(this).addClass("up");
			$('.hide_filter').slideDown();
		}
	});
	
	var softSlider = document.getElementById('slider');

	noUiSlider.create(softSlider, {
		start: 0,
		range: {
			min: 0,
			max: 24
		},
		pips: {
			mode: 'values',
			values: [0, 4, 8, 12, 16, 20, 24],
			density: 4
		}
	});		
});


/*Map*/
var map;
var markers = [];
var active_marker = false;

var icon1 = "/images/place-icon-off.png";
var icon2 = "/images/place-icon-over.png";
var icon3 = "/images/place-icon-on.png";

function initMap() {
	var mapDiv = document.getElementById('map');
	map = new google.maps.Map(mapDiv, {
      center: {lat: 57.911973, lng: 59.988096},
      zoom: 14
    });
	setMapSize();
	$(window).resize(setMapSize);
	/*initInfoBox();
	$("#map-city").change(map_city_change).change();*/
	$.ajax({ 
		type: 'GET',       // Use the GET method.
		url: '/terminals/get_terminals_by_city/402',
		async: false,
		dataType: 'json',
		data: {	},
		error: function (data) { /*ajax_server_error(data);setTimeout(3000, map_city_change);*/  },
		success: function (data) {
			removeMarkers();
			addMarkers(data);			
		}
	});
}
function setMapSize() {
	if($("body").width() > 700) {
		m_h = Math.max($("body").height() - $("#map").position().top - $(".footer").outerHeight(), 300);
		$("#map").height(m_h);
		/*$("#rating").css("margin-top", - m_h + 20);
		$("#rating").css("width", "300px");
		$(".r-items").css("max-height", m_h - 20 - 40 - 112);*/
	} else {
		/*$("#rating").css("margin-top", 20);
		$("#rating").css("width", " 100%");
		$(".r-items").css("max-height", 400);*/
	}
}

function addMarkers(data) {
	var bounds = new google.maps.LatLngBounds();
	
	for(i in data) {
		var c = data[i].coordinates.split(",");
		
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(parseFloat(c[0]), parseFloat(c[1])),
			map: map,
			icon: icon1,
			content: data[i].id_terminal
		});
		markers.push(marker);
		//extend the bounds to include each marker's position
		bounds.extend(marker.position);
		marker.addListener('click', function(e){
			if(active_marker) active_marker.setIcon(icon1);
			active_marker = this;
			this.setIcon(icon3);
		});
		google.maps.event.addListener(marker, 'mouseover', function() {
			if(this != active_marker) this.setIcon(icon2);
		});
		google.maps.event.addListener(marker, 'mouseout', function() {
			if(this != active_marker) this.setIcon(icon1);
		});
	}
	//now fit the map to the newly inclusive bounds
	map.fitBounds(bounds);
	var listener = google.maps.event.addListener(map, "idle", function() { 
	  if (map.getZoom() > 16) map.setZoom(16); 
	  google.maps.event.removeListener(listener); 
	});
}
// Sets the map on all markers in the array.
function removeMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
}
/*End Map*/