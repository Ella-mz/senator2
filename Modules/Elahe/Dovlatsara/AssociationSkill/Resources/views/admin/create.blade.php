@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد مهارت جدید
@endsection
@section('header')
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1" ></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start" >

                        <h1 class="card-title">مهارت جدید</h1>
                    </div>
                    <form action="{{ route('associationSkills.store.admin') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input  name="association_id" type="hidden" value="{{$association->id}}">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputName">عنوان مهارت</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus required>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>

                            {{--                            @if($parentId == 0)--}}

                            <div class="form-group">
                                <label for="inputName">عکس</label>

                                <input class="form-control filestyle"
                                       name="image" id="flag"
                                       type="file" data-classbutton="btn btn-secondary"
                                       data-classinput="form-control inline"
                                       data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                       value="{{old('image')}}">
                                <small class="text-danger">{{ $errors->first('image') }}</small>

                                {{--                                <input type="file" name="image" class="btn btn-primary float-right" >--}}
                            </div>
                            {{--                                @endif--}}

                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد مهارت</button>
                            <a href="{{route('associationSkills.index.admin', $association->id)}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
