;(function($) {   

	var slider = {
		
		init : function(){
		
			var $slideContainer = $('.home-slide'),
				$slides			= $slideContainer.find('.slides li');
				
			slider.showTitle($slides);
			
			//Create the background for each slide
			$slides.each(function(i, slide){
			
				//slider.createBackground($(slide));
				var $image = $(slide).find('img');
				var colorThief = new ColorThief();
				var $colour = colorThief.getColor( $image[0] );
				
				//$(slide).css('background', 'rgb(' + $colour[0] + ', ' + $colour[1] + ', ' + $colour[2] + ')');
			
			});
			
			if($slides.length == 1){
			}
			
			$(document).on('keydown', function(event){
				
				if ( event.keyCode == 40 ) {
     				event.preventDefault();
     				slider.prevSlide($slideContainer);
     				
  				}else if ( event.keyCode == 38 ){
  				
  					event.preventDefault();
     				slider.nextSlide($slideContainer);
  				
  				}
			
			});

		},
		
		nextSlide : function($slideContainer){
		
			var $current 		= $slideContainer.find('.current');
				
				if($current.next('li').length > 0){
				
					$current.removeClass('current');
					$current.next('li').addClass('current');
					slider.showCurrent($slideContainer);
					
				}else{
				
					return;
				
				}
		
		},
		
		prevSlide : function($slideContainer){
				
				var $current = $slideContainer.find('.current');
				
				if($current.prev('li').length > 0){
				
					$slideContainer.find('li').removeClass('current');
					$current.prev('li').addClass('current');
					slider.showCurrent($slideContainer);
					
				}else{
				
					return;
				
				}			
		
		},
		
		createBackground : function( $slide ){
		
			var $img 		= $slide.find('img'),
				$clonePre 	= $img.clone(),
				$clonePost	= $img.clone(),
				width		= $slide.find('img').width();
			
			//Set up Pre
			$clonePre.addClass('slide-bg-img');
			$clonePre.css('margin-left', '-' + width + 'px');
			$slide.prepend($clonePre);
			
			//Set up Post
			$clonePost.addClass('slide-bg-img');
			$slide.append($clonePost);
						
		},
		
		showCurrent : function($slideContainer){
		
			var offset 		= $slideContainer.find('.current').position().top;
				
			$slideContainer.find('.slides').css('top', '-' + offset + 'px');
			
			$slides = $slideContainer.find('.slides li');
			
			setTimeout(function() {
			
				slider.showTitle($slides);
				
			}, 200);
		
		},
		
		winScroll : function(){
		
			var scrolltop = $(window).scrollTop();
			
			var $current	= $('.slides li.current'),
				$img 		= $current.find('img'),
				$scrollmv	= (scrolltop - 40) / 3;
				
				$img.css('top', $scrollmv + 'px');	
		
		},
		
		showTitle : function($slides){
			
			var $current	= $slides.find('.current'),
				$title 		= $current.find('.slide-title'),
				$button		= $current.find('.slide-more');
			
			//Remove all the old titles
			$slides.find('.slide-title').removeClass('show');
			$slides.find('.slide-more').removeClass('in');

			//Hello title
			setTimeout(function() {
				
				$('.home-slide').find('.current .slide-title').addClass('show');

			}, 200);
			
			//Hello button
			setTimeout(function() {
				
				$('.home-slide').find('.current .slide-more').addClass('show');

			}, 350);
			
			setTimeout(function() {
				
				$('.home-slide').find('.current .slide-more').addClass('in').removeClass('show');

			}, 1350);
		
		}
	
	};
	
	var menu = {
			
			init : function(){
				
				var $nav = $('.rg-nav'),	
				$uls = $nav.find('li.menu-item-has-children'),
				$links = $nav.find('li.menu-item-has-children a'),
				$subnavs;
				
				menu.buildMenu($nav, $uls, $subnavs);
				
				//Don't get the submenu links
				var $parentLinks = $links.not('.rg-submenu a');
				
				$('.subnavs-container').hide();
				$('.rg-submenu').addClass('gone');
				
				//Menu Event
				$parentLinks.hoverIntent({
				
				    over: function(e){
				    	
				    	$(e.target).addClass('hovering');
				    	
				    	$('.subnavs-container').show();
				    	
						$('.rg-submenu').addClass('gone');
						
						menu.over(e);
					    
				    },
				    
				    out: function(e){
					    
					    $(e.target).removeClass('hovering');
					    
					    setTimeout(function(){
						
							menu.close();
						
						}, 2000 );	
					    
					    
				    },
				});
				
				var $subnavCont = $('.rg-header').find('.subnavs');
				
				$subnavCont.on('mouseover', function(){
					
					$subnavCont.addClass('over');
					
				}).on('mouseleave', function(){
				
					$subnavCont.removeClass('over');
					
					setTimeout(function(){
					
						menu.close();
						
					}, 1200 );	
					
				});
				
			},
			
			over : function(e){
				
				var $target = $(e.target),
					$parent = $target.parent('li'),
					$id		= $parent.attr('id');
				
				setTimeout(function(){
				
					$('ul.' + $id).removeClass('gone');
					
				}, 5);
				
				setTimeout(function(){

					$('.subnavs').addClass('display');
					$('ul.' + $id).addClass('display');					
					
				}, 25);
				
			},
			
			close : function(){
			
				if($('.rg-header').find('.subnavs').hasClass('over') || $('.main-navigation .hovering').length > 0){
					
					return;
					
				}
				
				$('.subnavs').removeClass('display');
				$('.subnavs ul').removeClass('display').addClass('gone');
				
				setTimeout(function(){
					
					$('.subnavs-container').hide();
					
				}, 250);
				
				
			},
			
			buildMenu : function($nav, $uls, $subnavs){
			
				$('<div class="subnavs-container"><div class="subnavs anim-fast"></div></div>').insertAfter($nav);	
					
				$subnavs = $('.subnavs');	
					
				$uls.each(function(i ,v){
					
					var $v = $(v),
					$children = $v.find('li');
						
					$subnavs.append('<ul class="rg-submenu ' + $v.attr('id') + '"></ul>');

					$subnavs.find('ul.' + $v.attr('id')).append($children);
					
				});
				
				
			}
			
			
			
	};
	
	var postSlider = {
		
		init : function(){
			
			$postLists = $('.post-list');
			
			if( $postLists.length > 0 ){
			
				$postLists.each(function( i, v ){
					
					var $v = $(v);
					
					$slides = $v.find('li');
					$($slides[0]).addClass('selected');
					postSlider.events($v);
						
				});	
				
			};
		},
		
		events: function( $postLists ){
			
			var $slides	= $postLists.find('li'),
				$next 	= $postLists.find('.next'),
				$prev 	= $postLists.find('.prev');
			
			$next.on('click', function(e){
				
				e.preventDefault();
				$target = $(e.target);
				
				if($target.hasClass('disabled')){
					
					return false;
					
				}
				
				postSlider.nextSlide($postLists);
				
			});
			
			$prev.on('click', function(e){
				
				e.preventDefault();
				$target = $(e.target);
				
				if($target.hasClass('disabled')){
					
					return false;
					
				}
				
				postSlider.prevSlide($postLists);
				
			});
			
		},
		
		nextSlide: function($slides){
			
			var $cur 	= $slides.find('.selected');
			var $next 	= $cur.next('li');
				
			console.log($next);
				
			$slides.find('li').removeClass('selected');

			$next.addClass('selected');
			
			postSlider.updateSlide();
			
		},
		
		prevSlide: function($slides){
			
			var $cur 	= $slides.find('.selected');
			var $prev 	= $cur.prev('li');
				
			$slides.find('li').removeClass('selected');
			
			$prev.addClass('selected');
			
			postSlider.updateSlide();
			
		},
		
		updateSlide: function(){
			
			$postList = $('.post-list');
			
			$postList.each(function( i, v ){
				
				var $v 			= $(v),
					$selected 	= $v.find('.selected'),
					offset 		= $selected.position().left;
					
					var $ul = $v.find('ul');
					
					$ul.css('left', '-' + offset + 'px');
				
				//Add disabled to prev
				if( $selected.prev('li').length == 0 ){
					
					$v.find('.prev').addClass('disabled');
					
				}else{
					
					$v.find('.prev').removeClass('disabled');
					
				};
				
				//Add disabled to next
				if( $selected.next('li').length == 0 ){
					
					$v.find('.next').addClass('disabled');
					
				}else{
					
					$v.find('.next').removeClass('disabled');
					
				};
				
				
				
			});
			
		},
		
		resizer: function(){
			
			var $postLists = $('.post-list');
			
			$postLists.each(function(i, v){
				
				var $v = $(v),
					$width = $v.width();
					
				var $lis = $v.find('li');
				
				$lis.css('width', $width + 'px');
				
				postSlider.updateSlide();
				
			});
			
		}
		
	};
	
	var flex = {
		
		init: function(){
			
			var $homeSlide,
				currentSlide,
				showTitle;
			
			$homeSlide = $('.home-slide');
			
			// Show titles
			currentSlide = function(){
			
				var $slides 	= $('.home-slide'),
					$current	= $slides.find('.flex-active-slide'),
					$title 		= $current.find('.slide-title'),
					$button		= $current.find('.slide-more');
				
				//Remove all the old titles
				$slides.find('.slide-title').removeClass('show');
				$slides.find('.slide-more').removeClass('in');
				
				$('.home-slide').find('.flex-active-slide .slide-title').addClass('show');
				$('.home-slide').find('.flex-active-slide .slide-more').addClass('show');
				
				
				//Hello title
				setTimeout(function() {
					
					$('.home-slide').find('.flex-active-slide .slide-title').addClass('show');
					$('.home-slide').find('.flex-active-slide .slide-more').addClass('show');
	
				}, 5);
				/*
				//Hello button
				setTimeout(function() {
					
					$('.home-slide').find('.flex-active-slide .slide-more').addClass('show');
	
				}, 350);
				
				setTimeout(function() {
					
					$('.home-slide').find('.flex-active-slide .slide-more').addClass('in').removeClass('show');
	
				}, 1350);
				*/
				
			};
			
			// Init Flexslider
			if($homeSlide.length > 0){
				
				$homeSlide.flexslider({
					animation: 'slide',
					direction: 'vertical',
					smoothHeight: true,
					slideshow: true,
					controlNav: false,
					directionNav: false,
					after: function(){
						//scroll();
						currentSlide();
					},
					start: currentSlide
				});
				
			}
			
		},
		
		scroll: function(){
			
			var scrollTop,
				$activeSlide,
				activeHeight,
				workWith;
			
			scrollTop 		= $(window).scrollTop();
			$activeSlide 	= $('.flex-active-slide');
			activeHeight 	= $activeSlide.find('img').height(); 
			workWith 		= activeHeight - 443; 
			
			if( Math.round(scrollTop / 4) < workWith ){
				
				scrollTop = scrollTop / 4;
				
				$activeSlide.find('img').css('top', '-' + scrollTop + 'px');
				
			}
			
		}
		
	};
	
	
	//slider.init();
	menu.init();
	postSlider.init();
	flex.init();
	
	$(window).scroll(function(e){
		
		slider.winScroll();
	
	});
	
	$(window).on('resize', function(){
	
		//slider.center();
			
		postSlider.resizer();
	
	});
	
	$(window).on('scroll', function(e){
		
		flex.scroll();
		
	});

} )( jQuery );
