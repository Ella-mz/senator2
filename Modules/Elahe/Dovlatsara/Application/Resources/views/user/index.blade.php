@extends('UserMasterNew::master')
@section('title_user')درخواست های من
@endsection
@section('css_user')

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2.css')}}">

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/homePage.css')}}">
@endsection
@section('content_userMasterNew')
    <main style="background: rgb(238, 238, 238)">
        <!-- show product -->
        <section class="show-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">

                        <div class="resent-product">
                            <div class="container">
                                <div class="resent-product-title" style="text-align: center">
                                    <h1>درخواست های من</h1>
                                </div>
                                <div class="accordion" id="accordionExample">
                                    <div class="row" id="firstPageFilterAdvertiser2Div">
                                        @foreach($applications as $key=>$application)

                                            <div class="col-xl-4 col-lg-6 mb-4">

                                                <div class="request-card">
                                                    <div class="px-4">
                                                        @if($application->active=='active')
                                                            <span class="text-success">تایید شده</span>
                                                        @elseif($application->active=='inactive')
                                                            <span class="text-secondary">غیرفعال</span>

                                                        @elseif($application->active=='delete')
                                                            <span class="text-danger">حذف توسط کاربر</span>
                                                        @elseif($application->active=='disConfirm')
                                                            <span class="text-danger">عدم تایید</span>
                                                            @if(isset($application->activationReason))
                                                                به علت: {{$application->activationReason}}
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="row px-4">
                                                        <div
                                                            class="align-content-end justify-content-end align-items-end">
                                                            <form
                                                                action="{{route('application.destroy.user', $application->id)}}"
                                                                method="post">
                                                                @csrf
                                                                <button class="btn btn-sm btn-danger">
                                                                    <i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
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

                                                                                {{--                                                                        یوسف آباد /--}}
                                                                                {{--                                                                        امیرآباد / فاطمی / کارگرشمالی/ شهرک والفجر /--}}
                                                                                {{--                                                                        جمالزاده / مطهری / ولیعصر--}}
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
                                                                            aria-controls="multiCollapseExample{{$application->id}}">
                                                                        اطلاعات
                                                                        تماس
                                                                    </button>
                                                                    <div class="collapse multi-collapse"
                                                                         id="multiCollapseExample{{$application->id}}">
                                                                        <div class="card card-body">
                                                                            <div class="request-contact-info">
                                                                                <div class="name">
                                                                                    <p>{{$application->user->name}} {{$application->user->sirName}}</p>
                                                                                </div>
                                                                                <div class="phoneNum" style="text-align: left;">
                                                                                    <p>{{$application->phone}}</p>
                                                                                    <p>{{$application->mobile}}</p>
                                                                                </div>
                                                                            </div>
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
                                                                    aria-controls="collapse{{$key}}">
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
@endsection
@section('js_user')
@endsection
