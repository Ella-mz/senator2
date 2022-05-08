<script>
    $('#editImage').on('show.bs.modal', function (e) {
        var opener = e.relatedTarget;
        var id = $(opener).attr('data-id');
        var reason = $(opener).attr('data-reason');
        $('#editImageForm').find('[name="adid"]').val(id);
        $('#editImageForm').find('[name="adreason"]').val(reason);
    });

</script>
<script>
    $(document).ready(function () {
        $('#editImageForm').on('submit', function (event) {
            event.preventDefault();
            // var formData = {
            //     'adid': $('input[name=adid]').val(),
            //     'adreason': $('textarea[name=adreason]').val(),
            //
            // };
            var formData = {
                'adid': $('input[name=adid]').val(),
                'adreason': $('textarea[name=adreason]').val(),
                // 'itemattribute'    : $('input[name=itemattribute]').val(),
            };
            var adid = formData["adid"];
            var adreason = formData["adreason"]
            // var attribute = formData["itemattribute"]
            // var adid = formData["adid"];
            // var adreason = formData["adreason"]
            // var url = $('form[id=editImageForm]').attr('action')+'/'+adid;
            // console.log(adreason)
            $.ajax({
                url: '{{route('ads.disconfirm')}}',
                method: "POST",
                data: new FormData(this),

                // data: {
                //     'FormData':new FormData(this),
                //     'adreason' : adreason,
                //     'adid' : adid
                // },
                {{--data: {--}}
                {{--    "formData": formData,--}}
                {{--    "_token" : "{{csrf_token()}}",--}}
                {{--    "id":adid--}}
                {{--},--}}
                // data: {
                //     'adreason' : adreason,
                //     'adid' : adid
                // },
                type: "POST",
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    // console.log(data)
                    if (data.errorValidation) {
                        $('#error').empty();
                        $('#error').append('<small class="text-danger">' + data.errorValidation + '</small>');
                    }
                    if (data.success) {
                        $('#success').empty();
                        $('#success').append(data.success);
                        window.setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                },
            })
        });
    });
</script>
