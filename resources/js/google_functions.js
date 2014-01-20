
var myOptions = {
  	zoom: 8,
  	center: centerLatLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: true,
    mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        position: google.maps.ControlPosition.RIGHT_TOP
    },
    navigationControl: true,
    navigationControlOptions: {
        style: google.maps.NavigationControlStyle.ZOOM_PAN,
        position: google.maps.ControlPosition.LEFT_TOP
    },
    scaleControl: true,
    scaleControlOptions: {
        position: google.maps.ControlPosition.LEFT_CENTER
    }
};

var map = new google.maps.Map(Ext.getDom("map_canvas"), myOptions);
map.enableKeyDragZoom();
var markerCluster = new MarkerClusterer(map, []);
var mgr = new MarkerManager(map);

var clusterClickedEvt=false;	// to disable click even, when you click the cluster image
google.maps.event.addListener(markerCluster, 'clusterclick', function(event, cluster) {
	clusterClickedEvt=true;
});	

var infoWindowPanEvt=false;		// to disable idle event when the event is occurred by infowindow's pan event

google.maps.event.addListener(map, "idle", function() {

	if (!infoWindowPanEvt) {
		var params = {neLat : map.getBounds().getNorthEast().lat(),
				neLng : map.getBounds().getNorthEast().lng(),
				swLat : map.getBounds().getSouthWest().lat(),
			 	swLng : map.getBounds().getSouthWest().lng() };

		if (Ext.get('conf_log') && Ext.get('conf_business') && Ext.get('conf_property') && Ext.get('conf_job')) {
			params['conf_log'] = Ext.get('conf_log').dom.checked ? 'Y' : 'N';
			params['conf_business'] = Ext.get('conf_business').dom.checked ? 'Y' : 'N';
			params['conf_property'] = Ext.get('conf_property').dom.checked ? 'Y' : 'N';
			params['conf_job'] = Ext.get('conf_job').dom.checked ? 'Y' : 'N';
		} else {
			params['conf_log'] = 'Y';
			params['conf_business'] = 'Y';
			params['conf_property'] = 'Y';
			params['conf_job'] = 'Y';
		}

		Ext.Ajax.request({
			method: 'POST',
			params: params,
		   	url: url_prefix + 'index.php/home/get_markers',
		   	success: function(response, opts) {
		   		markers = [];
			   	var infowindow = new google.maps.InfoWindow({maxWidth: 800});
			   	// var infowindow = new InfoBubble({maxWidth: 800});

			   	var obj = Ext.decode(response.responseText);
		   		Ext.iterate(obj, function(key, data) {
			   		Ext.each(data, function(val) {
			   			var geo_loc = val.geo_loc.replace(/[\(\)POINT]/g, "").split(" ");
			   		  	var latLng = new google.maps.LatLng(geo_loc[0], geo_loc[1]);
			   			var marker = new google.maps.Marker({'position': latLng});
			   			google.maps.event.addListener(marker, "click", function() {
			   				markerClickEvt(map, marker, infowindow, val.id, key);
						});
						markers.push(marker);
			   		});
				});
		   		mgr.clearMarkers();
		   		mgr.addMarkers(markers, 3);

		   		mgr.refresh();
		   	},
		   	failure: function(response, opts) {
		      	alert('server-side failure with status code ' + response.status);
		   	}
		});
	}
	infoWindowPanEvt = false;
});

