(function($) {
    'use strict';

    // Function to hide preloader
    var preloader = $('.dt_preloader');
    function initHidePreloader() {
        $('body').addClass('overlay--enabled')
        if (preloader.length) {
            preloader.addClass('loaded');
            preloader.delay(600).fadeOut();
            $('body').removeClass('overlay--enabled');
        }
    }
    if (preloader.length) {
        $('.dt_preloader-close').on('click', function() {
            preloader.addClass('loaded');
            preloader.delay(600).fadeOut();
            $('body').removeClass('overlay--enabled');
        });
    }
    // Function to initialize Owl Carousels
    function initOwlCarousels() {
        $(".dt_owl_carousel").each(function () {
            var carousel = $(this);
            var options = carousel.data("owl-options");
            carousel.owlCarousel(
                typeof options === "object" ? options : JSON.parse(options)
            );
        });
    }

    // Function to handle thumb navigation for sliders
    function initUpdateSliderThumbs() {
        var activeSlide = $('.dt_slider .owl-item.active');
        activeSlide.next('.owl-item').addClass('next');
        activeSlide.prev('.owl-item').addClass('prev');
        var nextSlideImg, prevSlideImg;
    
        if ($('.dt_slider').hasClass('dt_slider--one')) {
            nextSlideImg = $('.dt_slider .owl-item.next').find('.dt_slider-item > img').attr('src');
            prevSlideImg = $('.dt_slider .owl-item.prev').find('.dt_slider-item > img').attr('src');
        } else {
            nextSlideImg = $('.dt_slider .owl-item.next').find('.dt_slider-item .dt_slider-bg').css('background-image');
            prevSlideImg = $('.dt_slider .owl-item.prev').find('.dt_slider-item .dt_slider-bg').css('background-image');
        }
    
        // Remove 'url()' from background-image value
        nextSlideImg = nextSlideImg ? nextSlideImg.replace('url("', '').replace('")', '') : '';
        prevSlideImg = prevSlideImg ? prevSlideImg.replace('url("', '').replace('")', '') : '';
    
        $('.dt_slider .owl-nav .owl-prev .imgholder').css({ backgroundImage: 'url("' + prevSlideImg + '")' });
        $('.dt_slider .owl-nav .owl-next .imgholder').css({ backgroundImage: 'url("' + nextSlideImg + '")' });
    }

    // Function to handle scrolling and update progress bar
    function initUpdateProgressBar() {
        var scroll = $(window).scrollTop();
        var height = $(document).height() - $(window).height();
        var progressPath = $('.dt_uptop path')[0];
        var pathLength = progressPath.getTotalLength();
        var progress = pathLength - (scroll * pathLength / height);
        progressPath.style.strokeDashoffset = progress;
    }

    // Function to handle feature sticky Image
    function initStickyImg() {
        $(".dt_feature--one .feature-move-cursor").each(function() {
             let curs = document.querySelector(".dt_feature--one .feature-move-cursor");
             document.addEventListener("mousemove", (e) => {
                 let x = e.clientX;
                 let y = e.clientY;
                 curs.style.left = x - 25 + "px";
                 curs.style.top = y - 25 + "px";
             });
     
             let images = document.querySelectorAll(".dt_feature--one .feature-item");
     
             var ima_inner = document.querySelectorAll('.dt_feature--one .feature-inner-image');
             for(var i = 0; i<ima_inner.length; i++){
     
                 images.forEach((image, i) => {
                     image.addEventListener("mouseover", (e) => {
                         curs.classList.add("feature-cursor-show");
                         curs.style.backgroundImage = "url('"+ima_inner[i].getAttribute('data-image')+"')";
                     });
                     image.addEventListener("mouseleave", (e) => {
                         curs.classList.remove("feature-cursor-show");
                         curs.style.backgroundImage = "none";
                     });
                 });
     
             }
         });
    }

    // Event handling for scrolling and updating progress bar
    $(window).on('scroll', function() {
        $('.dt_uptop').toggleClass('active', $(this).scrollTop() > 50);
        initUpdateProgressBar();
    });

    // Function to handle click event for scrolling to top
    $('.dt_uptop').on('click', function(event) {
        event.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 550);
    });

    let endTl = gsplit.timeline({
        repeat: -1,
        delay: 0.5,
        scrollTrigger: {
            color: '#df0a0a',
            trigger: '.bounce-text',
            start: 'bottom 100%-=50px'
        }
    });
    gsplit.set('.bounce-text', {
        opacity: 1
    });
    gsplit.to('.bounce-text', {
        opacity: 1,
        duration: 1,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.bounce-text',
            start: 'bottom 100%-=50px',
            once: true
        }
    });
    let mySplitText = new SplitText(".bounce-text", { type: "words,chars" });
    let chars = mySplitText.chars;
    let endGradient = chromaSplit.scale(['#df0a0a', '#EE9617', '#df0a0a', '#EE9617']);
    endTl.to(chars, {
        duration: 0.5,
        scaleY: 0.6,
        ease: "power3.out",
        stagger: 0.04,
        transformOrigin: 'center bottom'
    });
    endTl.to(chars, {
        yPercent: -15,
        ease: "elastic",
        stagger: 0.03,
        duration: 0.8
    }, 0.5);
    endTl.to(chars, {
        scaleY: 1,
        ease: "elastic.out(2.5, 0.2)",
        stagger: 0.03,
        duration: 1.5
    }, 0.5);
    endTl.to(chars, {
        color: (i, el, arr) => {
            return endGradient(i / arr.length).hex();
        },
        ease: "power2.out",
        stagger: 0.03,
        duration: 0.3
    }, 0.5);
    endTl.to(chars, {
        yPercent: 0,
        ease: "back",
        stagger: 0.03,
        duration: 0.8
    }, 0.7);
    endTl.to(chars, {
        color: '#df0a0a',
        duration: 1.4,
        stagger: 0.05
    });

    // Btn Effect Six
    setTimeout(() => {
		document.querySelectorAll(".btn--effect-six .dt-btn").forEach(button => {
			const originalHTML = button.innerHTML;
			button.addEventListener("mouseover", () => {
				if (!button.classList.contains("animating") && !button.classList.contains("mouseover")) {
					button.classList.add("animating", "mouseover");
					const tempDiv = document.createElement("div");
					tempDiv.innerHTML = originalHTML;
					const chars = Array.from(tempDiv.childNodes);
					setTimeout(() => button.classList.remove("animating"), (chars.length + 1) * 50);
					const animationType = button.dataset.animation || "text-spin";
					button.innerHTML = "";
					chars.forEach(node => {
						if (node.nodeType === Node.TEXT_NODE) {
							node.textContent.split("").forEach(char => {
								button.innerHTML += `<span class="letter">${char === " " ? "&nbsp;" : char}</span>`;
							});
						} else {
							button.innerHTML += `<span class="letter">${node.outerHTML}</span>`;
						}
					});
					button.querySelectorAll(".letter").forEach((span, index) => {
						setTimeout(() => span.classList.add(animationType), 50 * index);
					});
				}
			});
			button.addEventListener("mouseout", () => {
				button.classList.remove("mouseover");
				button.innerHTML = originalHTML;
			});
		});
	}, 100);

    // smoooth scroll activation start
    const lenis = new Lenis();

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }

    requestAnimationFrame(raf);

    // Odometer Active
    $('.odometer').appear(function (e) {
        var odo = $(".odometer");
        odo.each(function () {
            var countNumber = $(this).attr("data-count");
            $(this).html(countNumber);
        });
    });

    // Function to initialize FancyBox for lightbox images
    function initLightbox() {
        if ($('.dt_lightbox_img').length) {
            $('.dt_lightbox_img').fancybox({
                openEffect: 'fade',
                closeEffect: 'fade',
                helpers: { media: {} }
            });
        }
        $('.wp-block-image').each(function() {
            $(this).find("a").attr('data-fancybox', 'gallery');
        });
        if ($('.wp-block-image a').length) {
            $('[data-fancybox="gallery"]').fancybox({
                buttons: ["slideShow", "thumbs", "zoom", "fullScreen", "share", "close"],
                loop: false,
                protect: true
            });
        }
    }

    // AOS Active
    function initAOSanimation() {
        AOS.init({
            duration: 1000,
            mirror: true,
            once: true,
            disable: 'mobile',
        });
    }

    // Data Background
    $("[data-background]").each(function () {
        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
    });

    // Function to initialize headline and preloader on window load
    function initializeComponents() {
        $(window).on('load', function() {
            initHidePreloader();
            initOwlCarousels();
            initUpdateProgressBar();
            initLightbox();
            initTitleAnimation();
            initAOSanimation();
            initStickyImg();

            const boxes = gsplit.utils.toArray('.dt_item_active');
            boxes.forEach(svg => {
                gsplit.to(svg, {
                    scrollTrigger: {
                        trigger: svg,
                        start: "top 70%",
                        end: "bottom bottom",
                        toggleClass: "active",
                        once: true,
                    }
                });
            });
        });
    }

    // Event handling for slider thumb navigation
    if ($(".dt_slider").hasClass("dt_slider--thumbnav")) {
        initUpdateSliderThumbs();
        $('.dt_slider .dt_owl_carousel').on('translated.owl.carousel', initUpdateSliderThumbs);
    }

    // Initialize headline and preloader
    initializeComponents();

})(jQuery);
