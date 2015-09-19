/*
 Name: Theme Base
 Writtern By: SWTHEMES
 Theme Version: 1.0.0
 */

// Theme
window.theme = {};

// Configuration
(function(theme, $) {

    theme = theme || {};

    var initialized = false;

    $.extend(theme, {

        rtl: js_porto_vars.rtl == '1' ? true : false,

        ajax_url: js_porto_vars.ajax_url,
        request_error: js_porto_vars.request_error,

        show_sticky_header: js_porto_vars.show_sticky_header == '1' ? true : false,
        show_sticky_header_tablet: js_porto_vars.show_sticky_header_tablet == '1' ? true : false,
        show_sticky_header_mobile: js_porto_vars.show_sticky_header_mobile == '1' ? true : false,

        post_zoom: js_porto_vars.post_zoom == '1' ? true : false,
        portfolio_zoom: js_porto_vars.portfolio_zoom == '1' ? true : false,
        member_zoom: js_porto_vars.member_zoom == '1' ? true : false,

        container_width: js_porto_vars.container_width,

        hoverIntentConfig: {
            sensitivity: 2,
            interval: 0,
            timeout: 0
        },

        owlConfig: {
            autoPlay : 5000,
            stopOnHover : true,
            singleItem : true,
            autoHeight : true,
            lazyLoad: true
        },

        infiniteConfig: {
            navSelector  : "div.pagination",
            nextSelector : "div.pagination a.next",
            loading      : {
                finishedMsg: "",
                msgText: "<em class='infinite-loading'></em>",
                img: "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
            }
        },

        getScrollbarWidth: function() {
            if (initialized)
                return this.scrollbar_width;

            initialized = true;
            this.scrollbar_width = window.innerWidth-$(window).width();
            return this.scrollbar_width;
        },

        isTablet: function() {
            var win_width = $(window).width();
            if (win_width < 992 - theme.scrollbar_width)
                return true;
            return false;
        },

        isMobile: function() {
            var win_width = $(window).width();
            if (win_width <= 480 - theme.scrollbar_width)
                return true;
            return false;
        }
    });

}).apply(this, [window.theme, jQuery]);


// Theme Functions
function portoCalcSliderMargin($parent, padding) {
    $parent.css({
        'margin-left': '-' + padding,
        'margin-right': '-' + padding
    });
}

function portoCalcSliderButtonsPosition($parent, padding) {
    var $buttons = $parent.find('.owl-buttons');
    if ($buttons.length) {
        if (window.theme.rtl) {
            $buttons.css('left', padding);
        } else {
            $buttons.css('right', padding);
        }
    }
}

function portoCalcSliderTitleLine($parent) {
    var c_w = $parent.width();
    var $title = $parent.parent().find('.slider-title');
    if (!$title.length) return;

    var $l = $title.find('.line');
    var $t = $title.find('.inline-title');

    if (!$t.length || !$l.length) return;

    var title_w = $title.width();
    var t_w = $t.width();
    if (title_w > t_w + 200) {
        if (window.theme.rtl) {
            $l.css({
                display: 'block',
                right: t_w + 20,
                width: title_w - t_w - 75
            });
        } else {
            $l.css({
                display: 'block',
                left: t_w + 20,
                width: title_w - t_w - 75
            });
        }
    } else {
        $l.css({
            display: 'none'
        });
    }
}


// Mobile Check
(function(theme, $) {

    theme = theme || {};

    var apple_phone         = /iPhone/i,
        apple_ipod          = /iPod/i,
        apple_tablet        = /iPad/i,
        android_phone       = /(?=.*\bAndroid\b)(?=.*\bMobile\b)/i, // Match 'Android' AND 'Mobile'
        android_tablet      = /Android/i,
        windows_phone       = /IEMobile/i,
        windows_tablet      = /(?=.*\bWindows\b)(?=.*\bARM\b)/i, // Match 'Windows' AND 'ARM'
        other_blackberry    = /BlackBerry/i,
        other_blackberry_10 = /BB10/i,
        other_opera         = /Opera Mini/i,
        other_firefox       = /(?=.*\bFirefox\b)(?=.*\bMobile\b)/i, // Match 'Firefox' AND 'Mobile'
        seven_inch = new RegExp(
            '(?:' +         // Non-capturing group

                'Nexus 7' +     // Nexus 7

                '|' +           // OR

                'BNTV250' +     // B&N Nook Tablet 7 inch

                '|' +           // OR

                'Kindle Fire' + // Kindle Fire

                '|' +           // OR

                'Silk' +        // Kindle Fire, Silk Accelerated

                '|' +           // OR

                'GT-P1000' +    // Galaxy Tab 7 inch

                ')',            // End non-capturing group

            'i');           // Case-insensitive matching

    var match = function(regex, userAgent) {
        return regex.test(userAgent);
    };

    var IsMobileClass = function(userAgent) {
        var ua = userAgent || navigator.userAgent;

        this.apple = {
            phone:  match(apple_phone, ua),
            ipod:   match(apple_ipod, ua),
            tablet: match(apple_tablet, ua),
            device: match(apple_phone, ua) || match(apple_ipod, ua) || match(apple_tablet, ua)
        };
        this.android = {
            phone:  match(android_phone, ua),
            tablet: !match(android_phone, ua) && match(android_tablet, ua),
            device: match(android_phone, ua) || match(android_tablet, ua)
        };
        this.windows = {
            phone:  match(windows_phone, ua),
            tablet: match(windows_tablet, ua),
            device: match(windows_phone, ua) || match(windows_tablet, ua)
        };
        this.other = {
            blackberry:   match(other_blackberry, ua),
            blackberry10: match(other_blackberry_10, ua),
            opera:        match(other_opera, ua),
            firefox:      match(other_firefox, ua),
            device:       match(other_blackberry, ua) || match(other_blackberry_10, ua) || match(other_opera, ua) || match(other_firefox, ua)
        };
        this.seven_inch = match(seven_inch, ua);
        this.any = this.apple.device || this.android.device || this.windows.device || this.other.device || this.seven_inch;
        // excludes 'other' devices and ipods, targeting touchscreen phones
        this.phone = this.apple.phone || this.android.phone || this.windows.phone;
        // excludes 7 inch devices, classifying as phone or tablet is left to the user
        this.tablet = this.apple.tablet || this.android.tablet || this.windows.tablet;

        if (typeof window === 'undefined') {
            return this;
        }
    };

    var instantiate = function() {
        var IM = new IsMobileClass();
        IM.Class = IsMobileClass;
        return IM;
    };

    $.extend(theme, {

        MobileCheck: instantiate()

    });

}).apply(this, [window.theme, jQuery]);


