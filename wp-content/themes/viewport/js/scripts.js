(function ($) {

	multi = {
		
		init: function(){
			
			var $container 	= $('.multi-post-container');
			
			if( $container.length > 0 ){
			
				var perpage 	= $container.attr('data-page'),
					$single 	= $container.find('.multi-single');
				
				multi.cutPages( $container, $single, perpage );
				
			}
			
		},
		
		cutPages: function( $container, $single, perpage ){
			
			pageCount = 0;
			
			$single.each(function( i, v ){
				
				var i = i + 1,
					$v = $(v),
					remainder = i % perpage;
					pageCount = 1;
					
				if( i == 1 ){
					
					$v.attr('data-first', true);
					
				};
				
				if( remainder == 0 ) {
					
					if( i >= perpage ){
						
						$v.attr('data-last', true);
						$v.next('.multi-single').attr('data-first', true);
						pageCount++;
					
					};
					
				};
				
			});
			
			multi.groupPages( $container, pageCount );
			
		},
		
		groupPages : function( $container, pageNum ){
			
			var $pageEls = $container.find('[data-first="true"]');
			
			$('[data-first="true"]').each(function(i, v){ 
			
				var count = i+1,
					$set = $(v).nextUntil('[data-last="true"]').andSelf(),
					setLength = $set.length - 1,
					$last = $($set[setLength]).next();

				$finalset = $set.add($last);
				
			    $finalset.wrapAll('<div class="page-multi" data-pagenumber="' + count + '" />');
			    
			});
			
			multi.domElements( $container );
			
		},
		
		domElements : function( $container ){
		
			var $navEl = $('<ul class="multi-nav"></ul>'),
				$pages = $container.find('.page-multi');
				
			$pages.each(function(i, v){
				
				pagenum = i + 1;
				$navEl.append('<li class="page-' + pagenum + '"><a href="#">' + pagenum + '</a></li>');
				
			});
		
			$container.append($navEl);
			$container.prepend($navEl.clone());
					
			multi.showPage( 1 );
			
		},
		
		showPage : function( pageNum ){
			
			var $container 	= $('.multi-post-container'),
			$pages 		= $('.page-multi'),
			$curPage 	= $('.page-multi[data-pagenumber="' + pageNum + '"]'),
			$multiNav 	= $('.multi-nav');
			
			$pages.removeClass('open');
			$curPage.addClass('open');
			
			$multiNav.find('li').removeClass('current-page');
			$multiNav.find('.page-' + pageNum ).addClass('current-page');
			
			multi.events();
			
		},
		
		events : function(){
			
			$('.multi-nav li a').on('click', function(e){
				
				e.preventDefault();
				
				var $target = $(e.target),
					num = $target.text();
				
				multi.showPage( num );
				
				var top = $('.multi-post-container').offset().top;
				top = top - 45;
				
				$('html, body').animate({scrollTop: top }, 'fast');
				
			});	
			
		}
		
	};
    
    
	multi.init();

})(jQuery);