@extends('UserMasterNew::master')
@section('title_user')انتخاب دسته بندی
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/agahi.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/category.css')}}">

    <style>
        /*the container must be positioned relative:*/

        .custom-select {
            position: relative;
            font-family: Arial;
        }

        .custom-select select {
            display: none;
            /*hide original SELECT element:*/
        }

        .select-selected {
            background-color: DodgerBlue;
        }

        /*style the arrow inside the select element:*/

        .select-selected:after {
            position: absolute;
            content: "";
            top: 14px;
            right: 10px;
            width: 0;
            height: 0;
            border: 6px solid transparent;
            border-color: #fff transparent transparent transparent;
        }

        /*point the arrow upwards when the select box is open (active):*/

        .select-selected.select-arrow-active:after {
            border-color: transparent transparent #fff transparent;
            top: 7px;
        }

        /*style the items (options), including the selected item:*/

        .select-items div,
        .select-selected {
            color: #ffffff;
            padding: 8px 16px;
            border: 1px solid transparent;
            border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
            cursor: pointer;
            user-select: none;
        }

        /*style items (options):*/

        .select-items {
            position: absolute;
            background-color: DodgerBlue;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 99;
        }

        /*hide the items when the select box is closed:*/

        .select-hide {
            display: none;
        }

        .select-items div:hover,
        .same-as-selected {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
@section('content_userMasterNew')
    {{--    <div class="row py-5">--}}
    <input hidden name="chooseAdType" id="chooseAdType" value="{{$type}}">
    <section class="category-page">
        <div class="show-category">
            <div class="show-category-bg">
                <h2>لطفا دسته بندی خود را انتخاب نمایید</h2>
                <div class="show-category-box">
                    <ul>
                        <div id="content-cats">

                            {{--                        <li class="li-bg-light-gray">--}}
                            {{--                                <span>--}}
                            {{--                                    بازگشت به قبل--}}
                            {{--                                 </span>--}}
                            {{--                            <i class="fa fa-angle-right"></i>--}}

                            {{--                        </li>--}}
                            @foreach($cats as $key=>$c)
                                @if($key%2==0)
                                    <li class="li-bg-light-gray" onclick="nextCats(this.id)" id="{{$c->id}}">
                                <span>
                                    {{$c->title}}
                                 </span>
                                        <i class="fa fa-angle-left"></i>

                                    </li>
                                @else
                                    <li class="li-bg-gray" onclick="nextCats(this.id)" id="{{$c->id}}">
                                <span>
                                    {{$c->title}}

                                </span>
                                        <i class="fa fa-angle-left"></i>

                                    </li>
                                @endif
                            @endforeach
                        </div>
                    </ul>

                </div>

            </div>

        </div>
    </section>
@endsection
@section('js_user')
    <script>
        function prevCats(id) {
            jQuery(document).ready(function () {
                var url1 = '{{route('application.prev.cats.user', ':x')}}';
                url1 = url1.replace(':x', document.getElementById("chooseAdType").value)
                jQuery.ajax({
                        url: url1,
                        data: {
                            'categoryId': id,
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            console.log(data)
                            if (data.content && data.ad != 'supplier') {
                                jQuery('#content-cats').html('');
                                jQuery('#content-cats').append(data.content);
                            }
                            if (data.ad == 'supplier') {
                                var url = '{{route('application.create.user', ':id')}}';
                                url = url.replace(':id', id);
                                window.location.href = url;
                            }
                        }
                    }
                );
            });
        }
    </script>

    <script>
        function nextCats(id) {
            jQuery(document).ready(function () {
                var url1 = '{{route('application.find.cats.user', ':x')}}';
                url1 = url1.replace(':x', document.getElementById("chooseAdType").value)
                jQuery.ajax({
                        url: url1,
                        data: {
                            'categoryId': id,
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            if (data.content && data.ad != 'applicant') {
                                jQuery('#content-cats').html('');
                                jQuery('#content-cats').append(data.content);
                            }
                            if (data.ad == 'applicant') {
                                var url = '{{route('application.create.user', ':id')}}';
                                url = url.replace(':id', id);
                                window.location.href = url;
                            }
                        }
                    }
                );
            });
        }
    </script>
@endsection
