@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش امتیاز
@endsection
@section('header')
    <ol class="breadcrumb float-sm-right">
{{--        <li class="breadcrumb-item"><a href="{{ route('category.index.admin',$category->parent_id)}}">دسته بندی ها</a></li>--}}
{{--        <li class="breadcrumb-item"><a href="{{ route('category.edit.admin',$category->id)}}">ویرایش</a></li>--}}
    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start">
                        <h1 class="card-title">ویرایش امتیاز</h1>
                    </div>
                    <form class="form-horizontal" action="{{ route('score.update.admin') }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" class=" form-control" name="score_id" value="{{$score->id}}">

                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label class="col-form-label"> امتیاز ریالی *</label>
                                        <input type="number" class=" form-control " name="bonus" value="{{$score->bonus}}" min="0">
                                        <small class="text-danger">{{ $errors->first('bonus') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label class="col-form-label"> امتیاز غیرریالی *</label>
                                        <input type="number" class=" form-control" name="grant" value="{{$score->grant}}" min="0">
                                        <small class="text-danger">{{ $errors->first('grant') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label class="col-form-label"> متن پیام ارسالی برای کاربر پس از ثبت امتیاز </label>
                                        <input type="text" class=" form-control" name="description" value="{{$score->description}}">
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش امتیاز</button>
                            <a href="{{ route('scores.index.admin')}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
