@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد گروه مشخصه جدید
@endsection
@section('header')
{{--    گروه مشخصه دسته بندی {{$category->createStringAsParents2(\Modules\Category\Entities\Category::find($category->parent_id)->path)}}--}}
    {{--    <a type="button" class="btn btn-info btn-sm" href="{{route('category.index.admin', $category->parent_id)}}" style="float: left">--}}
{{--        <i class="fa fa-arrow-left text-white"></i></a>--}}
{{--    <ol class="breadcrumb float-sm-right">--}}
{{--        <li class="breadcrumb-item active"><a href="{{ route('category.index.admin',$parentId)}}">دسته بندی ها</a></li>--}}
{{--        <li class="breadcrumb-item"><a href={{ route('cities.add',$state_id)}}>Create</a></li>--}}
{{--    </ol>--}}
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1" ></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start" >
                        <h1 class="card-title">گروه مشخصه جدید</h1>
                    </div>
                    <form action="{{ route('group-attrs.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input  name="category" type="hidden" value="{{$category->id}}">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">عنوان گروه مشخصه</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus required>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>

                            <div class="form-group">
                                <label for="advertiser">نوع ثبت آگهی</label>
                                <select class="form-control select2" name="advertiser" style="width: 100%;">
                                    <option value="" disabled selected class="form-control">نوع ثبت آگهی</option>
                                        <option value="supplier" @if('supplier' == old('advertiser'))
                                        selected @endif class="form-control">عرضه</option>
                                    <option value="applicant" @if('applicant' == old('advertiser'))
                                    selected @endif class="form-control">درخواست</option>
{{--                                    <option value="both" @if('both' == old('advertiser'))--}}
{{--                                    selected @endif class="form-control">هردو</option>--}}
                                </select>
                                <small class="text-danger">{{ $errors->first('advertiser') }}</small>

                                {{--                                <input type="file" name="image" class="btn btn-primary float-right" >--}}
                            </div>
                            <div class="form-group" id="numberOfColumnsForDisplay">
{{--                                <label for="numberOfColumnsForDisplay">تعداد ستون های نمایش</label>--}}

{{--                                <select class="form-control select2" name="numberOfColumnsForDisplay" style="width: 100%;">--}}
{{--                                    <option value="" disabled selected class="form-control">تعداد ستون های نمایش</option>--}}
{{--                                    <option value="6" @if('6' == old('numberOfColumnsForDisplay'))--}}
{{--                                    selected @endif class="form-control">2</option>--}}
{{--                                    <option value="4" @if('4' == old('numberOfColumnsForDisplay'))--}}
{{--                                    selected @endif class="form-control">3</option>--}}
{{--                                    <option value="3" @if('3' == old('numberOfColumnsForDisplay'))--}}
{{--                                    selected @endif class="form-control">4</option>--}}
{{--                                    <option value="2" @if('2' == old('numberOfColumnsForDisplay'))--}}
{{--                                    selected @endif class="form-control">6</option>--}}
{{--                                    <option value="12" @if('12' == old('numberOfColumnsForDisplay'))--}}
{{--                                    selected @endif class="form-control">1</option>--}}
{{--                                </select>--}}
{{--                                --}}{{--                                <input type="text" name="numberOfColumnsForDisplay" class="form-control" value="{{old('numberOfColumnsForDisplay')}}"--}}
{{--                                --}}{{--                                       autofocus required>--}}
{{--                                <small class="text-danger">{{ $errors->first('numberOfColumnsForDisplay') }}</small>--}}

                                {{--                                <input type="file" name="image" class="btn btn-primary float-right" >--}}
                            </div>
                            <div class="form-group" id="type">

                            </div>
                            <div class="form-group ">

                                <label class="col-form-label">عنوان گروه مشخصه تعریف شده پنهان شود؟</label>
                                <input class="icheckbox_minimal" type="checkbox" name="hidden">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد گروه مشخصه</button>
                            <a href="{{route('groupAttrs.index.admin', $category->id)}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="advertiser"]').on('change', function () {
                var attribute_group_advertiser = jQuery(this).val();
                if (attribute_group_advertiser == 'supplier') {
                    content1 = `<label for="numberOfColumnsForDisplay">تعداد ستون های نمایش</label>

                                <select class="form-control select2" name="numberOfColumnsForDisplay" style="width: 100%;">
                                    <option value="" disabled selected class="form-control">تعداد ستون های نمایش</option>
                                    <option value="6" @if('6' == old('numberOfColumnsForDisplay'))
                    selected @endif class="form-control">2</option>
                                    <option value="4" @if('4' == old('numberOfColumnsForDisplay'))
                    selected @endif class="form-control">3</option>
                                    <option value="3" @if('3' == old('numberOfColumnsForDisplay'))
                    selected @endif class="form-control">4</option>
                                    <option value="2" @if('2' == old('numberOfColumnsForDisplay'))
                    selected @endif class="form-control">6</option>
                                    <option value="12" @if('12' == old('numberOfColumnsForDisplay'))
                    selected @endif class="form-control">1</option>
                                </select>`;

                    jQuery('div[id="numberOfColumnsForDisplay"]').empty();
                    jQuery('div[id="numberOfColumnsForDisplay"]').append(content1);

                } else {
                    jQuery('div[id="numberOfColumnsForDisplay"]').empty();
                }

                if (attribute_group_advertiser == 'supplier') {
                    content2 = `<label for="type">جایگاه نمایش</label>

                                <select class="form-control select2" name="type" style="width: 100%;">
                                    <option value="" disabled selected class="form-control">ترتیب نمایش مشخصات</option>
                                    <option value="estate-information" @if('estate-information' == old('type'))
                    selected @endif class="form-control">ردیف بالا</option>
                    {{--                <option value="estate-features" @if('estate-features' == old('type'))--}}
                    {{--selected @endif class="form-control">امکانات ملک</option>--}}
                                    <option value="financial-situation" @if('financial-situation' == old('type'))
                    selected @endif class="form-control">ردیف پایین</option>
                                </select>
                                <small class="text-danger">{{ $errors->first('type') }}</small>`;
                    jQuery('div[id="type"]').empty();
                    jQuery('div[id="type"]').append(content2);
                } else {
                    jQuery('div[id="type"]').empty();
                }


            });
        });
    </script>
@endsection
