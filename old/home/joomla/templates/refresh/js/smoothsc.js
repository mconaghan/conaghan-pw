Scroller= { speed:10, gy: function (d) { gy = d.offsetTop
if (d.offsetParent) while (d = d.offsetParent) gy += d.offsetTop
return gy
}, scrollTop: function (){ body=document.body
d=document.documentElement
if (body && body.scrollTop) return body.scrollTop
if (d && d.scrollTop) return d.scrollTop
if (window.pageYOffset) return window.pageYOffset
return 0}, add: function(event, body, d) { if (event.addEventListener) return event.addEventListener(body, d,false)
if (event.attachEvent) return event.attachEvent('on'+body, d)
}, end: function(e){ if (window.event) { window.event.cancelBubble = true
window.event.returnValue = false
return;} if (e.preventDefault && e.stopPropagation) { e.preventDefault()
e.stopPropagation()}}, scroll: function(d){ i = window.innerHeight || document.documentElement.clientHeight; h=document.body.scrollHeight; a = Scroller.scrollTop()
if(d>a)
if(h-d>i)
a+=Math.ceil((d-a)/Scroller.speed)
else
a+=Math.ceil((d-a-(h-d))/Scroller.speed)
else
a = a+(d-a)/Scroller.speed; window.scrollTo(0,a)
if(a==d || Scroller.offsetTop==a)clearInterval(Scroller.interval)
Scroller.offsetTop=a}, init: function(){ Scroller.add(window,'load', Scroller.render)
}, render: function(){ var a = document.getElementsByTagName('a'); Scroller.end(this); for (var i=0, size=a.length;i<size;i++) { var l = a[i]; if(l.href && l.href.indexOf('#') != -1 && l.href.indexOf('#') != l.href.length-1 && ((l.pathname==location.pathname) || ('/'+l.pathname==location.pathname)) ){ Scroller.add(l,'click',Scroller.end); l.onclick = function(){ Scroller.end(this); var l=this.hash.substr(1), a = document.getElementsByTagName('a'); for (var i=0, size=a.length;i<size;i++) { if
(document.getElementById(l)) { clearInterval(Scroller.interval); Scroller.interval=setInterval('Scroller.scroll('+Scroller.gy(document.getElementById(l))+')',10);}}}}}}}
Scroller.init(); 