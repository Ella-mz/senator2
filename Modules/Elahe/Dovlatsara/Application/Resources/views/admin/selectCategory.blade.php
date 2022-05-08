@extends('AdminMasterNew::master')
@section('urlHeader')انتخاب دسته بندی
@endsection
@section('header')
    انتخاب دسته بندی
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/agahi.css')}}">
@endsection
@section('content')
    <div class="row py-5">
        <input hidden name="chooseAdType" id="chooseAdType" value="{{$type}}">
        <div class="col-md-3 mt-5"></div>
        <div class="col-md-6 mt-5 align-items-center">
            <ul class="list-group-flush">
                <div id="content-cats">
                    <li class="list-group-item" style="color: blue">لطفا دسته بندی خود را انتخاب کنید</li>

                    @foreach($cats as $c)
                        <li class="list-group-item category" onclick="nextCats(this.id)" id="{{$c->id}}">
                            {{--                        <input type="radio" name="radio-category" class="category" value="{{$cate1->id}}"--}}
                            {{--                               id="category{{$cate1->id}}">--}}
                            <label for="category{{$c->id}}" style="cursor: pointer">{{$c->title}} </label><i
                                class="mr-2 fa fa-angle-left pl-1 "></i>
                        </li>
                    @endforeach
                </div>
            </ul>
        </div>
    </div>

@endsection
@section('js')
    <script>
        function prevCats(id) {
            jQuery(document).ready(function () {
                var url1 = '{{route('application.prev.cats.admin', ':x')}}';
                url1 = url1.replace(':x', document.getElementById("chooseAdType").value)
                jQuery.ajax({
                        url: url1,
                        data: {
                            'categoryId': id,
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            if(data.content && data.ad != 'applicant') {
                                jQuery('#content-cats').html('');
                                jQuery('#content-cats').append(data.content);
                            }
                            if (data.ad == 'applicant'){
                                var url = '{{route('application.create.admin', ':id')}}';
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
                var url1 = '{{route('application.find.cats.admin', ':x')}}';
                url1 = url1.replace(':x', document.getElementById("chooseAdType").value)
                jQuery.ajax({
                        url: url1,
                        data: {
                            'categoryId': id,
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            if(data.content && data.ad != 'applicant') {
                                jQuery('#content-cats').html('');
                                jQuery('#content-cats').append(data.content);
                            }
                            if (data.ad == 'applicant'){
                                var url = '{{route('application.create.admin', ':id')}}';
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
