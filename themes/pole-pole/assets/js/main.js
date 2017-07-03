$(document).ready(function() {

	//check queries -------------------------------------------------//
	if(location.search){
		var query = location.search.split('?')[1];
		var item = query.split('&');
		for(var i=0; i<item.length; i++){
			// var cat = item[i].split('=')[0];
			// if(cat == 'kiosk') kiosk = val;
		}
	}
	//initialize api ------------------------------------------------//
	var fitImgW = function(){
		$('img.size-medium, iframe.video').each(function(){
			if(getSize().w < 980) $(this).fitW();
		});
		$('#outline img.size-thumbnail').each(function(){
			if(getSize().w < 600) $(this).fitW();
		});
		if(getSize().w < 980){
			$('#works a.work_wrapper, #works .work h3, #cat a').css({ width: getSize().w-20 + 'px' });
		}
	}
	var switchLang = function(lng){
		if(lng === 'en') hide = 'jap';
		else hide = 'eng';
		$('.eng, .jap').show();
		$('.'+hide).hide();
	}
	var fitNav = function(){
		if(860 < getSize().w){
			if($('header').hasClass('narrow')) $('header').removeClass('narrow');			
			if($('#wrapper').hasClass('narrow')) $('#wrapper').removeClass('narrow');			
			$('#lng span#divi').show();
		} else if(600 < getSize().w && getSize().w < 860){
			if($('header').hasClass('mob')) $('header').removeClass('mob');
			if($('footer').hasClass('mob')) $('footer').removeClass('mob');
			if(!$('header').hasClass('narrow')) $('header').addClass('narrow');			
			if(!$('#wrapper').hasClass('narrow')) $('#wrapper').addClass('narrow');
		} else if(getSize().w < 600){
			if(!$('header').hasClass('narrow')) $('header').addClass('narrow');			
			if(!$('header').hasClass('mob')) $('header').addClass('mob');
			if(!$('footer').hasClass('mob')) $('footer').addClass('mob');
			if(!$('#wrapper').hasClass('narrow')) $('#wrapper').addClass('narrow');			
		}
	}
	var changeLngHas = function(obj, lng){
		obj.attr({
			'href': $(obj).attr('href').split('#')[0] + '#' + lng
		});
	}
	$('#lng a').on('click',function(){
		switchLang($(this).attr('class'));
		window.location.hash = $(this).attr('class');
		$('nav ul li a, #archive div ul li a.self, #works a, #cat a').each(function(){
			changeLngHas($(this), window.location.hash.substr(1,2));
		})
		changeLngHas($('h1 a'), $(this).attr('class'));
		if($('#nav_mob_layer').hasClass('mob')) {
			$('#nav_mob_layer').removeClass('mob');
			$('nav, #lng').hide();
			$('#nav_btn').text('☰');
		}
	});
	$('#nav_btn').on('click', function(){
		if(!$('#nav_mob_layer').hasClass('mob')) {
			$('#nav_mob_layer').addClass('mob');
			$(this).text('×');
			$('nav, #lng').show();
		} else {
			$('#nav_mob_layer').removeClass('mob');
			$('nav, #lng').hide();
			$(this).text('☰');
		}
	});

	var init = function(){
		fitImgW();
		fitNav();
		if(window.location.hash === '')
			switchLang(browserLanguage());
		else {
			switchLang(window.location.hash.substr(1,2));
			$('nav ul li a, #archive div ul li a.self, #works a, #cat a').each(function(){
				changeLngHas($(this), window.location.hash.substr(1,2));
			});
			changeLngHas($('h1 a'), window.location.hash.substr(1,2));
		}
	}
	init();

	//api ready --------------------------------------------------//  

	$(window)
		.on('resize', function(){
			fitImgW();
			fitNav();
		})
		.on('scroll',function(){
		});
});

// funcitons ////////////////////////////////////////////////////////////////////////////////////////
;(function($){
	//get window size-------------------------------------------//
	getSize = function(){
		var client = (function(){
			if(!!(window.attachEvent && !window.opera) && document.compatMode == 'CSS1Compat'){
				return document.documentElement;
			}
			else if(!!(window.attachEvent && !window.opera)){
				return document.body;
			}
			else{
				return document.documentElement;
			}
		})();
		var size = {
			w: client.clientWidth,
			h: client.clientHeight,
			a: client.clientWidth / client.clientHeight //aspect
		}
		return size;
	}
	//detect browser --------------------------------------------//
	getBrowser = function(){
	    var ua = window.navigator.userAgent.toLowerCase();	
	    if (ua.indexOf('chrome') > 0 || ua.indexOf('firefox') > 0){
	    	return 1;
	    } else {
		    return 0;
	    }
	};
	//detect device --------------------------------------------//
	getDevice = function(){
	    var ua = navigator.userAgent;
	    if(ua.indexOf('iPhone') > 0 || ua.indexOf('iPod') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0){
	        return 'sp';
	    }else if(ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0){
	        return 'tab';
	    }else{
	        return 'other';
	    }
	};
	//detect lang -----------------------------------------------//
	browserLanguage = function() {
		var ua = window.navigator.userAgent.toLowerCase();
		try {
			if( ua.indexOf( 'chrome' ) != -1 ){
				return ( navigator.languages[0] || navigator.browserLanguage || navigator.language || navigator.userLanguage).substr(0,2);
			}
			else{
				return ( navigator.browserLanguage || navigator.language || navigator.userLanguage).substr(0,2);
			}
		}
		catch( e ) {
			return undefined;
		}
	}
	$.fn.fitW = function(opt){
		var target = $(this);
		var opt = $.extend({
			margin: 8
		}, opt);

		var w, h, _w, _h;
		_w = target.width();
		_h = target.height();
		w = getSize().w - (opt.margin*2);
		h = (w / _w) * _h;
		target.width(w).height(h);
	};	

	//fit image to window size --------------------------------//
	$.fn.fitWindow = function(options){
		var target = $(this);
		var options = $.extend({
			id : 1
		}, options);

		var w, h, marginT, marginL;
		var _w, _h;
		var ratio = '4to3';
		if(options.id === 9 || options.id === 12 || options.id === -1) ratio = '16to9';
		if(ratio == '16to9'){
			_w = 16;
			_h = 9;
		}
		else if(ratio == '4to3'){
			_w = 4;
			_h = 3;
		}
		if((getSize().w/_w)*_h < getSize().h){
			w = (getSize().h/_h)*_w;
			h = getSize().h;
			marginT = 0;
			marginL = (getSize().w-w)/2;
		} else if((getSize().w/_w)*_h >= getSize().h){
			w = getSize().w;
			h = (getSize().w/_w)*_h;
			marginT = (getSize().h-h)/2;
			marginL = 0;
		}
		target.width(w).height(h).css({marginTop:marginT+'px', marginLeft:marginL+'px'});
	};	
})(jQuery);