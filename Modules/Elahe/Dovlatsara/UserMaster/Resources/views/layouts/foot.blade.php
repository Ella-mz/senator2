<script src="{{asset('files/userMaster/assets/js/bootstrap.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/jquery.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/fontawesome.js')}}"></script>

{{--<script src="{{asset('files/userMaster/assets/js/jquery-3.2.1.min.js')}}"></script>--}}
{{--<script src="{{asset('files/userMaster/assets/js/main.js')}}"></script>--}}
<script>
    $(document).ready(function () {

        $(".owl-carousel").owlCarousel({
            rtl: true,
            items: 4,
            nav: true,
            autoplay: true,
            loop: true,
            autoplaySpeed: 2000,
            autoplayHoverPause: true,
            autoplayTimeout: 3000,
            dots: false,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                    loop: true
                },
                370: {
                    items: 1.05,
                    nav: false,
                    loop: true
                },

                390: {
                    items: 1.1,
                    nav: false,
                    loop: true
                },
                420: {
                    items: 1.15,
                    nav: false,
                    loop: true
                },

                450: {
                    items: 1.2,
                    nav: false,
                    loop: true
                },
                490: {
                    items: 1.3,
                    nav: false,
                    loop: true
                },
                550: {
                    items: 1.5,
                    nav: false,
                    loop: true
                },
                768: {
                    items: 1.9,
                    nav: false,
                    loop: true
                },
                920: {
                    items: 2.15,
                    nav: false,
                    loop: true
                },
                990: {
                    items: 2.6,
                    nav: false,
                    loop: true
                },
                1200: {
                    items: 3.2,
                    nav: false,
                    loop: true
                },
                1320: {
                    items: 3.3,
                    nav: false,
                    loop: true
                },
                1380: {
                    items: 3.4,
                    nav: false,
                    loop: true
                },



                1420: {
                    items: 4,

                    loop: true
                },

            }

        });


    })
</script>
<script>
    function separateNum(value, input) {
        /* seprate number input 3 number */
        var nStr = value + '';
        nStr = nStr.replace(/\,/g, "");
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        if (input !== undefined) {

            input.value = x1 + x2;
        } else {
            return x1 + x2;
        }
    }
</script>
@include('sweetalert::alert')

@yield('js_user')
