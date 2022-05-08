<script>
    function prevCats(id) {
        jQuery(document).ready(function () {
            var url1 = '{{route('categories.prev.cats', [':x', ':panel'])}}';
            url1 = url1.replace(':x', document.getElementById("chooseAdType").value)
            url1 = url1.replace(':panel', document.getElementById("panel").value)
            var panel = document.getElementById("panel").value;

            jQuery.ajax({
                url: url1,
                data: {
                    'categoryId': id,
                    'agencyId': '{{$agency_id}}',
                },
                type: "GET",
                dataType: "json",
                success: function (data) {

                    if (data.content && data.ad != 'supplier') {
                        jQuery('#content-cats').html('');
                        jQuery('#content-backbutton').html('');
                        jQuery('#content-cats').append(data.content);
                        jQuery('#content-backbutton').append(data.backbutton);
                    }
                    if (data.ad == 'supplier') {
                        if (panel == 'user') {
                            var url = '{{route('ad.crate.supplier.user', ':id')}}';
                        }
                        if (panel == 'panel') {
                            var url = '{{route('ad.create.supplier.realestate', ':id')}}';
                        }
                        if (panel == 'admin') {
                            var url = '{{route('ad.create.supplier.admin', ':id')}}';
                        }
                        {{--var url = '{{route('ad.crate.supplier.user', ':id')}}';--}}
                        url = url.replace(':id', id);
                        alert(url)
                        jQuery.ajax({
                            url: url,
                            data: {
                                // 'categoryId': id,
                                'agencyId': '{{$agency_id}}',
                            },
                            type: "GET",
                            dataType: "json",
                            success: function (data) {

                            }
                        });
                    }
                    if (data.ad == 'applicant') {
                        if (panel == 'user') {
                            var url = '{{route('application.create.user', ':id')}}';
                        }
                        {{--if (panel == 'panel') {--}}
                            {{--    var url = '{{route('ad.create.supplier.realestate', ':id')}}';--}}
                            {{--}--}}
                        if (panel == 'admin') {
                            var url = '{{route('application.create.admin', ':id')}}';
                        }
                        url = url.replace(':id', id);
                        window.location.href = url;
                    }

                }
                // );
            });
        })
    }
</script>

<script>
    function nextCats(id) {
        jQuery(document).ready(function () {
            var url1 = '{{route('categories.find.cats', [':x', ':panel'])}}';
            url1 = url1.replace(':x', document.getElementById("chooseAdType").value)
            url1 = url1.replace(':panel', document.getElementById("panel").value)
            var panel = document.getElementById("panel").value;
            jQuery.ajax({
                    url: url1,
                    data: {
                        'categoryId': id,
                        'agencyId': '{{$agency_id}}',
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.content && (data.ad != 'supplier' || data.ad != 'applicant')) {
                            jQuery('#content-backbutton').html('');
                            jQuery('#content-cats').html('');
                            jQuery('#content-cats').append(data.content);
                            jQuery('#content-backbutton').append(data.backbutton);
                        }
                        if (data.ad == 'supplier') {
                            if (panel == 'user') {
                                var url = '{{route('ad.crate.supplier.user', ':id')}}';
                            }
                            if (panel == 'panel') {
                                var url = '{{route('ad.create.supplier.realestate', ':id')}}';
                            }
                            if (panel == 'admin') {
                                var url = '{{route('ad.create.supplier.admin', ':id')}}';
                            }
                            url = url.replace(':id', id);
                            var form = document.createElement("form");
                            form.setAttribute("id", "form1");
                            form.setAttribute("method", "GET");
                            form.setAttribute("action", url);
                            form.setAttribute("target", "_self");
                            var hiddenField = document.createElement("input");
                            hiddenField.setAttribute("name", "agencyId");
                            hiddenField.setAttribute("value", '{{$agency_id}}');
                            form.appendChild(hiddenField);
                            document.body.appendChild(form);
                            form.submit();
                        }
                        if (data.ad == 'applicant') {
                            if (panel == 'user') {
                                var url = '{{route('application.create.user', ':id')}}';
                            }
                            {{--if (panel == 'panel') {--}}
                            {{--    var url = '{{route('ad.create.supplier.realestate', ':id')}}';--}}
                            {{--}--}}
                            if (panel == 'admin') {
                                var url = '{{route('application.create.admin', ':id')}}';
                            }
                            url = url.replace(':id', id);
                            window.location.href = url;
                        }
                    }
                }
            );
        });
    }
</script>
