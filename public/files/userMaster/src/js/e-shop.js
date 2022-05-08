$(document).ready(function () {
  $("#shipping-time-slider").owlCarousel({
    nav: true,
    rtl: true,
    autoWidth: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 2,
      },
      991: {
        items: 4,
      },
    },
  });
});
