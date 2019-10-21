(function($) { 
	'use strict';

  	/**
	 * WooCommerce Product Slider
	 */
	
	$(".wpb-woo-products-slider").each(function() {

	    var t = $(this),
	        auto 			= t.data("autoplay") ? !0 : !1,
	        rtl 			= t.data("direction") ? !0 : !1,
	        items 			= t.data("items") ? parseInt(t.data("items")) : '',
	        desktopsmall 	= t.data("desktopsmall") ? parseInt(t.data("desktopsmall")) : '',
	        tablet 			= t.data("tablet") ? parseInt(t.data("tablet")) : '',
	        mobile 			= t.data("mobile") ? parseInt(t.data("mobile")) : '',
	        nav 			= t.data("navigation") ? !0 : !1,
	        slideBy 		= t.data("slideby"),
	        pag 			= t.data("pagination") ? !0 : !1,
	        loop 			= t.data("loop") ? !0 : !1,
	        navTextLeft 	= t.data("direction") ? 'right' : 'left',
	        navTextRight 	= t.data("direction") ? 'left' : 'right';
	        
	    $(this).owlCarousel({
	        autoplay: auto,
	        rtl: rtl,
	        items : items,
	        responsiveClass:true,
		    responsive:{
		    	0:{
		            items: mobile,
		        },
		        480:{
		            items: mobile,
		        },
		        768:{
		            items: tablet,
		        },
		        1170:{
		            1024: desktopsmall,
		        },
		        1200:{
		            items: items,
		        }
		    },
            nav: nav,
            navText : ['<i class="wpb-wps-fa-angle-'+navTextLeft+'"></i>','<i class="wpb-wps-fa-angle-'+navTextRight+'"></i>'],
            slideBy: slideBy,
            dots: pag,
            loop: loop,
            margin: 10,
	    });
	});


})(jQuery);  