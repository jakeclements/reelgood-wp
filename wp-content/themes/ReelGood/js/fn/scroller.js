;(function($) {

	var setHome = function(){
	
		var $slides = $('.home .slides li');
		var $active = $slides.find('.flex-active-slide');
		var $cloned = $active.next().clone();
		
	}    
    
    var setSticky = function(){
    	
    	var $post = $(document).find('.post-content, .homepage-content, .archive-content');
       	var scrollTop     = $(window).scrollTop();
    	var elementOffset = $post.offset().top;
    	var distance      = (elementOffset - scrollTop);

    	//Scroll based events
        $(window).scroll(function(e){
        	stickyBanner(e, distance);
        });
    }
    
    var stickyBanner = function(e, postHeight){
  		
  		var scrollDist = $(e.target).scrollTop();  
  		
  		var $header = $('header');	
  			
  		if(scrollDist > postHeight && !$header.hasClass('fixed')){
  			$('body').addClass('fixed-header');
			$header.addClass('fixed hidden').delay(200).removeClass('hidden');
  		}
  		
		if(scrollDist == 0 && $header.hasClass('fixed')){
			$('body').removeClass('fixed-header');
			$header.removeClass('fixed');
		}
		
    }

    var init = function() {
                
        //init based events
        setSticky();
        
        setHome();

        //Window resize events
        $(window).resize(function(){

        });
        $(window).resize();
        	
        //User generated events

    };

    $(init);
})(jQuery);