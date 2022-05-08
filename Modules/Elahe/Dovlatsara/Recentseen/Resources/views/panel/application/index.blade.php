@extends('RealestateMaster::master')
@section('title_realestate') درخواست های دسده شده
@endsection
@section('card_title')درخواست های دیده شده توسط شما
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/product.css')}}">

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2.css')}}">

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/materialdesignicons.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/materialdesignicons.css.map')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/homePage.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/style.css')}}">
@endsection

@section('content_realestateMaster')
    <main>
        <!-- show product -->
        <section class="show-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12 d-lg-block d-none">
                        <div class="sidebar-wrapper search-sidebar">
                            <div class="box-sidebar">
                                <div class="catalog grouping">
                                    <div class="sidebar-title">
                                        <p>دسته بندی ها</p>
                                    </div>
                                    <ul class="catalog-list">
                                        @foreach($categories as $key=>$cat1)
                                            <li>
                                                <div class="type-category accordion-item">
                                                    <form action="{{route('applications.seen.realestate')}}" method="get"
                                                          id="level1{{$cat1->id}}">
                                                        <input hidden name="category"
                                                               value="{{$cat1->id}}">
                                                        <a onclick="document.getElementById('level1{{$cat1->id}}').submit()"
                                                           style="cursor: pointer"> {{$cat1->title}}</a>
                                                    </form>
                                                    @if($cat1->categories->count()>0)
                                                        <button type="button" class="catalog-link main accordion-button  @if($category1?$category1->id==$cat1->id:$key!=0) collapsed @endif"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#panelsStayOpen-collapseOne{{$cat1->id}}"
                                                                aria-expanded=" @if($category1?$category1->id==$cat1->id:$key==0) true @endif"
                                                                aria-controls="panelsStayOpen-collapseOne">
                                                            <i class="fa fa-chevron-down"></i>

                                                        </button>
                                                    @endif
                                                </div>
                                                @if($cat1->categories->count()>0)
                                                    <ul class="show-more accordion-collapse collapse @if($category1?$category1->parent_id==$cat1->id:$key==0) show @endif"
                                                        id="panelsStayOpen-collapseOne{{$cat1->id}}"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        @foreach($cat1->categories()->where('active', 1)->orderBy('order', 'asc')->get() as $cat_sub_1)
                                                            <li class="catalog-cat-item ">
                                                                <div class="type-category accordion-item">
                                                                    <form action="{{route('applications.seen.realestate')}}"
                                                                          method="get"
                                                                          id="level1{{$cat_sub_1->id}}"
                                                                          class="catalog-cat-item">

                                                                        <input hidden name="category"
                                                                               value="{{$cat_sub_1->id}}">
                                                                        <a style="cursor: pointer"
                                                                           onclick="document.getElementById('level1{{$cat_sub_1->id}}').submit()">{{$cat_sub_1->title}}</a>
                                                                    </form>
                                                                    @if($cat_sub_1->categories->count()>0)
                                                                        <button
                                                                            class="middle-div active accordion-button"
                                                                            type="button"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#panelsStayOpen-collapseTwo{{$cat_sub_1->id}}"
                                                                            aria-expanded="true"
                                                                            aria-controls="panelsStayOpen-collapseTwo">
                                                                            <i class="fa fa-chevron-down"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                                @if($cat_sub_1->categories->count()>0)
                                                                    <ul class="catalog-list inner-div accordion-collapse collapse show"
                                                                        id="panelsStayOpen-collapseTwo{{$cat_sub_1->id}}"
                                                                        aria-labelledby="panelsStayOpen-headingTwo">
                                                                        @foreach($cat_sub_1->categories()->where('active', 1)->orderBy('order', 'asc')->get() as $cat_sub_2)
                                                                            <li>
                                                                                <form
                                                                                    action="{{route('applications.seen.realestate')}}"
                                                                                    method="get"
                                                                                    id="level1{{$cat_sub_2->id}}">
                                                                                    <input hidden name="category"
                                                                                           value="{{$cat_sub_2->id}}">
                                                                                    <a style="cursor: pointer"
                                                                                       onclick="document.getElementById('level1{{$cat_sub_2->id}}').submit()"
                                                                                       class="catalog-link active">{{$cat_sub_2->title}}</a>
                                                                                </form>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

{{--                                <div class="catalog grouping">--}}
{{--                                    <span class="box-header-sidebar">دسته‌بندی ها</span>--}}
{{--                                    <ul class="catalog-list">--}}
{{--                                        @foreach($categories as $cat1)--}}

