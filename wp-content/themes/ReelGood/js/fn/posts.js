;(function($) {      
    
    var wideFeature = function(){
    	var $feature = $('.feature.wide');
    	var $image = $feature.find('img');
    	
    	var imgHeight = $image.height();
    	var halfHeight = (imgHeight/4);
    	//$image.css('top', '-'+halfHeight+'px');
    	
    	//Create bg
    	$feature.append('<div class="bg hidden"></div>');
    	$feature.find('.bg').css('background', 'url('+$image.attr('src')+')');
    	
    	//If bg loaded, clear hidden
		$image.imagesLoaded(function(){
			$feature.find('.bg').removeClass('hidden');
		});

    	//If scrolling is turned on, activate
    	if($feature.attr('data-scroll') == true){
    		wideScroll();
    	}
    }
    
    var tallFeature = function(){
    	var $feature = $('.feature.tall');
    	var $image = $feature.find('img');
    	
    	var winHeight = $(window).height();
    	$feature.css('height', winHeight);
    	//$image.css('height', winHeight);
    	
    	if($image.width() > $feature.width()){
    	
    	}else{
    		
    	}
    
    };
    
    var init = function() {     
        
        //init based events
        wideFeature();
        
        //Window resize events
        $(window).resize(function(){
        	tallFeature();
        });
        
        //Trigger window resize event
        $(window).resize();
        
        $(".login-signup a").fancybox();
        

    };

    $(init);
    
})(jQuery);