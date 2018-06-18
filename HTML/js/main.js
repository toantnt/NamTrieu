$(document).ready(function() {
	$(window).scroll(function(){
	  	var scroll = $(window).scrollTop();
	  	//alert(scroll);
	  	if (scroll > 50) {
	    	$(".navbar-fixed-top").css("background" , "#fff");
	  	} else{
		  	$(".navbar-fixed-top").css("background" , "linear-gradient(rgba(255,255,255,1), rgba(255,255,255,0.5), rgba(255,255,255,0))");  	
	  	}
  	});

  	$("#lang-select").on("change", function() {
  		var lang = $(this).val();
  		//alert(lang);
  		window.location = lang;
  	});

	$(".owl-home").owlCarousel({
		autoPlay:3900,
		autoplayTimeout:1000,
		autoplayHoverPause:true,
		dots: false,
		pagination: true,
     	// "singleItem:true" is a shortcut for:
		items : 1,
		itemsDesktop : false,
		responsiveClass:true,
		navigation : false,
		navigationText:  ["<img src='img/slide-prev.png' />","<img src='img/slide-next.png' />"],
		itemsTablet: [768,1]
	});
	$(".owl-news").owlCarousel({
		autoPlay:3900,
		autoplayTimeout:1000,
		autoplayHoverPause:true,
		dots: true,
		pagination: true,
     	// "singleItem:true" is a shortcut for:
		items : 1,
		itemsDesktop : false,
		responsiveClass:true,
		navigation : true,
		navigationText:  ["<img src='img/prev-slide.png' />","<img src='img/next-slide.png' />"],
		itemsTablet: [768,1]
	});
	$(".owl-videos").owlCarousel({
		pagination: true,
	  	items : 1,
	  	itemsDesktop : false,
	  	responsiveClass:true,
	  	navigation : true,
	  	navigationText:  ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		itemsTablet: [768,1],
	    responsive: {
			600: {
				items: 1
			},
		    500: {
		      items: 1
		    },
		    480: {
		      items: 1
		    }
	  	}
	});
	$(".owl-testosminal").owlCarousel({
		//autoPlay:12000,
		pagination: true,
	  	items : 1,
		dots: true,
	  	itemsDesktop : false,
	  	responsiveClass:true,
	  	navigation : false,
	  	navigationText:  ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		itemsTablet: [768,1],
	    responsive: {
			600: {
				items: 1
			},
		    500: {
		      items: 1
		    },
		    480: {
		      items: 1
		    }
	  	}
	});
	$(".owl-partners").owlCarousel({
		autoPlay:2700,
		loop: true,
		pagination: false,
      	items : 4,
      	itemsDesktop : false,
      	responsiveClass:true,
      	navigation : false,
      	navigationText:  ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
	});
  	$(".owl-awards").owlCarousel({
    	pagination: true,
    	items : 3,
    	itemsDesktop : false,
    	responsiveClass:true,
    	navigation : true,
    	navigationText:  ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
	});
  	$(".owl-featured").owlCarousel({
	    pagination: true,
	    items : 3,
	    itemsDesktop : false,
	    responsiveClass:true,
	    navigation : true,
	    navigationText:  ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
  	});

  
  //alert(isHover);
  //if(isHover) alert(1); //.toggle("slide");
});