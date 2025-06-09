! function($, b) {
    "use strict";
    var a = {
        eventID: "DtThemeJs",
        document: $(document),
        window: $(window),
        body: $("body"),
        classes: {
            toggled: "active",
            isOverlay: "overlay--enabled",
            mobileMainMenuActive: "dt_mobilenav-mainmenu--active",
            headerSearchActive: "dt_header-search--active",
            headerSidebarActive: "sidebar--active"
        },
        init: function() {
            this.document.on("ready", this.documentReadyRender.bind(this)),
                this.document.on("ready", this.menuFocusAccessibility.bind(this)),
                this.document.on("ready", this.headerHeight.bind(this)),
                this.document.on("ready", this.topbarMobile.bind(this)),
                this.document.on("ready", this.mobileNavRight.bind(this)),
                this.window.on("ready", this.documentReadyRender.bind(this))
        },
        documentReadyRender: function() {
            this.document.on("click." + this.eventID, ".dt_mobilenav-mainmenu-toggle", this.menuToggleHandler.bind(this)).on("click." + this.eventID, ".dt_header-closemenu", this.menuToggleHandler.bind(this)).on("click." + this.eventID, this.hideHeaderMobilePopup.bind(this)).on("click." + this.eventID, ".dt_mobilenav-dropdown-toggle", this.verticalMobileSubMenuLinkHandle.bind(this)).on("click." + this.eventID, ".dt_header-closemenu", this.resetVerticalMobileMenu.bind(this)).on("hideHeaderMobilePopup." + this.eventID, this.resetVerticalMobileMenu.bind(this)).on("click." + this.eventID, ".dt_navbar-search-toggle", this.searchPopupHandler.bind(this)).on("click." + this.eventID, ".dt_search-close", this.searchPopupHandler.bind(this)).on("click." + this.eventID, ".dt_navbar-sidebar-toggle", this.sidebarPopupHandler.bind(this)).on("click." + this.eventID, ".dt_sidebar-close", this.sidebarPopupHandler.bind(this)), this.window.on("scroll." + this.eventID, this.scrollToSticky.bind(this)).on("resize." + this.eventID, this.headerHeight.bind(this))
        },
        scrollToSticky: function(b) {
            var a = $(".is--sticky");
            this.window.scrollTop() >= 220 ? a.addClass("on") : a.removeClass("on")
        },
        headerHeight: function(d) {
            var a = $(".dt_header-navwrapper"),
                b = $(".dt_header-navwrapperinner"),
                c = 0;
            $("body").find("div").hasClass("is--sticky") && (b.each(function() {
                var a = this.clientHeight;
                a > c && (c = a)
            }), a.css("min-height", c))
        },
        topbarAccessibility: function() {
            var b, a, d, c = document.querySelector(".dt_mobilenav-topbar");
            var f = document.querySelector(".dt_mobilenav-topbar-toggle"),
                e = c.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                g = e[e.length - 1];
            if (!c) return !1;
            for (a = 0, d = (b = c.getElementsByTagName("a")).length; a < d; a++) b[a].addEventListener("focus", h, !0), b[a].addEventListener("blur", h, !0);

            function h() {
                for (var a = this; - 1 === a.className.indexOf("dt_mobilenav-topbar");) "*" === a.tagName.toLowerCase() && (-1 !== a.className.indexOf("focus") ? a.className = a.className.replace(" focus", "") : a.className += " focus"), a = a.parentElement
            }
            document.addEventListener("keydown", function(a) {
                ("Tab" === a.key || 9 === a.keyCode) && f.classList.contains("active") && (a.shiftKey ? document.activeElement === f && (g.focus(), a.preventDefault()) : document.activeElement === g && (f.focus(), a.preventDefault()))
            })
        },
        topbarMobile: function() {
            var c = $(".dt_mobilenav-topbar-content"),
                b = $(".dt_header-widget"),
                a = $(".dt_mobilenav-topbar-toggle");
            !b.children().length > 0 ? a.hide() : (a.show(), a.on("click", function(b) {
                c.slideToggle(), a.toggleClass("active"), b.preventDefault()
            }), this.topbarAccessibility())
        },
        mobileNavRight: function() {
            $(".dt_navbar-right .dt_navbar-cart-item").clone().prependTo(".dt_mobilenav-right .dt_navbar-list-right");
        },
        menuFocusAccessibility: function(a) {
            $(".dt_navbar-nav, .widget_nav_menu").find("a").on("focus blur", function() {
                $(this).parents("ul, li").toggleClass("focus")
            })
        },
        menuToggleHandler: function(c) {
            var b = $(".dt_mobilenav-mainmenu-content"),
                a = $(".dt_mobilenav-mainmenu-toggle");
            this.body.toggleClass(this.classes.mobileMainMenuActive), this.body.toggleClass(this.classes.isOverlay), a.toggleClass(this.classes.toggled), b.fadeToggle(), this.body.hasClass(this.classes.mobileMainMenuActive) ? $(".dt_header-closemenu").focus() : a.focus(), this.menuAccessibility()
        },
        hideHeaderMobilePopup: function(a) {
            var b = $(".dt_mobilenav-mainmenu-toggle"),
                c = $(".dt_mobilenav-mainmenu");
            !$(a.target).closest(b).length && !$(a.target).closest(c).length && this.body.hasClass(this.classes.mobileMainMenuActive) && (this.body.removeClass(this.classes.mobileMainMenuActive), this.body.removeClass(this.classes.isOverlay), b.removeClass(this.classes.toggled), mobileMainmenuContent.fadeOut(), this.document.trigger("hideHeaderMobilePopup." + this.eventID), a.stopPropagation())
        },
        verticalMobileSubMenuLinkHandle: function(a) {
            a.preventDefault();
            var b = $(a.currentTarget);
            b.closest(".dt_mobilenav-mainmenu .dt_navbar-mainmenu"), b.parents(".dropdown-menu").length, this.isRTL, setTimeout(function() {
                b.parent().toggleClass("current"), b.next().slideToggle()
            }, 250)
        },
        resetVerticalMobileMenu: function(a) {
            $(".dt_mobilenav-mainmenu .dt_navbar-mainmenu");
            var b = $(".dt_mobilenav-mainmenu  .menu-item"),
                c = $(".dt_mobilenav-mainmenu .dropdown-menu");
            setTimeout(function() {
                b.removeClass("current"), c.hide()
            }, 250)
        },
        menuAccessibility: function() {
            var b, a, d, c = document.querySelector(".dt_mobilenav-mainmenu-content");
            var f = document.querySelector(".dt_header-closemenu:not(.off--layer)"),
                e = c.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                g = e[e.length - 1];
            if (!c) return !1;
            for (a = 0, d = (b = c.getElementsByTagName("a")).length; a < d; a++) b[a].addEventListener("focus", h, !0), b[a].addEventListener("blur", h, !0);

            function h() {
                for (var a = this; - 1 === a.className.indexOf("dt_mobilenav-mainmenu-inner");) "li" === a.tagName.toLowerCase() && (-1 !== a.className.indexOf("focus") ? a.className = a.className.replace(" focus", "") : a.className += " focus"), a = a.parentElement
            }
            document.addEventListener("keydown", function(a) {
                ("Tab" === a.key || 9 === a.keyCode) && (a.shiftKey ? document.activeElement === f && (g.focus(), a.preventDefault()) : document.activeElement === g && (f.focus(), a.preventDefault()))
            })
        },
        searchPopupHandler: function(c) {
            var a = $(".dt_navbar-search-toggle"),
                b = $(".dt_search-field");
            this.body.toggleClass(this.classes.headerSearchActive), this.body.toggleClass(this.classes.isOverlay), this.body.hasClass(this.classes.headerSearchActive) ? b.focus() : a.focus(), this.searchPopupAccessibility()
        },
        searchPopupAccessibility: function() {
            var b, a, d, c = document.querySelector(".search--header");
            var f = document.querySelector(".dt_search-field"),
                e = c.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                g = e[e.length - 1];
            if (!c) return !1;
            for (a = 0, d = (b = c.getElementsByTagName("button")).length; a < d; a++) b[a].addEventListener("focus", h, !0), b[a].addEventListener("blur", h, !0);

            function h() {
                for (var a = this; - 1 === a.className.indexOf("search--header");) "input" === a.tagName.toLowerCase() && (-1 !== a.className.indexOf("focus") ? a.className = a.className.replace("focus", "") : a.className += " focus"), a = a.parentElement
            }
            document.addEventListener("keydown", function(a) {
                ("Tab" === a.key || 9 === a.keyCode) && (a.shiftKey ? document.activeElement === f && (g.focus(), a.preventDefault()) : document.activeElement === g && (f.focus(), a.preventDefault()))
            })
        },
        sidebarPopupHandler: function(d) {
            var a = $(".dt_navbar-sidebar-toggle"),
                b = $(".dt_sidebar"),
                c = $(".dt_sidebar-close");
            this.body.toggleClass(this.classes.headerSidebarActive), this.body.toggleClass(this.classes.isOverlay), a.toggleClass(this.classes.toggled), this.body.hasClass(this.classes.headerSidebarActive) ? ( /*b.addClass('1e3'),*/ c.focus()) : ( /*b.fadeOut(1e3),*/ a.focus()), this.sidebarPopupAccessibility()
        },
        sidebarPopupAccessibility: function() {
            var b, a, d, c = document.querySelector(".dt_sidebar");
            var f = document.querySelector(".dt_sidebar-close:not(.off--layer)"),
                e = c.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                g = e[e.length - 1];
            if (!c) return !1;
            for (a = 0, d = (b = c.getElementsByTagName("button")).length; a < d; a++) b[a].addEventListener("focus", h, !0), b[a].addEventListener("blur", h, !0);

            function h() {
                for (var a = this; - 1 === a.className.indexOf("dt_sidebar-inner");) "input" === a.tagName.toLowerCase() && (-1 !== a.className.indexOf("focus") ? a.className = a.className.replace("focus", "") : a.className += " focus"), a = a.parentElement
            }
            document.addEventListener("keydown", function(a) {
                ("Tab" === a.key || 9 === a.keyCode) && (a.shiftKey ? document.activeElement === f && (g.focus(), a.preventDefault()) : document.activeElement === g && (f.focus(), a.preventDefault()))
            })
        }
    };
    a.init()
}(jQuery, window.asConfig);
(function($) {
    $.fn.btnloadmore = function(options) {
        var defaults = {
            showItem: $(this).data("limit"),
            whenClickBtn: $(this).data("col"),
            textBtn: $(this).data("loadname") ? $(this).data("loadname") : "Load More",
            classBtn: "",
            setCookies: false,
            delayToScroll: 2000,
        };

        var settings = $.extend(defaults, options);

        return this.each(function() {
            var container = $(this);
            var items = container.children();

            items.hide().slice(0, settings.showItem).show();

            if (items.filter(":hidden").length > 0) {
                var loadMoreBtn = $(`
                    <div class="dt-row dt-text-center dt-mt-5" style="align-items: center;">
                        <div class="dt-col-12">
                            <a href="javascript:void(0);" data-title="${settings.textBtn}" class="dt-btn dt-btn-primary dt-btn-loadmore ${settings.classBtn}">
                                ${settings.textBtn}
                            </a>
                        </div>
                    </div>
                `);

                container.after(loadMoreBtn);

                let uniqueClass = loadMoreBtn.find('a');

                uniqueClass.on("click", function(event) {
                    event.preventDefault();

                    items.filter(":hidden").slice(0, settings.whenClickBtn).slideDown();

                    if (items.filter(":hidden").length === 0) {
                        loadMoreBtn.fadeOut("slow");
                    }

                    container.animate({
                            scrollTop: container.scrollTop() + items.filter(":visible").last().offset().top - container.offset().top,
                        },
                        settings.delayToScroll
                    );
                });
            }
        });
    };
})(jQuery);

