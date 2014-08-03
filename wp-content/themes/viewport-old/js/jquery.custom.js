/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end jQuery
 
-----------------------------------------------------------------------------------*/
 
jQuery(document).ready(function($) {

/*-----------------------------------------------------------------------------------*/
/*	Superfish Settings - http://users.tpg.com.au/j_birch/plugins/superfish/
/*-----------------------------------------------------------------------------------*/

	$('#primary-nav ul').supersubs({
        minWidth: 12,
        maxWidth: 27,
        extraWidth: 0 // set to 1 if lines turn over
    }).superfish({
		delay: 200,
		animation: {opacity:'show', height:'show'},
		speed: 'fast',
		autoArrows: false,
		dropShadows: false
	});
	
	$('#primary-nav ul li:last-child').addClass('last');
	

/*-----------------------------------------------------------------------------------*/
/*	Zilla MobileMenu
/*-----------------------------------------------------------------------------------*/

    $('<a class="menu-dropdown" href="#primary-nav" />').prependTo('#primary-nav');
    
    $('#primary-nav .menu-dropdown').click(function(e) {
        if( $('body').hasClass('ie8') ) {
            
            var $myDiv = $(this).next('div');
            
            if( $myDiv.css('display') === 'block' ) {
                $myDiv.css({
                    'display' : 'none'
                });
            } else {
                $myDiv.css({
                    'display' : 'block',
                    'height' : 'auto',
                    'z-index' : 999,
                    'position' : 'absolute' 
                });
            }
            
        } else {
            
            $(this).next('div').stop().slideToggle(500);
            
        }
        
        e.preventDefault();
    });

    function zilla_mobilemenu() {
        
        var windowWidth = $(window).width();

        if( typeof window.orientation === 'undefined' ) {
            $('#primary-nav > div').removeAttr('style');
        }

        if( windowWidth < 1000 ) {
            $('#primary-nav ul').removeClass('sf-js-enabled');
        } else {
            $('#primary-nav ul, #primary-nav > div').show();
        	$('#primary-nav ul').supersubs({
                minWidth: 12,
                maxWidth: 27,
                extraWidth: 0 // set to 1 if lines turn over
            }).superfish({
        		delay: 200,
        		animation: {opacity:'show', height:'show'},
        		speed: 'fast',
        		autoArrows: false,
        		dropShadows: false
        	});        
        }
        
    }
    
    zilla_mobilemenu();

    $(window).resize(function() {
        zilla_mobilemenu();
    });
    
    if( !$('body').hasClass('ie8') ) {    
        window.addEventListener( "orientationchange", function() {
            $('#primary-nav > div').removeAttr('style');
        }, false );
    }
        

/*-----------------------------------------------------------------------------------*/
/*	jQuery Masonry
/*-----------------------------------------------------------------------------------*/

	$('.masonry').imagesLoaded(function(){
		$('.masonry').masonry({
			itemSelector : '.post',
			columnWidth : 320
		});
	});


/*-----------------------------------------------------------------------------------*/
/*	Top Feature Slider
/*-----------------------------------------------------------------------------------*/

	var i = 0,
		animating = false,
		timer = 0,
		delay = 0;
		
	if($('#feature-wrapper').attr('data-delay')) delay = $('#feature-wrapper').attr('data-delay')*1000;
	
	if($('#feature-wrapper .feature').length){
		if($('#feature-wrapper .feature').length > 1){
			$('.feature-navigation').append('<a href="#" class="prev">Prev</a> <a href="#" class="next">Next</a>');
		}
		
		$('#feature-wrapper .feature-navigation .next').bind('click', function(){
			if(!animating) next();
			return false;
		});
		$('#feature-wrapper .feature-navigation .prev').bind('click', function(){
			if(!animating) prev();
			return false;
		});
		
		if(delay){
			clearTimeout(timer);
			timer = setTimeout(function(){ next(); }, delay);
		}
		
		$('#feature-wrapper').imagesLoaded(function() {
			$('#feature-wrapper.zilla-image .feature,#feature-wrapper.zilla-gallery .feature').show();
			centerImgs();
			$('#feature-wrapper.zilla-image .feature,#feature-wrapper.zilla-gallery .feature').hide();
			$('#feature-wrapper .feature:first-child').fadeIn(200);
		});
		if($.browser.msie && parseInt($.browser.version, 10) < 9){
			$('#feature-wrapper .feature:first-child').fadeIn(200); // imagesLoaded doesn't work in IE8
		}
		
		$(window).resize(function(){
        	centerImgs();
        });
	}
	
	function next(){
		animating = true;
		$('#feature-wrapper .feature:eq('+ i +')').fadeOut(500, function(){
			i++;
			if(i >= $('#feature-wrapper .feature').length) i = 0;
			$('#feature-wrapper .feature:eq('+ i +')').fadeIn(500, function(){
				animating = false;
				if(delay) {
					clearTimeout(timer);
					timer = setTimeout(function(){ next(); }, delay);
				}
			});
		});
	}
	
	function prev() {
		animating = true;
		$('#feature-wrapper .feature:eq('+ i +')').fadeOut(500, function(){
			i--;
			if(i < 0) i = $('#feature-wrapper .feature').length - 1;
			$('#feature-wrapper .feature:eq('+ i +')').fadeIn(500, function(){
				animating = false;
				if(delay){
					clearTimeout(timer);
					timer = setTimeout(function(){ next(); }, delay);
				}
			});
		});
	}
	
	function centerImgs() {
		$('#feature-wrapper.zilla-image .feature,#feature-wrapper.zilla-gallery .feature').each(function(){
			var img = $(this).find('img'),
			    vpWidth = $(window).width(),
			    vpHeight,
			    imgHeight = img.attr('height'),
		        imgWidth = img.attr('width'),
		        imgAspectRatio = imgWidth / imgHeight,
		        vpAspectRatio,
		        newImgWidth,
		        newImgHeight = vpWidth / imgAspectRatio;
  
		    if( vpWidth <= 660 ) {
		        vpHeight = 300;
		        newImgWidth = imgWidth * vpHeight / imgHeight;
		    } else if( vpWidth > 660 && vpWidth <= 1000 ) {
		        vpHeight = 400;
		        newImgWidth = imgWidth * vpHeight / imgHeight;
		    } else {
		        vpHeight = 600;
		        newImgWidth = imgWidth * vpHeight / imgHeight;
		    }
		    
		    vpAspectRatio = vpWidth / vpHeight;
		        					
			if( vpAspectRatio <= imgAspectRatio ) {
			    img.css({
			        'margin-top': 0,
			        'width': newImgWidth,
			        'height': '100%',
			        'margin-left': (vpWidth - newImgWidth)/2
			    });
		    } else {
			    img.css({
			        'width': '100%',
			        'height': newImgHeight,
			        'margin-left': 'auto',
			        'margin-top': (vpHeight - newImgHeight)/2
			    });
		    }
		});
	}


/*-----------------------------------------------------------------------------------*/
/*	Footer Carousel
/*-----------------------------------------------------------------------------------*/

	$('#footer-feature-nav').append('<a href="#" class="prev">Prev</a> <a href="#" class="next">Next</a>');
	
	$('#footer-feature-wrapper').imagesLoaded(function(){
		$('#footer-feature-wrapper ul').carouFredSel({
			width: 960,
			height: 'variable',
			items: { visible: 4 },
			next: { button: $('#footer-feature-nav .next') },
			prev: { button: $('#footer-feature-nav .prev') },
			auto: { play: false }
		});
	});


/*-----------------------------------------------------------------------------------*/
/*	Popular Posts Widget
/*-----------------------------------------------------------------------------------*/

	$('.zilla-popular-widget-nav').append('<a href="#" class="prev">Prev</a> <a href="#" class="next">Next</a>');
	
	$('.zilla-popular-widget').imagesLoaded(function(){
		$('.zilla-popular-widget').each(function(){
			var div = $(this),
				ul = $('ul', this);
			ul.carouFredSel({
				width: 240,
				height: 'variable',
				next: { button: $('.zilla-popular-widget-nav .next', div) },
				prev: { button: $('.zilla-popular-widget-nav .prev', div) },
				scroll: { fx: 'fade' },
				auto: { 
					play: ((ul.attr('data-delay') > 0) ? true : false),
					pauseDuration: ul.attr('data-delay')*1000,
					pauseOnHover: true 
				}
			});
		});
	});


/*-----------------------------------------------------------------------------------*/
/*	Make Video/Audio Responsive
/*-----------------------------------------------------------------------------------*/

	if($().jPlayer && $('#feature-wrapper .jp-jplayer,#feature-wrapper .embed-video').length){
		$('#feature-wrapper .jp-jplayer,#feature-wrapper .embed-video').each(function(){
			var player = $(this),
				orig_width = player.width(),
				orig_height = player.height();
				
			player.attr('data-orig-width', orig_width);
			player.attr('data-orig-height', orig_height);
		});
		
		$(window).resize(function(){
			$('#feature-wrapper .jp-jplayer,#feature-wrapper .embed-video').each(function(){
				var player = $(this),
					orig_width = player.attr('data-orig-width'),
					orig_height = player.attr('data-orig-height'),
					new_width = orig_width,
					new_height = orig_height,
					win_width = $(window).width();
					
				// Set responsive width breakpoints here
				if(win_width <= 660) new_width = 320;
				else if(win_width <= 1000) new_width = 640;
				
				new_height = Math.round((new_width / orig_width) * orig_height);
				if(player.hasClass('jp-jplayer')) player.jPlayer('option', 'size', { width: new_width, height: new_height });
				if(player.hasClass('embed-video')) player.width(new_width).height(new_height);
			});
		});
		
		$(window).trigger('resize'); // inital resize
	}

/*-----------------------------------------------------------------------------------*/
/*	Fix YouTube z-index bug
/*-----------------------------------------------------------------------------------*/

	$('iframe').each(function() {
        var url = $(this).attr("src");
        $(this).attr("src",url+"?wmode=transparent");
    });

});
