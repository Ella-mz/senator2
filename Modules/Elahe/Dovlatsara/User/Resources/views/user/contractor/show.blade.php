@extends('UserMasterNew::master')
@section('title_user')پیمانکار {{$user->name}} {{$user->sirName}}
@endsection
@section('css_user')
{{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/store.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/amalkiSingle.css')}}">--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/singleContractor.css')}}">

@endsection
@section('content_userMasterNew')
    <header>
        <div class="singlePageTopHeader">
            <div class="container">
                <div class="row header">
                    <div class="col-md-3">
                        <div class="topContractorInfo">
                            <div class="PicblankSpace"></div>
                            <div class="contarctorPic" style="object-fit: contain; justify-content: center; align-items: center; display: flex; overflow: hidden">
                                @if($user->userImage)
                                    <img src="{{asset($user->userImage)}}" alt="">
                                @elseif($user->sex==1)
                                    <img src="{{asset($contractor_women_default_photo)}}" alt="">
                                @else
                                    <img src="{{asset($contractor_men_default_photo)}}" alt="">
                                @endif
                            </div>
                            <div class="contractorRating">
{{--                                <img src="./assets/img/star (1).svg" alt="">--}}
{{--                                <img src="./assets/img/star.svg" alt="">--}}
{{--                                <img src="./assets/img/star.svg" alt="">--}}
{{--                                <img src="./assets/img/star.svg" alt="">--}}
{{--                                <img src="./assets/img/star.svg" alt="">--}}
                            </div>
                            <div class="contractorName">
                                <p>{{$user->name}} {{$user->sirName}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="blankSpace"></div>
{{--                        <ul class="tags-menu">--}}
{{--                            <li><a href="#">شهر<i class="fa fa-star"></i></a></li>--}}
{{--                            <li><a href="#">دسته بندی شغلی<i class="fa fa-angle-left"></i></a></li>--}}
{{--                            <li><a href="#">زیر دسته بندی شغلی<i class="fa fa-angle-left"></i></a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="contactorInfo">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 my-5 px-3">
                        <div class="DetailInfoBox d-flex justify-content-between">
                            <ul class="DetailInfo-title">
                                <li>نام :</li>
                                <li>نام خانوادگی :</li>
                                <li>تلفن همراه :</li>
                                <li>سابقه :</li>
{{--                                <li>حوزه فعالیت :</li>--}}
                            </ul>
                            <ul class="DetailInfo-info">
                                <li>{{$user->name}}</li>
                                <li>{{$user->sirName}}</li>
                                <li>{{$user->mobile}}</li>
                                <li>{{isset($user->yearOfOperation)?$user->yearOfOperation:''}}</li>
{{--                                <li>ساخت و ساز</li>--}}
                            </ul>
                        </div>
                        <div class="DetailInfoBox d-flex justify-content-center">
                            <div class="row">

                            <h4>صنف</h4><hr style="margin-bottom: 2px">
                            @foreach($user->associations as $association)
                                <div class="col-md-6">
                                <span>{{$association->title}}</span>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="row">
                            <div class="col-12">
                                <div class="contractorProjectTabnavigation">
                                    <nav>
                                        <ul class="tabs">
                                            <li data-content="skills">مهارت ها</li>
                                            <li data-content="projectsDone" class="selected">پروژه های انجام شده</li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="tabContent">
                                <div class="col-12">
                                    <div class="tabContent  selected" data-content="projectsDone">
                                        <div class="row">
                                            @foreach($user->contractorProjects as $project)
                                                <div class="col-12 mb-3 ContractorProjectsBox">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-6 col-sm-4">
                                                            <div class="imageBox">
                                                                @if($project->contractorProjectImages->first())
                                                                    <img src="{{asset($project->contractorProjectImages->first()->image)}}" alt="">
                                                                @else
                                                                    <img src="{{asset('files/userMaster/assets/img/download (3).jpg')}}" alt="">

                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-8 py-2 px-3">
                                                            <div class=" projectInfo">
                                                                <div class="Projectinfo projectTitle">
                                                                    <p class="title">عنوان پروژه :</p>
                                                                    <p class="Projectname">{{$project->title}}</p>
                                                                </div>
                                                                <div class="Projectinfo projectDiscribtion">
                                                                    <p class="title">توضیحات:</p>
                                                                    <p class="discribtion">{{$project->description}}</p>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="projectDirector d-flex">
{{--                                                                        <p class="title">کارفرما :</p>--}}
{{--                                                                        <p class="directorName">محمد عباسی</p>--}}
                                                                    </div>
                                                                    <div class="projectDate d-flex">
{{--                                                                        <p class="title">تاریخ :</p>--}}
{{--                                                                        <p class="date">1399/04/05</p>--}}
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tabContent ContractorSkillsBox" data-content="skills">
                                        <div class="skil ContractorProjectsBox">
                                            <div class="skil-show">
                                                <div class="skil-heder-title">
                                                    <h3>مهارت </h3>
                                                    <h3>سطح</h3>
                                                </div>
                                                @foreach($user->associationSkills as $skill)
                                                <div class="skil-title-score">

                                                    <div class="skil-title">
                                                        <p>
                                                            {{$skill->title}}:
                                                        </p>
                                                    </div>
                                                    <div class="skil-score">
                                                    @for($i=1;$i<=$skill->pivot->value;$i++)
                                                            <span class="star-item"><i class="fa fa-star" style="color: gold"></i></span>
                                                        @endfor
                                                        @for($i=5;$i>$skill->pivot->value;$i--)
                                                            <span class="star-item"><i class="fa fa-star-o" style="color: gold"></i></span>
                                                        @endfor
{{--                                                        {{$skill->pivot->value}}--}}

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
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js_user')
    <script src="{{asset('files/userMaster/assets/js/script.js')}}"></script>

@endsection
