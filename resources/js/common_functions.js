
function openGmapInfoWindow(lat, lng) {
	var latLng = new google.maps.LatLng(lat, lng);
	map.setCenter(latLng);

	new Ext.util.DelayedTask(function() {
		var marker = mgr.getMarker(lat, lng, map.getZoom());
		google.maps.event.trigger(marker, 'click');
	}).delay(1000);

	/*
	Ext.fly('map_info_window').load(url_prefix + 'index.php/home/gmapInfoWindowForm', {}, function(data) {
		gmapInfoWindow.setContent(Ext.fly("map_info_window").child('div', true));
		var tabs = new Ext.ux.Tabs('tabs', {width: '95%', height: '95%'});
		if (isLogined) {
			Ext.Loader.load( '<?php echo $media_url_prefix; ?>js/save_button_functions.js' );
			create_subcategory('category_list', 0, 1);
		}
	});
	*/

}

function getGeoUpdateParams(key) {
	var params = {};
	switch(true) {
		case key == 'log':
			params = { id : Ext.fly('log_id').getValue(),
						title : Ext.fly('log_title').getValue(),
						content : Ext.fly('log_content').getValue(),
						tags : Ext.fly('log_tag').getValue() };
			break;
		case key == 'business':
			params = { id : Ext.fly('business_id').getValue(),
						title : Ext.fly('business_title').getValue(),
						category_id : Ext.fly('category_list').last().getValue(),
						content : Ext.fly('business_content').getValue(),
						url : Ext.fly('business_url').getValue(),
						phone : Ext.fly('business_phone').getValue(),
						email : Ext.fly('business_email').getValue() };
			break;
		case key == 'property':
			params = { id : Ext.fly('property_id').getValue(),
						title : Ext.fly('property_title').getValue(),
						content : Ext.fly('property_content').getValue(),
						email : Ext.fly('property_email').getValue(),
						url : Ext.fly('property_url').getValue(),
						phone : Ext.fly('property_phone').getValue(),
						type : Ext.fly('property_type').getValue(),
						price : Ext.fly('property_price').getValue(),
						price_unit : Ext.fly('property_price_unit').getValue() };
			
			break;
		case key == 'job':
			params = { id : Ext.fly('job_id').getValue(),
						title : Ext.fly('job_title').getValue(),
						content : Ext.fly('job_content').getValue(),
						url : Ext.fly('job_url').getValue(),
						phone : Ext.fly('job_phone').getValue(),
						email : Ext.fly('job_email').getValue(),
						tags : Ext.fly('job_tag').getValue() };
			break;
		default:
			
			break;
	}
	return params
}

function markerClickEvt(map, marker, infowindow, geo_id, key) {
	Ext.Ajax.request({
		method: 'GET',
		params: {id: geo_id},
	   	url: url_prefix + 'index.php/' + key + '/retrieve',
	   	success: function(response, opts) {
	   		google.maps.event.clearListeners(infowindow, 'domready');
		   	google.maps.event.addListener(infowindow, 'domready', function () {
		   		Ext.fly('modify_btn').on('click', function(e, t) { 
	   				Ext.Ajax.request({
						method: 'GET',
						params: {id: geo_id},
					   	url: url_prefix + 'index.php/' + key + '/update',
					   	success: function(response, opts) {
					   		google.maps.event.clearListeners(infowindow, 'domready');
					   		google.maps.event.addListener(infowindow, 'domready', function () {
					   			Ext.fly('update_btn').on('click', function(e, t) {
					   				Ext.Ajax.request({
					   					method: 'POST',
					   					params: getGeoUpdateParams( key.split("/")[1] ),
					   				   	url: url_prefix + 'index.php/' + key + '/update',
					   				   	success: function(response, opts) {
					   				      	alert(response.responseText);
					   				   	},
					   				   	failure: function(response, opts) {
					   				   		alert('server-side failure with status code ' + response.status);
					   				   	}
					   				});
					   			});
					   		});
					   		infowindow.setContent(response.responseText);
					   		infowindow.open(map, marker);
					   		infoWindowPanEvt = true;
					   		// console.log('success!');
					   	},
					   	failure: function(response, opts) {
					      	alert('server-side failure with status code ' + response.status);
					   	}
					});
		   		});
		   		Ext.fly('delete_btn').on('click', function(e, t) { 
	   				Ext.Ajax.request({
						method: 'GET',
						params: {id: geo_id},
					   	url: url_prefix + 'index.php/' + key + '/delete',
					   	success: function(response, opts) {
					   		alert(response.responseText);
					   	},
					   	failure: function(response, opts) {
					      	alert('server-side failure with status code ' + response.status);
					   	}
					});
		   		});
		   	});
			infowindow.setContent(response.responseText);
			infowindow.open(map, marker);
			infoWindowPanEvt = true;
	   	},
	   	failure: function(response, opts) {
	   		alert('server-side failure with status code ' + response.status);
	   	}
	});
}

function create_subcategory(category_list_id, parent_id, depth) {

	Ext.Ajax.request({
		method: 'GET',
		params: {parent_id : parent_id},
	   	url: url_prefix + 'index.php/category/get_childs',
	   	success: function(response, opts) {
	      	var obj = Ext.decode(response.responseText);

			try {
				var startNodeID = depth;
				var lastNodeID = Ext.fly(category_list_id).last().id.split('_')[1];
				for (startNodeID; startNodeID <= lastNodeID; startNodeID++) {
					Ext.fly('subCategory_' + startNodeID).remove();
					if (Ext.fly('subCategoryLabel_' + startNodeID))
						Ext.fly('subCategoryLabel_' + startNodeID).remove();
				}
			} catch (exception) {
				// console.log(exception);
			}

			if (obj.length > 0) {
		      	var category_list = Ext.get(category_list_id);
		      	console.log(category_list);

		      	var directionTag = { tag: 'label', id: 'subCategoryLabel_' + depth, html : ' => ' };
		      	category_list.createChild( directionTag );
				var subCategoryTag = { tag: 'select', id : 'subCategory_' + depth };
				var child = category_list.createChild( subCategoryTag );
				child.insertFirst({ tag: 'option', value: -1, html: '선택해 주세요' });
		   		Ext.each(obj, function(data){
		   			child.insertFirst({
						tag: 'option',
						value: data.id,
						html: data.name
					});
		   		});
				Ext.fly('subCategory_' + depth).on('change', function(e, t) {
	    			create_subcategory(category_list_id, e.target.value, depth+1);
				});
			}
	   	},
	   	failure: function(response, opts) {
	      	alert('server-side failure with status code ' + response.status);
	   	}
	});

}

function createGmapMarker(map, infowindow, latLng) {
	var marker = new google.maps.Marker({
		draggable: true,
		position: latLng,
		map: map
	});
	google.maps.event.addListener(marker, "dragstart", function (dragEvent) {
		infowindow.close();
	});
	google.maps.event.addListener(marker, "dragend", function (dragEvent) { 
		infowindow.open(map, marker);
		map.setCenter(dragEvent.latLng);
	});
	infowindow.open(map, marker);
	google.maps.event.addListener(marker, "click", function() {
		infowindow.open(map, marker);
	});
	return marker;
}

function getLatLng(marker) {
	return {'latitude' : marker.getPosition().lat(), 'longitude' : marker.getPosition().lng()};
}
