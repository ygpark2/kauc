/*!
 * Ext Core Library 3.0
 * http://extjs.com/
 * Copyright(c) 2006-2009, Ext JS, LLC.
 * 
 * MIT Licensed - http://extjs.com/license/mit.txt
 */
Ext.ns('Ext.ux');

Ext.ux.Tabs = Ext.extend(Ext.util.Observable, {
	// Configuration options
    activeTab: 0,
    
	// Our class constructor
    constructor : function(element, config) {
        Ext.apply(this, config);
        Ext.ux.Tabs.superclass.constructor.call(this);
        
        this.addEvents(
            'beforetabchange',
            'tabchange'
        );
        
        this.el = Ext.get(element);
        this.init();
    },
    
    init : function() {
        var me = this;

		this.el.addClass('ux-tabs-container');
		
		this.tabStrip = this.el.child('ul');
		this.tabStrip.addClass('ux-tabs-strip');
		
		this.tabStrip.on('click', this.onStripClick, this, {delegate: 'a'});
		
		this.tabs = this.tabStrip.select('> li');
		this.cards = this.el.select('> div');
		
		this.cardsContainer = this.el.createChild({
			cls: 'ux-tabs-cards'
		});
		this.cardsContainer.setWidth( this.width ? this.width : this.el.getWidth() );
		this.cardsContainer.setHeight( this.height ? this.height : this.el.getHeight() );
		
		this.cards.addClass('ux-tabs-card');
		this.cards.appendTo(this.cardsContainer);
		
		this.el.createChild({
			cls: 'ux-tabs-clearfix'
		});
		
		this.setActiveTab(this.activeTab || 0);
	},
	
	onStripClick : function(ev, t) {
		if (t && t.name && t.href.split('#')[1].length < 1) {
			ev.preventDefault();
			this.setActiveTab(t.name);
		} else if(t && t.href && t.href.indexOf('#')) {
			ev.preventDefault();
			this.setActiveTab(t.href.split('#')[1]);
		} else {
			
		}
	},
	
	setActiveTab : function(tab) {
		var card;		
		if(Ext.isString(tab)) {
			card = Ext.get(tab);
			tab = this.tabStrip.child('a[name=' + tab + ']').parent();
		}
		else if (Ext.isNumber(tab)) {
			tab = this.tabs.item(tab);
			// card = Ext.get(tab.first().dom.href.split('#')[1]);
			card = Ext.get(tab.first().dom.name);
		}
		
		if(tab && card && this.fireEvent('beforetabchange', tab, card) !== false) {
			card.radioClass('ux-tabs-card-active');
			tab.radioClass('ux-tabs-tab-active');
			this.fireEvent('tabchange', tab, card);
		}
	}
});