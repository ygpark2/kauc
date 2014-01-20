
Ext.ux.extbox.register('a.category_update', false, {innerWidth: 520, innerHeight: 420, title: 'Custom title', scale: false, current: "{current} of {total}", close: '&#215;'});
Ext.ux.extbox.register('a.user_info', false, {innerWidth: 520, innerHeight: 420, title: 'Custom title', scale: false, current: "{current} of {total}", close: '&#215;'});

var viewSize = [
    Math.max(Ext.lib.Dom.getViewWidth(), Ext.lib.Dom.getDocumentWidth()),
    Math.max(Ext.lib.Dom.getViewHeight(), Ext.lib.Dom.getDocumentHeight())
];
Ext.fly("map_canvas").setWidth(viewSize[0]);
Ext.fly("map_canvas").setHeight(viewSize[1]);

Ext.fly('lost-pwd-link').on('click', function(e, t) {
	if (Ext.fly("lost-pwd-div").getStyle('display') === 'none') {
		Ext.fly("lost-pwd-div").setStyle('display', 'block');
	} else {
		Ext.fly("lost-pwd-div").setStyle('display', 'none');
	}
});

Ext.fly('login_btn').on('click', function(e, t) {
	var params = { login: Ext.fly('geo_login_id').getValue(),
					password: Ext.fly('geo_login_pwd').getValue(),
					remember : Ext.fly('remember').getValue() };
	Ext.Ajax.request({
		method: 'POST',
		params: params,
	   	url: url_prefix + 'index.php/auth/login',
	   	success: function(response, opts) {
			Ext.fly('member_register').load(url_prefix + 'index.php/category/login_menu', {}, function(data) {
				Ext.Loader.load( media_url_prefix + 'js/setting_functions.js' );
			});
			Ext.fly('member_login').load(url_prefix + 'index.php/profile/login_menu');
			Ext.fly('map_info_window').load(url_prefix + 'index.php/home/gmapInfoWindowForm', {}, function(data) {
				if(app_mode == "production") {
					gmapInfoWindow.setContent(Ext.fly("map_info_window").child('div', true));
				}
				var tabs = new Ext.ux.Tabs('tabs', {width: '95%', height: '95%'});
				Ext.Loader.load( media_url_prefix + 'js/gMapInfoWindow_functions.js' );
				create_subcategory('category_list', 0, 1);
			});

			usernameTags[0].html = usernameTags[0].html + params.login + ' !';
            Ext.fly('login_username').replaceWith( usernameTags );
			Ext.fly('logout_link').setStyle( 'display', 'block' );

	      	alert('success login!');
	   	},
	   	failure: function(response, opts) {
	   		alert('server-side failure with status code ' + response.status);
	   	}
	});
});

Ext.fly('lost-pwd_btn').on('click', function(e, t) {
	Ext.Ajax.request({
		method: 'POST',
		params: {login: Ext.fly('geo_lost_pwd_login_id').getValue()},
	   	url: url_prefix + 'index.php/auth/forgot_password',
	   	success: function(response, opts) {
	      	alert('send email !');
	   	},
	   	failure: function(response, opts) {
	   		alert('server-side failure with status code ' + response.status);
	   	}
	});
});

Ext.fly('register_btn').on('click', function(e, t) {
	var key_names = new Array('username', 'email', 'password', 'confirm_password');
	var params = {};
	Ext.iterate(key_names, function(name) {
		params[name] = Ext.fly(name).getValue();
		Ext.fly(name).dom.value="";
	});
	Ext.Ajax.request({
		method: 'POST',
		params: params,
	   	url: url_prefix + 'index.php/auth/register',
	   	success: function(response, opts) {
	      	alert(response.responseText);
	   	},
	   	failure: function(response, opts) {
	      	alert('server-side failure with status code ' + response.status);
	   	}
	});
});

Ext.fly('toggle').on('click', function(e, t) {
    var display = Ext.fly('toggle').child('a.close').getStyle('display');
    if (display === 'block') {
	    Ext.fly('login_panel').slideOut('t', {
		    duration: .5,
			remove: false,
			useDisplay: true,
		    callback : function() {
		    	Ext.fly('toggle').child('a.open').setStyle('display', 'block');
				Ext.fly('toggle').child('a.close').setStyle('display', 'none');
			}
		});
    } else {
	    Ext.fly('login_panel').slideIn('t', {
		    duration: .5,
		    callback : function() {
		    	Ext.fly('toggle').child('a.open').setStyle('display', 'none');
				Ext.fly('toggle').child('a.close').setStyle('display', 'block');
			}
		});
    }
});

Ext.fly('search_type').on('change', function(e, t) {
	Ext.fly('searchTxtBox').dom.value="";
	Ext.fly('searchTxtBox').focus();
});

Ext.fly('searchBtn').on('click', function(e, t) {
	var searchValue = Ext.fly('searchTxtBox').getValue();
	if (Ext.fly('search_type').getValue() == "map") {
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode( { 'address': searchValue}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (Ext.isObject(infoWindowMarker)) {
					marker.setMap(null);
				}
				infoWindowMarker = createGmapMarker(map, gmapInfoWindow, results[0].geometry.location);
				map.setCenter(results[0].geometry.location);
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
	} else {
		Ext.Ajax.request({
			method: 'GET',
			params: {},
		   	url: url_prefix + 'index.php/geo/' + Ext.fly('search_type').getValue() + '/search/title+content/'+ searchValue,
		   	success: function(response, opts) {
		   		var obj = Ext.decode(response.responseText);
		   		var t = new Ext.Template(['<div name="{id}">',
		   		                          	'<span class="{cls}"><a id="openGmapInfoWindowBtn" href="javascript:openGmapInfoWindow({lat}, {lon});">{title}</a></span>',
		   		                          '</div>',]);
	   			t.compile();

	   			Ext.fly('search_result_contents').replaceWith({ tag: 'div', id: 'search_result_contents' });
		   		Ext.iterate(obj, function(data) {
		   			var geo_loc = data.geo_loc.replace(/[\(\)POINT]/g, "").split(" ");
		   			data.lat = geo_loc[0];
		   			data.lon = geo_loc[1];
		   			data.cls = "search_result_row_cls";
		   			t.append('search_result_contents', data);
		   		});

		   		Ext.fly('search_results').position("absolute");
		      	var topPositionVal = Number(Ext.fly('login_tab').getHeight());
		      	var leftPositionVal = 113;

		      	Ext.fly('search_results').setLocation(leftPositionVal, topPositionVal);
			    Ext.fly('search_results').slideIn('t', {
				    duration: .5,
					remove: false,
					useDisplay: true,
				    callback : function() {
				    	// console.log('sdlkfjasldfkjasdf');
					}
				});

		   	},
		   	failure: function(response, opts) {
		      	alert('server-side failure with status code ' + response.status);
		   	}
		});
	}

});
