@extends('UserMasterNew::master')
@section('title_user')آگهی ها
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/homePage.css')}}">

@endsection
@section('content_userMasterNew')
    <main>
        <div class="header-search-box">
            <div class="container">
                <div class="search-box">
                    <div class="row">

                        <div class="input-box my-4 px-3 justify-content-center product-search-box-parent">
                            {{--                            <div class="row">--}}
                            <form action="{{route('searchSupplierAds.user')}}" method="get"
                                  class="product-search-box-form">
                                {{--                                @csrf--}}
                                <select name="cat" id="cat">
                                    <option value="">دنبال چی میگردی؟</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                                <input type="input" name="search" value="{{old('search')}}" class="header-input large"
                                       placeholder="عنوان یا شماره آگهی...">
                                <button class="RecBtn red">جستجو</button>
                            </form>
                            <br>
                            {{--                            </div>--}}
                            {{--                            <div class="row d-flex">--}}
                            {{--                                <div class="col-md-12">--}}
                            @if(session()->has('mm'))
                                <div class="text-danger">{{ session()->get('mm') }}</div>
                            @endif
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>

                        {{--                        <div class="input-box my-4 px-3">--}}
                        {{--                            @foreach($categories as $category)--}}
                        {{--                                @component('UserMaster::components.searchInSupplierAds',--}}
                        {{--                                ['id'=>$category->id,--}}
                        {{--                                'title'=>$category->title--}}
                        {{--                                ])--}}

                        {{--                                @endcomponent--}}
                        {{--                            @endforeach--}}
                        {{--                        </div>--}}
                    </div>


                    <div class="search-map">
                        <a href="#">
                            {{--                            <img src2="{{asset('files/userMaster/assets/img/download (2).jpg')}}" alt="">--}}
                            {{--                            <span>جستجو روی نقشه</span>--}}
                        </a>

                    </div>
                </div>

            </div>

        </div>


        <!-- show product -->
        <section class="show-product">
            <div class="container">
                <div class="row">


                    <div class="col-lg-3 col-md-4 col-xs-12 d-lg-block d-none">
                        <div class="sidebar-wrapper search-sidebar">
                            <form class="form-horizontal" id="attributes_form_filter_page"
                                  method="get">
                                <div class="box-sidebar">
                                    <span class="box-header-sidebar">دسته‌بندی نتایج</span>
                                    <div class="catalog">
                                        <ul class="catalog-list">
                                            @foreach($categories as $cat1)
                                                <li>
                                                    <div class="catInForm" style="cursor: pointer">
                                                        {{--                                                    <form id="myf{{$cat1->id}}" name="myf{{$cat1->id}}"--}}
                                                        {{--                                                          onclick="document.forms['myf{{$cat1->id}}'].submit()"--}}
                                                        {{--                                                          style="cursor: pointer; height: 10px"--}}
                                                        {{--                                                          action="{{route('supplierFilterPage.user')}}" method="get"--}}
                                                        {{--                                                  href="{{route('supplierFilterPage.user', $cat1->id)}}"--}}
                                                        {{--                                                    >--}}
                                                        {{--                                                @csrf--}}
                                                        {{--                                                <a onclick="document.getElementById('idid{{$cat1->id}}').submit()"></a>--}}

                                                        <input hidden type="radio" name="categoryInForm"
                                                               id="{{$cat1->id}}" value="{{$cat1->id}}">
                                                        <i class="fa fa-angle-left"></i>
                                                        <label for="{{$cat1->id}}"
                                                               style="cursor: pointer">{{$cat1->title}}</label>
                                                        {{--                            </form>--}}
                                                    </div>
                                                    <div class="show-more">
                                                        @foreach($cat1->categories as $cat_sub_1)
                                                            <div class="catInForm">
                                                                {{--                                                            <form id="myf{{$cat_sub_1->id}}"--}}
                                                                {{--                                                                  name="myf{{$cat_sub_1->id}}"--}}
                                                                {{--                                                                  onclick="document.forms['myf{{$cat_sub_1->id}}'].submit()"--}}
                                                                {{--                                                                  style="cursor: pointer; height: 10px"--}}
                                                                {{--                                                                  action="{{route('supplierFilterPage.user')}}"--}}
                                                                {{--                                                                  method="get">--}}
                                                                {{--                                                        @csrf--}}
                                                                {{--                                                    <a href="{{route('supplierFilterPage.user', $cat_sub_1->id)}}">--}}
                                                                <input hidden type="radio" name="categoryInForm"
                                                                       id="{{$cat_sub_1->id}}"
                                                                       value="{{$cat_sub_1->id}}">

                                                                <span class="catalog-cat-item"><i
                                                                        class="fa fa-angle-down">

                                                                    </i><label for="{{$cat_sub_1->id}}"
                                                                               style="cursor: pointer">{{$cat_sub_1->title}}</label></span>
                                                                {{--                                                    </a>--}}
                                                                {{--                                                            </form>--}}
                                                            </div>
                                                            <ul class="catalog-list">
                                                                @foreach($cat_sub_1->categories as $cat_sub_2)
                                                                    {{--                                                            <li>--}}
                                                                    {{--                                                                <a href="{{route('supplierFilterPage.user', $cat_sub_2->id)}}"--}}
                                                                    {{--                                                                   class="catalog-link">{{$cat_sub_2->title}}</a>--}}
                                                                    {{--                                                            </li>--}}
                                                                    <li class="catInForm " style="cursor: pointer">
                                                                        {{--                                                                        <form id="myf{{$cat_sub_2->id}}"--}}
                                                                        {{--                                                                              name="myf{{$cat_sub_2->id}}"--}}
                                                                        {{--                                                                              class="catalog-link"--}}
                                                                        {{--                                                                              onclick="document.forms['myf{{$cat_sub_2->id}}'].submit()"--}}
                                                                        {{--                                                                              style="cursor: pointer; height: 10px"--}}
                                                                        {{--                                                                              action="{{route('supplierFilterPage.user')}}"--}}
                                                                        {{--                                                                              method="get">--}}
                                                                        {{--                                                                    @csrf--}}
                                                                        {{--                                                                            <a href="{{route('supplierFilterPage.user', $cat_sub_2->id)}}"--}}
                                                                        {{--                                                                               class="catalog-link">--}}
                                                                        <a class="catalog-link">
                                                                            <input hidden type="radio"
                                                                                   name="categoryInForm"
                                                                                   id="{{$cat_sub_2->id}}"
                                                                                   value="{{$cat_sub_2->id}}">
                                                                            <label for="{{$cat_sub_2->id}}"
                                                                                   style="cursor: pointer">  {{$cat_sub_2->title}}</label>
                                                                        </a>
                                                                        {{--                                                                        </form>--}}
                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        @endforeach

                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                {{--                                @csrf--}}
                                {{--                                <input hidden name="cat" value="{{$category->id}}">--}}
                                <div class="box-sidebar">
                                    <div class="filter-switch">
                                        <div class="switch-box">
                                            <div class="centered hidden-xs">
                                                <div class="">
                                                    {{--                                                                    <a href="#">--}}
                                                    <label>
                                                        <input type="checkbox"
                                                               class="emergencyType"
                                                               {{--                                                               value="1"--}}
                                                               {{--                                                               id="emergencyType"--}}
                                                               name="emergencyType"><span
                                                            class="switch">
                                                                            <h1 class="switch-title">فوری</h1></span>
                                                        <span class="toggle"></span>
                                                    </label>
                                                    {{--                                                                    </a>--}}
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                {{--                                                <option value="" >محله</option>--}}
                                                {{--                                                @foreach($cities as $city)--}}
                                                {{--                                                    <option value="{{$city->id}}">{{$city->title}}</option>--}}
                                                {{--                                                @endforeach--}}
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
                                                                    {{--                                                                    <a href="#">--}}
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
                                                                    {{--                                                                    </a>--}}
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
                                                    <div class="catalog" style="display: none;">
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

                    <div class="col-lg-9 col-12">

                        <div class="resent-product">
                            <div class="container">
                                <div class="resent-product-title">

                                    <h4>آخرین ملک ها</h4>
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
                                                            <form class="form-horizontal" id="attributes_form_modal"
                                                                  method="get">
                                                                <div class="box-sidebar">
                                                                    <span
                                                                        class="box-header-sidebar">دسته‌بندی نتایج</span>
                                                                    <div class="catalog">
                                                                        <ul class="catalog-list">
                                                                            @foreach($categories2 as $cat1)
                                                                                <li>
                                                                                    <div class="catttt"
                                                                                         style="cursor: pointer">
                                                                                        {{--                                                    <form id="myf{{$cat1->id}}" name="myf{{$cat1->id}}"--}}
                                                                                        {{--                                                          onclick="document.forms['myf{{$cat1->id}}'].submit()"--}}
                                                                                        {{--                                                          style="cursor: pointer; height: 10px"--}}
                                                                                        {{--                                                          action="{{route('supplierFilterPage.user')}}" method="get"--}}
                                                                                        {{--                                                  href="{{route('supplierFilterPage.user', $cat1->id)}}"--}}
                                                                                        {{--                                                    >--}}
                                                                                        {{--                                                @csrf--}}
                                                                                        {{--                                                <a onclick="document.getElementById('idid{{$cat1->id}}').submit()"></a>--}}

                                                                                        <input hidden type="radio"
                                                                                               name="categoryInModal"
                                                                                               class="xxx"
                                                                                               id="m{{$cat1->id}}"
                                                                                               value="{{$cat1->id}}">
                                                                                        <i class="fa fa-angle-left"></i>
                                                                                        <label for="m{{$cat1->id}}"
                                                                                               style="cursor: pointer">{{$cat1->title}}</label>
                                                                                        {{--                            </form>--}}
                                                                                    </div>
                                                                                    <div class="show-more">
                                                                                        @foreach($cat1->categories as $cat_sub_1)
                                                                                            <div class="catttt">
                                                                                                {{--                                                            <form id="myf{{$cat_sub_1->id}}"--}}
                                                                                                {{--                                                                  name="myf{{$cat_sub_1->id}}"--}}
                                                                                                {{--                                                                  onclick="document.forms['myf{{$cat_sub_1->id}}'].submit()"--}}
                                                                                                {{--                                                                  style="cursor: pointer; height: 10px"--}}
                                                                                                {{--                                                                  action="{{route('supplierFilterPage.user')}}"--}}
                                                                                                {{--                                                                  method="get">--}}
                                                                                                {{--                                                        @csrf--}}
                                                                                                {{--                                                    <a href="{{route('supplierFilterPage.user', $cat_sub_1->id)}}">--}}
                                                                                                <input hidden
                                                                                                       type="radio"
                                                                                                       name="categoryInModal"
                                                                                                       id="m{{$cat_sub_1->id}}"
                                                                                                       value="{{$cat_sub_1->id}}"
                                                                                                       class="xxx">

                                                                                                <span
                                                                                                    class="catalog-cat-item"><i
                                                                                                        class="fa fa-angle-down">

                                                                    </i><label for="m{{$cat_sub_1->id}}"
                                                                               style="cursor: pointer">{{$cat_sub_1->title}}</label></span>
                                                                                                {{--                                                    </a>--}}
                                                                                                {{--                                                            </form>--}}
                                                                                            </div>
                                                                                            <ul class="catalog-list">
                                                                                                @foreach($cat_sub_1->categories as $cat_sub_2)
                                                                                                    {{--                                                            <li>--}}
                                                                                                    {{--                                                                <a href="{{route('supplierFilterPage.user', $cat_sub_2->id)}}"--}}
                                                                                                    {{--                                                                   class="catalog-link">{{$cat_sub_2->title}}</a>--}}
                                                                                                    {{--                                                            </li>--}}
                                                                                                    <li class="catttt "
                                                                                                        style="cursor: pointer">
                                                                                                        {{--                                                                        <form id="myf{{$cat_sub_2->id}}"--}}
                                                                                                        {{--                                                                              name="myf{{$cat_sub_2->id}}"--}}
                                                                                                        {{--                                                                              class="catalog-link"--}}
                                                                                                        {{--                                                                              onclick="document.forms['myf{{$cat_sub_2->id}}'].submit()"--}}
                                                                                                        {{--                                                                              style="cursor: pointer; height: 10px"--}}
                                                                                                        {{--                                                                              action="{{route('supplierFilterPage.user')}}"--}}
                                                                                                        {{--                                                                              method="get">--}}
                                                                                                        {{--                                                                    @csrf--}}
                                                                                                        {{--                                                                            <a href="{{route('supplierFilterPage.user', $cat_sub_2->id)}}"--}}
                                                                                                        {{--                                                                               class="catalog-link">--}}
                                                                                                        <a class="catalog-link">
                                                                                                            <input
                                                                                                                hidden
                                                                                                                type="radio"
                                                                                                                name="categoryInModal"
                                                                                                                class="xxx"
                                                                                                                id="m{{$cat_sub_2->id}}"
                                                                                                                value="{{$cat_sub_2->id}}">
                                                                                                            <label
                                                                                                                for="m{{$cat_sub_2->id}}"
                                                                                                                style="cursor: pointer">  {{$cat_sub_2->title}}</label>
                                                                                                        </a>
                                                                                                        {{--                                                                        </form>--}}
                                                                                                    </li>
                                                                                                @endforeach

                                                                                            </ul>
                                                                                        @endforeach

                                                                                    </div>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>

                                                                        {{--                                                                    <ul class="catalog-list">--}}
                                                                        {{--                                                                        --}}{{--                                                                        @if(isset($category->category->id))--}}
                                                                        {{--                                                                        @foreach($categories as $cat1)--}}
                                                                        {{--                                                                            <li>--}}
                                                                        {{--                                                                                <form id="myfm{{$cat1->id}}"--}}
                                                                        {{--                                                                                      name="myfm{{$cat1->id}}"--}}
                                                                        {{--                                                                                      onclick="document.forms['myfm{{$cat1->id}}'].submit()"--}}
                                                                        {{--                                                                                      style="cursor: pointer; height: 10px"--}}
                                                                        {{--                                                                                      action="{{route('supplierFilterPage.user')}}"--}}
                                                                        {{--                                                                                      method="get"--}}
                                                                        {{--                                                                                    --}}{{--                                                  href="{{route('supplierFilterPage.user', $cat1->id)}}"--}}
                                                                        {{--                                                                                >--}}

                                                                        {{--                                                                                    --}}{{--                                                                                    @csrf--}}
                                                                        {{--                                                                                    --}}{{--                                                <a onclick="document.getElementById('idid{{$cat1->id}}').submit()"></a>--}}

                                                                        {{--                                                                                    <input hidden name="cat"--}}
                                                                        {{--                                                                                           value="{{$cat1->id}}">--}}
                                                                        {{--                                                                                    <i class="fa fa-angle-left"></i>--}}
                                                                        {{--                                                                                    {{$cat1->title}}</form>--}}
                                                                        {{--                                                                                <div class="show-more">--}}
                                                                        {{--                                                                                    @foreach($cat1->categories as $cat_sub_1)--}}
                                                                        {{--                                                                                        <form--}}
                                                                        {{--                                                                                            id="myfm{{$cat_sub_1->id}}"--}}
                                                                        {{--                                                                                            name="myfm{{$cat_sub_1->id}}"--}}
                                                                        {{--                                                                                            onclick="document.forms['myfm{{$cat_sub_1->id}}'].submit()"--}}
                                                                        {{--                                                                                            style="cursor: pointer; height: 10px"--}}
                                                                        {{--                                                                                            action="{{route('supplierFilterPage.user')}}"--}}
                                                                        {{--                                                                                            method="POST"--}}
                                                                        {{--                                                                                        >--}}
                                                                        {{--                                                                                            @csrf--}}
                                                                        {{--                                                                                            --}}{{--                                                                                        <a href="{{route('supplierFilterPage.user', $cat_sub_1->id)}}">--}}

                                                                        {{--                                                                                            <span--}}
                                                                        {{--                                                                                                class="catalog-cat-item"><i--}}
                                                                        {{--                                                                                                    class="fa fa-angle-down">--}}

                                                                        {{--                                                            </i>{{$cat_sub_1->title}}</span>--}}
                                                                        {{--                                                                                            --}}{{--                                                                                            </a>--}}
                                                                        {{--                                                                                        </form>--}}
                                                                        {{--                                                                                        <ul class="catalog-list">--}}
                                                                        {{--                                                                                            @foreach($cat_sub_1->categories as $cat_sub_2)--}}

                                                                        {{--                                                                                                <li>--}}
                                                                        {{--                                                                                                    <form--}}
                                                                        {{--                                                                                                        id="myfm{{$cat_sub_2->id}}"--}}
                                                                        {{--                                                                                                        name="myfm{{$cat_sub_2->id}}"--}}
                                                                        {{--                                                                                                        onclick="document.forms['myfm{{$cat_sub_2->id}}'].submit()"--}}
                                                                        {{--                                                                                                        style="cursor: pointer; height: 10px"--}}
                                                                        {{--                                                                                                        action="{{route('supplierFilterPage.user')}}"--}}
                                                                        {{--                                                                                                        method="POST"--}}
                                                                        {{--                                                                                                    >--}}
                                                                        {{--                                                                                                        @csrf--}}
                                                                        {{--                                                                                                        --}}{{--                                                                                                    <a href="{{route('supplierFilterPage.user', $cat_sub_2->id)}}"--}}
                                                                        {{--                                                                                                        --}}{{--                                                                                                       class="catalog-link">{{$cat_sub_2->title}}</a>--}}
                                                                        {{--                                                                                                    </form>--}}
                                                                        {{--                                                                                                </li>--}}
                                                                        {{--                                                                                            @endforeach--}}

                                                                        {{--                                                                                        </ul>--}}
                                                                        {{--                                                                                    @endforeach--}}

                                                                        {{--                                                                                </div>--}}
                                                                        {{--                                                                            </li>--}}
                                                                        {{--                                                                        @endforeach--}}

                                                                        {{--                                                                    </ul>--}}
                                                                    </div>
                                                                </div>
                                                                <div class="box-sidebar">
                                                                    <div class="filter-switch">
                                                                        <div class="switch-box">
                                                                            <div class="centered hidden-xs">
                                                                                <div class="">
                                                                                    {{--                                                                    <a href="#">--}}
                                                                                    <label>
                                                                                        <input type="checkbox"
                                                                                               class="emergencyTypeModal"
                                                                                               {{--                                                               value="1"--}}
                                                                                               {{--                                                               id="emergencyType"--}}
                                                                                               name="emergencyTypeModal"><span
                                                                                            class="switch">
                                                                            <h1 class="switch-title">فوری</h1></span>
                                                                                        <span class="toggle"></span>
                                                                                    </label>
                                                                                    {{--                                                                    </a>--}}
                                                                                </div>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{--                                                                @csrf--}}
                                                                {{--                                                                <input hidden name="cat" value="{{$category->id}}">--}}
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
                                                                                {{--                                                <option value="" >محله</option>--}}
                                                                                {{--                                                @foreach($cities as $city)--}}
                                                                                {{--                                                    <option value="{{$city->id}}">{{$city->title}}</option>--}}
                                                                                {{--                                                @endforeach--}}
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
                                                                                <span
                                                                                    class="box-header-sidebar activeacc"><i
                                                                                        class="fa fa-chevron-down arrow"></i>{{$attr->title}}</span>
                                                                                    <div class="catalog"
                                                                                         style="display: none;">
                                                                                        <div class="select-box">
                                                                                            <select
                                                                                                class="js-example-basic-multiple attributeTypeSelect2"
                                                                                                style="width: 100%;"
                                                                                                name="attributeTypeSelect2[{{$attr->id}}][]"
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

                                <div class="row" id="firstPageFilterAdvertiser1Div">
                                    @foreach($ads as $ad)

                                        {{--                                        {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('attributes.isSignificant', 1)->where('attributes.attribute_type', 'bool')->first()->id)->title)}}--}}

                                        <div
                                            class=" col-xl-4 col-sm-6 mb-5 d-flex justify-content-center flex-column align-items-center">

                                            @component('UserMasterNew::components.adCard')
                                                @slot('image')
                                                    {{($ad->adImages->first())?$ad->adImages->first()->image:
                                                                        \Modules\Setting\Entities\Setting::where('title', 'ad_default_photo')->first()->str_value}}

                                                @endslot
                                                @slot('golden_hologram')
                                                    @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()
                                                            && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->status=='approved')
                                                        {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->hologram->logo}}
                                                    @else
                                                        {{''}}
                                                    @endif
                                                @endslot
                                                @slot('emergency_label')
                                                    {{$ad->type=='emergency'?\Modules\Setting\Entities\Setting::where('title', 'emergency_label')
                                                    ->first()->str_value:null}}
                                                @endslot
                                                @slot('real_estate')
                                                    {{($ad->user->hasRole('real-state-administrator'))?$ad->user->shop_title:''}}
                                                @endslot
                                                @slot('title')
                                                    {{$ad->title}}
                                                @endslot
                                                @slot('city')
                                                    {{isset($ad->neighborhood_id)?$ad->neighborhood->title:$ad->city->title}}
                                                @endslot
                                                @slot('ad_unique_code')
                                                    {{$ad->uniqueCodeOfAd}}
                                                @endslot
                                                @slot('first_attr')
                                                    @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first())
                                                        {{$ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->title}}

                                                        {{--                                                            {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->id)->title)}}--}}

                                                        {{--                                                            {{$ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->title}}--}}
                                                    @else
                                                        {{''}}
                                                    @endif
                                                @endslot
                                                @slot('second_attr')

                                                    @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                                        {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}
                                                    @else
                                                        {{''}}
                                                    @endif
                                                @endslot
                                                @slot('second_attr_unit')
                                                    @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                                        {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}
                                                    @endif
                                                @endslot
                                                @slot('id')
                                                    {{$ad->id}}
                                                @endslot
                                            @endcomponent
                                        </div>
                                    @endforeach

                                </div>
                                <div class="justify-content-center align-content-center d-flex">
                                    {{--                                    @if($ads->count()>0 && $ads->links())--}}
                                    {{--                                        {{$ads->links()}}--}}
                                    {{--                                    @endif--}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- show product -->

    </main>
@endsection
@section('js_user')
    <script src="{{asset('files/userMaster/assets/js/select2.js')}}"></script>
    <script src="{{asset('files/userMaster/assets/js/main.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#attributes_form_filter_page').on('submit', function (event) {
                event.preventDefault();
                // alert($('input[name=catLevel2]').val())
                // alert( $('select[name=city]').val())
                // var formData = {
                //     'attributeTypeBool': $('input[name=attributeTypeBool]').val(),
                //     'attributeTypeSelect': $('select[name=attributeTypeSelect]').val(),
                //     'attributeTypeNumber': $('input[name=attributeTypeNumber]').val(),
                //     'city': $('select[name=city]').val(),
                //     'neighborhood': $('select[name=neighborhood]').val(),
                //
                // };
                $.ajax({
                    url: "{{route('supplierFilterPage.user')}}",
                    type: "GET",
                    data: {
                        'attributeTypeBool': $('input[name=attributeTypeBool]').val(),
                        'attributeTypeSelect': $('select[name=attributeTypeSelect]').val(),
                        'attributeTypeNumber': $('input[name=attributeTypeNumber]').val(),
                        'city': $('select[name=city]').val(),
                        'neighborhood': $('select[name=neighborhood]').val(),
                        // 'categoryInForm': $('input[name=categoryInForm]:checked').val(),
                        'emergencyType': $('input[name=emergencyType]:checked').val(),

                    },
                    // data: formData,
                    dataType: 'json',
                    // contentType: false,
                    // cache: false,
                    // processData: false,
                    success: function (data) {
                        console.log(data)
                        $('#firstPageFilterAdvertiser1Div').empty();
                        $('#firstPageFilterAdvertiser1Div').append(data.content);
                    }
                })
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#attributes_form_modal').on('submit', function (event) {
                event.preventDefault();
                // var formData = {
                //     'attributeTypeBool': $('input[name=attributeTypeBool2]').val(),
                //     'attributeTypeSelect': $('select[name=attributeTypeSelect2]').val(),
                //     'attributeTypeNumber': $('input[name=attributeTypeNumber2]').val(),
                //     'cityModal': $('select[name=cityModal]').val(),
                //     'neighborhoodModal': $('select[name=neighborhoodModal]').val(),
                // };
                $.ajax({
                    url: "{{route('supplierFilterPage.user')}}",
                    type: "GET",
                    data: {
                        'attributeTypeBool2': $('input[name=attributeTypeBool2]').val(),
                        'attributeTypeSelect2': $('select[name=attributeTypeSelect2]').val(),
                        'attributeTypeNumber2': $('input[name=attributeTypeNumber2]').val(),
                        'cityModal': $('select[name=cityModal]').val(),
                        'neighborhoodModal': $('select[name=neighborhoodModal]').val(),
                        // 'categoryInFormModal':$('.xxx').checked==true,
                        'categoryInFormModal': $('input[name=categoryInFormModal]:checked').val(),
                        // 'categoryInFormModal': $('input[class=xxx]:checked').val(),
                        'emergencyTypeModal': $('input[name=emergencyTypeModal]:checked').val(),
                        // 'categoryInForm': $('input[name=categoryInForm]:checked').val(),

                    },
                    // data: new FormData(this),
                    //data: formData,
                    dataType: 'json',
                    // contentType: false,
                    // cache: false,
                    // processData: false,
                    success: function (data) {
                        console.log(data)

                        $('#firstPageFilterAdvertiser1Div').empty();
                        $('#firstPageFilterAdvertiser1Div').append(data.content);
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
        $('.emergencyType').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
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
        $('.emergencyTypeModal').change(function (e) {
            $("#attributes_form_modal").submit();
        });
        $('.catttt').on('click', function (e) {
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
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="city"], select[name="cityModal"]').on('change', function () {
                var cityId = jQuery(this).val();
                if (cityId) {
                    // console.log(cityId)
                    jQuery.ajax({
                        url: "{{route('gettingNeighborhood')}}",
                        data: {
                            'city': cityId
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            jQuery('select[name="neighborhood[]"]').empty();
                            jQuery('select[name="neighborhoodModal[]"]').empty();
                            $('select[name="neighborhood[]"]').append('<option value=""></option>');
                            $('select[name="neighborhoodModal[]"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="neighborhood[]"]').append('<option value="' + key + '">' + value + '</option>');
                                $('select[name="neighborhoodModal[]"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="neighborhood[]"]').empty();
                }
            });
        });
    </script>

@endsection
