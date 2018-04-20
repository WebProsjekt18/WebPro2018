/* Main-Menu Js */
/* Deafult js */
 jQuery(window).scroll(function () {
     if (jQuery(window).scrollTop() >= 100) {
         jQuery('nav').addClass('blackMenu');
     } else {
         jQuery('nav').removeClass('blackMenu');
     }
 });
 (function ($) {
     $.fn.menumaker = function (options) {
         var cssmenu = jQuery(this),
             settings = jQuery.extend({
                 title: "Menu",
                 format: "dropdown",
                 sticky: false
             }, options);
         return this.each(function () {
             cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
             jQuery(this).find("#menu-button").on('click', function () {                
                 jQuery(this).toggleClass('menu-opened');
                 var mainmenu = jQuery(this).next('ul.mobilemenu');
                 if (mainmenu.hasClass('open')) {
                     mainmenu.hide().removeClass('open');
                 } else {
                     mainmenu.show().addClass('open');
                     if (settings.format === "dropdown") {
                         mainmenu.find('ul').show();
                     }
                 }
             });
            
             cssmenu.find('li ul').parent().addClass('has-sub');
             multiTg = function () {
                 cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                 cssmenu.find('.submenu-button').on('click', function () {
                     jQuery(this).toggleClass('submenu-opened');
                     if (jQuery(this).siblings('ul').hasClass('open')) {
                         jQuery(this).siblings('ul').removeClass('open').hide();
                     } else {
                         jQuery(this).siblings('ul').addClass('open').show();
                     }
                 });
             };
             if (settings.format === 'multitoggle') multiTg();
             else cssmenu.addClass('dropdown');
             if (settings.sticky === true) cssmenu.css('position', 'fixed');
             resizeFix = function () {
                 if (jQuery(window).width() > 1024) {
                     cssmenu.find('ul').show();
                 }
                 if (jQuery(window).width() <= 1024) {
                     cssmenu.find('ul').hide().removeClass('open');
                 }
             };
             resizeFix();
             return jQuery(window).on('resize', resizeFix);
         });
     };
 })(jQuery);
 (function ($) {
     jQuery(document).ready(function () {
         jQuery(document).ready(function () {
             jQuery("#menu-style-header").menumaker({
                 title: "",
                 format: "multitoggle"
             });
            /** Set Position of Sub-Menu **/
            var wapoMainWindowWidth = jQuery(window).width();
            jQuery('#menu-style-header ul ul li').mouseenter(function () {
                var subMenuExist = jQuery(this).find('.sub-menu').length;
                if (subMenuExist > 0) {
                    var subMenuWidth = jQuery(this).find('.sub-menu').width();
                    var subMenuOffset = jQuery(this).find('.sub-menu').parent().offset().left + subMenuWidth;
                    if ((subMenuWidth + subMenuOffset) > wapoMainWindowWidth) {
                        jQuery(this).find('.sub-menu').removeClass('submenu-left');
                        jQuery(this).find('.sub-menu').addClass('submenu-right');
                    } else {
                        jQuery(this).find('.sub-menu').removeClass('submenu-right');
                        jQuery(this).find('.sub-menu').addClass('submenu-left');
                    }
                }
            });
         });
     });
 })(jQuery);