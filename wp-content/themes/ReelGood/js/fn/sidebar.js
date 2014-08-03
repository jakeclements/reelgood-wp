;(function($) {      

	/* Sidebar */
	
	var search = {
	
		init : function(){
			
			var $search = $('.side-search__input');
			
			$search.on('focus', function(){
			
				if($search.val() == 'Looking for something?'){
				
					$(this).val('');
				
				};
			
			});
			
			$search.on('blur', function(){
			
				if($search.val() == ''){
				
					$(this).val('Looking for something?');
				
				};
			
			
			})
			
		
		}
	
	}
	
	/* var calendar = {
		
		init: function(){
			
			//http://kylestetz.github.io/CLNDR
			// var sidebarCal = $('.calendar-container').clndr(); 
			
			$calendar = $('.calendar-container');
			
			if($calendar.length > 0) {
			
				theCalendarInstance = $calendar.clndr();
				
				var events = calendar.getEvents();	
			
			}
			
		},
		
		getEvents: function(){
			
			var request = $.ajax({
			  url: "http://pilot.reelgood.dev.au/json/get_events",
			});
			 
			request.done(function( msg ) {
			  
			  var events = $.parseJSON(msg);
			  
			  calendar.updateEvents(events.events);
			  
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  alert( "Request failed: " + textStatus );
			});
			
		},
		
		updateEvents: function(events){
			
			theCalendarInstance.setEvents(events);
			
		}
		
		
		
		
	} */
	
	/*var loginsignup = {
		
		init : function(){
		
			$('.login-signup a').on('click', function(e){
				
				e.preventDefault();
				alert('when the user clicks a bar comes out from the right with the login form');
				
			});
		
		}
		
	}*/
	
	
	//The Inits
	//calendar.init();
	search.init();
    //loginsignup.init();
       
})(jQuery);