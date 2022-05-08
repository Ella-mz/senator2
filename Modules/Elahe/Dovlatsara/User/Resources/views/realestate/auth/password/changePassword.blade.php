@extends('RealestateMaster::master')
@section('title_realestate')تغییر رمز عبور
@endsection
@section('content_realestateMaster')

{{--    </div>--}}
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">اطلاعات شخصی</h3>


                    </div>

                    <!-- /.card-header -->
                    <form action="{{route('users.changePassword.realestate', $user->id)}}" method="post" enctype="multipart/form-data">

                        @csrf
                        <input hidden name="id" value="{{$user->id}}">
                        {{--                        @method('patch')--}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="prev_password">رمز عبور قبلی</label>

                                        <input type="password" name="prev_password" class="form-control"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('prev_password') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="new_password">رمز عبور جدید</label>

                                        <input type="password" name="new_password" class="form-control"

                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('new_password') }}</small>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn float-right" style="background-color: #3c3cce;color: #fff">ویرایش رمز عبور</button>
                            <a href="{{route('user.profile.realestate', auth()->id())}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                        </div>

                    </form>


                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js_realestate')

@endsection
