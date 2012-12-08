

// DOM Ready
$(document).ready(function() {
	// jQuery Code
	
	// Responsive Projects, iPhone/iPad URL bar hides itself on pageload
	if (navigator.userAgent.indexOf('iPhone') != -1) {
	    addEventListener("load", function () {
	        setTimeout(hideURLbar, 0);
	    }, false);
	}
	
	function hideURLbar() {
	    window.scrollTo(0, 0);
	}
	
	$('.dropdown-toggle').dropdownHover({
								delay: 500,
								instantlyCloseOthers: true
							});	
							
    $('.carousel').carousel({interval: 4000	});

	selectnav('nav_menu'); 		
	
	// Fix dropdown on iPad
	$('body')
		.on('touchstart.dropdown', '.dropdown-menu', function (e) {e.stopPropagation();})
		.on('touchstart.dropdown', '.dropdown-submenu', function (e) {e.preventDefault();});
	}					
});


//********************************************************
// Custom jQuery Plugins
//********************************************************

// outside the scope of the jQuery plugin to
// keep track of all dropdowns
var $allDropdowns = $();

// if instantlyCloseOthers is true, then it will instantly
// shut other nav items when a new one is hovered over
$.fn.dropdownHover = function(options) {

    // the element we really care about
    // is the dropdown-toggle's parent
    $allDropdowns = $allDropdowns.add(this.parent());

    return this.each(function() {
        var $this = $(this).parent(),
            defaults = {
                delay: 500,
                instantlyCloseOthers: true
            },
            data = {
                delay: $(this).data('delay'),
                instantlyCloseOthers: $(this).data('close-others')
            },
            options = $.extend(true, {}, defaults, options, data),
            timeout;

        $this.hover(function() {
            if(options.instantlyCloseOthers === true)
                $allDropdowns.removeClass('open');

            window.clearTimeout(timeout);
            $(this).addClass('open');
        }, function() {
            timeout = window.setTimeout(function() {
                $this.removeClass('open');
            }, options.delay);
        });
    });
};  