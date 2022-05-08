@extends('RealestateMaster::master')
@section('title_realestate')پروفایل
@endsection
@section('card_title')پروفایل

@endsection
@section('content_realestateMaster')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @can('LevelUpAccountPanel')
                    @if(isset($levelupToAdminOfAgency->str_value))
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-8 justify-content-center align-items-end d-flex">
                        <div class="card">
                            <div class="card-body">
                                <form target="_blank" action="{{route('auth.realestate.registerForm.user')}}"
                                      id="register_business" method="get"
                                      style="display: unset">
                                    <input hidden name="user" value="{{$user->user_id}}">
                                    <a target="_blank" onclick="document.getElementById('register_business').submit()"
                                       style="cursor: pointer">
                                        <img src="{{asset($levelupToAdminOfAgency->str_value)}}"
                                             style="max-width: 100%;max-height: 150px">
                                    </a>
                                </form>

                            </div>
                        </div>
                    </div>
                @endif
                @endcan

                <div class="col-md-1">

                </div>
                <!-- /.col -->
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header p-2">
                            <div class="row">
                                <div class="col-md-8">

                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link @if(!old('skill_old')) active @endif"
                                                                href="#activity" data-toggle="tab">اطلاعات
                                                شخصی</a></li>
                                        @if($user->hasRole('contractor'))
                                            <li class="nav-item"><a class="nav-link @if(old('skill_old')) active @endif"
                                                                    href="#timeline" data-toggle="tab">مهارت ها</a>
                                            </li>
                                        @endif
                                        {{--                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">تنظیمات</a></li>--}}
                                    </ul>
                                </div>
                                <div class="col-md-4 text-left">
                                    @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $user->id)->where('type', 'user')->first()
                                                            && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $user->id)->where('type', 'user')->first()->status=='approved')
                                        <img
                                            src="{{asset(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $user->id)->where('type', 'user')->first()->hologram->logo)}}"
                                            style="width: 50px;height: 40px">
                                    @endif
                                </div>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class=" @if(!old('skill_old')) active @endif tab-pane" id="activity">
                                    <div class="row">
                                        <div class="col-1">
                                            <div class="col-md-1">

                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="card">
                                                <div class="card-header">

                                                    <h3 class="card-title text-bold">اطلاعات شخصی</h3>

                                                    <div class="card-tools">

                                                        {{--                        <div class="input-group input-group-sm" style="width: 150px;">--}}
                                                        {{--                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">--}}

                                                        <div class="input-group-append">
                                                            <a href="{{route('user.edit.realestate' ,$user->id)}}"
                                                               class="btn btn-sm"
                                                               style="background-color: #3c3cce;color: #fff">ویرایش
                                                                اطلاعات</a>
                                                        </div>
                                                        {{--                        </div>--}}
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-hover">

                                                        <tr>

                                                            <th>نام و نام خانوادگی</th>
                                                            <td>{{$user->name}} {{$user->sirName}}</td>
                                                        </tr>
                                                        <tr>

                                                            <th>کد کاربر</th>
                                                            <td>{{$user->user_id}}</td>
                                                        </tr>
                                                        {{--                                                        <tr>--}}

                                                        {{--                                                            <th>نام کاربری</th>--}}
                                                        {{--                                                            <td>{{$user->userName}}</td>--}}
                                                        {{--                                                        </tr>--}}
                                                        <tr>

                                                            <th>موبایل</th>
                                                            <td>{{$user->mobile}}</td>
                                                        </tr>
                                                        <tr>

                                                            <th>ایمیل</th>
                                                            <td>{{$user->email}}</td>
                                                        </tr>
                                                        <tr>

                                                            <th>جنسیت</th>
                                                            <td>@if($user->sex==1)
                                                                    زن
                                                                @elseif($user->sex==0)
                                                                    مرد
                                                                @endif</td>

                                                        </tr>
                                                        <tr>

                                                            <th>تاریخ شروع فعالیت</th>
                                                            <td>{{$user->yearOfOperation}}</td>

                                                        </tr>
                                                        <tr>

                                                            <th>تاریخ تولد</th>
                                                            <td>{{$user->birthDate}}</td>

                                                        </tr>
                                                        @if($user->hasRole('contractor'))

                                                            <tr>

                                                                <th>اصناف</th>
                                                                <td>
                                                                    @foreach($user->associations as $association)
                                                                        {{$association->title}}/
                                                                    @endforeach
                                                                </td>

                                                            </tr>
                                                        @endif
                                                        {{--                        <tr>--}}

                                                        {{--                            <th>فعال/غیرفعال</th>--}}
                                                        {{--                            <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</td>--}}

                                                        {{--                        </tr>--}}
                                                    </table>
                                                </div>
                                                <hr>
                                                <h3 class="card-title mr-3 text-bold">احراز هویت</h3><br>
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>عکس کاربر</th>
                                                            <td>
                                                                @if(isset($user->userImage))
                                                                    <img src="{{asset($user->userImage)}}" width="80"
                                                                         height="40">
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        @can('nationalCardImage')
                                                            <tr>

                                                                <th>عکس کارت ملی</th>
                                                                <td>
                                                                    @if(isset($user->nationalCardImage))
                                                                        <img src="{{asset($user->nationalCardImage)}}"
                                                                             width="80"
                                                                             height="40">
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endcan
                                                        {{--                        @can('shenasnamehImage')--}}
                                                        {{--                            <tr>--}}
                                                        {{--                                <th>عکس شناسنامه</th>--}}
                                                        {{--                                <td>--}}
                                                        {{--                                    @if(isset($user->shenasnamehImage))--}}
                                                        {{--                                        <img src2="{{asset($user->shenasnamehImage)}}" width="80"--}}
                                                        {{--                                             height="40">--}}
                                                        {{--                                    @endif--}}
                                                        {{--                                </td>--}}
                                                        {{--                            </tr>--}}
                                                        {{--                        @endcan--}}
                                                        @can('mobasherCardImage')
                                                            <tr>
                                                                <th>عکس کارت مباشر</th>
                                                                <td>
                                                                    @if(isset($user->mobasherCardImage))
                                                                        <img src="{{asset($user->mobasherCardImage)}}"
                                                                             width="80"
                                                                             height="40">
                                                                    @endif
                                                                </td>

                                                            </tr>
                                                        @endcan
                                                        {{--                        @can('unionCardImage')--}}
                                                        {{--                            <tr>--}}
                                                        {{--                                <th>عکس کارت اتحادیه</th>--}}
                                                        {{--                                <td>--}}
                                                        {{--                                    @if(isset($user->unionCardImage))--}}
                                                        {{--                                        <img src2="{{asset($user->unionCardImage)}}" width="80"--}}
                                                        {{--                                             height="40">--}}
                                                        {{--                                    @endif--}}
                                                        {{--                                </td>--}}

                                                        {{--                            </tr>--}}
                                                        {{--                        @endcan--}}
                                                        @can('businessLicenseImage')

                                                            <tr>

                                                                <th>عکس پروانه کسب</th>
                                                                <td>
                                                                    @if(isset($user->businessLicenseImage))
                                                                        <img
                                                                            src="{{asset($user->businessLicenseImage)}}"
                                                                            width="80"
                                                                            height="40">
                                                                    @endif
                                                                </td>

                                                            </tr>
                                                        @endcan

                                                        {{--                        <tr>--}}

                                                        {{--                            <th>فعال/غیرفعال</th>--}}
                                                        {{--                            <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</td>--}}

                                                        {{--                        </tr>--}}
                                                    </table>
                                                </div>

                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                @if($user->hasRole('contractor'))

                                    <div class="tab-pane @if(old('skill_old')) active @endif" id="timeline">
                                        <!-- The timeline -->
                                        <div class="row">
                                            <div class="col-1"></div>
                                            <div class="col-10">
                                                <div class="card">
                                                    <div class="card-header">
                                                        {{--                <a href="{{route('attrs.add.admin', $attribute->id)}}"--}}
                                                        {{--                   class="btn btn-sm btn-primary" style="float: left">ایجاد مشخصه آیتم جدید</a>--}}

                                                        <h1 class="card-title text-bold" style="float: right">مهارت
                                                            ها </h1>

                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="modal fade" id="editItem" tabindex="-1"
                                                             role="dialog"
                                                             aria-labelledby="exampleModalCenterTitle"
                                                             aria-hidden="true" data-backdrop="false">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                 role="document">
                                                                <div class="modal-content">
                                                                    <form class="form-horizontal" id="editItemForm"
                                                                          method="post">
                                                                        @csrf

                                                                        @if(session()->has('message'))
                                                                            <div class="alert alert-danger "
                                                                                 style="color:darkred">{{ session()->get('message') }}</div>
                                                                        @endif
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLongTitle">
                                                                                ویرایش مهارت</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div id="success" class="w-100"></div>
                                                                            <div id="error"></div>
                                                                            <input class="form-control" name="itemid"
                                                                                   hidden>
                                                                            <input class="form-control"
                                                                                   name="itemattribute" hidden>
                                                                            <div class="row">
                                                                                <div class="col-md-1 mb-3"></div>
                                                                                <div class="col-md-10 mb-3">
                                                                                    <label
                                                                                        class="col-form-label">امتیاز</label>
                                                                                    <select class="form-control"
                                                                                            style="width: 100%;text-align: right"
                                                                                            name="value" id="value">
                                                                                    </select>
                                                                                    <small
                                                                                        class="text-danger">{{ $errors->first('value') }}</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-danger text-white btn-sm"
                                                                                        data-dismiss="modal">انصراف
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn btn-success btn-sm "
                                                                                        id="edititem">ثبت
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form class="form-horizontal"
                                                              action="{{route('users.contractorSkills.store.realestate')}}"
                                                              method="post">
                                                            <input hidden name="skill_old" value="1">
                                                            @if(session()->has('message'))
                                                                <div class="alert alert-danger "
                                                                     style="color:darkred">{{ session()->get('message') }}</div>
                                                            @endif
                                                            @csrf
                                                            {{--                                            <input class="form-control" hidden value="{{$attribute->id}}" name="attribute">--}}
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-md-3 mb-3"></div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="skill[]">مهارت ها</label>
                                                                            <select class="form-control select2"
                                                                                    name="skill[]"
                                                                                    style="width: 100%;text-align: right"
                                                                                    multiple="multiple">
                                                                                {{--                                                                <option value="" disabled selected class="form-control">نوع بسته</option>--}}
                                                                                @foreach($skills2 as $skill)
                                                                                    <option value="{{$skill->id}}"
                                                                                            @if($skill->id == old('skill'))
                                                                                            selected
                                                                                            @endif class="form-control">{{$skill->title}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <small
                                                                                class="text-danger">{{ $errors->first('skill') }}</small>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="value">امتیاز</label>
                                                                            <select class="form-control select2"
                                                                                    name="value"
                                                                                    style="width: 100%;text-align: right">
                                                                                <option value="" selected
                                                                                        class="form-control">
                                                                                </option>
                                                                                @for($i=0;$i<6;$i++)
                                                                                    <option value="{{$i}}"
                                                                                            @if($i == old('value'))
                                                                                            selected
                                                                                            @endif class="form-control">{{$i}}</option>
                                                                                @endfor
                                                                            </select>
                                                                            <small
                                                                                class="text-danger">{{ $errors->first('value') }}</small>
                                                                        </div>
                                                                        {{--                                                        <label class="col-form-label">عنوان آیتم <small class="text-danger"> * </small> </label>--}}
                                                                        {{--                                                        <input class="form-control" type="text" value="{{old('title')}}"--}}
                                                                        {{--                                                               name="title">--}}
                                                                        {{--                                                        <small class="text-danger">{{ $errors->first('title') }}</small>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex justify-content-center align-content-center">
                                                                <input class="btn btn-info" type="submit" value="ثبت">
                                                            </div>
                                                            <br>
                                                        </form>
                                                        <table id="example1" class="table table-bordered table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>ردیف</th>
                                                                <th>عنوان مهارت</th>
                                                                <th>امتیاز</th>
                                                                <th>ویرایش/حذف</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($skills as $key=>$skill)
                                                                <tr>
                                                                    <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                                                                    <td>{{$skill->title}}</td>
                                                                    <td>
                                                                        {{$skill->pivot->value}}
                                                                    </td>

                                                                    <td>
                                                                        <form
                                                                            action="{{route('users.contractorSkills.destroy.realestate', $skill->id)}}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <a type="button" class="btn btn-info btn-sm"
                                                                               data-toggle="modal"
                                                                               data-target="#editItem"

                                                                               data-id="{{$skill->id }}"
                                                                               data-value="{{$skill->pivot->value}}"
                                                                               data-title="{{$skill->title }}"><i
                                                                                    class="fa fa-edit text-white"></i>
                                                                            </a>
                                                                            <button type="submit"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    onclick="return confirm('آیا از حذف مهارت {{$skill->title}} اطمینان دارید؟')">
                                                                                <i class="fa fa-trash-o"></i>
                                                                            </button>
                                                                        </form>

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                            <!-- /.tab-pane -->

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('js_realestate')

    <script>
        $('#editItem').on('show.bs.modal', function (e) {
            var opener = e.relatedTarget;
            var id = $(opener).attr('data-id');
            var title = $(opener).attr('data-title');
            var value = $(opener).attr('data-value');
            $('#editItemForm').find('[name="itemid"]').val(id);
            $('#editItemForm').find('[name="itemtitle"]').val(title);
            $('select[name="value"]').empty();
            if (value == 0) {
                $('select[name="value"]').empty();
                $('select[name="value"]').append('<option value="0" selected>0</option>');
                $('select[name="value"]').append('<option value="1">1</option>');
                $('select[name="value"]').append('<option value="2">2</option>');
                $('select[name="value"]').append('<option value="3">3</option>');
                $('select[name="value"]').append('<option value="4">4</option>');
                $('select[name="value"]').append('<option value="5">5</option>');
            }
            if (value == 1) {
                $('select[name="value"]').append('<option value="0" >0</option>');
                $('select[name="value"]').append('<option value="1" selected>1</option>');
                $('select[name="value"]').append('<option value="2">2</option>');
                $('select[name="value"]').append('<option value="3">3</option>');
                $('select[name="value"]').append('<option value="4">4</option>');
                $('select[name="value"]').append('<option value="5">5</option>');
            }
            if (value == 2) {
                $('select[name="value"]').append('<option value="0" >0</option>');
                $('select[name="value"]').append('<option value="1">1</option>');
                $('select[name="value"]').append('<option value="2" selected>2</option>');
                $('select[name="value"]').append('<option value="3">3</option>');
                $('select[name="value"]').append('<option value="4">4</option>');
                $('select[name="value"]').append('<option value="5">5</option>');
            }
            if (value == 3) {
                $('select[name="value"]').append('<option value="0" >0</option>');
                $('select[name="value"]').append('<option value="1">1</option>');
                $('select[name="value"]').append('<option value="2">2</option>');
                $('select[name="value"]').append('<option value="3" selected>3</option>');
                $('select[name="value"]').append('<option value="4">4</option>');
                $('select[name="value"]').append('<option value="5">5</option>');
            }
            if (value == 4) {
                $('select[name="value"]').append('<option value="0" >0</option>');
                $('select[name="value"]').append('<option value="1">1</option>');
                $('select[name="value"]').append('<option value="2">2</option>');
                $('select[name="value"]').append('<option value="3">3</option>');
                $('select[name="value"]').append('<option value="4" selected>4</option>');
                $('select[name="value"]').append('<option value="5">5</option>');
            }
            if (value == 5) {
                $('select[name="value"]').append('<option value="0" >0</option>');
                $('select[name="value"]').append('<option value="1">1</option>');
                $('select[name="value"]').append('<option value="2">2</option>');
                $('select[name="value"]').append('<option value="3">3</option>');
                $('select[name="value"]').append('<option value="4">4</option>');
                $('select[name="value"]').append('<option value="5" selected>5</option>');
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#editItemForm').on('submit', function (event) {
                event.preventDefault();
                var formData = {
                    'itemid': $('input[name=itemid]').val(),
                    'itemtitle': $('input[name=itemtitle]').val(),
                    'value': $('select[name=value]').val(),
                };
                var id = formData["itemid"];
                var title = formData["itemtitle"]
                var value = formData["value"]
                // console.log(formData["itemtitle"])
                $.ajax({
                    url: "{{route('users.contractorSkills.update.realestate')}}",
                    method: "POST",
                    data: new FormData(this),
                    //data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
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
                    }
                })
            });
        });
    </script>
@endsection