{{--                                            <li>--}}
{{--                                                <form action="{{route('applications.seen.realestate')}}" method="get"--}}
{{--                                                      id="level1{{$cat1->id}}" class="catalog-link main">--}}
{{--                                                    <input hidden name="category"--}}
{{--                                                           value="{{$cat1->id}}">--}}
{{--                                                    <a onclick="document.getElementById('level1{{$cat1->id}}').submit()"--}}
{{--                                                       class="catalog-link main @if($category1) @if($cat1->id==$category1->id) active @endif @endif"--}}
{{--                                                       style="cursor: pointer">--}}
{{--                                                        <i class="fa fa-angle-left"></i>{{$cat1->title}}</a>--}}
{{--                                                </form>--}}
{{--                                                @if($cat1->categories->count()>0)--}}
{{--                                                    <ul class="show-more">--}}
{{--                                                        @foreach($cat1->categories()->orderBy('order', 'asc')->get() as $cat_sub_1)--}}

{{--                                                            <li class="catalog-cat-item">--}}
{{--                                                                <form action="{{route('applications.seen.realestate')}}"--}}
{{--                                                                      method="get"--}}
{{--                                                                      id="level1{{$cat_sub_1->id}}"--}}
{{--                                                                      class="catalog-cat-item">--}}

{{--                                                                    <input hidden name="category"--}}
{{--                                                                           value="{{$cat_sub_1->id}}">--}}
{{--                                                                    <a style="cursor: pointer"--}}
{{--                                                                       onclick="document.getElementById('level1{{$cat_sub_1->id}}').submit()"--}}
{{--                                                                       class="middle-div @if($category1) @if($cat_sub_1->id==$category1->id) active @endif @endif"><i--}}
{{--                                                                            class="fa fa-angle-down"></i>{{$cat_sub_1->title}}--}}
{{--                                                                    </a>--}}
{{--                                                                </form>--}}
{{--                                                                @if($cat_sub_1->categories->count()>0)--}}

{{--                                                                    <ul class="catalog-list inner-div">--}}
{{--                                                                        @foreach($cat_sub_1->categories()->orderBy('order', 'asc')->get() as $cat_sub_2)--}}

{{--                                                                            <li>--}}
{{--                                                                                <form--}}
{{--                                                                                    action="{{route('applications.seen.realestate')}}"--}}
{{--                                                                                    method="get"--}}
{{--                                                                                    id="level1{{$cat_sub_2->id}}"--}}
{{--                                                                                    class="catalog-link">--}}

