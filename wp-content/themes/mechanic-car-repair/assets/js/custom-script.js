jQuery(document).ready(function ($) {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(".scroll-to-top a").fadeIn();
    } else {
      $(".scroll-to-top a").fadeOut();
    }
  });

  $(".scroll-to-top a").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 800);
    return false;
  });
});
