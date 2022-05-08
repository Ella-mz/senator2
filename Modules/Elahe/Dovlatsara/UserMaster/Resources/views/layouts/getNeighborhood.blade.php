<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('select[name="city"]').on('change', function () {
            var cityId = jQuery(this).val();
            // alert(cityId)
            if (cityId) {
                // console.log(cityId)
                jQuery.ajax({
                    url: "{{route('gettingNeighborhood')}}",
                    data: {
                        'city': cityId
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        // console.log(data);
                        jQuery('select[name="neighborhood"]').empty();
                        $('select[name="neighborhood"]').append('<option value=""></option>');
                        jQuery.each(data, function (key, value) {
                            $('select[name="neighborhood"]').append('<option value="' + key + '">' + value + '</option>');

                        });
                    }
                });
            } else {
                $('select[name="neighborhood"]').empty();
            }
        });
    });
</script>
