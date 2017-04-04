var ie6warning = new Class({
	'site': 'sitename',
	'initialize': function() {
		var warning = "<h4>You are browsing this site with Internet Explorer 6.</h4> <h2> This template is compatible with IE6 for the most part, however your experience will be enhanced with a newer browser.</h2> <h3>Why should I upgrade my browser?</h3> There are hundreds of reasons why you should consider upgrading from Internet Explorer 6. Here are a few features that newer browsers offer:</br> Added Security, Frequently Updates, Tabbed Browsing, Custom Add-On’s, Better HTML and CSS support and a lot more. IE 6 was released in 2001. The last security update was released in 2004. A lot has changed in that time. You aren't still using the same cell phone you had in 2001, so why not upgrade your browser? It is simple and FREE! </br></br><h2>We recommend that you consider upgrading to a modern browser now by selecting a link from the right.</h2>";




		
		this.box = new Element('div', {'id': 'iewarn'}).inject(document.body, 'top');
		var div = new Element('div').inject(this.box).setHTML(warning);
		
		var click = this.toggle.bind(this);
		var button = new Element('a', {'id': 'iewarn_close'}).addEvents({
			'mouseover': function() {
				this.addClass('cHover');
			},
			'mouseout': function() {
				this.removeClass('cHover');
			},
			'click': function() {
				click();	
			}
		}).inject(div, 'top');


var button = new Element('a', {'id': 'firefox'}).addEvents({
			'click': function newwindow() 

{ window.open('http://www.mozilla.com/en-US/firefox'); }
		}).inject(div, 'top');
	
var button = new Element('a', {'id': 'safari'}).addEvents({
			'click': function newwindow() 

{ window.open('http://www.apple.com/safari'); }
		}).inject(div, 'top');

var button = new Element('a', {'id': 'chrome'}).addEvents({
			'click': function newwindow() 

{ window.open('http://www.google.com/chrome'); }
		}).inject(div, 'top');

var button = new Element('a', {'id': 'opera'}).addEvents({
			'click': function newwindow() 

{ window.open('http://www.opera.com'); }
		}).inject(div, 'top');


		
		this.height = $('iewarn').getSize().size.y;
		
		this.fx = new Fx.Styles(this.box, {duration: 1000}).set({'margin-top': $('iewarn').getStyle('margin-top').toInt()});
		this.open = false;
		
		var cookie = Cookie.get('ie6warning'), height = this.height;
		//cookie = 'open'; // added for debug to not use the cookie value
		if (!cookie || cookie == "open") this.show();
		else this.fx.set({'margin-top': -height});

		
		return ;
	},
	
	'show': function() {
		this.fx.start({
			'margin-top': 0
		});
		this.open = true;
		Cookie.set('ie6warning', 'open', {duration: 7});
	},	
	'close': function() {
		var margin = this.height;
		this.fx.start({
			'margin-top': -margin
		});
		this.open = false;
		Cookie.set('ie6warning', 'close', {duration: 7});
	},	
	'status': function() {
		return this.open;
	},
	'toggle': function() {
		if (this.open) this.close();
		else this.show();
	}
});

window.addEvent('domready', function() {
	if (window.ie6) { (function() {var iewarn = new ie6warning();}).delay(2000); }
});