// Mega Menu
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        MegaMenu: {

            defaults: {
                menu: $('.mega-menu')
            },

            initialize: function($menu) {
                this.$menu = ($menu || this.defaults.menu);

                this.build()
                    .events();

                return this;
            },

            popupWidth: function() {
                var winWidth = $(window).width() + theme.getScrollbarWidth();
                if (winWidth >= theme.container_width)
                    return theme.container_width - 30;
                if (winWidth >= 992)
                    return 940;
                if (winWidth >= 768)
                    return 710;
                return $(window).width() - 30;
            },

            build: function() {
                var self = this;

                self.$menu.each( function() {
                    var $menu = $(this);
                    var $menu_container = $menu.closest('.container');
                    var container_width = self.popupWidth();
                    var offset = 0;

                    if ($menu_container.length) {
                        if (theme.rtl) {
                            offset = ($menu_container.offset().left + $menu_container.width()) - ($menu.offset().left + $menu.width()) + parseInt($menu_container.css('padding-right'));
                        } else {
                            offset = $menu.offset().left - $menu_container.offset().left - parseInt($menu_container.css('padding-left'));
                        }
                        offset = (offset == 1) ? 0 : offset;
                    }

                    var $menu_items = $menu.find('> li');

                    $menu_items.each( function() {
                        var $menu_item = $(this);
                        var $popup = $menu_item.find('> .popup');
                        if ($popup.length > 0) {
                            $popup.css('display', 'block');
                            if ($menu_item.hasClass('wide')) {
                                $popup.css('left', 0);
                                var padding = parseInt($popup.css('padding-left')) + parseInt($popup.css('padding-right')) +
                                    parseInt($popup.find('> .inner').css('padding-left')) + parseInt($popup.find('> .inner').css('padding-right'));

                                var row_number;

                                if ($menu_item.hasClass('col-2')) row_number = 2;
                                if ($menu_item.hasClass('col-3')) row_number = 3;
                                if ($menu_item.hasClass('col-4')) row_number = 4;
                                if ($menu_item.hasClass('col-5')) row_number = 5;
                                if ($menu_item.hasClass('col-6')) row_number = 6;

                                if ($(window).width() < 992 - theme.scrollbarWidth)
                                    row_number = 1;

                                var col_length = 0;
                                $popup.find('> .inner > ul > li').each(function() {
                                    var cols = parseInt($(this).attr('data-cols'));
                                    if (cols < 1)
                                        cols = 1;

                                    if (cols > row_number)
                                        cols = row_number;

                                    col_length += cols;
                                });

                                if (col_length > row_number) col_length = row_number;

                                var col_width = container_width / row_number;

                                $popup.find('> .inner > ul > li').each(function() {
                                    var cols = parseFloat($(this).attr('data-cols'));
                                    if (cols < 1)
                                        cols = 1;

                                    if (cols > row_number)
                                        cols = row_number;

                                    if ($menu_item.hasClass('pos-center') || $menu_item.hasClass('pos-left') || $menu_item.hasClass('pos-right'))
                                        $(this).css('width', (100 / col_length * cols) + '%');
                                    else
                                        $(this).css('width', (100 / row_number * cols) + '%');
                                });

                                if ($menu_item.hasClass('pos-center')) { // position center
                                    $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                    var left_position = $popup.offset().left - ($(window).width() - col_width * col_length) / 2;
                                    $popup.css({
                                        'left': -left_position
                                    });
                                } else if ($menu_item.hasClass('pos-left')) { // position left
                                    $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                    $popup.css({
                                        'left': 0
                                    });
                                } else if ($menu_item.hasClass('pos-right')) { // position right
                                    $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                    $popup.css({
                                        'left': 'auto',
                                        'right': 0
                                    });
                                } else { // position justify
                                    $popup.find('> .inner > ul').width(container_width - padding);
                                    if (theme.rtl) {
                                        $popup.css({
                                            'right': 0,
                                            'left': 'auto'
                                        });
                                        var right_position = ($popup.offset().left + $popup.width()) - ($menu.offset().left + $menu.width()) - offset;
                                        $popup.css({
                                            'right': right_position,
                                            'left': 'auto'
                                        });
                                    } else {
                                        $popup.css({
                                            'left': 0,
                                            'right': 'auto'
                                        });
                                        var left_position = $popup.offset().left - $menu.offset().left + offset;
                                        $popup.css({
                                            'left': -left_position,
                                            'right': 'auto'
                                        });
                                    }
                                }
                            }
                            $popup.css('display', 'none');

                            $menu_item.hoverIntent(
                                $.extend({}, theme.hoverIntentConfig, {
                                    over: function(){
                                        $menu_items.find('.popup').hide();
                                        $popup.show();
                                    },
                                    out: function(){
                                        $popup.hide();
                                    }
                                })
                            );
                        }
                    });
                });

                return self;
            },

            events: function() {
                var self = this;

                $(window).on('resize', function() {
                    self.build();
                });

                setTimeout(function() {
                    self.build();
                }, 400);

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Sidebar Menu
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        SidebarMenu: {

            defaults: {
                menu: $('.sidebar-menu'),
                toggle: $('.widget_sidebar_menu .widget-title .toggle'),
                menu_toggle: $('#main-toggle-menu .menu-title')
            },

            rtl: theme.rtl,

            initialize: function($menu, $toggle, $menu_toggle) {
                this.$menu = ($menu || this.defaults.menu);
                this.$toggle = ($toggle || this.defaults.toggle);
                this.$menu_toggle = ($menu_toggle || this.defaults.menu_toggle);

                this.build()
                    .events();

                return this;
            },

            isRightSidebar: function($menu) {
                var flag = false;
                if (this.rtl) {
                    flag = !($('#main').hasClass('column2-right-sidebar') || $('#main').hasClass('column2-wide-right-sidebar'));
                } else {
                    flag = $('#main').hasClass('column2-right-sidebar') || $('#main').hasClass('column2-wide-right-sidebar');
                }

                if ($menu.closest('#main-toggle-menu').length) {
                    if (this.rtl) {
                        flag = true;
                    } else {
                        flag = false;
                    }
                }

                if ($header_wrapper = $menu.closest('.header-wrapper')) {
                    if ($header_wrapper.length && $header_wrapper.hasClass('header-side-nav')) {
                        if (this.rtl) {
                            flag = true;
                        } else {
                            flag = false;
                        }
                    }
                }

                return flag;
            },

            popupWidth: function() {
                var winWidth = $(window).width() + theme.getScrollbarWidth();
                if (winWidth >= theme.container_width)
                    return theme.container_width - 30;
                if (winWidth >= 992)
                    return 940;
                if (winWidth >= 768)
                    return 710;
                return $(window).width() - 30;
            },

            build: function() {
                var self = this;

                self.$menu.each( function() {
                    var $menu = $(this);
                    var $menu_container = $menu.closest('.container');
                    var container_width;
                    if ($(window).width() < 992 - theme.getScrollbarWidth())
                        container_width = self.popupWidth();
                    else
                        container_width = self.popupWidth() - $menu.width() - 45;

                    var is_right_sidebar = self.isRightSidebar($menu);

                    var $menu_items = $menu.find('> li');

                    $menu_items.each( function() {
                        var $menu_item = $(this);
                        var $popup = $menu_item.find('> .popup');
                        if ($popup.length > 0) {
                            $popup.css('display', 'block');
                            if ($menu_item.hasClass('wide')) {
                                $popup.css('left', 0);
                                var padding = parseInt($popup.css('padding-left')) + parseInt($popup.css('padding-right')) +
                                    parseInt($popup.find('> .inner').css('padding-left')) + parseInt($popup.find('> .inner').css('padding-right'));

                                var row_number;

                                if ($menu_item.hasClass('col-2')) row_number = 2;
                                if ($menu_item.hasClass('col-3')) row_number = 3;
                                if ($menu_item.hasClass('col-4')) row_number = 4;
                                if ($menu_item.hasClass('col-5')) row_number = 5;
                                if ($menu_item.hasClass('col-6')) row_number = 6;

                                if ($(window).width() < 992 - theme.getScrollbarWidth())
                                    row_number = 1;

                                var col_length = 0;
                                $popup.find('> .inner > ul > li').each(function() {
                                    var cols = parseInt($(this).attr('data-cols'));
                                    if (cols < 1)
                                        cols = 1;

                                    if (cols > row_number)
                                        cols = row_number;

                                    col_length += cols;
                                });

                                if (col_length > row_number) col_length = row_number;

                                var col_width = container_width / row_number;

                                $popup.find('> .inner > ul > li').each(function() {
                                    var cols = parseFloat($(this).attr('data-cols'));
                                    if (cols < 1)
                                        cols = 1;

                                    if (cols > row_number)
                                        cols = row_number;

                                    if ($menu_item.hasClass('pos-center') || $menu_item.hasClass('pos-left') || $menu_item.hasClass('pos-right'))
                                        $(this).css('width', (100 / col_length * cols) + '%');
                                    else
                                        $(this).css('width', (100 / row_number * cols) + '%');
                                });

                                $popup.find('> .inner > ul').width(col_width * col_length + 1);
                                if (is_right_sidebar) {
                                    $popup.css({
                                        'left': 'auto',
                                        'right': $(this).width()
                                    });
                                } else {
                                    $popup.css({
                                        'left': $(this).width(),
                                        'right': 'auto'
                                    });
                                }
                            }
                            $popup.css('display', 'none');

                            $menu_item.hoverIntent(
                                $.extend({}, theme.hoverIntentConfig, {
                                    over: function(){
                                        $menu_items.find('.popup').hide();
                                        $popup.show();
                                        $popup.parent().addClass('open');
                                    },
                                    out: function(){
                                        $popup.hide();
                                        $popup.parent().removeClass('open');
                                    }
                                })
                            );
                        }
                    });
                });

                return self;
            },

            events: function() {
                var self = this;

                self.$toggle.click(function() {
                    var $widget = $(this).parent().parent();
                    var $this = $(this);
                    if ($this.hasClass('closed')) {
                        $this.removeClass('closed');
                        $widget.removeClass('closed');
                        $widget.find('.sidebar-menu-wrap').stop().slideDown(400, function() {
                            self.build();
                        });
                    } else {
                        $this.addClass('closed');
                        $widget.addClass('closed');
                        $widget.find('.sidebar-menu-wrap').stop().slideUp(400);
                    }
                });

                this.$menu_toggle.click(function() {
                    var $toggle_menu = $(this).parent();
                    var $this = $(this);
                    if ($this.hasClass('closed')) {
                        $this.removeClass('closed');
                        $toggle_menu.removeClass('closed');
                        $toggle_menu.find('.toggle-menu-wrap').stop().slideDown();

                        self.build();

                    } else {
                        $this.addClass('closed');
                        $toggle_menu.addClass('closed');
                        $toggle_menu.find('.toggle-menu-wrap').stop().slideUp();
                    }
                });

                $(window).on('resize', function() {
                    self.build();
                });

                setTimeout(function() {
                    self.build();
                }, 400);

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Accordion Menu
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        AccordionMenu: {

            defaults: {
                menu: $('.accordion-menu')
            },

            initialize: function($menu) {
                this.$menu = ($menu || this.defaults.menu);

                this.events()
                    .build();

                return this;
            },

            build: function() {
                var self = this;

                self.$menu.find('li.menu-item.active').each(function() {
                    if ($(this).find('> .arrow').length)
                        $(this).find('> .arrow').click();
                });

                return self;
            },

            events: function() {
                var self = this;

                self.$menu.find('.arrow').click(function() {
                    var $parent = $(this).parent();
                    $(this).next().stop().slideToggle();
                    if ($parent.hasClass('open')) {
                        $parent.removeClass('open');
                    } else {
                        $parent.addClass('open');
                    }
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);

// Sticky Header
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        StickyHeader: {

            defaults: {
                header: $('#header')
            },

            initialize: function($header) {
                this.$header = ($header || this.defaults.header);
                this.sticky_height = 0;
                this.sticky_offset = 0;
                this.sticky_pos = 0;

                if (!theme.show_sticky_header || !this.$header.length)
                    return this;

                var self = this;

                var $header_top = self.$header.find('> .header-top');
                if ($header_top.length) {
                    self.$header_top = $header_top;
                    self.top_height = $header_top.height();
                } else {
                    self.$header_top = false;
                }

                var $menu_wrap = self.$header.find('> .main-menu-wrap');
                if ($menu_wrap.length) {
                    self.$menu_wrap = $menu_wrap;
                    self.menu_height = $menu_wrap.height();
                } else {
                    self.$menu_wrap = false;
                }

                self.$header_main = self.$header.find('.header-main');

                self.is_sticky = false;

                self.reset()
                    .build()
                    .events();

                return self;
            },

            build: function() {
                var self = this;

                if (!self.is_sticky && ($(window).height() + self.header_height + self.adminbar_height + 5 >= $(document).height())) {
                    return self;
                }

                var scroll_top = $(window).scrollTop();

                if (self.$menu_wrap && !theme.isTablet()) {

                    self.$header_main.css('top', 0);

                    if (self.$header.parent().hasClass('fixed-header'))
                        self.$header.parent().attr('style', '');

                    if (scroll_top > self.sticky_pos) {
                        self.$header.addClass('sticky-header');
                        self.$header.css('padding-bottom', self.menu_height);
                        self.$menu_wrap.css('top', self.adminbar_height);

                        if (self.$header.parent().hasClass('fixed-header')) {
                            self.$header_main.hide();
                            self.$header.css('padding-bottom', 0);
                        }

                        if (!self.init_toggle_menu) {
                            self.init_toggle_menu = true;
                            theme.MegaMenu.build();
                            if ($('#main-toggle-menu').length) {
                                if ($('#main-toggle-menu').hasClass('show-always')) {
                                    $('#main-toggle-menu').data('show-always', true);
                                    $('#main-toggle-menu').removeClass('show-always');
                                }
                                $('#main-toggle-menu').addClass('closed');
                                $('#main-toggle-menu .menu-title').addClass('closed');
                                $('#main-toggle-menu .toggle-menu-wrap').attr('style', '');
                            }
                        }
                        self.is_sticky = true;
                    } else {
                        self.$header.removeClass('sticky-header');
                        self.$header.css('padding-bottom', 0);
                        self.$menu_wrap.css('top', 0);
                        self.$header_main.show();

                        if (self.init_toggle_menu) {
                            self.init_toggle_menu = false;
                            theme.MegaMenu.build();
                            if ($('#main-toggle-menu').length) {
                                if ($('#main-toggle-menu').data('show-always')) {
                                    $('#main-toggle-menu').addClass('show-always');
                                    $('#main-toggle-menu').removeClass('closed');
                                    $('#main-toggle-menu .menu-title').removeClass('closed');
                                    $('#main-toggle-menu .toggle-menu-wrap').attr('style', '');
                                }
                            }
                        }
                        self.is_sticky = false;
                    }
                } else {
                    self.$header_main.show();
                    if (self.$header.parent().hasClass('fixed-header') && $('#wpadminbar').length && $('#wpadminbar').css('position') == 'absolute') {
                        self.$header.parent().css('top', ($('#wpadminbar').height() - scroll_top) < 0 ? -$('#wpadminbar').height() : -scroll_top);
                    } else if (self.$header.parent().hasClass('fixed-header')) {
                        //self.$header.parent().css('top', 'auto');
                        self.$header.parent().attr('style', '');
                    } else {
                        if (self.$header.parent().hasClass('fixed-header'))
                            self.$header.parent().attr('style', '');
                    }
                    if (self.$header.hasClass('sticky-menu-header') && !theme.isTablet()) {
                        self.$header_main.css('top', 0);
                        self.$header.removeClass('sticky-header');
                        self.$header_main.removeClass('sticky');
                        self.is_sticky = false;
                        self.sticky_height = 0;
                        self.sticky_offset = 0;
                    } else {
                        if (self.$menu_wrap)
                            self.$menu_wrap.css('top', 0);
                        if (scroll_top > self.sticky_pos && (!theme.isTablet() || (theme.isTablet() && (!theme.isMobile() && theme.show_sticky_header_tablet) || (theme.isMobile() && theme.show_sticky_header_tablet && theme.show_sticky_header_mobile)))) {
                            self.$header.addClass('sticky-header');
                            self.$header.css('padding-bottom', self.sticky_main_height);
                            self.$header_main.addClass('sticky');
                            self.$header_main.css('top', self.adminbar_height);

                            if (!self.init_toggle_menu) {
                                self.init_toggle_menu = true;
                                theme.MegaMenu.build();
                                if ($('#main-toggle-menu').length) {
                                    if ($('#main-toggle-menu').hasClass('show-always')) {
                                        $('#main-toggle-menu').data('show-always', true);
                                        $('#main-toggle-menu').removeClass('show-always');
                                    }
                                    $('#main-toggle-menu').addClass('closed');
                                    $('#main-toggle-menu .menu-title').addClass('closed');
                                    $('#main-toggle-menu .toggle-menu-wrap').attr('style', '');
                                }
                            }
                            self.is_sticky = true;
                        } else {
                            self.$header.removeClass('sticky-header');
                            self.$header.css('padding-bottom', 0);
                            self.$header_main.removeClass('sticky');
                            self.$header_main.css('top', 0);

                            if (self.init_toggle_menu) {
                                self.init_toggle_menu = false;
                                theme.MegaMenu.build();
                                if ($('#main-toggle-menu').length) {
                                    if ($('#main-toggle-menu').data('show-always')) {
                                        $('#main-toggle-menu').addClass('show-always');
                                        $('#main-toggle-menu').removeClass('closed');
                                        $('#main-toggle-menu .menu-title').removeClass('closed');
                                        $('#main-toggle-menu .toggle-menu-wrap').attr('style', '');
                                    }
                                }
                            }
                            self.is_sticky = false;
                        }
                    }
                }

                return self;
            },

            reset: function() {
                var self = this;

                var $admin_bar = $('#wpadminbar');
                var height = 0;
                if ($admin_bar.length) {
                    height = $('#wpadminbar').css('position') == 'fixed' ? $('#wpadminbar').height() : 0;
                }
                self.adminbar_height = height;

                if (self.$menu_wrap && !theme.isTablet()) {
                    // show main menu
                    self.$header_main.addClass('sticky');
                    self.$header.addClass('sticky-header');

                    self.sticky_height = self.$menu_wrap.height() + parseInt(self.$menu_wrap.css('padding-top')) * 2;
                    self.sticky_offset = parseInt(self.$menu_wrap.css('padding-top')) * 2;

                    self.$header_main.removeClass('sticky');
                    self.$header.removeClass('sticky-header');
                    self.header_height = self.$header.height();
                    self.menu_height = self.$menu_wrap.height();

                    self.sticky_pos = (self.header_height - self.menu_height) + $('.banner-before-header').height();
                } else {
                    // show header main
                    self.$header.addClass('sticky-header');
                    self.$header_main.addClass('sticky');
                    self.sticky_main_height = self.$header_main.height();

                    self.$header.removeClass('sticky-header');
                    self.$header_main.removeClass('sticky');
                    self.header_height = self.$header.height();
                    self.main_height = self.$header_main.height();

                    self.sticky_height = self.sticky_main_height;
                    self.sticky_offset = self.main_height - self.sticky_main_height;

                    if (!(!theme.isTablet() || (theme.isTablet() && (!theme.isMobile() && theme.show_sticky_header_tablet) || (theme.isMobile() && theme.show_sticky_header_tablet && theme.show_sticky_header_mobile)))) {
                        self.sticky_height = 0;
                        self.sticky_offset = 0;
                    }

                    self.sticky_pos = (self.header_height - self.sticky_main_height) + $('.banner-before-header').height();
                }

                self.init_toggle_menu = false;

                self.$header.removeAttr('style');

                return self;
            },

            events: function() {
                var self = this;

                $(window).on('resize', function() {
                    self.reset()
                        .build();
                });

                $(window).on('scroll', function() {
                    self.build();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);

// Sticky Header
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        SideNav: {

            defaults: {
                side_nav: $('.header-side-nav #header')
            },

            bc_pos_top: 0,

            initialize: function($side_nav) {
                this.$side_nav = ($side_nav || this.defaults.side_nav);

                if (!this.$side_nav.length)
                    return this;

                var self = this;

                self.$side_nav.addClass("initialize");

                self.reset()
                    .build()
                    .events();

                return self;
            },

            build: function() {
                var self = this;

                $page_top = $('.page-top');
                $main = $('#main');

                if (theme.isTablet()) {
                    self.$side_nav.removeClass("fixed-bottom");
                    $page_top.removeClass("fixed-pos");
                    $page_top.attr('style', '');
                    $main.attr('style', '');
                } else {
                    var side_height = self.$side_nav.innerHeight();
                    var window_height = $(window).height();
                    var scroll_top = $(window).scrollTop();

                    if (side_height - window_height + self.adminbar_height < scroll_top) {
                        if (!self.$side_nav.hasClass("fixed-bottom"))
                            self.$side_nav.addClass("fixed-bottom");
                    } else {
                        if (self.$side_nav.hasClass("fixed-bottom"))
                            self.$side_nav.removeClass("fixed-bottom");
                    }

                    if ($page_top.length) {
                        if (self.page_top_offset == self.adminbar_height || self.page_top_offset <= scroll_top) {
                            if (!$page_top.hasClass("fixed-pos")) {
                                $page_top.addClass("fixed-pos");
                                $page_top.css('top', self.adminbar_height);
                                $main.css('padding-top', $page_top.outerHeight());
                            }
                        } else {
                            if ($page_top.hasClass("fixed-pos")) {
                                $page_top.removeClass("fixed-pos");
                                $page_top.attr('style', '');
                                $main.attr('style', '');
                            }
                        }
                    }
                }

                return self;
            },

            reset: function() {
                var self = this;

                if (theme.isTablet()) {

                    self.$side_nav.attr('style', '');

                } else {

                    var $admin_bar = $('#wpadminbar');
                    var height = 0;
                    if ($admin_bar.length) {
                        height = $('#wpadminbar').css('position') == 'fixed' ? $('#wpadminbar').height() : 0;
                    }
                    self.adminbar_height = height;

                    var w_h = $(window).height();

                    $side_bottom = self.$side_nav.find('.side-bottom');

                    self.$side_nav.css({
                        'min-height': w_h - self.adminbar_height,
                        'padding-bottom': $side_bottom.height() + parseInt($side_bottom.css('margin-top')) + parseInt($side_bottom.css('margin-bottom'))
                    });
                }

                $page_top = $('.page-top');
                $main = $('#main');

                if ($page_top.length) {
                    $page_top.removeClass("fixed-pos");
                    $page_top.attr('style', '');
                    $main.attr('style', '');
                    self.page_top_offset = $page_top.offset().top;
                }

                return self;
            },

            events: function() {
                var self = this;

                $(window).on('resize', function() {
                    self.reset()
                        .build();
                });

                $(window).on('scroll', function() {
                    self.build();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Search
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        Search: {

            defaults: {
                popup: $('.searchform-popup'),
                form: $('.searchform')
            },

            initialize: function($popup, $form) {
                this.$popup = ($popup || this.defaults.popup);
                this.$form = ($form || this.defaults.form);

                this.build()
                    .events();

                return this;
            },

            build: function() {
                var self = this;

                return this;
            },

            events: function() {
                var self = this;

                self.$popup.click(function(e) {
                    e.stopPropagation();
                });
                self.$popup.find('.search-toggle').click(function(e) {
                    $(this).next().toggle();
                    e.stopPropagation();
                });

                //if (!(theme.MobileCheck.any) {
                if (!('ontouchstart' in document)) {
                    $('html,body').click(function() {
                        self.removeFormStyle();
                    });

                    $(window).on('resize', function() {
                        self.removeFormStyle();
                    });
                }

                return self;
            },

            removeFormStyle: function() {
                this.$form.removeAttr('style');
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Mobile Panel
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        Panel: {

            initialize: function() {

                this.events();

                return this;
            },

            events: function() {
                var self = this;

                $('.mobile-toggle').click(function(e) {
                    var $body = $('body');
                    if ($body.hasClass('panel-opened')) {
                        $body.removeClass('panel-opened');
                        $('.panel-overlay').removeClass('active');
                    } else {
                        $body.addClass('panel-opened');
                        $('.panel-overlay').addClass('active');
                    }
                });
                $('.panel-overlay').click(function() {
                    $('body').removeClass('panel-opened');
                    $(this).removeClass('active');
                });

                $(window).on('resize', function() {
                    var winWidth = $(window).width();
                    if (winWidth > 767 - theme.getScrollbarWidth()) {
                        $('.panel-overlay').click();
                    }
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Flickr Zoom
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        FlickrZoom: {

            defaults: {
                wrapper: $('.wpb_flickr_widget')
            },

            initialize: function($wrapper) {
                this.$wrapper = ($wrapper || this.defaults.wrapper);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$wrapper.each(function() {
                    var links = [];
                    var i = 0;
                    var $flickr_links = $(this).find('.flickr_badge_image > a');
                    $flickr_links.each(function() {
                        var slide = {};
                        var $image = $(this).find('> img');
                        slide.title = $image.attr('title');
                        slide.href = $image.attr('src').replace('_s.', '_b.');
                        slide.thumbnail = $image.attr('src');
                        links[i] = slide;
                        i++;
                    });
                    $flickr_links.unbind('click').click(function(e) {
                        e.preventDefault();
                        var options = {index: $flickr_links.index($(this)), event: e};
                        blueimp.Gallery(links, options);
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Way Points
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WayPoints: {

            defaults: {
                wrapper: $('body')
            },

            initialize: function($wrapper) {
                this.$wrapper = ($wrapper || this.defaults.wrapper);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                if($().waypoint) {

                    var $animations = self.$wrapper.find('.appear-animation');

                    $animations.waypoint(function() {

                        // this code is executed for each appeared element
                        var $this = $(this);
                        var animation_type = $this.attr('data-appear-animation');
                        var animation_duration = $this.attr('data-appear-animation-duration');
                        var animation_delay = $this.attr('data-appear-animation-delay');

                        $this.addClass('appear-animation-visible ' + animation_type);

                        if (animation_duration) {
                            $this.css('-moz-animation-duration', animation_duration+'ms');
                            $this.css('-webkit-animation-duration', animation_duration+'ms');
                            $this.css('-ms-animation-duration', animation_duration+'ms');
                            $this.css('-o-animation-duration', animation_duration+'ms');
                            $this.css('animation-duration', animation_duration+'ms');
                        }
                        if (animation_delay) {
                            $this.css('-moz-animation-delay', animation_delay+'ms');
                            $this.css('-webkit-animation-delay', animation_delay+'ms');
                            $this.css('-ms-animation-delay', animation_delay+'ms');
                            $this.css('-o-animation-delay', animation_delay+'ms');
                            $this.css('animation-delay', animation_delay+'ms');
                        }
                    }, {
                        triggerOnce: true,
                        offset: '85%'
                    });

                    // circular bar
                    var circular_bars = self.$wrapper.find('.circular-bar');
                    circular_bars.waypoint(function() {

                        var $chart = $(this).find('.chart');

                        var barcolor = $chart.attr('data-barcolor');
                        var trackcolor = $chart.attr('data-trackcolor');
                        var linecap = $chart.attr('data-linecap');
                        var linewidth = $chart.attr('data-linewidth');
                        var size = $chart.attr('data-size');
                        var speed = $chart.attr('data-speed');
                        var percent = $chart.attr('data-percent');
                        var label_value = $chart.attr('data-label-value');
                        if (!label_value)
                            label_value = percent;

                        var $label = $chart.find('.percent');
                        $chart.easyPieChart({
                            barColor: barcolor,
                            trackColor: trackcolor,
                            scaleColor: false,
                            scaleLength: 5,
                            lineCap: linecap,
                            lineWidth: linewidth,
                            size: size,
                            rotate: 0,
                            animate: {
                                duration: speed,
                                enabled: true
                            },
                            onStep: function(from, to, current_value) {
                                $label.html(parseInt(label_value * current_value / percent));
                            }
                        });
                    }, {
                        triggerOnce: true,
                        offset: '85%'
                    });

                    // Progress bar tooltip
                    var progress_bar_tooltips = self.$wrapper.find('.progress-bar-tooltip');
                    progress_bar_tooltips.waypoint(function() {

                        var $this = $(this);
                        setTimeout(function() {
                            $this.animate({
                                opacity: 1
                            });
                        }, 500);
                    }, {
                        triggerOnce: true,
                        offset: '85%'
                    });
                }

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Scroll to Top
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        ScrollToTop: {

            defaults: {
                html: '<i class="fa fa-chevron-up"></i>',
                offsetx: 10,
                offsety: 0
            },

            initialize: function(html, offsetx, offsety) {
                this.html = (html || this.defaults.html);
                this.offsetx = (offsetx || this.defaults.offsetx);
                this.offsety = (offsety || this.defaults.offsety);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                if (typeof scrolltotop !== 'undefined') {
                    // scroll top control
                    scrolltotop.controlHTML = self.html;
                    scrolltotop.controlattrs = {offsetx: self.offsetx, offsety: self.offsety};
                    scrolltotop.init();
                }

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Fit Videos
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        FitVideos: {

            defaults: {
                wrapper: $('body')
            },

            initialize: function($wrapper) {
                this.$wrapper = ($wrapper || this.defaults.wrapper);

                this.build()
                    .events();

                return this;
            },

            build: function() {
                var self = this;

                var $videos = self.$wrapper.find('.fit-video');
                if ($videos.length)
                    $videos.fitVids();

                return self;
            },

            events: function() {
                var self = this;

                $(window).on('resize', function() {
                    self.build();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Refresh Video Sizes
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        RefreshVideoSizes: {

            defaults: {
                wrapper: $('.video-cover .upb_video-src')
            },

            initialize: function($wrapper) {
                this.$wrapper = ($wrapper || this.defaults.wrapper);

                this.build()
                    .events();

                return this;
            },

            build: function() {
                var self = this;

                self.$wrapper.each(function() {
                    var $this = $(this);
                    $('<img src="'+ $this.attr('poster') +'">').load(function() {
                        $(this).css({
                            'position': 'absolute',
                            'z-index': -1,
                            'bottom': 0
                        });
                        $('body').append($(this));
                        var height = $(this).height();
                        var width = $(this).width();
                        var ratio = height / width;
                        var $parent = $this.closest('.vc_row');
                        var parentWidth = $parent.width();
                        var parentHeight = $parent.height();
                        $this.css({
                            'width': parentWidth,
                            'min-width': parentWidth,
                            'height': parentWidth * ratio
                        });
                        $this.parent().css({
                            'width': parentWidth,
                            'min-width': parentWidth
                        });
                        if (parentWidth * ratio < parentHeight) {
                            $this.css({
                                'height': parentHeight,
                                'min-width': parentHeight / ratio,
                                'width': parentHeight * ratio
                            });
                            $this.parent().css({
                                'height': parentHeight,
                                'min-width': parentHeight / ratio,
                                'width': parentHeight * ratio
                            });
                        }
                        $(this).remove();
                    });
                });

                return self;
            },

            events: function() {
                var self = this;

                setTimeout(function() {
                    self.build();
                }, 600);

                $(window).on('resize', function() {
                    self.build();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Accordion
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        Accordion: {

            defaults: {
                elements: $('.panel-group')
            },

            initialize: function($elements) {
                this.$elements = ($elements || this.defaults.elements);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function(){
                    var $this = $(this), $collapse = $this.find('.collapse');
                    var collapsible = $this.data('collapsible'), active_num = $this.data('active-tab');
                    if ( $collapse.length > 0 ) {
                        if ( collapsible == 'yes' ) {
                            $collapse.collapse({toggle: false});
                        } else if ( !isNaN(active_num) && active_num == parseInt(active_num) && $this.find('.collapse').length > active_num ) {
                            $this.find('.collapse').eq(active_num-1).collapse({parent: '#' + $this.attr('id')});
                        }
                    }
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Toggle
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        Toggle: {

            defaults: {
                elements: $('section.toggle')
            },

            initialize: function($elements) {
                this.$elements = ($elements || this.defaults.elements);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    if ($this.hasClass('active'))
                        $this.find("> div.toggle-content").stop().slideDown(350, function() {});

                    $this.find("> label").unbind('click').click(function(e) {
                        var parentSection = $(this).parent(),
                            parentWrapper = $(this).parents("div.toogle"),
                            isAccordion = parentWrapper.hasClass("toogle-accordion");
                        if(isAccordion && typeof(e.originalEvent) != "undefined") {
                            parentWrapper.find("section.toggle.active > label").trigger("click");
                        }
                        parentSection.toggleClass("active");
                        // Content
                        var toggleContent = parentSection.find("> div.toggle-content");
                        // Preview Paragraph
                        if(parentSection.hasClass("active")) {
                            if (parentSection.data('view') == 'one-toggle') {
                                parentSection.siblings('.toggle').each(function() {
                                    $(this).removeClass('active');
                                    $(this).find("> div.toggle-content").stop().slideUp(350, function() {});
                                });
                            }
                            toggleContent.stop().slideDown(350, function() {});
                        } else {
                            toggleContent.stop().slideUp(350, function() {});
                        }
                    });
                });

                return self;
            }
        }
    });

}).apply(this, [window.theme, jQuery]);


// Tooltip
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        Tooltip: {

            initialize: function() {

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                // wishlist tooltip
                /*$('.products .yith-wcwl-wishlistexistsbrowse.show, .products .yith-wcwl-wishlistaddedbrowse.show').each(function(){
                 var title = $(this).find('a').text();
                 $(this).find('a').attr('data-title', title).attr('data-toggle', 'tooltip');
                 });
                 $('.products .yith-wcwl-add-button.show').each(function(){
                 var title = $(this).find('a').text();
                 $(this).find('a.add_to_wishlist').attr('data-title', title).attr('data-toggle', 'tooltip');
                 });
                 //quickview, add to cart tooltip
                 $('.products .viewcart, .products .quickview, .products a.compare.button, .products .add_to_cart_read_more, .product .add_to_cart_button').each(function(){
                 var title = $(this).text();
                 $(this).attr('data-title', title).attr('data-toggle', 'tooltip');
                 });*/
                $("[data-toggle='tooltip']").tooltip();
                $('.star-rating').tooltip();

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Visual Composer Image Zoom
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        VcImageZoom: {

            defaults: {
                elements: $('.porto-vc-zoom')
            },

            initialize: function($elements) {
                this.$elements = ($elements || this.defaults.elements);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                var links = [];
                var i = 0;
                self.$elements.each(function() {
                    var slide = {};
                    slide.title = $(this).attr('data-caption');
                    slide.href = $(this).attr('href');
                    slide.thumbnail = $(this).attr('href');
                    links[i] = slide;
                    i++;
                });
                self.$elements.unbind('click').click(function(e) {
                    e.preventDefault();
                    var options = {index: self.$elements.index($(this)), event: e};
                    blueimp.Gallery(links, options);
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Slideshow
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        Slideshow: {

            defaults: {
                $wrapper: $('body'),
                slider: '.post-slideshow',
                zoom: false,
                options: {}
            },

            initialize: function($wrapper, slider, zoom, options) {
                this.$wrapper = ($wrapper || this.defaults.wrapper);
                this.slider = (slider || this.defaults.slider);
                this.zoom = zoom;
                this.options = (options || this.defaults.options);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$wrapper.find(self.slider).each(function() {
                    if (typeof self.zoom !== 'undefined' && self.zoom) {
                        var links = [];
                        var i = 0;
                        $(this).find('img').each(function() {
                            var slide = {};
                            slide.title = $(this).attr('data-caption');
                            slide.href = $(this).attr('data-image');
                            slide.thumbnail = $(this).attr('data-src');
                            links[i] = slide;
                            i++;
                        });
                        var $zoom_buttons = $(this).find('.zoom');
                        $zoom_buttons.unbind('click').click(function(e) {
                            e.preventDefault();
                            var options = {index: $zoom_buttons.index($(this)), event: e};
                            blueimp.Gallery(links, options);
                        });
                    }
                    $(this).owlCarousel($.extend(theme.owlConfig, self.options));
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Carousel
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        Carousel: {

            defaults: {
                carousel: '.post-carousel',
                options: {}
            },

            initialize: function(carousel, zoom, options) {
                this.carousel = (carousel || this.defaults.carousel);
                this.zoom = zoom;
                this.options = (options || this.defaults.options);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                $(self.carousel).each(function() {
                    if (typeof self.zoom !== 'undefined' && self.zoom) {
                        var links = [];
                        var i = 0;
                        $(this).find('img').each(function() {
                            var slide = {};
                            slide.title = $(this).attr('data-caption');
                            slide.href = $(this).attr('data-image');
                            slide.thumbnail = $(this).attr('src');
                            links[i] = slide;
                            i++;
                        });
                        var $zoom_buttons = $(this).find('.zoom');
                        $zoom_buttons.unbind('click').click(function(e) {
                            e.preventDefault();
                            var options = {index: $zoom_buttons.index($(this)), event: e};
                            blueimp.Gallery(links, options);
                        });
                    }

                    var cols_lg = $(this).data('cols-lg'), cols_md = $(this).data('cols-md'), cols_sm = $(this).data('cols-sm');
                    var single = $(this).data('single');
                    var singleItem = false;

                    if (single) {
                        singleItem = true;
                    }

                    var items = [], scrollWidth = theme.getScrollbarWidth();
                    var i = 0;

                    items[i++] = [0, 1];
                    if (cols_sm)
                        items[i++] = [481 - scrollWidth, cols_sm];
                    if (cols_md)
                        items[i++] = [768 - scrollWidth, cols_md];
                    if (cols_lg)
                        items[i++] = [992 - scrollWidth, cols_lg];

                    $(this).owlCarousel($.extend(theme.owlConfig, {
                        singleItem : singleItem,
                        itemsCustom : items,
                        autoHeight: false
                    }, self.options));
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Grid (Isotope)
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        Grid: {

            defaults: {
                elements: null,
                itemSelector: null,
                callback: null
            },

            initialize: function($elements, itemSelector, callback) {
                this.$elements = ($elements || this.defaults.elements);
                this.itemSelector = (itemSelector || this.defaults.itemSelector);
                this.callback = (callback || this.defaults.callback);

                this.build();

                return this;
            },

            build: function() {
                var self = this;
                var itemSelector = self.itemSelector;
                var callback = self.callback;

                if (self.$elements.length && self.itemSelector) {
                    self.$elements.each(function() {
                        var $this = $(this);
                        if ($().isotope) {
                            $this.imagesLoaded(function() {
                                $this.isotope({
                                    itemSelector : itemSelector,
                                    isOriginLeft : !theme.rtl
                                }).isotope('layout');
                                if (callback)
                                    $this.isotope('on', 'layoutComplete', callback);
                            });
                        }
                    });
                }

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Posts Infinite
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        PostsInfinite: {

            defaults: {
                elements: $('.posts-infinite'),
                itemSelector: '.posts-infinite .post, .posts-infinite .timeline-date'
            },

            initialize: function($elements, itemSelector) {
                this.$elements = ($elements || this.defaults.elements);
                this.itemSelector = (itemSelector || this.defaults.itemSelector);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    var curr_page = $this.attr('data-pagenum');
                    var page_path = $this.attr('data-path');
                    $this.infinitescroll($.extend(theme.infiniteConfig, {
                        itemSelector : self.itemSelector,
                        state : {
                            currPage: curr_page
                        },
                        pathParse : function(a, b) {
                            return [page_path, '/'];
                        }
                    }), function(posts) {

                        theme.Slideshow.initialize($(posts), '.post-slideshow', theme.post_zoom);
                        theme.WayPoints.initialize($(posts));
                        theme.FitVideos.initialize($(posts));

                        if ($().isotope) {
                            if ($this.hasClass('grid')) {
                                $(posts).hide();
                                $(posts).imagesLoaded(function() {
                                    $(posts).show();
                                    if ($this.data('isotope')) {
                                        $this.isotope('appended', $(posts)).isotope('layout');
                                        theme.FitVideos.initialize($(posts));
                                        $this.isotope('layout');
                                    }
                                });
                            }
                        }
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Portfolios Infinite
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        PortfoliosInfinite: {

            defaults: {
                elements: $('.portfolios-infinite'),
                itemSelector: '.portfolios-infinite .portfolio, .portfolios-infinite .timeline-date'
            },

            initialize: function($elements, itemSelector) {
                this.$elements = ($elements || this.defaults.elements);
                this.itemSelector = (itemSelector || this.defaults.itemSelector);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    var curr_page = $this.attr('data-pagenum');
                    var page_path = $this.attr('data-path');
                    $this.infinitescroll($.extend(theme.infiniteConfig, {
                        itemSelector : self.itemSelector,
                        state : {
                            currPage: curr_page
                        },
                        pathParse : function(a, b) {
                            return [page_path, '/'];
                        }
                    }), function(posts) {

                        theme.Slideshow.initialize($(posts), '.portfolio-slideshow', theme.portfolio_zoom);
                        theme.WayPoints.initialize($(posts));
                        theme.FitVideos.initialize($(posts));

                        var $parent = $this.closest('.page-portfolios');

                        if ($parent.hasClass('portfolios-grid')) {
                            if ($().isotope) {
                                $(posts).hide();
                                $(posts).imagesLoaded(function() {
                                    $(posts).show();
                                    if ($this.data('isotope')) {
                                        $this.isotope('appended', $(posts)).isotope('layout');
                                        theme.FitVideos.initialize($(posts));
                                        $this.isotope('layout');
                                    }
                                });
                            }
                        } else {
                            var selected = 0;
                            if ($parent.find('.portfolio-filter').length) {
                                var selector = $parent.find('.portfolio-filter .active').attr('data-filter');
                                $(posts).each(function() {
                                    var $this = $(this);
                                    if (selector == '*') {
                                        $this.stop().fadeIn(300, function() {
                                            var $slideshow = $(this).find('.portfolio-slideshow');
                                            if ($slideshow.length) {
                                                var owl = $(this).find('.portfolio-slideshow').data('owlCarousel');
                                                owl.reload();
                                            }
                                        });
                                        selected++;
                                    } else {
                                        if ($this.hasClass(selector)) {
                                            $this.stop().fadeIn(300, function() {
                                                var $slideshow = $(this).find('.portfolio-slideshow');
                                                if ($slideshow.length) {
                                                    var owl = $(this).find('.portfolio-slideshow').data('owlCarousel');
                                                    owl.reload();
                                                }
                                            });
                                            selected++;
                                        } else {
                                            $this.stop().hide();
                                        }
                                    }
                                });
                            }
                            if (!selected && $parent.find('.portfolios-infinite').length) {
                                $parent.find('.portfolios-infinite').infinitescroll('retrieve');
                            }
                            if ($parent.hasClass('portfolios-timeline'))
                                theme.FilterZoom.initialize($('.portfolios-timeline'), theme.portfolio_zoom);
                        }
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Portfolio Like
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        PortfolioLike: {

            initialize: function() {

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                $('body').on('click', '.portfolio-like', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var $parent = $this.parent();
                    var portfolio_id = $(this).attr('data-id');
                    $.post(theme.ajax_url, {
                            portfolio_id: portfolio_id,
                            action: 'porto_portfolio-like'
                        },
                        function(data) {
                            if (data) {
                                $this.remove();
                                $parent.html(data);
                                $parent.find("[data-toggle='tooltip']").tooltip();
                            }
                        })
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Portfolio Filter
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        PortfolioFilter: {

            defaults: {
                elements: $('.portfolio-filter')
            },

            initialize: function($elements) {
                this.$elements = ($elements || this.defaults.elements);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    $this.find('li').on('click', function(e) {
                        e.preventDefault();

                        var selector = $(this).attr('data-filter');
                        $this.find('.active').removeClass('active');

                        var $parent = $(this).closest('.page-portfolios');

                        if ($parent.hasClass('portfolios-grid')) {
                            if (selector != '*')
                                selector = '.' + selector;
                            $parent.find('.portfolio-row').isotope({
                                filter: selector
                            });
                        } else {
                            $parent.find('.portfolio').each(function() {
                                var $this = $(this);
                                if (selector == '*') {
                                    $this.stop().fadeIn(300, function() {
                                        if (!$this.hasClass('portfolio-timeline')) {
                                            var owl = $(this).find('.portfolio-slideshow').data('owlCarousel');
                                            owl.reload();
                                        }
                                    });
                                } else {
                                    if ($this.hasClass(selector)) {
                                        $this.stop().fadeIn(300, function() {
                                            if (!$this.hasClass('portfolio-timeline')) {
                                                var owl = $(this).find('.portfolio-slideshow').data('owlCarousel');
                                                owl.reload();
                                            }
                                        });
                                    } else {
                                        $this.stop().fadeOut();
                                    }
                                }
                            });
                            if ($parent.hasClass('portfolios-timeline')) {
                                setTimeout(function() {
                                    theme.FilterZoom.initialize($('.portfolios-timeline'), theme.portfolio_zoom);
                                }, 400);
                            }
                        }

                        $(this).addClass('active');
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Members Infinite
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        MembersInfinite: {

            defaults: {
                elements: $('.members-infinite'),
                itemSelector: '.members-infinite .member'
            },

            initialize: function($elements, itemSelector) {
                this.$elements = ($elements || this.defaults.elements);
                this.itemSelector = (itemSelector || this.defaults.itemSelector);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    var curr_page = $this.attr('data-pagenum');
                    var page_path = $this.attr('data-path');
                    $this.infinitescroll($.extend(theme.infiniteConfig, {
                        itemSelector : self.itemSelector,
                        state : {
                            currPage: curr_page
                        },
                        pathParse : function(a, b) {
                            return [page_path, '/'];
                        }
                    }), function(posts) {

                        if ($().isotope) {
                            $(posts).hide();
                            $(posts).imagesLoaded(function() {
                                $(posts).show();
                                if ($this.data('isotope')) {
                                    $this.isotope('appended', $(posts)).isotope('layout');
                                    theme.FitVideos.initialize($(posts));
                                    $this.isotope('layout');
                                }
                            });
                        }
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Member Filter
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        MemberFilter: {

            defaults: {
                elements: $('.member-filter')
            },

            initialize: function($elements) {
                this.$elements = ($elements || this.defaults.elements);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    $this.find('li').on('click', function(e) {
                        e.preventDefault();

                        var selector = $(this).attr('data-filter');
                        $this.find('.active').removeClass('active');

                        var $parent = $(this).closest('.page-members');

                        if (selector != '*')
                            selector = '.' + selector;
                        $parent.find('.member-row').isotope({
                            filter: selector
                        });
                        $(this).addClass('active');
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// FAQs Infinite
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        FaqsInfinite: {

            defaults: {
                elements: $('.faqs-infinite'),
                itemSelector: '.faqs-infinite section'
            },

            initialize: function($elements, itemSelector) {
                this.$elements = ($elements || this.defaults.elements);
                this.itemSelector = (itemSelector || this.defaults.itemSelector);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    var curr_page = $this.attr('data-pagenum');
                    var page_path = $this.attr('data-path');
                    $this.infinitescroll($.extend(theme.infiniteConfig, {
                        itemSelector : self.itemSelector,
                        state : {
                            currPage: curr_page
                        },
                        pathParse : function(a, b) {
                            return [page_path, '/'];
                        }
                    }), function(posts) {
                        theme.Toggle.initialize($(posts));
                        theme.WayPoints.initialize($(posts));
                        theme.FitVideos.initialize($(posts));
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// FAQ Filter
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        FaqFilter: {

            defaults: {
                elements: $('.faq-filter')
            },

            initialize: function($elements) {
                this.$elements = ($elements || this.defaults.elements);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    $this.find('li').on('click', function(e) {
                        e.preventDefault();

                        var selector = $(this).attr('data-filter');
                        $this.find('.active').removeClass('active');

                        var $parent = $(this).closest('.page-faqs');

                        $parent.find('section').each(function() {
                            var $this = $(this);
                            if (selector == '*') {
                                $this.stop().fadeIn();
                            } else {
                                if ($this.hasClass(selector)) {
                                    $this.stop().fadeIn();
                                } else {
                                    $this.stop().hide();
                                }
                            }
                        });

                        $(this).addClass('active');
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Filter Zoom
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        FilterZoom: {

            defaults: {
                elements: null,
                zoom: false
            },

            initialize: function($elements, zoom) {
                this.$elements = ($elements || this.defaults.elements);
                this.zoom = zoom;

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                if (self.$elements.length && self.zoom) {
                    self.$elements.each(function() {
                        $(this).find('.zoom').unbind('click');
                        var links = [];
                        var i = 0;
                        $(this).find('article').each(function() {
                            if ($(this).css('display') != 'none') {
                                var $image = $(this).find('img');
                                var slide = {};
                                slide.title = $image.attr('data-caption');
                                slide.href = $image.attr('data-image');
                                slide.thumbnail = $image.attr('src');
                                links[i] = slide;
                                $(this).find('.zoom').attr('zoom-index', i);
                                i++;
                            }
                        });
                        $(this).find('article').each(function() {
                            if ($(this).css('display') != 'none') {
                                $(this).find('.zoom').click(function(e) {
                                    e.preventDefault();
                                    var options = {index: $(this).attr('zoom-index'), event: e};
                                    blueimp.Gallery(links, options);
                                });
                            }
                        });
                    });
                }

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Way Points
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WooGridListToggle: {

            initialize: function() {

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                $('#grid').unbind('click').click(function() {
                    $(this).addClass('active');
                    $('#list').removeClass('active');
                    if (($.cookie && $.cookie('gridcookie') == 'list') || !$.cookie) {
                        var $toggle = $('.gridlist-toggle');
                        if ($toggle.length) {
                            var $parent = $toggle.parent().parent();
                            var $products = $parent.find('ul.products');
                            $products.fadeOut(300, function() {
                                $products.addClass('grid').removeClass('list').fadeIn(300);
                            });
                        }
                    }
                    if ($.cookie)
                        $.cookie('gridcookie', 'grid', { path: '/' });
                    return false;
                });

                $('#list').unbind('click').click(function() {
                    $(this).addClass('active');
                    $('#grid').removeClass('active');
                    if (($.cookie && $.cookie('gridcookie') == 'grid') || !$.cookie) {
                        var $toggle = $('.gridlist-toggle');
                        if ($toggle.length) {
                            var $parent = $toggle.parent().parent();
                            var $products = $parent.find('ul.products');
                            $products.fadeOut(300, function() {
                                $products.addClass('list').removeClass('grid').fadeIn(300);
                            });
                        }
                    }
                    if ($.cookie)
                        $.cookie('gridcookie', 'list', { path: '/' });
                    return false;
                });

                if ($.cookie && $.cookie('gridcookie')) {
                    var $toggle = $('.gridlist-toggle');
                    if ($toggle.length) {
                        var $parent = $toggle.parent().parent();
                        if ($parent.find('ul.products').hasClass('grid')) {
                            $.cookie('gridcookie', 'grid', { path: '/' });
                        } else if ($parent.find('ul.products').hasClass('list')) {
                            $.cookie('gridcookie', 'list', { path: '/' });
                        } else {
                            $parent.find('ul.products').addClass($.cookie('gridcookie'));
                        }
                    }
                }

                if ($.cookie && $.cookie('gridcookie') == 'grid') {
                    $('.gridlist-toggle #grid').addClass('active');
                    $('.gridlist-toggle #list').removeClass('active');
                }

                if ($.cookie && $.cookie('gridcookie') == 'list') {
                    $('.gridlist-toggle #list').addClass('active');
                    $('.gridlist-toggle #grid').removeClass('active');
                }

                if ($.cookie && $.cookie('gridcookie') == null) {
                    var $toggle = $('.gridlist-toggle');
                    if ($toggle.length) {
                        var $parent = $toggle.parent().parent();
                        $parent.find('ul.products').addClass('grid');
                    }
                    $('.gridlist-toggle #grid').addClass('active');
                    if ($.cookie)
                        $.cookie('gridcookie', 'grid', { path: '/' });
                }

                // Viewby
                $( '.woocommerce-viewing' ).off( 'change' ).on( 'change', 'select.count', function() {
                    $( this ).closest( 'form' ).submit();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Products Slider
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WooProductsSlider: {

            defaults: {
                elements: $('.products-slider')
            },

            initialize: function($elements) {
                this.$elements = ($elements || this.defaults.elements);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    var cols_lg = $(this).attr('data-cols-lg'), cols_md = $(this).attr('data-cols-md'), cols_xs = $(this).attr('data-cols-xs'), cols_ls = $(this).attr('data-cols-ls');

                    var $slider_wrapper = $this.parents('.slider-wrapper');
                    if ($this.find('.product').length) {
                        portoCalcSliderMargin($slider_wrapper, $this.find('.product').css('padding-left'));
                        portoCalcSliderButtonsPosition($slider_wrapper, $this.find('.product').css('padding-left'));
                    } else if ($this.find('.product-category').length) {
                        portoCalcSliderMargin($slider_wrapper, $this.find('.product-category').css('padding-left'));
                        portoCalcSliderButtonsPosition($slider_wrapper, $this.find('.product-category').css('padding-left'));
                    }
                    portoCalcSliderTitleLine($slider_wrapper);

                    var single = $(this).data('single');
                    var singleItem = false, autoHeight = false;

                    var pagination = $(this).data('pagination') == '1' ? true : false;
                    var navigation = $(this).data('navigation') == '1' ? true : false;

                    if (!navigation && !pagination)
                        navigation = true;

                    if (single) {
                        singleItem = true;
                        //autoHeight = true;
                    }

                    var items = [], scrollWidth = theme.getScrollbarWidth();
                    var i = 0;

                    if (cols_ls)
                        items[i++] = [0, cols_ls];
                    else
                        items[i++] = [0, 1];

                    if (cols_xs)
                        items[i++] = [481 - scrollWidth, cols_xs];
                    if (cols_md)
                        items[i++] = [768 - scrollWidth, cols_md];
                    if (cols_lg)
                    //items[i++] = [parseInt(theme.container_width) + 30 - scrollWidth, cols_lg];
                        items[i++] = [992 - scrollWidth, cols_lg];

                    $(this).owlCarousel({
                        autoPlay : 5000,
                        navigation: navigation,
                        navigationText: ["", ""],
                        pagination: pagination,
                        rewindNav: true,
                        stopOnHover : true,
                        singleItem : singleItem,
                        autoHeight : autoHeight,
                        itemsCustom : items,
                        lazyLoad: true,
                        beforeUpdate: function() {
                            if ($this.find('.product').length) {
                                portoCalcSliderMargin($slider_wrapper, $this.find('.product').css('padding-left'));
                                portoCalcSliderButtonsPosition($slider_wrapper, $this.find('.product').css('padding-left'));
                            } else if ($this.find('.product-category').length) {
                                portoCalcSliderMargin($slider_wrapper, $this.find('.product-category').css('padding-left'));
                                portoCalcSliderButtonsPosition($slider_wrapper, $this.find('.product-category').css('padding-left'));
                            }
                            portoCalcSliderTitleLine($slider_wrapper);
                        },
                        afterInit: function() {
                            if ($this.find('.product').length) {
                                portoCalcSliderButtonsPosition($slider_wrapper, $this.find('.product').css('padding-left'));
                            } else if ($this.find('.product-category').length) {
                                portoCalcSliderButtonsPosition($slider_wrapper, $this.find('.product-category').css('padding-left'));
                            }
                        }
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Quick View
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WooQuickView: {

            initialize: function() {

                this.events();

                return this;
            },

            events: function() {
                var self = this;

                $(document).on('click', '.quickview', function(e) {
                    e.preventDefault();

                    var pid = $(this).attr('data-id');

                    var image_es;
                    var slider_timer;
                    var win_width = 0;

                    function resize_porto_quickview() {
                        clearTimeout(slider_timer);
                        slider_timer = setTimeout(refresh_porto_quickview, 400);
                    }

                    function refresh_porto_quickview() {
                        var $image_slider = $('.quickview-wrap-' + pid + ' .product-image-slider');
                        if ($image_slider.length) {
                            var product_image_slider = $image_slider.data('imageSlider');
                            if (product_image_slider && product_image_slider.slideController)
                                product_image_slider.slideController.locate();
                        }
                    }

                    $.fancybox({
                        href : theme.ajax_url + '?action=porto_product_quickview&pid=' + pid,
                        type : 'ajax',
                        helpers : {
                            overlay: {
                                locked: true
                            }
                        },
                        error    : '<p class="fancybox-error">' + theme.request_error + '</p>',
                        autoSize: true,
                        autoWidth : true,
                        afterShow : function() {
                            $(window).bind('resize', resize_porto_quickview);
                            theme.WooQtyField.initialize();
                            theme.Tooltip.initialize();
                        },
                        afterClose : function() {
                            $(window).unbind('resize', resize_porto_quickview);
                        }
                    });
                    return false;
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Qty Field
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WooQtyField: {

            initialize: function() {

                this.build()
                    .events();

                return this;
            },

            build: function() {
                var self = this;

// Quantity buttons
                $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );

                // Target quantity inputs on product pages
                $( 'input.qty:not(.product-quantity input.qty)' ).each( function() {
                    var min = parseFloat( $( this ).attr( 'min' ) );

                    if ( min && min > 0 && parseFloat( $( this ).val() ) < min ) {
                        $( this ).val( min );
                    }
                });

                $( document ).off('click', '.plus, .minus').on( 'click', '.plus, .minus', function() {

                    // Get values
                    var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
                        currentVal	= parseFloat( $qty.val() ),
                        max			= parseFloat( $qty.attr( 'max' ) ),
                        min			= parseFloat( $qty.attr( 'min' ) ),
                        step		= $qty.attr( 'step' );

                    // Format values
                    if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
                    if ( max === '' || max === 'NaN' ) max = '';
                    if ( min === '' || min === 'NaN' ) min = 0;
                    if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

                    // Change the value
                    if ( $( this ).is( '.plus' ) ) {

                        if ( max && ( max == currentVal || currentVal > max ) ) {
                            $qty.val( max );
                        } else {
                            $qty.val( currentVal + parseFloat( step ) );
                        }

                    } else {

                        if ( min && ( min == currentVal || currentVal < min ) ) {
                            $qty.val( min );
                        } else if ( currentVal > 0 ) {
                            $qty.val( currentVal - parseFloat( step ) );
                        }

                    }

                    // Trigger change event
                    $qty.trigger( 'change' );
                });

                return self;
            },

            events: function() {
                var self = this;

                $(document).ajaxComplete(function(event, xhr, options) {
                    self.build();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Widget Toggle
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WooWidgetToggle: {

            defaults: {
                elements: $('.widget_product_categories .widget-title, .widget_price_filter .widget-title, .widget_layered_nav .widget-title')
            },

            initialize: function($elements) {
                this.$elements = ($elements || this.defaults.elements);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    $this.parent().removeClass('closed');
                    if (!$this.find('.toggle').length) {
                        $this.append('<span class="toggle"></span>');
                    }
                    $this.find('.toggle').unbind('click').click(function() {
                        if ($this.next().is(":visible")){
                            $this.parent().addClass('closed');
                        } else {
                            $this.parent().removeClass('closed');
                        }
                        $this.next().stop().slideToggle(200);
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Widget Accordion
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WooWidgetAccordion: {

            defaults: {
                elements: $('.widget_product_categories, .widget_price_filter, .widget_layered_nav')
            },

            initialize: function($elements) {
                this.$elements = ($elements || this.defaults.elements);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    $(this).find('ul.children').each(function() {
                        if (!$(this).prev().hasClass('toggle')) {
                            $(this).before(
                                $('<span class="toggle"></span>').unbind('click').click(function() {
                                    if ($(this).next().is(":visible")) {
                                        $(this).parent().removeClass('open');
                                    } else {
                                        $(this).parent().addClass('open');
                                    }
                                    $(this).next().stop().slideToggle(200);
                                })
                            );
                        }
                    });
                    $(this).find('li[class*="current-"]').addClass('current');
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Variation Form
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WooVariationForm: {

            initialize: function() {

                this.events();

                return this;
            },

            events: function() {
                var self = this;

                $( document ).on( 'check_variations', 'form.variations_form', function( event, exclude, focus ) {
                    var $variation_form = $( this ),
                        $reset_variations = $variation_form.find( '.reset_variations' );

                    if ($reset_variations.css('visibility') == 'hidden')
                        $reset_variations.hide();
                });
                $( document ).off( 'reset_image', 'form.variations_form').on( 'reset_image', 'form.variations_form', function(event) {
                    var $product        = $(this).closest( '.product' );
                    var $product_img    = $product.find( 'div.product-images .woocommerce-main-image' );
                    var o_src           = $product_img.attr('data-o_src');
                    var o_title         = $product_img.attr('data-o_title');
                    var o_href          = $product_img.attr('data-o_href');
                    var $thumb_img      = $product.find( '.ms-thumb:eq(0)' );
                    var o_thumb_src     = $thumb_img.attr('data-o_src');

                    if ( o_src && o_title ) {
                        $product_img
                            .attr( 'src', o_src )
                            .attr( 'alt', o_title )
                            .attr( 'title', o_title )
                            .attr( 'href', o_href );

                        var elevateZoom = $product_img.data('elevateZoom');
                        if (typeof elevateZoom != 'undefined') {
                            elevateZoom.swaptheimage($product_img.attr( 'src' ), $product_img.attr( 'src' ));
                        }
                    }
                    if (o_thumb_src) {
                        $thumb_img.attr( 'src', o_thumb_src );
                    }
                });

                $( document ).on( 'found_variation woocommerce_variation_has_changed woocommerce_update_variation_values', 'form.variations_form', function(event, variation) {

                    if (typeof variation == 'undefined') {
                        return;
                    }

                    var $main_form = $(this);

                    var $product              = $(this).closest( '.product' );

                    var $image_slider = $product.find('.product-image-slider');
                    var product_image_slider = $image_slider.data('imageSlider');

                    if (product_image_slider != null && typeof product_image_slider.api.view != 'undefined') {
                        product_image_slider.api.gotoSlide(0);
                    }

                    var $shop_single_image    = $product.find( 'div.product-images .woocommerce-main-image' );
                    var productimage           =  $shop_single_image.attr('data-o_src');
                    var imagetitle             =  $shop_single_image.attr('data-o_title');
                    var imagehref              =  $shop_single_image.attr('data-o_href');

                    var $shop_thumb_image = $product.find( '.ms-thumb:eq(0)');
                    var thumbimage   =  $shop_thumb_image.attr('data-o_src');

                    var variation_image = variation.image_src;
                    var variation_link = variation.image_link;
                    var variation_title = variation.image_title;
                    var variation_thumb = variation.image_thumb;

                    $main_form.find('.variations_button').show();
                    $main_form.find('.single_variation').html( variation.price_html + variation.availability_html );

                    if ( ! productimage ) {
                        productimage = ( ! $shop_single_image.attr('src') ) ? '' : $shop_single_image.attr('src');
                        $shop_single_image.attr('data-o_src', productimage );
                    }

                    if ( ! imagehref ) {
                        imagehref = ( ! $shop_single_image.attr('href') ) ? '' : $shop_single_image.attr('href');
                        $shop_single_image.attr('data-o_href', imagehref );
                    }

                    if ( ! imagetitle ) {
                        imagetitle = ( ! $shop_single_image.attr('title') ) ? '' : $shop_single_image.attr('title');
                        $shop_single_image.attr('data-o_title', imagetitle );
                    }

                    if ( ! thumbimage ) {
                        thumbimage = ( ! $shop_thumb_image.attr('src') ) ? '' : $shop_thumb_image.attr('src');
                        $shop_thumb_image.attr('data-o_src', thumbimage );
                    }

                    if ( variation_image && variation_image.length > 1 ) {
                        $shop_single_image.attr( 'src', variation_image )
                        $shop_single_image.attr( 'alt', variation_title )
                        $shop_single_image.attr( 'title', variation_title );
                        $shop_single_image.attr( 'href', variation_link );
                        $shop_thumb_image.attr( 'src', variation_thumb );
                    } else {
                        $shop_single_image.attr( 'src', productimage )
                        $shop_single_image.attr( 'alt', imagetitle )
                        $shop_single_image.attr( 'title', imagetitle );
                        $shop_single_image.attr( 'href', imagehref );
                        $shop_thumb_image.attr( 'src', thumbimage );
                    }
                    var elevateZoom = $shop_single_image.data('elevateZoom');
                    if (typeof elevateZoom != 'undefined') {
                        elevateZoom.swaptheimage($shop_single_image.attr( 'src' ), $shop_single_image.attr( 'src' ));
                    }
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Events
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WooEvents: {

            initialize: function() {

                this.events();

                return this;
            },

            events: function() {
                var self = this;

                // add ajax cart loading
                $(document).on('click', 'a.add_to_cart_button', function(e) {
                    $(this).addClass('product-adding');
                });


                // refresh cart fragment
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: theme.ajax_url,
                    data: { action: "porto_refresh_cart_fragment" },
                    success: function( response ) {
                        self.updateCartFragment(response);
                        $( 'body' ).trigger( 'wc_fragments_loaded' );
                    }
                });

                $('body').bind('added_to_cart', function() {
                    $('ul.products li.product .added_to_cart').remove();
                    theme.Tooltip.initialize();
                    self.initAjaxRemoveCartItem();
                });

                $('body').bind('wc_fragments_refreshed wc_fragments_loaded', function() {
                    self.initAjaxRemoveCartItem();
                });

                // view cart link
                $(document).on( 'click', '.product-image .viewcart', function( e ){
                    var link = $(this).attr('data-link');
                    window.location.href = link;
                    e.preventDefault();
                });

                // add added cart
                $( document ).on( 'added_to_cart', 'body', function(event) {
                    $('.add_to_cart_button.product-adding').each(function() {
                        var $link = $(this);
                        $link.removeClass('product-adding');
                        $link.closest('.product').find('.viewcart').addClass('added');
                    });
                });

                if (typeof yith_wcan != 'undefined') {
                    yith_wcan.container = '.archive-products .products';
                    yith_wcan.pagination = '.shop-loop-before';
                    yith_wcan.result_count = '.shop-loop-after';
                }

                /* yith ajax navigation callback */
                $(document).on('click', '.yith-wcan a', function(e){
                    if (typeof yith_wcan != 'undefined') {
                        var scroll_to;

                        if ($(window).scrollTop() > theme.StickyHeader.sticky_pos) {
                            scroll_to = $(yith_wcan.container).offset().top - $(yith_wcan.pagination).height() - theme.StickyHeader.sticky_height;
                        } else {
                            scroll_to = $(yith_wcan.container).offset().top - $(yith_wcan.pagination).height() - theme.StickyHeader.sticky_height - theme.StickyHeader.sticky_offset;
                        }

                        $('html,body').animate({
                            scrollTop: scroll_to
                        }, 400);
                    }
                });
                $(document).on('ready yith-wcan-ajax-filtered', function() {
                    if (typeof yith_wcan != 'undefined') {
                        if ($(yith_wcan.container).find('.product').length) {
                            $(yith_wcan.pagination).show();
                            $(yith_wcan.result_count).show();
                        } else {
                            $(yith_wcan.pagination).hide();
                            $(yith_wcan.result_count).hide();
                        }
                    }
                    theme.WooWidgetToggle.initialize();
                    theme.WooWidgetAccordion.initialize();
                    theme.WooGridListToggle.initialize();
                    theme.Tooltip.initialize();

                    if ($.cookie('gridcookie')) {
                        $('.archive-products .products').addClass($.cookie('gridcookie'));
                    }

                    var scroll_to;
                });

                // Woocommerce variation select
                $(document).on( 'mouseenter click', '.wcvaswatchinput', function( e ){
                    var hoverimage    = $(this).attr('data-o-src');
                    var parent        = $(this).closest('li');
                    var parentdiv     = $(this).closest('div.shopswatchinput');
                    var productimage  = $("img:eq(0)", parent).attr("src");

                    if (hoverimage) {
                        $("img:eq(0)", parent).attr("src", hoverimage);
                        if (hoverimage != productimage)
                            $(parentdiv).attr("prod-img", productimage);
                    } else {
                        productimage = parentdiv.attr('prod-img');
                        if (productimage) {
                            $("img:eq(0)", parent).attr("src", productimage);
                        }
                    }
                    $(this).closest('.shopswatchinput').find('.wcvaswatchinput').removeClass('active');
                    $(this).addClass('active');
                });

                // wcml currency switcher
                $('.wcml-switcher li').on('click', function(){
                    if ($(this).parent().attr('disabled') == 'disabled')
                        return;
                    var currency = $(this).attr('rel');
                    self.loadCurrency(currency);
                });

                return self;
            },

            updateCartFragment: function(response) {
                var fragments = response.fragments;
                var cart_hash = response.cart_hash;

                if ( fragments ) {
                    $.each(fragments, function(key, value) {
                        $(key).replaceWith(value);
                    });
                }
            },

            initAjaxRemoveCartItem: function() {
                var self = this;

                $('#mini-cart .cart_list').scrollbar();
                $('.widget_shopping_cart .remove-product').unbind('click').click(function(){
                    var $this = $(this);
                    var cart_id = $this.data("cart_id");
                    var product_id = $this.data("product_id");
                    $this.closest('li').find('.ajax-loading').show();

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: theme.ajax_url,
                        data: { action: "porto_cart_item_remove",
                            cart_id: cart_id
                        },
                        success: function( response ) {
                            self.updateCartFragment(response);
                            $( 'body' ).trigger( 'wc_fragments_refreshed' );
                            $('.viewcart-' + product_id).removeClass('added');
                            $('.porto_cart_item_' + cart_id).remove();
                        }
                    });

                    return false;
                });
            },

            loadCurrency : function(currency) {
                $('.wcml-switcher').attr('disabled', 'disabled');
                $('.wcml-switcher').append('<li class="loading"></li>');
                var data = {action: 'wcml_switch_currency', currency: currency}
                $.ajax({
                    type : 'post',
                    url : theme.ajax_url,
                    data : {
                        action: 'wcml_switch_currency',
                        currency : currency
                    },
                    success: function(response) {
                        $('.wcml-switcher').removeAttr('disabled');
                        $('.wcml-switcher').find('.loading').remove();
                        window.location = window.location.href;
                    }
                });
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Init Theme

(function (theme, $) {
    "use strict";

    if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
        $('body').addClass('safari');
    }

    function porto_init() {

        // Mega Menu
        if (typeof theme.MegaMenu !== 'undefined') {
            theme.MegaMenu.initialize();
        }

        // Sidebar Menu
        if (typeof theme.SidebarMenu !== 'undefined') {
            theme.SidebarMenu.initialize();
        }

        // Accordion Menu
        if (typeof theme.AccordionMenu !== 'undefined') {
            theme.AccordionMenu.initialize();
        }

        // Side Navigation
        if (typeof theme.SideNav !== 'undefined') {
            theme.SideNav.initialize();
        }

        // Sticky Header
        if (typeof theme.StickyHeader !== 'undefined') {
            theme.StickyHeader.initialize();
        }

        // Search
        if (typeof theme.Search !== 'undefined') {
            theme.Search.initialize();
        }

        // Panel
        if (typeof theme.Panel !== 'undefined') {
            theme.Panel.initialize();
        }

        // FlickrZoom
        if (typeof theme.FlickrZoom !== 'undefined') {
            theme.FlickrZoom.initialize();
        }

        // Way Points
        if (typeof theme.WayPoints !== 'undefined') {
            theme.WayPoints.initialize();
        }

        // Scroll to Top
        if (typeof theme.ScrollToTop !== 'undefined') {
            theme.ScrollToTop.initialize();
        }

        // Fit Videos
        if (typeof theme.FitVideos !== 'undefined') {
            theme.FitVideos.initialize();
        }

        // Refresh Video Sizes
        if (typeof theme.RefreshVideoSizes !== 'undefined') {
            theme.RefreshVideoSizes.initialize();
        }

        // Accordion
        if (typeof theme.Accordion !== 'undefined') {
            theme.Accordion.initialize();
        }

        // Toggle
        if (typeof theme.Toggle !== 'undefined') {
            theme.Toggle.initialize();
        }

        // Tooltip
        if (typeof theme.Tooltip !== 'undefined') {
            theme.Tooltip.initialize();
        }

        // Slideshow
        if (typeof theme.Slideshow !== 'undefined') {
            // Post Slideshow
            theme.Slideshow.initialize($('body'), '.post-slideshow', theme.post_zoom);
            // Portfolio Slideshow
            theme.Slideshow.initialize($('body'), '.portfolio-slideshow', theme.portfolio_zoom);
            // Member Slideshow
            theme.Slideshow.initialize($('body'), '.member-slideshow', theme.member_zoom);
            // Page Slideshow
            theme.Slideshow.initialize($('body'), '.page-slideshow', theme.page_zoom);
        }

        // Carousel
        if (typeof theme.Carousel !== 'undefined') {
            // Post Carousel
            theme.Carousel.initialize('.post-carousel', theme.post_zoom);
            // Portfolio Carousel
            theme.Carousel.initialize('.portfolio-carousel', theme.portfolio_zoom);
            // Member Carousel
            theme.Carousel.initialize('.member-carousel', theme.member_zoom);
        }

        // Grid
        if (typeof theme.Grid !== 'undefined') {
            // Posts Grid
            theme.Grid.initialize($('.posts-grid .grid'), '.post');
            // Portfolis Grid
            theme.Grid.initialize($('.portfolios-grid .portfolio-row'), '.portfolio', function() {
                setTimeout(function() {
                    theme.FilterZoom.initialize($('.portfolios-grid'), theme.portfolio_zoom);
                }, 400);
            });
            // Members Grid
            theme.Grid.initialize($('.page-members .member-row'), '.member', function() {
                setTimeout(function() {
                    theme.FilterZoom.initialize($('.page-members'), theme.member_zoom);
                }, 400);
            });
        }

        // Posts Infinite
        if (typeof theme.PostsInfinite !== 'undefined') {
            theme.PostsInfinite.initialize();
        }

        // Portfolios Infinite
        if (typeof theme.PortfoliosInfinite !== 'undefined') {
            theme.PortfoliosInfinite.initialize();
        }

        // Portfolio Like
        if (typeof theme.PortfolioLike !== 'undefined') {
            theme.PortfolioLike.initialize();
        }

        // Portfolio Filter
        if (typeof theme.PortfolioFilter !== 'undefined') {
            theme.PortfolioFilter.initialize();
        }

        // Members Infinite
        if (typeof theme.MembersInfinite !== 'undefined') {
            theme.MembersInfinite.initialize();
        }

        // Member Filter
        if (typeof theme.MemberFilter !== 'undefined') {
            theme.MemberFilter.initialize();
        }

        // FAQs Infinite
        if (typeof theme.FaqsInfinite !== 'undefined') {
            theme.FaqsInfinite.initialize();
        }

        // FAQ Filter
        if (typeof theme.FaqFilter !== 'undefined') {
            theme.FaqFilter.initialize();
        }

        // Filter Zooms
        if (typeof theme.FilterZoom !== 'undefined') {
            // Portfolio Filter Zoom
            theme.FilterZoom.initialize($('.portfolios-grid, .portfolios-timeline'), theme.portfolio_zoom);
            // Member Filter Zoom
            theme.FilterZoom.initialize($('.page-members'), theme.member_zoom);
        }

        // Visual Composer Image Zoom
        if (typeof theme.VcImageZoom !== 'undefined') {
            theme.VcImageZoom.initialize();
        }

        // Woocommerce Grid List Toggle, View By
        if (typeof theme.WooGridListToggle !== 'undefined') {
            theme.WooGridListToggle.initialize();
        }

        // Woocommerce Products Slider
        if (typeof theme.WooProductsSlider !== 'undefined') {
            theme.WooProductsSlider.initialize();
        }

        // Woocommerce Products Slider
        if (typeof theme.WooProductsSlider !== 'undefined') {
            theme.WooProductsSlider.initialize();
        }

        // Woocommerce Qty Field
        if (typeof theme.WooQtyField !== 'undefined') {
            theme.WooQtyField.initialize();
        }

        // Woocommerce Quick View
        if (typeof theme.WooQuickView !== 'undefined') {
            theme.WooQuickView.initialize();
        }

        // Woocommerce Widget Toggle
        if (typeof theme.WooWidgetToggle !== 'undefined') {
            theme.WooWidgetToggle.initialize();
        }

        // Woocommerce Widget Accordion Toggle
        if (typeof theme.WooWidgetAccordion !== 'undefined') {
            theme.WooWidgetAccordion.initialize();
        }

        // Woocommerce Events
        if (typeof theme.WooEvents !== 'undefined') {
            theme.WooEvents.initialize();
        }

        // Woocommerce Variation Form
        if (typeof theme.WooVariationForm !== 'undefined') {
            theme.WooVariationForm.initialize();
        }

        // bootstrap dropdown hover
        $('[data-toggle="dropdown"]').dropdownHover();

        // disable default hide dropdown popup
        //if (!theme.MobileCheck.any) {
        if (!('ontouchstart' in document)) {
            $('.mini-cart').on('hide.bs.dropdown', function () {
                return false;
            });
        }

        /*
         Circle Slider
         */
        if ($.isFunction($.fn.flipshow)) {
            var circleContainers = $('.concept-slideshow');

            if (circleContainers.length) {
                circleContainers.each(function() {
                    var circleContainer = $(this);
                    circleContainer.flipshow();

                    function circleFlip() {
                        circleContainer.data().flipshow._navigate(circleContainer.find('div.fc-right span:first'), 'right');
                        setTimeout(circleFlip, 3000);
                    }

                    setTimeout(circleFlip, 3000);
                });
            }
        }

        /*
         Move Cloud
         */
        var clouds = $('.cloud');
        if (clouds.length) {
            clouds.each(function() {
                var cloud = $(this);
                var moveCloud = function() {
                    cloud.animate({
                        'top': '+=20px'
                    }, 3000, 'linear', function() {
                        cloud.animate({
                            'top': '-=20px'
                        }, 3000, 'linear', function() {
                            moveCloud();
                        });
                    });
                };

                moveCloud();
            });
        }
    }

    $(document).ready(function() {
        porto_init();

        $(window).bind('vc_reload', function() {
            porto_init();
            $('.type-product').addClass('product');
            $('.type-post').addClass('post');
            $('.type-portfolio').addClass('portfolio');
            $('.type-member').addClass('member');
            $('.type-block').addClass('block');
        });
    });

}.apply(this, [window.theme, jQuery]));



// @koala-prepend "theme/base.js"
// @koala-prepend "theme/functions.js"
// @koala-prepend "theme/mobile_check.js"

// @koala-prepend "theme/mega_menu.js"
// @koala-prepend "theme/sidebar_menu.js"
// @koala-prepend "theme/accordion_menu.js"
// @koala-prepend "theme/sticky_header.js"
// @koala-prepend "theme/side_nav.js"
// @koala-prepend "theme/search.js"
// @koala-prepend "theme/panel.js"

// @koala-prepend "theme/flickr_zoom.js"
// @koala-prepend "theme/waypoints.js"
// @koala-prepend "theme/scroll_to_top.js"

// @koala-prepend "theme/fit_videos.js"
// @koala-prepend "theme/refresh_video_sizes.js"
// @koala-prepend "theme/accordion.js"
// @koala-prepend "theme/toggle.js"
// @koala-prepend "theme/tooltip.js"
// @koala-prepend "theme/vc_image_zoom.js"

// @koala-prepend "theme/slideshow.js"
// @koala-prepend "theme/carousel.js"

// @koala-prepend "theme/grid.js"
// @koala-prepend "theme/posts_infinite.js"
// @koala-prepend "theme/portfolios_infinite.js"
// @koala-prepend "theme/portfolio_like.js"
// @koala-prepend "theme/portfolio_filter.js"
// @koala-prepend "theme/members_infinite.js"
// @koala-prepend "theme/member_filter.js"
// @koala-prepend "theme/faqs_infinite.js"
// @koala-prepend "theme/faq_filter.js"
// @koala-prepend "theme/filter_zoom.js"

// @koala-prepend "theme/woo_grid_list_toggle.js"
// @koala-prepend "theme/woo_products_slider.js"
// @koala-prepend "theme/woo_quick_view.js"
// @koala-prepend "theme/woo_qty_field.js"
// @koala-prepend "theme/woo_widget_toggle.js"
// @koala-prepend "theme/woo_widget_accordion.js"
// @koala-prepend "theme/woo_variation_form.js"
// @koala-prepend "theme/woo_events.js"


// @koala-prepend "theme/init.js"

