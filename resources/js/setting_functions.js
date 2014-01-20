
var id_names = new Array("conf_log", "conf_business", "conf_property", "conf_job");

Ext.fly('conf_all').on('click', function(e, t) {
	if (Ext.get(t.id).dom.checked) {
		Ext.each(id_names, function(val) {
			Ext.get(val).dom.checked = true;
		});
	} else {
		Ext.each(id_names, function(val) {
			Ext.get(val).dom.checked = false;
		});
	}
});

Ext.each(id_names, function(val) {
	Ext.fly(val).on('click', function(e, t) {
		console.log(e);
	});
});
