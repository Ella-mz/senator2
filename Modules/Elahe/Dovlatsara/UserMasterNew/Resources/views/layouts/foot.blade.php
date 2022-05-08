{{--<script src="{{asset('files/userMaster/assets/js/bootstrap.js')}}"></script>--}}
<script src="{{asset('files/userMaster/assets/js/jquery.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/fontawesome.js')}}"></script>

{{--<script src="{{asset('files/userMaster/assets/js/jquery-3.2.1.min.js')}}"></script>--}}
{{--<script src="{{asset('files/userMaster/assets/js/main.js')}}"></script>--}}
<script>

    function closeCity(id) {
        $(".sessionCity" + id).remove();
        $("input[value=" + id + "]").prop("checked", false);
    }
</script>
<script>
    // console.log($("#homePageInput"))

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
<script src="{{asset('files/userMaster/assets/js/numtostr.js')}}"></script>
<script>
    function scrollToTop() {

        window.scrollTo({top: 0, behavior: 'smooth'});

    }
</script>
<script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"
></script>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- fontawesome JS -->
{{--<script defer src="{{asset('files/userMaster/src/js/all.min.js')}}"></script>--}}

<!--Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
<script src="{{asset('files/userMaster/src/js/dolatsara.js')}}"></script>

@include('sweetalert::alert')

@yield('js_user')
