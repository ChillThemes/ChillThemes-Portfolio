jQuery(document).ready(function($) {

	/* Quicksand. */
	function quicksand() {

		/* Set variables. */
		var $filter;
		var $container;
		var $containerClone;
		var $filterLink;
		var $filteredItems

		/* Set filter. */
		$filter = jQuery('.portfolio-filter li.active a').attr('class');

		/* Set filter link. */
		$filterLink = jQuery('.portfolio-filter li a');

		/* Set container. */
		$container = jQuery('.portfolio-grid');

		/* Clone container. */
		$containerClone = $container.clone();

		/* Filter link click function. */
		$filterLink.click( function(evt) {

		/* Remove active class. */
		$('.portfolio-filter li').removeClass('active');

		/* Split filter. */
		$filter = $(this).attr('class').split(' ');

		/* Add active class. */
		$(this).parent().addClass('active');

		/* If 'all' is clicked, display all items. */
		if ( $filter == 'all' ) {
			$filteredItems = $containerClone.find('li');
		} else {
			$filteredItems = $containerClone.find('li[data-type~=' + $filter + ']');
		}

		/* Call the Quicksand function. */
		$container.quicksand( $filteredItems, {
			adjustHeight: 'dynamic', /* Make height dynamic. */
			duration: 750 /* Amount of time it takes to animate, in milliseconds. */
		},

		/* Without this the lightbox won't function. */
		function() {
			$(".fancybox").fancybox({ 'titlePosition': 'over' });
		});

		/* Prevent default when links are clicked. */
		evt.preventDefault();
	}

	/* Initiate quicksand. */
	if ( jQuery().quicksand ) {
		quicksand();	
	}

});

/*
* Quicksand, Reorder and filter items with a nice shuffling animation
* Project site: http://razorjack.net/quicksand
* Github site: http://github.com/razorjack/quicksand
* Version: 1.2.2
*
* Dual licensed under the MIT and GPL version 2 licenses.
* http://github.com/jquery/jquery/blob/master/MIT-LICENSE.txt
* http://github.com/jquery/jquery/blob/master/GPL-LICENSE.txt
*
* Copyright (c) 2010 Jacek Galanciak (razorjack.net) and agilope.com
* Big thanks for Piotr Petrus (riddle.pl) for deep code review and wonderful docs & demos.
*/
(function(a){a.fn.quicksand=function(b,c){var e={duration:750,easing:"swing",attribute:"data-id",adjustHeight:"auto",useScaling:true,enhancement:function(a){},selector:"> *",dx:0,dy:0};a.extend(e,c);if(a.browser.msie||typeof a.fn.scale=="undefined"){e.useScaling=false}var f;if(typeof arguments[1]=="function"){var f=arguments[1]}else if(typeof (arguments[2]=="function")){var f=arguments[2]}return this.each(function(c){var g;var h=[];var i=a(b).clone();var j=a(this);var k=a(this).css("height");var l;var m=false;var n=a(j).offset();var o=[];var p=a(this).find(e.selector);if(a.browser.msie&&a.browser.version.substr(0,1)<7){j.html("").append(i);return}var q=0;var r=function(){if(!q){q=1;$toDelete=j.find("> *");j.prepend(w.find("> *"));$toDelete.remove();if(m){j.css("height",l)}e.enhancement(j);if(typeof f=="function"){f.call(this)}}};var s=j.offsetParent();var t=s.offset();if(s.css("position")=="relative"){if(s.get(0).nodeName.toLowerCase()=="body"){}else{t.top+=parseFloat(s.css("border-top-width"))||0;t.left+=parseFloat(s.css("border-left-width"))||0}}else{t.top-=parseFloat(s.css("border-top-width"))||0;t.left-=parseFloat(s.css("border-left-width"))||0;t.top-=parseFloat(s.css("margin-top"))||0;t.left-=parseFloat(s.css("margin-left"))||0}if(isNaN(t.left)){t.left=0}if(isNaN(t.top)){t.top=0}t.left-=e.dx;t.top-=e.dy;j.css("height",a(this).height());p.each(function(b){o[b]=a(this).offset()});a(this).stop();var u=0;var v=0;p.each(function(b){a(this).stop();var c=a(this).get(0);if(c.style.position=="absolute"){u=-e.dx;v=-e.dy}else{u=e.dx;v=e.dy}c.style.position="absolute";c.style.margin="0";c.style.top=o[b].top-parseFloat(c.style.marginTop)-t.top+v+"px";c.style.left=o[b].left-parseFloat(c.style.marginLeft)-t.left+u+"px"});var w=a(j).clone();var x=w.get(0);x.innerHTML="";x.setAttribute("id","");x.style.height="auto";x.style.width=j.width()+"px";w.append(i);w.insertBefore(j);w.css("opacity",0);x.style.zIndex=-1;x.style.margin="0";x.style.position="absolute";x.style.top=n.top-t.top+"px";x.style.left=n.left-t.left+"px";if(e.adjustHeight==="dynamic"){j.animate({height:w.height()},e.duration,e.easing)}else if(e.adjustHeight==="auto"){l=w.height();if(parseFloat(k)<parseFloat(l)){j.css("height",l)}else{m=true}}p.each(function(b){var c=[];if(typeof e.attribute=="function"){g=e.attribute(a(this));i.each(function(){if(e.attribute(this)==g){c=a(this);return false}})}else{c=i.filter("["+e.attribute+"="+a(this).attr(e.attribute)+"]")}if(c.length){if(!e.useScaling){h.push({element:a(this),animation:{top:c.offset().top-t.top,left:c.offset().left-t.left,opacity:1}})}else{h.push({element:a(this),animation:{top:c.offset().top-t.top,left:c.offset().left-t.left,opacity:1,scale:"1.0"}})}}else{if(!e.useScaling){h.push({element:a(this),animation:{opacity:"0.0"}})}else{h.push({element:a(this),animation:{opacity:"0.0",scale:"0.0"}})}}});i.each(function(b){var c=[];var f=[];if(typeof e.attribute=="function"){g=e.attribute(a(this));p.each(function(){if(e.attribute(this)==g){c=a(this);return false}});i.each(function(){if(e.attribute(this)==g){f=a(this);return false}})}else{c=p.filter("["+e.attribute+"="+a(this).attr(e.attribute)+"]");f=i.filter("["+e.attribute+"="+a(this).attr(e.attribute)+"]")}var k;if(c.length===0){if(!e.useScaling){k={opacity:"1.0"}}else{k={opacity:"1.0",scale:"1.0"}}d=f.clone();var l=d.get(0);l.style.position="absolute";l.style.margin="0";l.style.top=f.offset().top-t.top+"px";l.style.left=f.offset().left-t.left+"px";d.css("opacity",0);if(e.useScaling){d.css("transform","scale(0.0)")}d.appendTo(j);h.push({element:a(d),animation:k})}});w.remove();e.enhancement(j);for(c=0;c<h.length;c++){h[c].element.animate(h[c].animation,e.duration,e.easing,r)}})}})(jQuery);