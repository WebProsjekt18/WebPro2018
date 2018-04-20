/*Appear start*/
(function ($) {
    $.fn.appear = function (fn, options) {

        var settings = $.extend({

            //arbitrary data to pass to fn
            data: undefined,

            //call fn only on the first appear?
            one: true,

            // X & Y accuracy
            accX: 0,
            accY: 0

        }, options);

        return this.each(function () {

            var t = $(this);

            //whether the element is currently visible
            t.appeared = false;

            if (!fn) {

                //trigger the custom event
                t.trigger('appear', settings.data);
                return;
            }

            var w = $(window);

            //fires the appear event when appropriate
            var check = function () {

                //is the element hidden?
                if (!t.is(':visible')) {

                    //it became hidden
                    t.appeared = false;
                    return;
                }

                //is the element inside the visible window?
                var a = w.scrollLeft();
                var b = w.scrollTop();
                var o = t.offset();
                var x = o.left;
                var y = o.top;

                var ax = settings.accX;
                var ay = settings.accY;
                var th = t.height();
                var wh = w.height();
                var tw = t.width();
                var ww = w.width();

                if (y + th + ay >= b &&
                    y <= b + wh + ay &&
                    x + tw + ax >= a &&
                    x <= a + ww + ax) {

                    //trigger the custom event
                    if (!t.appeared) t.trigger('appear', settings.data);

                } else {

                    //it scrolled out of view
                    t.appeared = false;
                }
            };

            //create a modified fn with some additional logic
            var modifiedFn = function () {

                //mark the element as visible
                t.appeared = true;

                //is this supposed to happen only once?
                if (settings.one) {

                    //remove the check
                    w.unbind('scroll', check);
                    var i = $.inArray(check, $.fn.appear.checks);
                    if (i >= 0) $.fn.appear.checks.splice(i, 1);
                }

                //trigger the original fn
                fn.apply(this, arguments);
            };

            //bind the modified fn to the element
            if (settings.one) t.one('appear', settings.data, modifiedFn);
            else t.bind('appear', settings.data, modifiedFn);

            //check whenever the window scrolls
            w.scroll(check);

            //check whenever the dom changes
            $.fn.appear.checks.push(check);

            //check now
            (check)();
        });
    };

    //keep a queue of appearance checks
    $.extend($.fn.appear, {

        checks: [],
        timeout: null,

        //process the queue
        checkAll: function () {
            var length = $.fn.appear.checks.length;
            if (length > 0)
                while (length--)($.fn.appear.checks[length])();
        },

        //check the queue asynchronously
        run: function () {
            if ($.fn.appear.timeout) clearTimeout($.fn.appear.timeout);
            $.fn.appear.timeout = setTimeout($.fn.appear.checkAll, 20);
        }
    });

    //run checks when these methods are called
    $.each(['append', 'prepend', 'after', 'before', 'attr',
        'removeAttr', 'addClass', 'removeClass', 'toggleClass',
        'remove', 'css', 'show', 'hide'], function (i, n) {
        var old = $.fn[n];
        if (old) {
            $.fn[n] = function () {
                var r = old.apply(this, arguments);
                $.fn.appear.run();
                return r;
            }
        }
    });

})(jQuery);
jQuery(window).load(function(){
    jQuery('.preloader').delay(400).fadeOut(500);
});
//One page smooth scrolling

    jQuery(function() {
      jQuery('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = jQuery(this.hash);
          target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            jQuery('html, body').animate({
              scrollTop: target.offset().top - 110
            }, 1000);
            return false;
          }
        }
      });
    });

/** start Shuffle Script **/
jQuery(document).ready(function() {
    var cf7_icon = jQuery(".cf7-btn-icon").html();
    jQuery('.wpcf7-form input[type="submit"]').replaceWith('<button id="submit" type="submit" class="btn icon wpcf7-form-control wpcf7-submit">'+cf7_icon+'  &nbsp;' + jQuery('.wpcf7-form input[type="submit"]').val() +'</button>');
    
    
    jQuery('.menu-options').click(function () {
        jQuery('.port_menu1').slideToggle('slow');
    });
        if (jQuery(window).width() < 767) {
            if(jQuery('li').hasClass('portfolioCategories')){
             jQuery('.port_menu1 li a').click(function () {
                jQuery('.selected-option').text(jQuery(this).text());
                jQuery('.port_menu1').slideToggle('slow');
            });   
        }
        else{jQuery('.menu-options').hide();}
    }
    
    jQuery(".wpcf7-form").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    jQuery.ajax({
           type: "POST",
           success: function(data)
           {
             var newdd= jQuery(".wpcf7-response-output").html().split('</span>');
             if(newdd[1]){
              var check_url = isUrl(jQuery(".redirect-link-get").html());
              if(check_url == true){
                  window.setInterval(function(){
                      window.location.href=jQuery(".redirect-link-get").html();
                }, 800);
                  
              }
             }
          }
         });
    });
});
function isUrl(s) {
   var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
   return regexp.test(s);
}