/* ==================================== old version listener ===============================
google.maps.event.addListener(map, "idle", function() {
	// console.log(map.getBounds().getNorthEast());
	// console.log(map.getBounds().getSouthWest());

	if (!infoWindowPanEvt) {
		var params = {neLat : map.getBounds().getNorthEast().lat(),
						neLng : map.getBounds().getNorthEast().lng(),
						swLat : map.getBounds().getSouthWest().lat(),
					 	swLng : map.getBounds().getSouthWest().lng() };
		Ext.Ajax.request({
			method: 'POST',
			params: params,
		   	url: url_prefix + 'index.php/home/get_markers',
		   	success: function(response, opts) {
		   		markers = [];
			   	var infowindow = new google.maps.InfoWindow({maxWidth: 800});

			   	// var infowindow = new InfoBubble({maxWidth: 800});
		   		var obj = Ext.decode(response.responseText);
		   		Ext.iterate(obj, function(key, val){
		   			// console.log(key);
		   			console.log(data);
			   		Ext.each(data, function(val){
			   			console.log(val);
			   		  	var latLng = new google.maps.LatLng(val.latitude, val.longitude);
			   			var marker = new google.maps.Marker({'position': latLng});
			   			google.maps.event.addListener(marker, "click", function() {
			   				Ext.Ajax.request({
								method: 'GET',
								params: {id: val.id},
							   	url: url_prefix + 'index.php/' + key + '/retrieve',
							   	success: function(response, opts) {
							   		google.maps.event.clearListeners(infowindow, 'domready');
								   	google.maps.event.addListener(infowindow, 'domready', function () {
								   		Ext.fly('modify_btn').on('click', function(e, t) { 
							   				Ext.Ajax.request({
												method: 'GET',
												params: {id: val.id},
											   	url: url_prefix + 'index.php/' + key + '/update',
											   	success: function(response, opts) {
											   		google.maps.event.clearListeners(infowindow, 'domready');
											   		google.maps.event.addListener(infowindow, 'domready', function () {
											   			Ext.fly('update_btn').on('click', function(e, t) {
											   				var params = { title : Ext.fly('log_title').getValue(),
											   								content : Ext.fly('log_content').getValue(),
											   								tags : Ext.fly('log_tag').getValue() };
											   				Ext.Ajax.request({
											   					method: 'POST',
											   					params: params,
											   				   	url: url_prefix + 'index.php/' + key + '/update',
											   				   	success: function(response, opts) {
											   				      	alert(response.responseText);
											   				   	},
											   				   	failure: function(response, opts) {
											   				      	console.log('server-side failure with status code ' + response.status);
											   				   	}
											   				});
											   			});
											   		});
											   		infowindow.setContent(response.responseText);
											   		infowindow.open(map, marker);
											   		infoWindowPanEvt = true;
											   		console.log('success!');
											   	},
											   	failure: function(response, opts) {
											      	console.log('server-side failure with status code ' + response.status);
											   	}
											});
								   			console.log(key);
								   		});
								   		Ext.fly('delete_btn').on('click', function(e, t) { 
								   			alert('delete !');
								   			console.log(key);
								   		});
								   	});
									infowindow.setContent(response.responseText);
									infowindow.open(map, marker);
									infoWindowPanEvt = true;
							   	},
							   	failure: function(response, opts) {
							      	console.log('server-side failure with status code ' + response.status);
							   	}
							});
						});
						markers.push(marker);
			   		});
				});
		   		mgr.clearMarkers();
		   		mgr.addMarkers(markers, 3);
		   		
		   		mgr.refresh();
		   	},
		   	failure: function(response, opts) {
		      	console.log('server-side failure with status code ' + response.status);
		   	}
		});
	}
	infoWindowPanEvt = false;
});
========================================================================================== */

var gmapInfoWindow = new google.maps.InfoWindow({
					maxWidth: 800,
					content: Ext.fly("map_info_window").child('div', true)
				});

var infoWindowMarker = null;

var doubleClickedEvt=false;
google.maps.event.addListener(map, "dblclick", function(event) {
	doubleClickedEvt=true;
});

google.maps.event.addListener(map, "click", function(event) {
	new Ext.util.DelayedTask(function() {
		if (!doubleClickedEvt && !clusterClickedEvt) {
			if (Ext.isObject(infoWindowMarker)) {
				infoWindowMarker.setMap(null);
			}
			infoWindowMarker = createGmapMarker(map, gmapInfoWindow, event.latLng);
    		map.setCenter(event.latLng);
    	}
    	// reset all status
		doubleClickedEvt = false;
		clusterClickedEvt = false;
	}).delay(250);
});
