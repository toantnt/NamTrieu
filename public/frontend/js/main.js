function sendAjax(form, url, div) {
    $.ajax({
        type: $(form).attr("method"),
        url: $(form).attr("data-url"),
        data: $(form).serialize(),
        beforeSend: function () {
            $(".sending").removeClass("hidden");
        },
        success: function (res) {
            if(div == null) {
                if(res === 'TRUE') {
                    setTimeout(function() {
                        $(".sending").addClass("hidden");
                        window.location = url;
                    }, 1500);
                } else {
                    alert("System error. Please reload page !");
                }
            } else {
                $(".sending").addClass("hidden");
                $.ajax({
                    type: "post",
                    url: url,
                    data: {},
                    success: function(res1) {
                        setTimeout(function() {
                            $(".sending").addClass("hidden");
                        }, 900);
                        reloadPage(res1,div);
                    }
                });
            }
        }
    });
}


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


  	$.ajax({
		type: 'post',
		url: '/account/register/captcha',
		data: {},
		success: function(res) {
			$("#captchaRegister").html(res);
		}
	});
  	$("#registerForm").validate({
		rules: {
			username: {
				required: true,
				remote: {
                    url: '/account/register/checkUsername',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        email: function () {
                            return $('#registerForm :input[name="username"]').val();
                        }
                    }
				}
			},
			email: {
				required: true,
				email: true,
				remote: {
                    url: '/account/register/checkEmail',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        email: function () {
                            return $('#registerForm :input[name="email"]').val();
                        }
                    }
                }
			},
			password: {
				required: true,
                minlength:8
			},
			phone: {
				required: true,
				number: true
			},
            member_type: {
				required: true
			},
            register_captcha: {
				required: true,
                remote: {
                    url: '/account/register/checkCaptcha',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        register_captcha: function () {
                            return $('#registerForm :input[name="register_captcha"]').val();
                        }
                    }
                }
			}
		},
		messages: {
			username: {
				remote: 'This account already exists.'
			},
			email: {
				remote: 'This email already exists.'
			},
			password: {
                minlength: 'Password minimum with 8 characters.'
			},
            register_captcha: {
				remote: 'The captcha code is incorrect.'
			}
		},
		submitHandler: function(form) {
			$.ajax({
				type: $(form).attr('method'),
				url: '/account/register/saveData',
				data: $(form).serialize(),
				beforeSend: function() {
					$(".sending").removeClass('hidden');
				},
				success: function(res) {
					if(res === 'TRUE') {
						setTimeout(function () {
                            $(".sending").addClass('hidden');
                        }, 1500);
						$("#registerSuccess").modal('show');
					} else {
						// modal error
						alert("The system has an error, please try again.")
					}
                    resetForm('registerForm');
                    loadCaptcha();
				}
			});
		}
	});
  	$("#loginForm").validate({
		rules: {
			email: {
				required: true,
				email: true,
                remote: {
                    url: '/account/login/checkEmail',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        email: function () {
                            return $('#loginForm :input[name="email"]').val();
                        }
                    }
                }
			},
			password: {
				required: true,
                remote: {
                    url: '/account/login/checkPassword',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        password: function () {
                            return $('#loginForm :input[name="password"]').val();
                        }
                    }
                }
			}
		},
		messages: {},
        submitHandler: function(form) {
            $.ajax({
                type: $(form).attr('method'),
                url: '/account/login/loggedIn',
                data: $(form).serialize(),
                success: function (res) {
                    var json = JSON.parse(''+res+'');
                    if(json['success']) {
                        window.location = json['url'];
                    } else {
                        alert('Login failed.')
                    }
                }
            });
        }

	});
  //alert(isHover);
  //if(isHover) alert(1); //.toggle("slide");
});

function loadCaptcha() {
    $.ajax({
        type: 'post',
        url: '/account/register/captcha',
        data: {},
        success: function(res) {
            $("#captchaRegister").html(res);
        }
    });
}