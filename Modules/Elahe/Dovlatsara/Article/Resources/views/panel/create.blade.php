@extends('RealestateMaster::master')
@section('title_realestate')ایجاد مقاله جدید
@endsection
@section('card_title')ایجاد مقاله جدید
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-default">
                    <div class="card-header d-flex align-content-start justify-content-start">

                        <h1 class="card-title">مقاله جدید</h1>
                    </div>
                    <form action="{{ route('articles.store.panel') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{--                        <input hidden name="article_group_id" value="{{$articleGroup->id}}">--}}
                        <div class="card-body">

                            <div class="form-group">
                                <label for="sex">دسته بندی مقاله</label>
                                <select class="form-control" name="article_group_id"
                                        style="width: 100%;text-align: right">
                                    <option value="" disabled selected class="form-control"></option>
                                    @foreach($articleGroups as $group)
                                        <option value="{{$group->id}}" @if($group->id == old('article_group_id'))
                                        selected @endif >{{$group->title}}
                                        </option>
                                    @endforeach

                                </select>
                                <small class="text-danger">{{ $errors->first('article_group_id') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="title">عنوان مقاله</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="en_title">عنوان انگلیسی مقاله(slug)</label>
                                <input type="text" name="en_title" class="form-control" value="{{old('en_title')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('en_title') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="inputName">عکس</label>

                                <input class="form-control filestyle"
                                       name="image" id="flag"
                                       type="file" data-classbutton="btn btn-secondary"
                                       data-classinput="form-control inline"
                                       data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                       value="{{old('image')}}">
                                <small class="text-danger">{{ $errors->first('image') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="inputName">ویدیو</label>

                                <input class="form-control filestyle"
                                       name="video" id="video"
                                       type="file" data-classbutton="btn btn-secondary"
                                       data-classinput="form-control inline"
                                       data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                       value="{{old('video')}}">
                                <small class="text-danger">{{ $errors->first('video') }}</small>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"> توضیحات کوتاه </label>
                                <div>
                                    <input class="form-control" type="text" value="{{old('shortDescription')}}"
                                           name="shortDescription">
                                    <small class="text-danger">{{ $errors->first('shortDescription') }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"> توضیحات </label>
                                <textarea id="description12" name="description" rows="10"
                                          style="width: 100%">{{old('description')}}</textarea>
                                <small class="text-danger">{{ $errors->first('description') }}</small>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn float-right" style="background-color: #3c3cce;color: #fff">
                                ایجاد مقاله
                            </button>
                            <a href="{{route('articles.index.panel', auth()->id())}}" class="btn btn-secondary"
                               style="margin-left:1%">لغو</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js_realestate')
@endsection
