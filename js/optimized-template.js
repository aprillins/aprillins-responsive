/*
	DOMtab Version 3.1415927
	Updated March the First 2006
	written by Christian Heilmann
	check blog for updates: http://www.wait-till-i.com	
	free to use, not free to resell
*/

domtab={
	tabClass:'domtab', // class to trigger tabbing
	listClass:'domtabs', // class of the menus
	activeClass:'active', // class of current link
	contentElements:'div', // elements to loop through
	backToLinks:/#top/, // pattern to check "back to top" links
	printID:'domtabprintview', // id of the print all link
	showAllLinkText:'show all content', // text for the print all link
	prevNextIndicator:'doprevnext', // class to trigger prev and next links
	prevNextClass:'prevnext', // class of the prev and next list
	prevLabel:'previous', // HTML content of the prev link
	nextLabel:'next', // HTML content of the next link
	prevClass:'prev', // class for the prev link
	nextClass:'next', // class for the next link
	init:function(){
		var temp;
		if(!document.getElementById || !document.createTextNode){return;}
		var tempelm=document.getElementsByTagName('div');		
		for(var i=0;i<tempelm.length;i++){
			if(!domtab.cssjs('check',tempelm[i],domtab.tabClass)){continue;}
			domtab.initTabMenu(tempelm[i]);
			domtab.removeBackLinks(tempelm[i]);
			if(domtab.cssjs('check',tempelm[i],domtab.prevNextIndicator)){
				domtab.addPrevNext(tempelm[i]);
			}
			domtab.checkURL();
		}
		if(document.getElementById(domtab.printID) 
		   && !document.getElementById(domtab.printID).getElementsByTagName('a')[0]){
			var newlink=document.createElement('a');
			newlink.setAttribute('href','#');
			domtab.addEvent(newlink,'click',domtab.showAll,false);
			newlink.onclick=function(){return false;} // safari hack
			newlink.appendChild(document.createTextNode(domtab.showAllLinkText));
			document.getElementById(domtab.printID).appendChild(newlink);
		}
	},
	checkURL:function(){
		var id;
		var loc=window.location.toString();
		loc=/#/.test(loc)?loc.match(/#(\w.+)/)[1]:'';
		if(loc==''){return;}
		var elm=document.getElementById(loc);
		if(!elm){return;}
		var parentMenu=elm.parentNode.parentNode.parentNode;
		parentMenu.currentSection=loc;
		parentMenu.getElementsByTagName(domtab.contentElements)[0].style.display='none';
		domtab.cssjs('remove',parentMenu.getElementsByTagName('a')[0].parentNode,domtab.activeClass);
		var links=parentMenu.getElementsByTagName('a');
		for(i=0;i<links.length;i++){
			if(!links[i].getAttribute('href')){continue;}
			if(!/#/.test(links[i].getAttribute('href').toString())){continue;}
			id=links[i].href.match(/#(\w.+)/)[1];
			if(id==loc){
				var cur=links[i].parentNode.parentNode;
				domtab.cssjs('add',links[i].parentNode,domtab.activeClass);
				break;
			}
		}
		domtab.changeTab(elm,1);
		elm.focus();
		cur.currentLink=links[i];
		cur.currentSection=loc;
	},
	showAll:function(e){
		document.getElementById(domtab.printID).parentNode.removeChild(document.getElementById(domtab.printID));
		var tempelm=document.getElementsByTagName('div');		
		for(var i=0;i<tempelm.length;i++){
			if(!domtab.cssjs('check',tempelm[i],domtab.tabClass)){continue;}
			var sec=tempelm[i].getElementsByTagName(domtab.contentElements);
			for(var j=0;j<sec.length;j++){
				sec[j].style.display='block';
			}
		}
		var tempelm=document.getElementsByTagName('ul');		
		for(i=0;i<tempelm.length;i++){
			if(!domtab.cssjs('check',tempelm[i],domtab.prevNextClass)){continue;}
			tempelm[i].parentNode.removeChild(tempelm[i]);
			i--;
		}
		domtab.cancelClick(e);
	},
	addPrevNext:function(menu){
		var temp;
		var sections=menu.getElementsByTagName(domtab.contentElements);
		for(var i=0;i<sections.length;i++){
			temp=domtab.createPrevNext();
			if(i==0){
				temp.removeChild(temp.getElementsByTagName('li')[0]);
			}
			if(i==sections.length-1){
				temp.removeChild(temp.getElementsByTagName('li')[1]);
			}
			temp.i=i; // h4xx0r!
			temp.menu=menu;
			sections[i].appendChild(temp);
		}
	},
	removeBackLinks:function(menu){
		var links=menu.getElementsByTagName('a');
		for(var i=0;i<links.length;i++){
			if(!domtab.backToLinks.test(links[i].href)){continue;}
			links[i].parentNode.removeChild(links[i]);
			i--;
		}
	},
	initTabMenu:function(menu){
		var id;
		var lists=menu.getElementsByTagName('ul');
		for(var i=0;i<lists.length;i++){
			if(domtab.cssjs('check',lists[i],domtab.listClass)){
				var thismenu=lists[i];
				break;
			}
		}
		if(!thismenu){return;}
		thismenu.currentSection='';
		thismenu.currentLink='';
		var links=thismenu.getElementsByTagName('a');
		for(i=0;i<links.length;i++){
			if(!/#/.test(links[i].getAttribute('href').toString())){continue;}
			id=links[i].href.match(/#(\w.+)/)[1];
			if(document.getElementById(id)){
				domtab.addEvent(links[i],'click',domtab.showTab,false);
				links[i].onclick=function(){return false;} // safari hack
				domtab.changeTab(document.getElementById(id),0);
			}
		}
		id=links[0].href.match(/#(\w.+)/)[1];
		if(document.getElementById(id)){
			domtab.changeTab(document.getElementById(id),1);
			thismenu.currentSection=id;
			thismenu.currentLink=links[0];
			domtab.cssjs('add',links[0].parentNode,domtab.activeClass);
		}
	},
	createPrevNext:function(){
		// this would be so much easier with innerHTML, darn you standards fetish!
		var temp=document.createElement('ul');
		temp.className=domtab.prevNextClass;
		temp.appendChild(document.createElement('li'));
		temp.getElementsByTagName('li')[0].appendChild(document.createElement('a'));
		temp.getElementsByTagName('a')[0].setAttribute('href','#');
		temp.getElementsByTagName('a')[0].innerHTML=domtab.prevLabel;
		temp.getElementsByTagName('li')[0].className=domtab.prevClass;
		temp.appendChild(document.createElement('li'));
		temp.getElementsByTagName('li')[1].appendChild(document.createElement('a'));
		temp.getElementsByTagName('a')[1].setAttribute('href','#');
		temp.getElementsByTagName('a')[1].innerHTML=domtab.nextLabel;
		temp.getElementsByTagName('li')[1].className=domtab.nextClass;
		domtab.addEvent(temp.getElementsByTagName('a')[0],'click',domtab.navTabs,false);
		domtab.addEvent(temp.getElementsByTagName('a')[1],'click',domtab.navTabs,false);
		// safari fix
		temp.getElementsByTagName('a')[0].onclick=function(){return false;}
		temp.getElementsByTagName('a')[1].onclick=function(){return false;}
		return temp;
	},
	navTabs:function(e){
		var li=domtab.getTarget(e);
		var menu=li.parentNode.parentNode.menu;
		var count=li.parentNode.parentNode.i;
		var section=menu.getElementsByTagName(domtab.contentElements);
		var links=menu.getElementsByTagName('a');
		var othercount=(li.parentNode.className==domtab.prevClass)?count-1:count+1;
		section[count].style.display='none';
		domtab.cssjs('remove',links[count].parentNode,domtab.activeClass);
		section[othercount].style.display='block';
		domtab.cssjs('add',links[othercount].parentNode,domtab.activeClass);
		var parent=links[count].parentNode.parentNode;
		parent.currentLink=links[othercount];
		parent.currentSection=links[othercount].href.match(/#(\w.+)/)[1];
		domtab.cancelClick(e);
	},
	changeTab:function(elm,state){
		do{
			elm=elm.parentNode;
		} while(elm.nodeName.toLowerCase()!=domtab.contentElements)
		elm.style.display=state==0?'none':'block';
	},
	showTab:function(e){
		var o=domtab.getTarget(e);
		if(o.parentNode.parentNode.currentSection!=''){
			domtab.changeTab(document.getElementById(o.parentNode.parentNode.currentSection),0);
			domtab.cssjs('remove',o.parentNode.parentNode.currentLink.parentNode,domtab.activeClass);
		}
		var id=o.href.match(/#(\w.+)/)[1];
		o.parentNode.parentNode.currentSection=id;
		o.parentNode.parentNode.currentLink=o;
		domtab.cssjs('add',o.parentNode,domtab.activeClass);
		domtab.changeTab(document.getElementById(id),1);
		document.getElementById(id).focus();
		domtab.cancelClick(e);
	},
/* helper methods */
	getTarget:function(e){
		var target = window.event ? window.event.srcElement : e ? e.target : null;
		if (!target){return false;}
		if (target.nodeName.toLowerCase() != 'a'){target = target.parentNode;}
		return target;
	},
	cancelClick:function(e){
		if (window.event){
			window.event.cancelBubble = true;
			window.event.returnValue = false;
			return;
		}
		if (e){
			e.stopPropagation();
			e.preventDefault();
		}
	},
	addEvent: function(elm, evType, fn, useCapture){
		if (elm.addEventListener) 
		{
			elm.addEventListener(evType, fn, useCapture);
			return true;
		} else if (elm.attachEvent) {
			var r = elm.attachEvent('on' + evType, fn);
			return r;
		} else {
			elm['on' + evType] = fn;
		}
	},
	cssjs:function(a,o,c1,c2){
		switch (a){
			case 'swap':
				o.className=!domtab.cssjs('check',o,c1)?o.className.replace(c2,c1):o.className.replace(c1,c2);
			break;
			case 'add':
				if(!domtab.cssjs('check',o,c1)){o.className+=o.className?' '+c1:c1;}
			break;
			case 'remove':
				var rep=o.className.match(' '+c1)?' '+c1:c1;
				o.className=o.className.replace(rep,'');
			break;
			case 'check':
				var found=false;
				var temparray=o.className.split(' ');
				for(var i=0;i<temparray.length;i++){
					if(temparray[i]==c1){found=true;}
				}
				return found;
			break;
		}
	}
}

function load() {
	domtab.addEvent(window,'load', domtab.init, false);
}

load(); 




/*
Author: mg12
BASE.JS
*/
(function() {

function $(id) {
	return document.getElementById(id);
}

function setStyleDisplay(id, status) {
	$(id).style.display = status;
}

function goTop(a, t) {
	a = a || 0.1;
	t = t || 16;

	var x1 = 0;
	var y1 = 0;
	var x2 = 0;
	var y2 = 0;
	var x3 = 0;
	var y3 = 0;

	if (document.documentElement) {
		x1 = document.documentElement.scrollLeft || 0;
		y1 = document.documentElement.scrollTop || 0;
	}
	if (document.body) {
		x2 = document.body.scrollLeft || 0;
		y2 = document.body.scrollTop || 0;
	}
	var x3 = window.scrollX || 0;
	var y3 = window.scrollY || 0;

	var x = Math.max(x1, Math.max(x2, x3));
	var y = Math.max(y1, Math.max(y2, y3));

	var speed = 1 + a;
	window.scrollTo(Math.floor(x / speed), Math.floor(y / speed));
	if(x > 0 || y > 0) {
		var f = "MGJS.goTop(" + a + ", " + t + ")";
		window.setTimeout(f, t);
	}
}

function switchTab(showPanels, hidePanels, activeTab, activeClass, fadeTab, fadeClass) {
	$(activeTab).className = activeClass;
	$(fadeTab).className = fadeClass;

	var panel, panelList;
	panelList = showPanels.split(',');
	for (var i = 0; i < panelList.length; i++) {
		var panel = panelList[i];
		if ($(panel)) {
			setStyleDisplay(panel, 'block');
		}
	}
	panelList = hidePanels.split(',');
	for (var i = 0; i < panelList.length; i++) {
		panel = panelList[i];
		if ($(panel)) {
			setStyleDisplay(panel, 'none');
		}
	}
}

function loadCommentShortcut() {
	$('comment').onkeydown = function (moz_ev) {
		var ev = null;
		if (window.event){
			ev = window.event;
		} else {
			ev = moz_ev;
		}
		if (ev != null && ev.ctrlKey && ev.keyCode == 13) {
			$('submit').click();
		}
	}
	$('submit').value += ' (Ctrl+Enter)';
}

function getElementsByClassName(className, tag, parent) {
	parent = parent || document;

	var allTags = (tag == '*' && parent.all) ? parent.all : parent.getElementsByTagName(tag);
	var matchingElements = new Array();

	className = className.replace(/\-/g, '\\-');
	var regex = new RegExp('(^|\\s)' + className + '(\\s|$)');

	var element;
	for (var i = 0; i < allTags.length; i++) {
		element = allTags[i];
		if (regex.test(element.className)) {
			matchingElements.push(element);
		}
	}

	return matchingElements;
}

window['MGJS'] = {};
window['MGJS']['$'] = $;
window['MGJS']['setStyleDisplay'] = setStyleDisplay;
window['MGJS']['goTop'] = goTop;
window['MGJS']['switchTab'] = switchTab;
window['MGJS']['loadCommentShortcut'] = loadCommentShortcut;
window['MGJS']['getElementsByClassName'] = getElementsByClassName;

})();


/*
COMMENT.JS
*/
(function() {

function reply(authorId, commentId, commentBox) {
	var author = MGJS.$(authorId).innerHTML;
	var insertStr = '<a href="#' + commentId + '">@' + author.replace(/\t|\n|\r\n/g, "") + ' </a> \n';

	appendReply(insertStr, commentBox);
}

function quote(authorId, commentId, commentBodyId, commentBox) {
	var author = MGJS.$(authorId).innerHTML;
	var comment = MGJS.$(commentBodyId).innerHTML;

	var insertStr = '<blockquote cite="#' + commentBodyId + '">';
	insertStr += '\n<strong><a href="#' + commentId + '">' + author.replace(/\t|\n|\r\n/g, "") + '</a> :</strong>';
	insertStr += comment.replace(/\t/g, "");
	insertStr += '</blockquote>\n';

	insertQuote(insertStr, commentBox);
}

function appendReply(insertStr, commentBox) {
	if(MGJS.$(commentBox) && MGJS.$(commentBox).type == 'textarea') {
		field = MGJS.$(commentBox);

	} else {
		alert("The comment box does not exist!");
		return false;
	}

	if (field.value.indexOf(insertStr) > -1) {
		alert("You've already appended this reply!");
		return false;
	}

	if (field.value.replace(/\s|\t|\n/g, "") == '') {
		field.value = insertStr;
	} else {
		field.value = field.value.replace(/[\n]*$/g, "") + '\n\n' + insertStr;
	}
	field.focus();
}

function insertQuote(insertStr, commentBox) {
	if(MGJS.$(commentBox) && MGJS.$(commentBox).type == 'textarea') {
		field = MGJS.$(commentBox);

	} else {
		alert("The comment box does not exist!");
		return false;
	}

	if(document.selection) {
		field.focus();
		sel = document.selection.createRange();
		sel.text = insertStr;
		field.focus();

	} else if (field.selectionStart || field.selectionStart == '0') {
		var startPos = field.selectionStart;
		var endPos = field.selectionEnd;
		var cursorPos = startPos;
		field.value = field.value.substring(0, startPos)
					+ insertStr
					+ field.value.substring(endPos, field.value.length);
		cursorPos += insertStr.length;
		field.focus();
		field.selectionStart = cursorPos;
		field.selectionEnd = cursorPos;

	} else {
		field.value += insertStr;
		field.focus();
	}
}

window['MGJS_CMT'] = {};
window['MGJS_CMT']['reply'] = reply;
window['MGJS_CMT']['quote'] = quote;

})();


/*
MENU.JS
*/
(function() {

var Class = {
	create: function() {
		return function() {
			this.initialize.apply(this, arguments);
		}
	}
}

var GhostlyMenu = Class.create();
GhostlyMenu.prototype = {

	initialize: function(target, align, sub) {
		this.obj = cleanWhitespace(target);
		this.align = align || 'left';
		this.sub = sub || -1;

		this.menu = this.obj.childNodes;
		if (this.menu.length < 2) { return; }

		this.title = this.menu[0];
		this.body = this.menu[1];

		cleanWhitespace(this.body).lastChild.getElementsByTagName('a')[0].className += ' last';

		setStyle(this.body, 'visibility', 'hidden');
		setStyle(this.body, 'display', 'block');

		addListener(this.obj, 'mouseover', bind(this, this.activate), false);
		addListener(this.obj, 'mouseout', bind(this, this.deactivate), false);
	},

	activate: function() {
		if(this.sub == 1) {
			var pos = currentOffset(this.title);
			var top = pos[1] - 1;
			var left = getWidth(this.body) - 2;
			if (this.align == 'right') {
			var left = getWidth(this.body) * (-1);
			}
		} else {
			var pos = cumulativeOffset(this.title);
			var top = pos[1] + getHeight(this.title);
			var left = pos[0];
			if (this.align == 'right') {
				left += getWidth(this.title) - getWidth(this.body);
			}
		}

		if(!/current/.test(this.title.className)) {
			this.title.className += ' current';
		}

		setStyle(this.body, 'left', left + 'px');
		setStyle(this.body, 'top', top + 'px');
		setStyle(this.body, 'visibility', 'visible');
	},

	deactivate: function(){
		this.title.className = this.title.className.replace('current', '');
		var thismenu = this;
		var tid = setInterval( function() {
			clearInterval(tid);
			if (!/current/.test(thismenu.title.className)) {
				setStyle(thismenu.body, 'visibility', 'hidden');
			}
			return false;
		}, 400);
	}
}

$A = function(iterable) {
	if(!iterable) {
		return [];
	}
	if(iterable.toArray) {
		return iterable.toArray();
	} else {
		var results = [];
		for(var i = 0; i < iterable.length; i++) {
			results.push(iterable[i]);
		}
		return results;
	}
}

bind = function() {
	var array = this.$A(arguments);
	var func = array[array.length - 1];
	var method = func, args = array, object = args.shift();
	return function() {
		return method.apply(object, args.concat(array));
	}
}

getHeight = function(element) {
	return element.offsetHeight;
}

getWidth = function(element) {
	return element.offsetWidth;
}

setStyle = function(element, key, value) {
	element.style[key] = value;
}

cleanWhitespace = function(list) {
	var node = list.firstChild;
	while (node) {
		var nextNode = node.nextSibling;
		if(node.nodeType == 3 && !/\S/.test(node.nodeValue)) {
			list.removeChild(node);
		}
		node = nextNode;
	}
	return list;
}

currentOffset = function(element) {
	var valueT = element.offsetTop  || 0;
	var valueL = element.offsetLeft || 0;
	return [valueL, valueT];
}

cumulativeOffset = function(element) {
	var valueT = 0, valueL = 0;
	do {
		valueT += element.offsetTop  || 0;
		valueL += element.offsetLeft || 0;
		element = element.offsetParent;
	} while (element);
	return [valueL, valueT];
}

addListener = function(element, name, observer, useCapture) {
	if(element.addEventListener) {
		element.addEventListener(name, observer, useCapture);
	} else if(element.attachEvent) {
		element.attachEvent('on' + name, observer);
	}
}

function loadMenus() {
	var align = 'left';
	for(var i = 0; (a = document.getElementsByTagName('link')[i]); i++) {
		if((a.getAttribute('rel') == 'stylesheet') && (a.getAttribute('href').indexOf('rtl.css') != -1)) {
			align = 'right';
		}
	}

	var subscribe = document.getElementById('subscribe');
	if (subscribe) {
		new GhostlyMenu(subscribe, align);
	}

	var menubar = document.getElementById('menus');
	if (menubar) {
		var list = menubar.getElementsByTagName('ul');
		for (var i = 0; i < list.length; i++) {
			var menu = list[i].parentNode;
			if(menu.parentNode === menubar) {
				new GhostlyMenu(menu, align);
			} else {
				new GhostlyMenu(menu, align, 1);
				menu.firstChild.className += ' subtitle';
			}
		}
	}
}

if (document.addEventListener) {
	document.addEventListener("DOMContentLoaded", loadMenus, false);

} else if (/MSIE/i.test(navigator.userAgent)) {
	document.write('<script id="__ie_onload_for_inove" defer src="javascript:void(0)"></script>');
	var script = document.getElementById('__ie_onload_for_inove');
	script.onreadystatechange = function() {
		if (this.readyState == 'complete') {
			loadMenus();
		}
	}

} else if (/WebKit/i.test(navigator.userAgent)) {
	var _timer = setInterval( function() {
		if (/loaded|complete/.test(document.readyState)) {
			clearInterval(_timer);
			loadMenus();
		}
	}, 10);

} else {
	window.onload = function(e) {
		loadMenus();
	}
}

})();