
<script type="text/javascript">
    @isset($ad->adImages)
    function deleteimageOfAd(id) {
        jQuery(document).ready(function () {
            if (id) {
                jQuery.ajax({
                    url: '{{route('deleteAdImage.realestate')}}',
                    data: {
                        'id': id,
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data == true) {
                            $('#oldImage').html('');
                            window.setTimeout(function () {
                                location.reload();
                            }, 2000);

                        }
                    }
                });
            }
        });
    }
    @endisset
</script>
