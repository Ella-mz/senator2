@extends('RealestateMaster::master')
@section('title_realestate')افزودن کارشناس
@endsection
@section('card_title') افزودن کارشناس
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title" style="float: right">افزودن کارشناس ثبت نام شده</h1>
            </div>
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="text-bold mb-2" style="color: #3c3cce">میتوانید کاربر را با یکی از اطلاعات زیر پیدا
                            کنید
                        </div>
                        <div class="form-group">
                            <label for="code">کد کاربر</label>
                            <div class="input-group" style="display: unset">
                                <form id="searchInUsersWithCode" method="post" style="display: flex">
                                    @csrf
                                    <input type="text" name="code" class="form-control" value="{{old('code')}}"
                                           autofocus>
                                    <input type="text" name="type" value="code" hidden>

                                    <div class="input-group-append">
                                        <span class="input-group-text" style="cursor:pointer;">
                                                <i class="fa fa-search" onclick="searchUser('code')"></i>
                                        </span>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile">موبایل</label>
                            <div class="input-group" style="display: unset">
                                <form id="searchInUsersWithMobile" method="post" style="display: flex">
                                    @csrf
                                    <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}"
                                           autofocus>
                                    <input type="text" name="type" value="mobile" hidden>
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="cursor:pointer;">
                                            <i class="fa fa-search" onclick="searchUser('mobile')"></i>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="username">نام کاربری</label>--}}
{{--                            <div class="input-group" style="display: unset">--}}
{{--                                <form id="searchInUsersWithUsername" method="post" style="display: flex">--}}
{{--                                    @csrf--}}
{{--                                    <input type="text" name="username" class="form-control" value="{{old('username')}}"--}}
{{--                                           autofocus>--}}
{{--                                    <input type="text" name="type" value="username" hidden>--}}

{{--                                    <div class="input-group-append">--}}
{{--                                        <span class="input-group-text" style="cursor:pointer;">--}}
{{--                                            <i class="fa fa-search" onclick="searchUser('username')"></i>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="table-responsive p-2" id="userData">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@section('js_realestate')
    <script>
        $(document).ready(function () {
            $('#searchInUsersWithCode').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('user.findAgent.panel')}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#userData').empty();
                        $('#userData').append(data.content);
                    }
                })
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#searchInUsersWithMobile').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('user.findAgent.panel')}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#userData').empty();
                        $('#userData').append(data.content);
                    }
                })
            });
        });
    </script>
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#searchInUsersWithUsername').on('submit', function (event) {--}}
{{--                event.preventDefault();--}}
{{--                $.ajax({--}}
{{--                    url: "{{route('user.findAgent.panel')}}",--}}
{{--                    method: "POST",--}}
{{--                    data: new FormData(this),--}}
{{--                    dataType: 'json',--}}
{{--                    contentType: false,--}}
{{--                    cache: false,--}}
{{--                    processData: false,--}}
{{--                    success: function (data) {--}}
{{--                        console.log(data)--}}

{{--                        $('#userData').empty();--}}
{{--                        $('#userData').append(data.content);--}}
{{--                    }--}}
{{--                })--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
    <script type="text/javascript">
        function searchUser(type) {
            if (type == 'code') {
                $("#searchInUsersWithCode").submit();
            }
            if (type == 'mobile') {
                $("#searchInUsersWithMobile").submit();
            }
            // if (type == 'username') {
            //     $("#searchInUsersWithUsername").submit();
            // }
        }
    </script>
@endsection
