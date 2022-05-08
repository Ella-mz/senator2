<script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>
{{--<script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>--}}


<script type="text/javascript">

    jQuery(document).ready(function () {
        jQuery('select[name="city"]').on('change', function () {
            var cityId = jQuery(this).val();
            if (cityId) {
                jQuery.ajax({
                    url: "{{route('user.city.getLatAndLng')}}",
                    data: {
                        'city': cityId
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        myMap.flyTo(data, 13)
                    }
                });
            }

        });
    });

    var center = [35.72422098694338, 51.4022610865622];
    @if (count($mapCenter)>1)
        center = @json($mapCenter)
        @endif

        @if (($latitude) && ($longitude))

        center = ['{{$latitude}}', '{{$longitude}}']

    @endif

    var myMap = new L.Map('map', {
        key: '{{$sdk_key}}',
        maptype: 'dreamy',
        poi: true,
        traffic: false,
        center: center,
        zoom: 14
    });
    var lat = document.getElementById("latt");
    var long = document.getElementById("longg");

    var accessToken = '{{$api_key}}';

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: '',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: accessToken
    }).addTo(myMap);

    var popup = L.popup();

    if ('{{$latitude}}' && '{{$longitude}}') {
        var redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        var markerOptions2 = {
            title: "مکان انتخاب شده",
            // clickable: true,
            // draggable: true
            icon: redIcon
        }

        markerPrevious = L.marker(['{{$latitude}}', '{{$longitude}}'], markerOptions2).addTo(myMap)
    }
    var markerOptions = {
        title: "مکان جدید",
        // clickable: true,
        // draggable: true
    }

    function onMapClick(e) {
        jQuery(document).ready(function () {
            jQuery.ajax({
                url: "{{route('get-address-with-location')}}",
                data: {
                    'latitude': e.latlng.lat,
                    'longitude': e.latlng.lng,
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.status == 200) {
                        marker = L.marker([e.latlng.lat, e.latlng.lng], markerOptions).addTo(myMap)

                        popup
                            .setLatLng(e.latlng)
                            .setContent(data.address)
                            .openOn(myMap);
                        document.getElementById("latt").value = e.latlng.lat;
                        document.getElementById("longg").value = e.latlng.lng;
                        $('#supplierStore').find('[name="address"]').val(data.address);
                        $('#supplierUpdate').find('[name="address"]').val(data.address);
                    }
                }
            });
        });
        myMap.removeLayer(marker)
    }

    // const search = new GeoSearch.GeoSearchControl({
    //     provider: new GeoSearch.OpenStreetMapProvider(),
    // });
    // myMap.addControl(search);

    if (('{{old('latt')}}') && ('{{old('longg')}}')) {

        myMap.panTo(['{{old('latt')}}', '{{old('longg')}}'], 13)
        marker = L.marker(['{{old('latt')}}', '{{old('longg')}}'], markerOptions).addTo(myMap)
    }
    myMap.on('click', onMapClick);
</script>

<script type="text/javascript">
    if ('{{$latitude}}' && '{{$longitude}}') {
        var myMap = new L.Map('myMap', {
            key: '{{$sdk_key}}',
            maptype: 'dreamy',
            poi: true,
            traffic: false,
            center: center,
            zoom: 13
        });
        var accessToken = '{{$api_key}}';

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: '',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: accessToken
        }).addTo(myMap);
        var redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        var markerOptions2 = {
            // title: data.address,
            // clickable: true,
            // draggable: true
            icon: redIcon
        }
        markerPrevious = L.marker(['{{$latitude}}', '{{$longitude}}'], markerOptions2).addTo(myMap)
    {{--jQuery(document).ready(function () {--}}
        {{--    jQuery.ajax({--}}
        {{--        url: "{{route('get-address-with-location')}}",--}}
        {{--        data: {--}}
        {{--            'latitude': {{$latitude}},--}}
        {{--            'longitude': {{$longitude}},--}}
        {{--        },--}}
        {{--        type: "GET",--}}
        {{--        dataType: "json",--}}
        {{--        success: function (data) {--}}
        {{--            console.log(data)--}}

        //             var redIcon = new L.Icon({
        //                 iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        //                 shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        //                 iconSize: [25, 41],
        //                 iconAnchor: [12, 41],
        //                 popupAnchor: [1, -34],
        //                 shadowSize: [41, 41]
        //             });
        // var markerOptions2 = {
        //     title: data.address,
        //     // clickable: true,
        //     // draggable: true
        //     icon: redIcon
        // }
        {{--            if (data.status == 200) {--}}

        {{--                markerPrevious = L.marker(['{{$latitude}}', '{{$longitude}}'], markerOptions2).addTo(myMap)--}}

        {{--            }else {--}}
        {{--                markerOptions2 = {--}}
        {{--                    title: "مکان انتخاب شده",--}}
        {{--                    // clickable: true,--}}
        {{--                    // draggable: true--}}
        {{--                    icon: redIcon--}}
        {{--                }--}}
        {{--                markerPrevious = L.marker(['{{$latitude}}', '{{$longitude}}'], markerOptions2).addTo(myMap)--}}

        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

    }

</script>
