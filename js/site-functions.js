/**
 * Prepares the main menu for mobile.
 */
jQuery( document ).ready( function( $ ) {
	
	
	//Mobile Menu
	$.fn.mobilemenuclass = function() {
		//Set sub nav mobile menu closed by default
		$( 'body' ).addClass( 'sub-nav-closed' );
		//Set class for first level sub menu
		$( '.sub-menu' ).addClass( 'sub-nav-hidden' );
		//Set class for second level sub menu
		$( '.sub-menu .sub-menu' ).addClass( 'sub-sub-nav-hidden' ).removeClass( 'sub-nav-hidden' );
		//Add back buttons to fist level sub menus
		$('.sub-nav-hidden').prepend('<li class="sub-nav-back"><a>Back</a></li>');
		//Add back buttons to second level sub menus
		$('.sub-sub-nav-hidden').prepend('<li class="sub-sub-nav-back"><a>Back</a></li>');
		
		//Set functionality for returning to main mobile menu
		$( '.sub-menu .sub-nav-back' ).click( function() {
			//Stop from effecting other elements
			event.stopPropagation();
			//Set classes on body
			$( '.sub-nav-opened' ).removeClass( 'sub-nav-opened' ).addClass( 'sub-nav-closed' );
			//Set class on sub menu to hide
			$( '.sub-nav-visible' ).removeClass( 'sub-nav-visible' ).addClass( 'sub-nav-hidden' );
		});
		
		//Set functionality for returning to first level sub menu
		$( '.sub-menu .sub-sub-nav-back' ).click( function() {
			//Stop from effecting other elements
			event.stopPropagation();
			//Show first level sub menu
			$( '.sub-nav-hide' ).removeClass( 'sub-nav-hide' );
			//Hide second level sub menu
			$( '.sub-sub-nav-visible' ).removeClass( 'sub-sub-nav-visible' ).addClass( 'sub-sub-nav-hidden' );
		});
		
		//Set functinality to show second level sub menu
		$( '.sub-sub-nav-hidden' ).click( function() {
			//Hide first level sub meu
			$( '.sub-nav-visible' ).addClass( 'sub-nav-hide' );
			//Show second level sub menu
			$(this).removeClass( 'sub-sub-nav-hidden' ).addClass( 'sub-sub-nav-visible' );
		});
		
		//Set functionality to show first level sub menu
		$( '.sub-nav-closed .sub-nav-hidden' ).click( function() {
			//Set class on body
			$( '.sub-nav-closed' ).removeClass( 'sub-nav-closed' ).addClass( 'sub-nav-opened' );
			//Show sub menu
			$(this).removeClass( 'sub-nav-hidden' ).addClass( 'sub-nav-visible' );
		});
	};
	
	//Sticky Nav Functionality
	$.fn.stickymenu = function() {
		
		//Set TOP of Header
		$('#headercontainer.sticky').css('top','0px');
		
		//Set Interval
		setInterval(stickIt, 10);
		
		//Create function
		function stickIt() {
			//gets height of header
			var height = $("#headercontainer.sticky").outerHeight(); 
			//Is window scrolled past header             
  			if ($(window).scrollTop() >= height) {     
				//Set classes for sticky nav
				$('body').removeClass( 'nav-fix' ).addClass( 'nav-stick' );
				$("#bannercontainer").css("padding-top", height);
  			} 
			else {
    			//Remove classes for sticky nav
    			$('body').removeClass( 'nav-stick' ).addClass( 'nav-fix' );
				$("#bannercontainer").css("padding-top", "0");
  			}
		}
	};
	
	//On Scroll Nav Functionality
	$.fn.onscrollmenu = function() {
		// Hide Header on on scroll down
		var didScroll;
		var lastScrollTop = 0;
		var delta = 5;
		var navbarHeight = $('#headercontainer.on-scroll').outerHeight();

		$(window).scroll(function(event){
    		didScroll = true;
		});

		setInterval(function() {
    		if (didScroll) {
    		    hasScrolled();
        		didScroll = false;
    		}
		}, 250);

		function hasScrolled() {
    		var st = $(this).scrollTop();
    
    		// Make sure they scroll more than delta
    		if(Math.abs(lastScrollTop - st) <= delta)
    	   		return;
    
    		// If they scrolled down and are past the navbar, add class .nav-up.
    		// This is necessary so you never see what is "behind" the navbar.
    		if (st > lastScrollTop && st > navbarHeight){
    	    	// Scroll Down
    	    	$('body').removeClass('nav-down').addClass('nav-up');
				$("#bannercontainer").css("padding-top", navbarHeight);
    		} else {
        		// Scroll Up
        		if(st + $(window).height() < $(document).height()) {
        	    	$('body').removeClass('nav-up').addClass('nav-down');
					$("#bannercontainer").css("padding-top", navbarHeight);
        		}
    		}
			
			if (st < navbarHeight) {
				$('body').removeClass('nav-down');
				$("#bannercontainer").css("padding-top", "0");
			}
    	
	    	lastScrollTop = st;
		}
	};

	//CSS IMAGE SLIDER
	$.fn.sliderer = function() {
		
		//Set First Input to Checked
		$('#img-0').attr('checked', true);
		
		//Get ID of lastt input
		var $lastid = $('.slides input:last').attr('id');
		
		//Set Previous button of first slide to last input ID
		$('#img-prev-0').attr('for', $lastid);
		
		//Set Next button of last slide to first input ID
		$('.slides li:last label:last').attr('for', 'img-0');
		
		//Get number of slides
		var $numslides = $('.slides').children('input').length;
		
		//Create LI for dots Navigation
		$('.slides').append('<li class="nav-dots"></li>');
		
		//Create dots navigation
		for(var i = 0; i < $numslides; i++) {
         $('.nav-dots').append('<label for="img-'+i+'" class="nav-dot" id="img-dot-'+i+'"></label>');
    	}
     	
		//set set default hovering variable for hover check
		var hovering = false;
	
		//empty timer variable
		var itvl = null;
		
    	//set timer variable
		itvl = window.setInterval(function(){slideIT();},5000);	

		//Check for hover
		$(".slides").hover(
   			function() {
       			//if is hovering set to true
				hovering = true;
				//clear timer on function
				window.clearInterval(itvl);
   			},
    		
			function() {
				//if not hover set to false
        		hovering = false;
				//reset timer variable
				itvl = window.setInterval(function(){slideIT();},5000);
    		}
		);

		function slideIT() {
		
			if (!hovering) {
				//get checked input by name
				var $radio = $('input[name=slide-btn]:checked');
				//get id of checked input
				var $radioid = $radio.attr('id');
				//remove non numerical characters
				var $res = $radioid.replace(/[A-Za-z$-]/g, "");
				//set number as an intger
				var $number = parseInt($res);
				//Increase integer by 1
				var $numb = $number+1;
				//build the input ID
				var $imgnumb = "#img-"+$numb;
				//testing output
				//window.alert($imgnumb);
				
				//Input with this id exist
				if ($($imgnumb).length){
					//set that input to checked
        			$($imgnumb).attr('checked', 'checked');
    			}
				//Input with this id does not exist
				else {
					//set first input to checked
					$("#img-0").attr('checked', 'checked');
				}
			}
		}
		
	};
	
	
	//SEARCH MODAL
	
	$.fn.searchmodal = function() {
		$( '.f4d-site-search a' ).click( function() {
			//If mobile menu is opened close it
			if($( 'body' ).hasClass('modal-search')){
				$( 'body' ).removeClass( 'modal-search' );
			}
			//If mobile menu is closed open it
			else {
			$( 'body' ).addClass( 'modal-search' );
			}
		});
	};
	
	
	//ADD CLASS ON VIEW
	
	$(window).on('scroll', function() {
  		$(".f4d-has-view").each(function() {
    		if (isScrolledIntoView($(this))) {
      			$(this).addClass("f4d-in-view").removeClass('f4d-has-view');
    		}
  		});
		
		if ($('.f4d-in-view.count-to').length) {$.fn.counter();}
	});

	function isScrolledIntoView(elem) {
  		var docViewTop = $(window).scrollTop();
  		var docViewBottom = docViewTop + $(window).height();

  		var elemTop = $(elem).offset().top;
  		var elemBottom = elemTop + $(elem).height();

  		return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
	}
	
	
	//ANIMATE COUNTERS
	
	$.fn.counter = function() {
		$('.f4d-in-view.count-to').each(function () {
			$(this).prop('Counter',0).animate({
        		Counter: $(this).text()
    		}, {
        		duration: 4000,
        		easing: 'swing',
        		step: function (now) {
            		$(this).text(Math.ceil(now));
        		}
    		});
			
			$(this).addClass('f4d-was-viewed').removeClass('f4d-in-view');
		});
	};
	
	//CSS IMAGE SLIDER
	$.fn.gallery = function(gallery) {
				
		//Set First Input to Checked
		$('#'+gallery+'-img-0').attr('checked', true);
		
		//Get ID of lastt input
		var $lastid = $('#'+gallery+'.f4d-gallery input:last').attr('id');
		
		//Set Previous button of first slide to last input ID
		$('#'+gallery+' #img-prev-0').attr('for', $lastid);
		
		//Set Next button of last slide to first input ID
		$('#'+gallery+'.f4d-gallery li:last label:last').attr('for', gallery+'-img-0');
  
	};
	
	//BUTTON TO CLASS
	$.fn.btnclass = function() {
		
		//If button with class jq-st-btn is clicked do stuff
		$( '.jq-st-btn' ).click( function() {
			
			//Get target
			var $btnTarget = $(this).data("target");
			
			//Get apply class
			var $btnADD = $(this).data("add");
			
			//Get remove class
			var $btnRMV = $(this).data("remove");
			
			//If class exists remove it
			if($( '#'+$btnTarget ).hasClass($btnADD)){
				$( '#'+$btnTarget ).removeClass($btnADD).addClass($btnRMV);
				$(this).removeClass('button-active');
			}
			//If does not exist apply it
			else {
				$( '#'+$btnTarget ).addClass($btnADD).removeClass($btnRMV);
				$(this).addClass('button-active');
			}
		});
  
	};

	if ($('.f4d-gallery').length) {
		$.each($('.f4d-gallery'), function() {
			$.fn.gallery(this.id);
		});
			
	}
	
	if ($('#headercontainer.sticky').length) {$.fn.stickymenu();}
	if ($('#headercontainer.on-scroll').length) {$.fn.onscrollmenu();}
	if ($('.slides').length) {$.fn.sliderer();}
	$.fn.mobilemenuclass();
	$.fn.searchmodal();
	$.fn.btnclass();


} );