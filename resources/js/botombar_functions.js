
Ext.ux.extbox.register('a.editprofile', false, {innerWidth: 520, innerHeight: 420, title: 'Custom title', scale: false, current: "{current} of {total}", close: '&#215;'});

Ext.fly('bt_videos').on('click', function(e, t) {

    var display = Ext.fly('bt_board_subpanel').getStyle('display');
    if (display === 'block') {
	    Ext.fly('bt_board_subpanel').slideOut('b', {
	    	easing: 'easeOut',
		    duration: .0,
			remove: false,
			useDisplay: true,
		    callback : function() {

			}
		});
    } else {
    	Ext.fly('bt_board_subpanel').setStyle('display', 'block');
    	/*
    	Ext.fly('bt_board_subpanel').slideIn('b', {
		    duration: .5,
		    callback : function() {

			}
		})
		*/
    }

});

Ext.fly('bt_bookmark_area').on('click', function(e, t) {

    var display = Ext.fly(t.id).next("div").getStyle('display');
    if (display === 'block') {
	    Ext.fly(t.id).next("div").slideOut('b', {
	    	easing: 'easeOut',
		    duration: .0,
			remove: false,
			useDisplay: true,
		    callback : function() {

			}
		});
    } else {
    	Ext.fly(t.id).next("div").setStyle('display', 'block');
    	/*
	    Ext.fly(t.id).next("div").slideIn('b', {
		    duration: .5,
		    callback : function() {

			}
		})
		*/;
    }

});

Ext.fly('bt_bookmark_area_close_btn').on('click', function(e, t) {
	Ext.fly(t.id).parent("div").slideOut('b', {
    	easing: 'easeOut',
	    duration: .0,
		remove: false,
		useDisplay: true,
	    callback : function() {

		}
	});
	
});

Ext.fly('bt_alerts').on('click', function(e, t) {

    var display = Ext.fly(t.id).next("div").getStyle('display');
    if (display === 'block') {
	    Ext.fly(t.id).next("div").slideOut('b', {
		    duration: .5,
			remove: false,
			useDisplay: true,
		    callback : function() {

			}
		});
    } else {
    	Ext.fly(t.id).next("div").setStyle('display', 'block');
    	/*
	    Ext.fly(t.id).next("div").slideIn('b', {
	    	easing: 'easeOut',
		    duration: .5,
			remove: false,
			useDisplay: true,
		    callback : function() {

			}
		});
		*/
    }

});

Ext.fly('bt_alerts_close_btn').on('click', function(e, t) {
	Ext.fly(t.id).parent("div").slideOut('b', {
    	easing: 'easeOut',
	    duration: .0,
		remove: false,
		useDisplay: true,
	    callback : function() {

		}
	});
	
});