gsplit.registerPlugin(ScrollTrigger, SplitText);
gsplit.config({
    nullTargetWarn: false,
    trialWarn: false
});

function initTitleAnimation() {

    var tg_var = jQuery('.section-title-two');
    if (!tg_var.length) {
        return;
    }

    const quotes = document.querySelectorAll(".section-title-two .dt-element-title");

    quotes.forEach(quote => {

        //Reset if needed
        if (quote.animation) {
            quote.animation.progress(1).kill();
            quote.split.revert();
        }

        var getclass = quote.closest('.section-title').className;
        var animation = getclass.split('animation-');
        if (animation[1] == "style4") return

        quote.split = new SplitText(quote, {
            type: "lines,words,chars",
            linesClass: "split-line"
        });
        gsplit.set(quote, {
            perspective: 400
        });

        if (animation[1] == "style1") {
            gsplit.set(quote.split.chars, {
                opacity: 0,
                y: "90%",
                rotateX: "-40deg"
            });
        }
        if (animation[1] == "style2") {
            gsplit.set(quote.split.chars, {
                opacity: 0,
                x: "50"
            });
        }
        if (animation[1] == "style3") {
            gsplit.set(quote.split.chars, {
                opacity: 0,
            });
        }
        quote.animation = gsplit.to(quote.split.chars, {
            scrollTrigger: {
                trigger: quote,
                start: "top 90%",
            },
            x: "0",
            y: "0",
            rotateX: "0",
            opacity: 1,
            duration: 1,
            ease: Back.easeOut,
            stagger: .02
        });
    });
}
ScrollTrigger.addEventListener("refresh", initTitleAnimation);