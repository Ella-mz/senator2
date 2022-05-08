@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش مشخصه
@endsection
@section('header')
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">ویرایش مشخصه</h1>
                    </div>
                    <form action="{{ route('attributes.update', $attribute->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">عنوان مشخصه</label>
                                <input type="text" name="title" class="form-control" value="{{ $attribute->title }}">
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                            <input hidden value="{{$attribute->attribute_type}}" name="selectVal">
                            <div class="form-group">
                                <label for="attribute_type">نوع مشخصه</label>
                                <select class="form-control select2" name="attribute_type" style="width: 100%;">
                                    <option value="" disabled selected class="form-control">نوع مشخصه</option>
                                    <option value="select" @if('select' == $attribute->attribute_type)
                                    selected @endif class="form-control">چند گزینه ای
                                    </option>
                                    <option value="int" @if('int' == $attribute->attribute_type)
                                    selected @endif class="form-control">عدد
                                    </option>
                                    <option value="bool" @if('bool' == $attribute->attribute_type)
                                    selected @endif class="form-control">دو گزینه ای
                                    </option>
                                    <option value="string" @if('string' == $attribute->attribute_type)
                                    selected @endif class="form-control">کاراکتر
                                    </option>
                                    @if(\Modules\GroupAttribute\Entities\GroupAttribute::find($attribute->groupAttribute_id)->advertiser=='supplier')

                                        <option value="description" @if('description' == $attribute->attribute_type)
                                        selected @endif class="form-control">متن
                                        </option>
                                    @endif
                                </select>
                                <small class="text-danger">{{ $errors->first('attribute_type') }}</small>

                            </div>
                            @if(\Modules\GroupAttribute\Entities\GroupAttribute::find($attribute->groupAttribute_id)->advertiser == 'supplier')

                                <div class="form-group" id="alt_value">

                                </div>
                            @endif
                            <div class="form-group" id="selectType">
                            </div>
                            <div class="form-group" id="palceHolderr">

                            </div>
                            <div class="form-group">
                                <label for="title">واحد</label>
                                <input type="text" name="unit" class="form-control" value="{{$attribute->unit}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('unit') }}</small>

                            </div>
                            <div class="form-group px-4">
                                <label class="col-form-label">دارای الویت؟ </label>
                                <input class="icheckbox_minimal" type="checkbox" name="significant"
                                       @if($attribute->isSignificant==1) checked @endif>
                            </div>
                            <div class="form-group px-4">

                                <label class="col-form-label">مشخصه تعریف شده در فیلترها قرار بگیرد؟</label>
                                <input class="icheckbox_minimal" type="checkbox" name="isFilterField"
                                       @if($attribute->isFilterField==1) checked @endif>
                            </div>
                            @if(\Modules\GroupAttribute\Entities\GroupAttribute::find($attribute->groupAttribute_id)->advertiser == 'applicant')

                                <div class="form-group px-4" id="hasScale">


                                </div>
                            @endif
                            <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                                <button type="submit" class="btn btn-success float-right">ویرایش مشخصه</button>
                                <a href="{{ route('attrs.index.admin', $attribute->groupAttribute_id)}}"
                                   class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                            </div>
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
            if (jQuery('input[name="selectVal"]').val() == 'bool') {

            } else {
                content3 = ` <label for="title">Place holder</label>
                                <input type="text" name="placeHolder" class="form-control"
                                       value="{{$attribute->placeHolder}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('placeHolder') }}</small>`;
                jQuery('div[id="palceHolderr"]').empty();
                jQuery('div[id="palceHolderr"]').append(content3);
            }
        });
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            if (jQuery('input[name="selectVal"]').val() == 'int') {
                content4 = `<label class="col-form-label">مشخصه تعریف شده دارای حداقل و حداکثر باشد؟</label>
                                    <input class="icheckbox_minimal" type="checkbox" name="hasScale"
                                           @if($attribute->hasScale==1) checked @endif>`;

                jQuery('div[id="hasScale"]').empty();
                jQuery('div[id="hasScale"]').append(content4);
                content5 = `<label for="alt_value">عنوان جایگزین</label>
                                <input type="text" name="alt_value" class="form-control" value="{{($attribute->alt_value)}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('alt_value') }}</small>`;
                jQuery('div[id="alt_value"]').empty();
                jQuery('div[id="alt_value"]').append(content5);
            }
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            if (jQuery('input[name="selectVal"]').val() == 'select') {
                content1 = ` <label for="input_type">نحوه نمایش</label>
                                <select class="form-control select2" name="input_type" style="width: 100%;">
                                    <option value="" disabled selected class="form-control">نحوه نمایش</option>
                                    <option value="checkbox" @if('checkbox' == $attribute->input_type)
                selected @endif class="form-control">سلکت افقی</option>
                                    <option value="select" @if('select' == $attribute->input_type)
                selected @endif class="form-control">دراپ دان</option>
                                    {{--                                    <option value="both" @if('both' == old('advertiser'))--}}
                {{--                                    selected @endif class="form-control">هردو</option>--}}
                </select>
                <small class="text-danger">{{ $errors->first('input_type') }}</small>`;
                content4 = `<label class="col-form-label">مشخصه تعریف شده دارای حداقل و حداکثر باشد؟</label>
                                    <input class="icheckbox_minimal" type="checkbox" name="hasScale"
                                           @if($attribute->hasScale==1) checked @endif>`;

                jQuery('div[id="selectType"]').empty();
                jQuery('div[id="selectType"]').append(content1);
                jQuery('div[id="hasScale"]').empty();
                jQuery('div[id="hasScale"]').append(content4);
                {{--content5 = `<label for="alt_value">عنوان جایگزین</label>--}}
                {{--                <input type="text" name="alt_value" class="form-control" value="{{($attribute->alt_value)}}"--}}
                {{--                       autofocus>--}}
                {{--                <small class="text-danger">{{ $errors->first('alt_value') }}</small>`;--}}
                {{--jQuery('div[id="alt_value"]').empty();--}}
                {{--jQuery('div[id="alt_value"]').append(content5);--}}
            }
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="attribute_type"]').on('change', function () {
                jQuery('div[id="hasScale"]').empty();
                jQuery('div[id="alt_value"]').empty();
                var attribute_type = jQuery(this).val();
                if (attribute_type == 'select') {
                    content1 = ` <label for="input_type">نحوه نمایش</label>
                                <select class="form-control select2" name="input_type" style="width: 100%;">
                                    <option value="" disabled selected class="form-control">نحوه نمایش</option>
                                    <option value="checkbox" @if('checkbox' == $attribute->input_type)
                    selected @endif class="form-control">سلکت افقی</option>
                                    <option value="select" @if('select' == $attribute->input_type)
                    selected @endif class="form-control">دراپ دان</option>
                                    {{--                                    <option value="both" @if('both' == old('advertiser'))--}}
                    {{--                                    selected @endif class="form-control">هردو</option>--}}
                    </select>
                    <small class="text-danger">{{ $errors->first('input_type') }}</small>`;
                    content4 = `<label class="col-form-label">مشخصه تعریف شده دارای حداقل و حداکثر باشد؟</label>
                                    <input class="icheckbox_minimal" type="checkbox" name="hasScale"
@if($attribute->hasScale==1) checked @endif>`;
                    jQuery('div[id="selectType"]').empty();
                    jQuery('div[id="selectType"]').append(content1);
                    jQuery('div[id="hasScale"]').empty();
                    jQuery('div[id="hasScale"]').append(content4);
                    {{--content5 = `<label for="alt_value">عنوان جایگزین</label>--}}
                    {{--            <input type="text" name="alt_value" class="form-control" value="{{($attribute->alt_value)}}"--}}
                    {{--                   autofocus>--}}
                    {{--            <small class="text-danger">{{ $errors->first('alt_value') }}</small>`;--}}
                    {{--jQuery('div[id="alt_value"]').empty();--}}
                    {{--jQuery('div[id="alt_value"]').append(content5);--}}

                } else {
                    jQuery('div[id="selectType"]').empty();
                }

                if (attribute_type == 'int') {
                    content4 = `<label class="col-form-label">مشخصه تعریف شده دارای حداقل و حداکثر باشد؟</label>
                                    <input class="icheckbox_minimal" type="checkbox" name="hasScale"
@if($attribute->hasScale==1) checked @endif>`;
                    jQuery('div[id="hasScale"]').empty();
                    jQuery('div[id="hasScale"]').append(content4);
                    content5 = `<label for="alt_value">عنوان جایگزین</label>
                                <input type="text" name="alt_value" class="form-control" value="{{($attribute->alt_value)}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('alt_value') }}</small>`;
                    jQuery('div[id="alt_value"]').empty();
                    jQuery('div[id="alt_value"]').append(content5);
                } else {
                }
                if (attribute_type == 'bool') {
                    jQuery('div[id="palceHolderr"]').empty();

                } else {
                    content3 = ` <label for="title">Place holder</label>
                                <input type="text" name="placeHolder" class="form-control"
                                       value="{{$attribute->placeHolder}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('placeHolder') }}</small>`;
                    jQuery('div[id="palceHolderr"]').empty();
                    jQuery('div[id="palceHolderr"]').append(content3);
                }

            });
        });
    </script>

@endsection

