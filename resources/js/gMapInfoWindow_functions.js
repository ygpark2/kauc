
Ext.fly('job_save_btn').on('click', function(e, t) {
	var params = { title : Ext.fly('job_title').getValue(),
					content : Ext.fly('job_content').getValue(),
					url : Ext.fly('job_url').getValue(),
					phone : Ext.fly('job_phone').getValue(),
					email : Ext.fly('job_email').getValue(),
					tags : Ext.fly('job_tag').getValue() };

	if (app_mode == "production")
		Ext.apply(params, getLatLng(infoWindowMarker));
	else
		Ext.apply(params, {'latitude' : 3.42434234, 'longitude' : 134.3829342});

	Ext.Ajax.request({
		method: 'POST',
		params: params,
	   	url: url_prefix + 'index.php/geo/job/create',
	   	success: function(response, opts) {
	      	alert(response.responseText);
	   	},
	   	failure: function(response, opts) {
	      	alert('server-side failure with status code ' + response.status);
	   	}
	});
});


Ext.fly('log_save_btn').on('click', function(e, t) {
	var params = { title : Ext.fly('log_title').getValue(),
					content : Ext.fly('log_content').getValue(),
					tags : Ext.fly('log_tag').getValue() };

	if (app_mode == "production")
		Ext.apply(params, getLatLng(infoWindowMarker));
	else 
		Ext.apply(params, {'latitude' : 3.42434234, 'longitude' : 134.3829342})

	Ext.Ajax.request({
		method: 'POST',
		params: params,
	   	url: url_prefix + 'index.php/geo/log/create',
	   	success: function(response, opts) {
	      	alert(response.responseText);
	   	},
	   	failure: function(response, opts) {
	      	alert('server-side failure with status code ' + response.status);
	   	}
	});
});

Ext.fly('property_save_btn').on('click', function(e, t) {
	var params = { title : Ext.fly('property_title').getValue(),
					content : Ext.fly('property_content').getValue(),
					email : Ext.fly('property_email').getValue(),
					url : Ext.fly('property_url').getValue(),
					phone : Ext.fly('property_phone').getValue(),
					type : Ext.fly('property_type').getValue(),
					price : Ext.fly('property_price').getValue(),
					price_unit : Ext.fly('property_price_unit').getValue() };

	if (app_mode == "production")
		Ext.apply(params, getLatLng(infoWindowMarker));
	else
		Ext.apply(params, {'latitude' : 3.42434234, 'longitude' : 134.3829342});

	Ext.Ajax.request({
		method: 'POST',
		params: params,
	   	url: url_prefix + 'index.php/geo/property/create',
	   	success: function(response, opts) {
	      	alert(response.responseText);
	   	},
	   	failure: function(response, opts) {
	      	alert('server-side failure with status code ' + response.status);
	   	}
	});
});

Ext.fly('business_save_btn').on('click', function(e, t) {
	var params = { title : Ext.fly('business_title').getValue(),
					category_id : Ext.fly('category_list').last().getValue(),
					content : Ext.fly('business_content').getValue(),
					url : Ext.fly('business_url').getValue(),
					phone : Ext.fly('business_phone').getValue(),
					email : Ext.fly('business_email').getValue() };
	
	if (app_mode == "production")
		Ext.apply(params, getLatLng(infoWindowMarker));
	else
		Ext.apply(params, {'latitude' : 3.42434234, 'longitude' : 134.3829342});

	Ext.Ajax.request({
		method: 'POST',
		params: params,
	   	url: url_prefix + 'index.php/geo/business/create',
	   	success: function(response, opts) {
	      	alert(response.responseText);
	   	},
	   	failure: function(response, opts) {
	      	alert('server-side failure with status code ' + response.status);
	   	}
	});
});

Ext.fly('profile_save_btn').on('click', function(e, t) {
	var birth_date = Ext.fly('birth_year').getValue() + '-' + Ext.fly('birth_month').getValue() + '-' + Ext.fly('birth_day').getValue()
	var params = { id : Ext.fly('profile_id').getValue(),
					name : Ext.fly('name').getValue(),
					mobile : Ext.fly('mobile').getValue(),
					phone : Ext.fly('phone').getValue(),
					birth : birth_date,
					twitter_id : Ext.fly('twitter').getValue(),
					facebook_id : Ext.fly('facebook').getValue(),
					occupation : Ext.fly('occupation').getValue(),
					website : Ext.fly('url').getValue(),
					introduction : Ext.fly('introduction').getValue() };

	if (app_mode == "production")
		Ext.apply(params, getLatLng(infoWindowMarker));
	else
		Ext.apply(params, {'latitude' : 3.42434234, 'longitude' : 134.3829342});

	Ext.Ajax.request({
		method: 'POST',
		params: params,
	   	url: 'index.php/profile/update',
	   	success: function(response, opts) {
	      	alert(response.responseText);
	      	Ext.fly('member_login').load({url: url_prefix + 'index.php/profile/login_menu'});
	   	},
	   	failure: function(response, opts) {
	      	console.log('server-side failure with status code ' + response.status);
	   	}
	});
});