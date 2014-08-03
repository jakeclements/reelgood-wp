(function($) {


    /*
	*  f
	*
	*  This is the core object that holds all the theme's JS
	*  It is good practise to create a function that matches a jQuery event (eg: resize)
	*
	*  $note	The data for the object 'o' is populated by the PHP found in 'library/front.php - wp_head()'
	*  @type	object
	*  @date	5/08/13
	*/

	f = {

		o : {},


		init : function(){

			$('.slider').flexslider({
			    animation: "slide",
			    slideshow: true,
			    direction: 'vertical',
			    touch: false
			});

			$('.sidebar-post-slider').flexslider({
				animation: "slide",
				slideshow: false,
				touch: true,
				directionNav: true,
				controlNav: false,
				smoothHeight: true
			});

			$(window).on('scroll', function(e){
				f.showSocial(e);
				f.sliderScroll(e);

			});

			$(window).on('load', function(){
				/*
				// Make sidebar as high as content if we're not on mobile
				if( $(window).width() > 640 ){

					// sidebar as high as content
					var contentHeight = $('.page-content').outerHeight();
					$('.sidebar').css('height', contentHeight);

				}
				*/

			});

			$('.mobile-nav-toggle').on('click', function(){

				var $nav = $('.mobile-nav-container');

				if( $nav.hasClass('show-mobile-nav') ){

					$nav.removeClass('show-mobile-nav');
					$('.site-wrap').css('height', 'auto');

				}else{

					$nav.addClass('show-mobile-nav');
					$('.site-wrap').css('height', $nav.height());

				}



			});


		},

		sliderScroll: function(e){

			// Find current height of the slider + its distance from the top + 10px for overlap, that's how we calculate
			// How far background position moves. ;)

			var $slider,
				sliderTop,
				sliderHeight,
				sliderBase,
				sliderPercent;

			$slider = $('.slider');
			sliderTop = $slider.offset().top;
			sliderHeight = $slider.height();
			sliderBase = sliderHeight + sliderTop + 10;

			if( $(window).scrollTop() > sliderBase ){

				return;

			}

			sliderPercent = ($(window).scrollTop() / sliderBase) * 100;

			sliderPercent = sliderPercent / 4;

			$slider.find('.flex-active-slide').css('background-position-y',  sliderPercent + '%');

			if($(window).scrollTop() < 1 ){

				$slider.find('.flex-active-slide').css('background-position-y', '0%');

			}

		},

		showSocial: function(e){

			// Find current height of the slider + its distance from the top + 10px for overlap, that's how we calculate
			// How far background position moves. ;)

			var $slider,
				sliderTop,
				sliderHeight,
				sliderBase,
				sliderPercent,
				shareWidget,
				shareWidgetTop;

			$slider = $('.slider');
			sliderTop = $slider.offset().top;
			sliderHeight = $slider.height();
			sliderBase = sliderHeight + sliderTop + 10;

			// select sharing widget
			$shareWidget = $(document).find('#at4-share');

			// Only continue if sharing widget can be found
			if($shareWidget.length > 0){

				shareWidgetTop = $shareWidget.position().top;

				// if we've done a good crack of scrolling, show the widget
				if( $(window).scrollTop() > (sliderBase + shareWidgetTop) ){

					if( !$shareWidget.hasClass('at4-show') ){
						$('.at-share-open-control-left').trigger('click');
					}

				}else{

					if( $shareWidget.hasClass('at4-show') ){
						$('#at4-scc').trigger('click');
					}

				}

			}

		},

		resize : function(){



		}

	}


	/*
	*  Document Ready
	*
	*  This event is triggered when all DOM objects are ready.
	*  This calles the f.init() function and triggers the resize event
	*
	*  @type	event
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	$(document).ready(function(){

		f.init();

		$(window).trigger('resize');

	});



	/*
	*  Window Load
	*
	*  This event is triggered when all DOM objects are loaded.
	*  Webkit browsers will not know the width / hieght of an image until this event
	*
	*  @type	event
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	$(window).load(function(){

		$(window).trigger('resize');

	});


	/*
	*  Window Resize
	*
	*  This event is triggered when the window is resized
	*
	*  @type	event
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	$(window).resize(function(){

		f.resize();

	});


	/*
	*  Helpers
	*
	*  A bunch of useful helper functions
	*
	*  @type	function
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	$.fn.exists = function()
	{
		return $(this).length > 0;
	};

	function uniqid()
    {
    	var newDate = new Date;
    	return newDate.getTime();
    }


})(jQuery);