{{--                                                                                    <input hidden name="category"--}}
{{--                                                                                           value="{{$cat_sub_2->id}}">--}}
{{--                                                                                    <a style="cursor: pointer"--}}
{{--                                                                                       onclick="document.getElementById('level1{{$cat_sub_2->id}}').submit()"--}}
{{--                                                                                       class="catalog-link @if($category1) @if($cat_sub_2->id==$category1->id) active @endif @endif">--}}
{{--                                                                                        {{$cat_sub_2->title}}--}}
{{--                                                                                    </a>--}}
{{--                                                                                </form>--}}
{{--                                                                            </li>--}}
{{--                                                                        @endforeach--}}
{{--                                                                    </ul>--}}
{{--                                                                @endif--}}
{{--                                                            </li>--}}
{{--                                                        @endforeach--}}
{{--                                                    </ul>--}}
{{--                                                @endif--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}

{{--                                    </ul>--}}
{{--                                </div>--}}
                            </div>

                            <form class="form-horizontal"
                                  id="attributes_form_filter_page"
                                  {{--action="{{route('applications.seen.filter.realestate')}}"--}}

                                  method="post">
                                @csrf
                                @if($category1)

                                    <input hidden name="category" value="{{$category1->id}}">
                                @endif
                                {{--                                <button type="submit" class="btn btn-primary">ihiughuyigh</button>--}}

                                <div class="box-sidebar">
                                    <span class="box-header-sidebar activeacc"><i class="fa fa-chevron-down arrow"></i>شهر و محله</span>
                                    <div class="catalog" style="display: none;">
                                        <div class="select-box">
                                            <select class="js-example-basic-multiple city" style="width: 100%;"
                                                    name="city">
                                                <option value="all">شهر</option>

                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{$city->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="select-box">
                                            <select class="js-example-basic-multiple neighborhood" style="width: 100%;"
                                                    name="neighborhood[]" multiple="multiple">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="attrFilter">
                                    @if(($attributeGroups))
                                        @foreach($attributeGroups as $attrGroup)
                                            @foreach($attrGroup->attributes->where('isFilterField', 1) as $attr)
                                                @if($attr->attribute_type == 'int')
                                                    <div class="box-sidebar">
                                                <span class="box-header-sidebar "> <i
                                                        class="fa fa-chevron-down arrow"></i>حدود {{$attr->title}}</span>
                                                        <div class="catalog" style="display: none;">
                                                            <div class="price minimum">
                                                                <p>حداقل {{$attr->title}}:</p>
                                                                <input type="text"
                                                                       name="attributeTypeNumber[{{$attr->id}}][min]"
                                                                       class="minimum-price attributeTypeNumber"
                                                                       onkeyup="separateNum(this.value,this);">
                                                            </div>
                                                            <div class="price maximum">
                                                                <p>حداکثر {{$attr->title}}:</p>
                                                                <input type="text"
                                                                       name="attributeTypeNumber[{{$attr->id}}][max]"
                                                                       class="maximum-price attributeTypeNumber"
                                                                       onkeyup="separateNum(this.value,this);">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($attr->attribute_type == 'bool')
                                                    <div class="box-sidebar">
                                                        <div class="filter-switch">
                                                            <div class="switch-box">
                                                                <div class="centered hidden-xs">
                                                                    <div class="">
                                                                        <label for="switch2{{$attr->id}}">
                                                                            <input type="checkbox"
                                                                                   class="attributeTypeBool"
                                                                                   value="1"
                                                                                   id="switch2{{$attr->id}}"
                                                                                   name="attributeTypeBool[{{$attr->id}}][]"><span
                                                                                class="switch">
                                                                            <h1 class="switch-title">{{$attr->title}}</h1></span>
                                                                            <span class="toggle"></span>
                                                                        </label>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @elseif($attr->attribute_type == 'select')
                                                    <div class="box-sidebar">
                                                <span class="box-header-sidebar activeacc"><i
                                                        class="fa fa-chevron-down arrow"></i>حدود {{$attr->title}}</span>
                                                        <div class="catalog" style="display: none;">
                                                            <div class="select-box">
                                                                <p>حداقل {{$attr->title}}:</p>
                                                                <select
                                                                    class="js-example-basic-multiple attributeTypeSelect"
                                                                    style="width: 100%;"
                                                                    name="attributeTypeSelect[{{$attr->id}}][min]">
                                                                    <option value="">{{$attr->placeHolder}}</option>
                                                                    @foreach($attr->attributeItems as $item)
                                                                        <option
                                                                            value="{{$item->id}}">{{$item->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="select-box">
                                                                <p>حداکثر {{$attr->title}}:</p>

                                                                <select
                                                                    class="js-example-basic-multiple attributeTypeSelect"
                                                                    style="width: 100%;"
                                                                    name="attributeTypeSelect[{{$attr->id}}][max]">
                                                                    <option value="">{{$attr->placeHolder}}</option>
                                                                    @foreach($attr->attributeItems as $item)
                                                                        <option
                                                                            value="{{$item->id}}">{{$item->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif

                                </div>

                            </form>


                            <!--   adplacement -------------------->

                            <!--   adplacement -------------------->

                        </div>
                    </div>

                    <div class="col-lg-9 col-12">

                        <div class="resent-product">
                            <div class="container">
                                <div class="resent-product-title">

                                    <h4>آخرین درخواست ها</h4>

                                </div>
                                <div class="header-product-box-left mb-4">

                                    <div class="filter d-lg-none">
                                        <button type="button" class="RecBtn red show" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal2">
                                            فیلتر‌های بیشتر
                                        </button>
                                        <div class="modal fade" id="exampleModal2" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">فیلترها</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="sidebar-wrapper search-sidebar">
                                                            <div class="box-sidebar">
                                                                <div class="catalog grouping">
                                                                    <div class="sidebar-title">
                                                                        <p>دسته بندی ها</p>
                                                                    </div>
                                                                    <ul class="catalog-list">
                                                                        @foreach($categories as $key=>$cat1)
                                                                            <li>
                                                                                <div class="type-category accordion-item">
                                                                                    <form action="{{route('applications.seen.realestate')}}" method="get"
                                                                                          id="level1{{$cat1->id}}">
                                                                                        <input hidden name="category"
                                                                                               value="{{$cat1->id}}">
                                                                                        <a onclick="document.getElementById('level1{{$cat1->id}}').submit()"
                                                                                           style="cursor: pointer"> {{$cat1->title}}</a>
                                                                                    </form>
                                                                                    @if($cat1->categories->count()>0)
                                                                                        <button type="button" class="catalog-link main accordion-button  @if($category1?$category1->id==$cat1->id:$key!=0) collapsed @endif"
                                                                                                data-bs-toggle="collapse"
                                                                                                data-bs-target="#panelsStayOpen-collapseOne{{$cat1->id}}"
                                                                                                aria-expanded=" @if($category1?$category1->id==$cat1->id:$key==0) true @endif"
                                                                                                aria-controls="panelsStayOpen-collapseOne">
                                                                                            <i class="fa fa-chevron-down"></i>

                                                                                        </button>
                                                                                    @endif
                                                                                </div>
                                                                                @if($cat1->categories->count()>0)
                                                                                    <ul class="show-more accordion-collapse collapse @if($category1?$category1->parent_id==$cat1->id:$key==0) show @endif"
                                                                                        id="panelsStayOpen-collapseOne{{$cat1->id}}"
                                                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                                                        @foreach($cat1->categories()->orderBy('order', 'asc')->get() as $cat_sub_1)
                                                                                            <li class="catalog-cat-item ">
                                                                                                <div class="type-category accordion-item">
                                                                                                    <form action="{{route('applications.seen.realestate')}}"
                                                                                                          method="get"
                                                                                                          id="level1{{$cat_sub_1->id}}"
                                                                                                          class="catalog-cat-item">

                                                                                                        <input hidden name="category"
                                                                                                               value="{{$cat_sub_1->id}}">
                                                                                                        <a style="cursor: pointer"
                                                                                                           onclick="document.getElementById('level1{{$cat_sub_1->id}}').submit()">{{$cat_sub_1->title}}</a>
                                                                                                    </form>
                                                                                                    @if($cat_sub_1->categories->count()>0)
                                                                                                        <button
                                                                                                            class="middle-div active accordion-button"
                                                                                                            type="button"
                                                                                                            data-bs-toggle="collapse"
                                                                                                            data-bs-target="#panelsStayOpen-collapseTwo{{$cat_sub_1->id}}"
                                                                                                            aria-expanded="true"
                                                                                                            aria-controls="panelsStayOpen-collapseTwo">
                                                                                                            <i class="fa fa-chevron-down"></i>
                                                                                                        </button>
                                                                                                    @endif
                                                                                                </div>
                                                                                                @if($cat_sub_1->categories->count()>0)
                                                                                                    <ul class="catalog-list inner-div accordion-collapse collapse show"
                                                                                                        id="panelsStayOpen-collapseTwo{{$cat_sub_1->id}}"
                                                                                                        aria-labelledby="panelsStayOpen-headingTwo">
                                                                                                        @foreach($cat_sub_1->categories()->orderBy('order', 'asc')->get() as $cat_sub_2)
                                                                                                            <li>
                                                                                                                <form
                                                                                                                    action="{{route('applications.seen.realestate')}}"
                                                                                                                    method="get"
                                                                                                                    id="level1{{$cat_sub_2->id}}">
                                                                                                                    <input hidden name="category"
                                                                                                                           value="{{$cat_sub_2->id}}">
                                                                                                                    <a style="cursor: pointer"
                                                                                                                       onclick="document.getElementById('level1{{$cat_sub_2->id}}').submit()"
                                                                                                                       class="catalog-link active">{{$cat_sub_2->title}}</a>
                                                                                                                </form>
                                                                                                            </li>
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                @endif
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>

{{--                                                                <div class="catalog grouping">--}}
{{--                                                                    <span class="box-header-sidebar">دسته‌بندی ها</span>--}}
{{--                                                                    <ul class="catalog-list">--}}
{{--                                                                        @foreach($categories as $cat1)--}}

{{--                                                                            <li>--}}
{{--                                                                                <form--}}
{{--                                                                                    action="{{route('applications.seen.realestate')}}"--}}
{{--                                                                                    method="get"--}}
{{--                                                                                    id="level1{{$cat1->id}}"--}}
{{--                                                                                    class="catalog-link main">--}}
{{--                                                                                    <input hidden name="category"--}}
{{--                                                                                           value="{{$cat1->id}}">--}}
{{--                                                                                    <a onclick="document.getElementById('level1{{$cat1->id}}').submit()"--}}
{{--                                                                                       class="catalog-link main @if($category1) @if($cat1->id==$category1->id) active @endif @endif"--}}
{{--                                                                                       style="cursor: pointer">--}}
{{--                                                                                        <i class="fa fa-angle-left"></i>{{$cat1->title}}--}}
{{--                                                                                    </a>--}}
{{--                                                                                </form>--}}
{{--                                                                                @if($cat1->categories->count()>0)--}}
{{--                                                                                    <ul class="show-more">--}}
{{--                                                                                        @foreach($cat1->categories()->orderBy('order', 'asc')->get() as $cat_sub_1)--}}

{{--                                                                                            <li class="catalog-cat-item">--}}
{{--                                                                                                <form--}}
{{--                                                                                                    action="{{route('applications.seen.realestate')}}"--}}
{{--                                                                                                    method="get"--}}
{{--                                                                                                    id="level1{{$cat_sub_1->id}}"--}}
{{--                                                                                                    class="catalog-cat-item">--}}

{{--                                                                                                    <input hidden--}}
{{--                                                                                                           name="category"--}}
{{--                                                                                                           value="{{$cat_sub_1->id}}">--}}
{{--                                                                                                    <a style="cursor: pointer"--}}
{{--                                                                                                       onclick="document.getElementById('level1{{$cat_sub_1->id}}').submit()"--}}
{{--                                                                                                       class="middle-div @if($category1) @if($cat_sub_1->id==$category1->id) active @endif @endif"><i--}}
{{--                                                                                                            class="fa fa-angle-down"></i>{{$cat_sub_1->title}}--}}
{{--                                                                                                    </a>--}}
{{--                                                                                                </form>--}}
{{--                                                                                                @if($cat_sub_1->categories->count()>0)--}}

{{--                                                                                                    <ul class="catalog-list inner-div">--}}
{{--                                                                                                        @foreach($cat_sub_1->categories()->orderBy('order', 'asc')->get() as $cat_sub_2)--}}

{{--                                                                                                            <li>--}}
{{--                                                                                                                <form--}}
{{--                                                                                                                    action="{{route('applications.seen.realestate')}}"--}}
{{--                                                                                                                    method="get"--}}
{{--                                                                                                                    id="level1{{$cat_sub_2->id}}"--}}
{{--                                                                                                                    class="catalog-link">--}}

{{--                                                                                                                    <input--}}
{{--                                                                                                                        hidden--}}
{{--                                                                                                                        name="category"--}}
{{--                                                                                                                        value="{{$cat_sub_2->id}}">--}}
{{--                                                                                                                    <a style="cursor: pointer"--}}
{{--                                                                                                                       onclick="document.getElementById('level1{{$cat_sub_2->id}}').submit()"--}}
{{--                                                                                                                       class="catalog-link @if($category1) @if($cat_sub_2->id==$category1->id) active @endif @endif">--}}
{{--                                                                                                                        {{$cat_sub_2->title}}--}}
{{--                                                                                                                    </a>--}}
{{--                                                                                                                </form>--}}
{{--                                                                                                            </li>--}}
{{--                                                                                                        @endforeach--}}
{{--                                                                                                    </ul>--}}
{{--                                                                                                @endif--}}
{{--                                                                                            </li>--}}
{{--                                                                                        @endforeach--}}
{{--                                                                                    </ul>--}}
{{--                                                                                @endif--}}
{{--                                                                            </li>--}}
{{--                                                                        @endforeach--}}
{{--                                                                    </ul>--}}
{{--                                                                </div>--}}
                                                            </div>

                                                            <form class="form-horizontal"
                                                                  id="attributes_form_modal"
                                                                  method="post">
                                                                @csrf
                                                                @if($category1)

                                                                    <input hidden name="category"
                                                                           value="{{$category1->id}}">
                                                                @endif

                                                                <div class="box-sidebar">
                                                                    <span class="box-header-sidebar activeacc"><i
                                                                            class="fa fa-chevron-down arrow"></i>شهر</span>
                                                                    <div class="catalog" style="display: none;">
                                                                        <div class="select-box">
                                                                            <select
                                                                                class="js-example-basic-multiple cityModal"
                                                                                style="width: 100%;" name="cityModal">
                                                                                <option value="all">شهر</option>
                                                                                @foreach($cities as $city)
                                                                                    <option
                                                                                        value="{{$city->id}}">{{$city->title}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="select-box">
                                                                            <select
                                                                                class="js-example-basic-multiple neighborhoodModal"
                                                                                style="width: 100%;"
                                                                                name="neighborhoodModal[]"
                                                                                multiple="multiple">
                                                                                <option value="">محله</option>
                                                                                @foreach($cities as $city)
                                                                                    <option
                                                                                        value="{{$city->id}}">{{$city->title}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if(($attributeGroups))

                                                                    @foreach($attributeGroups as $attrGroup)
                                                                        @foreach($attrGroup->attributes->where('isFilterField', 1) as $attr)
                                                                            @if($attr->attribute_type == 'int')
                                                                                <div class="box-sidebar">
                                                                                <span class="box-header-sidebar "> <i
                                                                                        class="fa fa-chevron-down arrow"></i>حدود {{$attr->title}}</span>
                                                                                    <div class="catalog"
                                                                                         style="display: none;">
                                                                                        <div class="price minimum">
                                                                                            <p>حداقل {{$attr->title}}
                                                                                                :</p>
                                                                                            <input type="text"
                                                                                                   name="attributeTypeNumber2[{{$attr->id}}][min]"
                                                                                                   class="minimum-price attributeTypeNumber2"
                                                                                                   onkeyup="separateNum(this.value,this);">
                                                                                        </div>
                                                                                        <div class="price maximum">
                                                                                            <p>حداکثر {{$attr->title}}
                                                                                                :</p>
                                                                                            <input type="text"
                                                                                                   name="attributeTypeNumber2[{{$attr->id}}][max]"
                                                                                                   class="maximum-price attributeTypeNumber2"
                                                                                                   onkeyup="separateNum(this.value,this);">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @elseif($attr->attribute_type == 'bool')
                                                                                <div class="box-sidebar">
                                                                                    <div class="filter-switch">
                                                                                        <div class="switch-box">
                                                                                            <div
                                                                                                class="centered hidden-xs">
                                                                                                <div class="">
                                                                                                    <a href="#">
                                                                                                        <label
                                                                                                            for="1switch2{{$attr->id}}">
                                                                                                            <input
                                                                                                                type="checkbox"
                                                                                                                class="attributeTypeBool2"
                                                                                                                value="1"
                                                                                                                id="1switch2{{$attr->id}}"
                                                                                                                name="attributeTypeBool2[{{$attr->id}}][]"><span
                                                                                                                class="switch">
                                                                            <h1 class="switch-title">{{$attr->title}}</h1></span>
                                                                                                            <span
                                                                                                                class="toggle"></span>
                                                                                                        </label>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <br>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            @elseif($attr->attribute_type == 'select')
                                                                                <div class="box-sidebar">
                                                <span class="box-header-sidebar activeacc"><i
                                                        class="fa fa-chevron-down arrow"></i>{{$attr->title}}</span>
                                                                                    <div class="catalog"
                                                                                         style="display: none;">
                                                                                        <div class="select-box">
                                                                                            <select
                                                                                                class="js-example-basic-multiple attributeTypeSelect"
                                                                                                style="width: 100%;"
                                                                                                name="attributeTypeSelect[{{$attr->id}}][]"
                                                                                                multiple="multiple">
                                                                                                @foreach($attr->attributeItems as $item)
                                                                                                    <option
                                                                                                        value="{{$item->id}}">{{$item->title}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach
                                                                @endif
                                                            </form>
                                                            <!--   adplacement -------------------->

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="RecBtn white operate "
                                                                data-bs-dismiss="modal">بستن
                                                        </button>
                                                        <button type="button" class="RecBtn red close">اعمال
                                                            تغییرات
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="accordion" id="accordionExample">
                                    <div class="row" id="firstPageFilterAdvertiser2Div">
                                        @foreach($applications as $key=>$application)

                                            <div class="col-lg-6 mb-4">

                                                <div class="request-card">

                                                    <div class="request-title">

                                                        <p>{{$application->title}}</p>
                                                    </div>
                                                    <div
                                                        class="request-save d-flex align-items-center justify-content-between  mt-2">
                                                        <ul class="request-tags">
                                                            {{\Modules\Category\Entities\Category::where('id', $application->category_id)->first()->createStringAsParents3()}}

                                                        </ul>
                                                        <div class="bookmark">
                                                            {{--                                                        <i class="fa fa-bookmark"></i>--}}
                                                        </div>
                                                    </div>

                                                    <ul class="request-main-info">
                                                        <li>
                                                            <P class="request-info-title">شهر :</P>
                                                            <p class="request-main-info-data">{{$application->city->title}}</p>
                                                        </li>
                                                        <li>
                                                            <P class="request-info-title">تاریخ درخواست :</P>
                                                            <p class="request-main-info-data">{{verta($application->startDate)->formatJalaliDate()}}</p>
                                                        </li>
                                                        <li>
                                                            @if($application->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first())
                                                                <P class="request-info-title">{{$application->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()->title}}
                                                                    :</P>
                                                                @if($application->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()->hasScale)
                                                                    <p class="request-main-info-data">{{\Modules\AttributeItem\Entities\AttributeItem::where('id',$application->attributes->where('isSignificant', 1)
                                                            ->where('attribute_type', 'select')->first()->pivot->attribute_item_id1)
                                                                            ->first()->title}}-{{\Modules\AttributeItem\Entities\AttributeItem::where('id',$application->attributes->where('isSignificant', 1)
                                                            ->where('attribute_type', 'select')->first()->pivot->attribute_item_id2)
                                                                            ->first()->title}}</p>
                                                                @else
                                                                    <p class="request-main-info-data">{{\Modules\AttributeItem\Entities\AttributeItem::where('id',$application->attributes->where('isSignificant', 1)
                                                            ->where('attribute_type', 'select')->first()->pivot->attribute_item_id1)
                                                                            ->first()->title}}</p>
                                                                @endif
                                                            @endif
                                                        </li>
                                                        <li>
                                                            @if($application->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())

                                                                <P class="request-info-title">{{$application->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->title}}
                                                                    :</P>
                                                                @if($application->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->hasScale)

                                                                    <p class="request-main-info-data">
                                                                        {{number_format($application->attributes->where('isSignificant', 1)
                                                                                ->where('attribute_type', 'int')->first()->pivot->value1)}}
                                                                        -{{number_format($application->attributes->where('isSignificant', 1)
                                                                                ->where('attribute_type', 'int')->first()->pivot->value2)}} {{($application->attributes->where('isSignificant', 1)
                                                                                ->where('attribute_type', 'int')->first()->unit)}}
                                                                    </p>
                                                                @else
                                                                    <p class="request-main-info-data">
                                                                        {{number_format($application->attributes->where('isSignificant', 1)
                                                                                ->where('attribute_type', 'int')->first()->pivot->value1)}} {{($application->attributes->where('isSignificant', 1)
                                                                                ->where('attribute_type', 'int')->first()->unit)}}
                                                                    </p>
                                                                @endif
                                                            @endif
                                                        </li>

                                                    </ul>
                                                    <div class="accordion-item">
                                                        <div id="collapse{{$key}}" class="accordion-collapse collapse"
                                                             aria-labelledby="headingOne"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                @if($application->attributes->count()>0)

                                                                    <ul class="request-minor-info">
                                                                        @foreach($application->attributes as $attribute)
                                                                            @if($attribute->attribute_type=='int')
                                                                                @if($application->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first() && $application->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id!=$attribute->id)
                                                                                    <li>
                                                                                        <P class="request-info-title">{{$attribute->title}}
                                                                                            :</P>
                                                                                        <p class="request-minor-info-data">

                                                                                            @if(isset($attribute->pivot->value2))
                                                                                                <span>
                                                                            {{number_format($attribute->pivot->value1)}}
                                                                                            </span>
                                                                                                <span>  تا {{number_format($attribute->pivot->value2)}} </span>{{($attribute->unit)}}
                                                                                                {{--                                                            <p>از {{$attribute->pivot->value1}} تا {{$attribute->pivot->value2}} </p>--}}
                                                                                            @else
                                                                                                <span>{{number_format($attribute->pivot->value1)}} {{($attribute->unit)}}</span>
                                                                                            @endif
                                                                                        </p>
                                                                                    </li>
                                                                                @endif
                                                                            @elseif($attribute->attribute_type=='select')
                                                                                @if($application->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first() && $application->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()->id!=$attribute->id)

                                                                                    <li>
                                                                                        <P class="request-info-title">{{$attribute->title}}
                                                                                            :</P>
                                                                                        <p class="request-minor-info-data">
                                                                                            @if(isset($attribute->pivot->attribute_item_id2))
                                                                                                {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$attribute->pivot->attribute_item_id1)
                                                                        ->first()->title}}- {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$attribute->pivot->attribute_item_id2)
                                                                ->first()->title}}

                                                                                            @else
                                                                                                {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$attribute->pivot->attribute_item_id1)
                                                                                                                                                                    ->first()->title}}
                                                                                            @endif
                                                                                        </p>
                                                                                    </li>
                                                                                @endif
                                                                            @elseif($attribute->attribute_type=='string')
                                                                                <li>
                                                                                    <P class="request-info-title">{{$attribute->title}}
                                                                                        :</P>
                                                                                    <p class="request-minor-info-data">
                                                                                        <span>{{($attribute->pivot->value1)}} {{($attribute->unit)}}</span>

                                                                                    </p>
                                                                                </li>
                                                                            @elseif($attribute->attribute_type=='bool')
                                                                                <li>
                                                                                    <P class="request-info-title">{{$attribute->title}}
                                                                                        :</P>
                                                                                    <p class="request-minor-info-data">
                                                                                        <span><i
                                                                                                class="fa fa-check"></i></span>

                                                                                    </p>
                                                                                </li>

                                                                            @endif
                                                                        @endforeach
                                                                        <li>
                                                                            <P class="request-info-title">محله:</P>
                                                                            <p class="request-minor-info-data">
                                                                                @if(($application->neighborhoods()->count()>0))

                                                                                    @foreach($application->neighborhoods as $neighborhood)
                                                                                        {{\Modules\Neighborhood\Entities\Neighborhood::find($neighborhood->neighborhood_id)->title}}
                                                                                        /
                                                                                    @endforeach
                                                                                @endif
                                                                            </p>
                                                                        </li>

                                                                    </ul>
                                                                @endif
                                                                <div class="extra-info">
                                                                    <P class="request-info-title">توضیحات :</P>
                                                                    <div class="textarea">
                                                                        <p>{{$application->description}}</p></div>
                                                                    {{--                                                                <textarea rows="5"></textarea>--}}

                                                                </div>
                                                                <div class="contact-call-info">
                                                                    <button data-bs-toggle="collapse"
                                                                            data-bs-target="#multiCollapseExample{{$application->id}}"
                                                                            aria-expanded="false"
                                                                            aria-controls="multiCollapseExample{{$application->id}}"
                                                                            onclick="contact({{$application->id}})">
                                                                        اطلاعات
                                                                        تماس
                                                                    </button>
                                                                    <div class="collapse multi-collapse"
                                                                         id="multiCollapseExample{{$application->id}}">
                                                                        <div class="card card-body contact-info"
                                                                            {{--                                                                             id="contact-info"--}}
                                                                        >
                                                                            {{--                                                                            <div class="request-contact-info">--}}
                                                                            {{--                                                                                <p>{{$application->user->name}} {{$application->user->sirName}}</p>--}}
                                                                            {{--                                                                                <p>{{$application->phone}}</p>--}}
                                                                            {{--                                                                            </div>--}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h2 class="accordion-header" id="heading{{$key}}">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapse{{$key}}"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapse{{$key}}"
                                                                    onclick="setSeen({{$application->id}})">
                                                                اطلاعات بیشتر
                                                            </button>
                                                        </h2>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- show product -->

    </main>
    <!-- end of main -->
@endsection
@section('js_realestate')
    <script>
        function contact(applicationId) {
            $('.contact-info').empty();
            jQuery.ajax({
                url: "{{route('applications.contact.realestate')}}",
                data: {
                    'applicationId': applicationId
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('.contact-info').append(data.content)
                }
            });
        }
    </script>
    <script>
        function setSeen(applicationId) {
            jQuery.ajax({
                url: "{{route('applications.recentSeen.realestate')}}",
                data: {
                    'applicationId': applicationId
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                }
            });
        }
    </script>
    <script src="{{asset('files/userMaster/assets/js/main.js')}}"></script>
    <script src="{{asset('files/userMaster/assets/js/bootstrap.js')}}"></script>

    <script>
        $('#sidebarCollapseChange').addClass('sidebar-collapse');
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="city"]').on('change', function () {
                var cityId = jQuery(this).val();
                if (cityId) {
                    jQuery.ajax({
                        url: "{{route('gettingNeighborhood')}}",
                        data: {
                            'city': cityId
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            jQuery('select[name="neighborhood[]"]').empty();
                            $('select[name="neighborhood[]"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="neighborhood[]"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="neighborhood[]"]').empty();
                }
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="cityModal"]').on('change', function () {
                var cityId = jQuery(this).val();
                if (cityId) {
                    console.log(cityId)
                    jQuery.ajax({
                        url: "{{route('gettingNeighborhood')}}",
                        data: {
                            'city': cityId
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            jQuery('select[name="neighborhoodModal[]"]').empty();
                            $('select[name="neighborhoodModal[]"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="neighborhoodModal[]"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="neighborhoodModal[]"]').empty();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#attributes_form_filter_page').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('applications.seen.filter.realestate')}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#firstPageFilterAdvertiser2Div').empty();
                        $('#firstPageFilterAdvertiser2Div').append(data.content);
                    }
                })
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#attributes_form_modal').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('applications.seen.filter.realestate')}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {

                        $('#firstPageFilterAdvertiser2Div').empty();
                        $('#firstPageFilterAdvertiser2Div').append(data.content);
                    }
                })
            });
        });
    </script>
    <script>
        jQuery(document).ready(function () {
            $('.attributeTypeNumber').on('keypress', function (e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    $("#attributes_form_filter_page").submit();
                }
            });
        })
        $('.catInForm').on('click', function (e) {
            $("#attributes_form_filter_page").submit();
        });
        $('.attributeTypeBool').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
        $('.city').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
        $('.neighborhood').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
        $('.attributeTypeSelect').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
        jQuery(document).ready(function () {
            $('.attributeTypeNumber2').on('keypress', function (e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    $("#attributes_form_modal").submit();
                }
            });
        })
        $('.catModal').on('click', function (e) {
            $("#attributes_form_modal").submit();
        });
        $('.attributeTypeBool2').change(function (e) {
            $("#attributes_form_modal").submit();
        });
        $('.cityModal').change(function (e) {
            $("#attributes_form_modal").submit();
        });
        $('.neighborhoodModal').change(function (e) {
            $("#attributes_form_modal").submit();
        });
    </script>
@endsection
