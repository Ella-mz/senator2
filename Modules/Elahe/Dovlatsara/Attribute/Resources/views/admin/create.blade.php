@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد مشخصه جدید
@endsection
@section('header')
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start">
                        <h1 class="card-title"> مشخصه جدید</h1>
                    </div>
                    <form action="{{ route('attributes.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input name="groupAttr" type="hidden" value="{{$groupAttribute->id}}">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">عنوان مشخصه</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="attribute_type">نوع مشخصه</label>
                                <select class="form-control select2" name="attribute_type" style="width: 100%;">
                                    <option value="" disabled selected class="form-control">نوع مشخصه</option>
                                    <option value="select" @if('select' == old('attribute_type'))
                                    selected @endif class="form-control">چند گزینه ای
                                    </option>
                                    <option value="int" @if('int' == old('attribute_type'))
                                    selected @endif class="form-control">عدد
                                    </option>
                                    <option value="bool" @if('bool' == old('attribute_type'))
                                    selected @endif class="form-control">دو گزینه ای
                                    </option>
                                    <option value="string" @if('string' == old('attribute_type'))
                                    selected @endif class="form-control">کاراکتر
                                    </option>
                                    @if($groupAttribute->advertiser=='supplier')
                                        <option value="description" @if('description' == old('attribute_type'))
                                        selected @endif class="form-control">متن
                                        </option>
                                    @endif
                                </select>
                                <small class="text-danger">{{ $errors->first('attribute_type') }}</small>

                            </div>
                            @if($groupAttribute->advertiser == 'supplier')

                                <div class="form-group" id="alt_value">

                                </div>
                            @endif
                            <div class="form-group" id="selectType">
                            </div>
                            <div class="form-group" id="palceHolderr">

                            </div>
                            <div class="form-group">
                                <label for="title">واحد</label>
                                <input type="text" name="unit" class="form-control" value="{{old('unit')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('unit') }}</small>

                            </div>
                            <div class="form-group ">
                                <label class="col-form-label" for="significant">دارای الویت؟ </label>
                                <input class="icheckbox_minimal" type="checkbox" name="significant" id="significant" @if(old('significant') == 'on') checked @endif>
                            </div>
                            <div class="form-group ">

                                <label class="col-form-label" for="isFilterField">مشخصه تعریف شده در فیلترها قرار بگیرد؟</label>
                                <input class="icheckbox_minimal" type="checkbox" name="isFilterField" id="isFilterField" @if(old('isFilterField') == 'on') checked @endif>
                            </div>
                            @if($groupAttribute->advertiser == 'applicant')
                                <div class="form-group" id="hasScale">


                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد مشخصه</button>
                            <a href="{{route('attrs.index.admin', $groupAttribute->id)}}" class="btn btn-secondary"
                               style="margin-left:1%">لغو</a>
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
            jQuery('select[name="attribute_type"]').on('change', function () {
                var attribute_type = jQuery(this).val();
                jQuery('div[id="hasScale"]').empty();
                jQuery('div[id="alt_value"]').empty();

                if (attribute_type == 'select') {
                    content1 = ` <label for="input_type">نحوه نمایش</label><br>
                    <select class="form-control select2" name="input_type" style="width: 100%;">
                        <option value="" disabled selected class="form-control">نحوه نمایش</option>
                            <option value="checkbox" @if('checkbox' == old('input_type'))
                    selected @endif class="form-control">سلکت افقی</option>
                                    <option value="select" @if('select' == old('input_type'))
                    selected @endif class="form-control">دراپ دان</option>
                    </select>
                    <small class="text-danger">{{ $errors->first('input_type') }}</small>`;

                    jQuery('div[id="selectType"]').empty();
                    jQuery('div[id="selectType"]').append(content1);

                    content4 = `<label class="col-form-label">مشخصه تعریف شده دارای حداقل و حداکثر باشد؟</label>
                                <input class="icheckbox_minimal" type="checkbox" name="hasScale">`;
                    jQuery('div[id="hasScale"]').empty();
                    jQuery('div[id="hasScale"]').append(content4);

                    {{--content5 = `<label for="alt_value">عنوان جایگزین</label>--}}
                    {{--            <input type="text" name="alt_value" class="form-control" value="{{old('alt_value')}}"--}}
                    {{--                   autofocus>--}}
                    {{--            <small class="text-danger">{{ $errors->first('alt_value') }}</small>`;--}}
                    {{--jQuery('div[id="alt_value"]').empty();--}}
                    {{--jQuery('div[id="alt_value"]').append(content5);--}}
                } else {

                    jQuery('div[id="selectType"]').empty();
                }
                if (attribute_type == 'int') {
                    content4 = `<label class="col-form-label">مشخصه تعریف شده دارای حداقل و حداکثر باشد؟</label>
                                <input class="icheckbox_minimal" type="checkbox" name="hasScale">`;
                    jQuery('div[id="hasScale"]').empty();
                    jQuery('div[id="hasScale"]').append(content4);
                    content5 = `<label for="alt_value">عنوان جایگزین</label>
                                <input type="text" name="alt_value" class="form-control" value="{{old('alt_value')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('alt_value') }}</small>`;
                    jQuery('div[id="alt_value"]').empty();
                    jQuery('div[id="alt_value"]').append(content5);

                } else {
                }
                if (attribute_type != 'bool') {
                    content3=` <label for="title">Place holder</label>
                                <input type="text" name="placeHolder" class="form-control"
                                       value="{{old('placeHolder')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('placeHolder') }}</small>`;
                    jQuery('div[id="palceHolderr"]').empty();
                    jQuery('div[id="palceHolderr"]').append(content3);
                } else {
                    jQuery('div[id="palceHolderr"]').empty();
                }

            });
        });
    </script>
@endsection
