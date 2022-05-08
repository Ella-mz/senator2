@extends('AdminMasterNew::master')
@section('urlHeader') درخواست
@endsection
@section('header')
    {{--    {!! $map !!}--}}
    {{--    @foreach($categories as $category->iteme)--}}
    {{--    <li><a href="{{route('category.index.admin',0)}}" title="categories">Categories</a></li>--}}
    {{--    @endforeach--}}
@endsection
@section('css')
@endsection
@section('content')
    <div class="modal fade" id="editImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="editImageForm" method="post">
                    @csrf
                    {{--                    <div id="nnn"></div>--}}
                    @if(session()->has('message'))
                        <div class="alert alert-danger " style="color:darkred">{{ session()->get('message') }}</div>
                    @endif
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">علت عدم تایید درخواست</h5>
                    </div>
                    <div class="modal-body">
                        <div id="success" class="w-100"></div>
                        <div id="error"></div>
                        <div class="row">
                            <input hidden class="form-control" name="adid" id="modal-Id">
                            <div class="col-md-12 mb-3">
                                <textarea class="form-control" name="appreason" id="modal-Id"
                                          placeholder="توضیحات خود را برای درخواست دهنده در این قسمت بنویسید."></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-white btn-sm" data-dismiss="modal">انصراف
                            </button>
                            <button type="submit" class="btn btn-success btn-sm " id="editimage">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section class="content">
        <h3 class="text-bold">{{$application->category->createStringAsParents2($application->category->path)}}</h3><br>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            {{--                            <div class="col-md-6"><h6 class="card-title"> </h6></div>--}}
                            <div class="col-md-6 text-right">
                                    <form action="{{route('application.destroy.admin', $application->id)}}" method="POST">

                                        {{--                                <div class="row d-flex justify-content-end align-content-end mb-2 ml-2">--}}
                                        <a data-toggle="modal" data-target="#editImage" data-id="{{$application->id}}"
                                           data-reason="{{$application->reason}}"
                                           class="btn btn-outline-secondary btn-sm">عدم
                                            تایید</a>
                                        <a href="{{route('application.approve.admin', $application->id)}}"
                                           class="btn btn-outline-success btn-sm">تایید</a>
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('آیا از حذف درخواست اطمینان دارید؟')">
                                            حذف
                                        </button>
                                    </form>
                                {{--                            @if($ad->active != 0)--}}
                                {{--                                <a href="{{route('ads.deactive', $ad->id)}}"--}}
                                {{--                                   class="btn btn-outline-secondary btn-sm">غیرفعال</a>--}}
                                {{--                            @endif--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="col-md-6 text-left">
                                <a type="button" class="btn btn-info btn-sm"
                                   href="{{route('application.index.admin')}}"><i
                                        class="fa fa-arrow-left text-white"></i></a>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        {{--                        <div clas/s="row">--}}
                        <div class="col-md-1"></div>
                        <div class="col-md-10 py-5">
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <div class="row p-4">
                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-2">
                                            @if($application->active=='active')
                                                <span class="badge badge-success">فعال</span>
                                            @elseif($application->active=='inactive')
                                                <span class="badge badge-secondary">غیرفعال</span>

                                            @elseif($application->active=='delete')
                                                <span class="badge badge-danger">حذف توسط کاربر</span>
                                            @elseif($application->active=='disConfirm')
                                                <span class="badge badge-danger">عدم تایید</span>

                                            @endif
                                        </div>
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>
                                                عنوان درخواست
                                            </th>
                                            <td>
                                                {{$application->title}}
                                            </td>
                                        </tr>
                                        <tr>

                                            <th>شماره تلفن درخواست کننده</th>
                                            <td>{{$application->phone}}</td>
                                        </tr>
                                        <tr>

                                            <th>شماره موبایل درخواست کننده</th>
                                            <td>{{$application->mobile}}</td>
                                        </tr>
                                        <tr>

                                            <th>شهر و محله ها</th>
                                            <td>{{$application->city->title}} @if(($application->neighborhoods()->count()>0))

                                                    , @foreach($application->neighborhoods as $neighborhood)
                                                        {{\Modules\Neighborhood\Entities\Neighborhood::find($neighborhood->neighborhood_id)->title}}
                                                        /
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>تاریخ ثبت</th>
                                            <td>{{verta($application->startDate)->formatJalaliDate()}}</td>
                                        </tr>
                                        <tr>

                                            <th>تاریخ اتمام</th>
                                            <td>{{verta($application->endDate)->formatJalaliDate()}}</td>
                                        </tr>
                                        <tr>
                                            <th>ثبت شده توسط</th>
                                            <td>
                                                {{$application->user->name}} {{$application->user->sirName}}
                                            </td>
                                        </tr>
                                    </table>
                                    @if(isset($application->description))
                                        <hr>

                                        <div class="row p-4">
                                            <div class="callout callout-info" style="width: 100%">
                                                <h5>توضیحات</h5>

                                                <p>{{$application->description}} </p>
                                            </div>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        @if($application->attributes->count()>0)
                            <div class="col-md-1"></div>
                            <div class="col-md-1"></div>
                            <div class="col-md-10 py-5">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <div class="row p-4">
                                            @foreach($application->attributes->where('attribute_type', 'bool') as $attribute)
                                                <div class="col-md-2">
                                                    <span class="badge badge-info">{{$attribute->title}}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <table class="table table-hover">
                                            @foreach($application->attributes as $attribute)
                                                <tr>
                                                    @if($attribute->attribute_type=='int')
                                                        <th>{{$attribute->title}}</th>

                                                        @if(isset($attribute->pivot->value2))
                                                            <td>
                                                                از {{number_format($attribute->pivot->value1)}} {{($attribute->unit)}}
                                                                تا {{number_format($attribute->pivot->value2)}} {{($attribute->unit)}}</td>
                                                            {{--                                                            <p>از {{$attribute->pivot->value1}} تا {{$attribute->pivot->value2}} </p>--}}
                                                        @else
                                                            <td>{{number_format($attribute->pivot->value1)}} {{($attribute->unit)}}</td>
                                                        @endif
                                                        {{--                                                        <td>{{number_format($attribute->pivot->value1)}} {{($attribute->unit)}}</td>--}}

                                                    @elseif($attribute->attribute_type=='string')
                                                        <th>{{$attribute->title}} </th>
                                                        @if(isset($attribute->pivot->value2))
                                                            <td>از {{$attribute->pivot->value1}} {{($attribute->unit)}}
                                                                تا {{$attribute->pivot->value2}} {{($attribute->unit)}}</td>
                                                            {{--                                                            <p>از {{$attribute->pivot->value1}} تا {{$attribute->pivot->value2}} </p>--}}
                                                        @else
                                                            <td>{{$attribute->pivot->value1}} {{($attribute->unit)}}</td>
                                                        @endif
                                                        {{--                                                        <td>{{$attribute->pivot->value1}} {{($attribute->unit)}}</td>--}}

                                                    @elseif($attribute->attribute_type=='select')
                                                        <th>{{$attribute->title}}</th>
                                                        @if(isset($attribute->pivot->attribute_item_id2))
                                                            <td>از {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$attribute->pivot->attribute_item_id1)
                                                                ->first()->title}} تا {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$attribute->pivot->attribute_item_id2)
                                                                ->first()->title}}</td>
                                                            {{--                                                            <p>از {{$attribute->pivot->value1}} تا {{$attribute->pivot->value2}} </p>--}}
                                                        @else
                                                            <td> {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$attribute->pivot->attribute_item_id1)
                                                                ->first()->title}}</td>
                                                        @endif
                                                    @endif
                                                </tr>
                                            @endforeach
                                            {{--                        <tr>--}}

                                            {{--                            <th>فعال/غیرفعال</th>--}}
                                            {{--                            <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</td>--}}

                                            {{--                        </tr>--}}
                                        </table>
                                        <hr>
                                        <div class="row p-4">
                                            @foreach($application->attributes->where('attribute_type', 'description') as $attribute)
                                                <div class="callout callout-info" style="width: 100%">
                                                    <h5>{{$attribute->title}} </h5>

                                                    @if(isset($attribute->pivot->value2))
                                                        <p>از {{$attribute->pivot->value1}}
                                                            تا {{$attribute->pivot->value2}} </p>
                                                    @else
                                                        <p>{{$attribute->pivot->value1}} </p>

                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
@section('js')
    <script>
        $('#editImage').on('show.bs.modal', function (e) {
            var opener = e.relatedTarget;
            var id = $(opener).attr('data-id');
            var reason = $(opener).attr('data-reason');
            $('#editImageForm').find('[name="adid"]').val(id);
            $('#editImageForm').find('[name="appreason"]').val(reason);
        });

    </script>
    <script>
        $(document).ready(function () {
            $('#editImageForm').on('submit', function (event) {
                event.preventDefault();
                // var formData = {
                //     'adid': $('input[name=adid]').val(),
                //     'adreason': $('textarea[name=adreason]').val(),
                //
                // };
                var formData = {
                    'adid': $('input[name=adid]').val(),
                    'appreason': $('textarea[name=appreason]').val(),
                    // 'itemattribute'    : $('input[name=itemattribute]').val(),
                };
                var adid = formData["adid"];
                var adreason = formData["appreason"]
                // var attribute = formData["itemattribute"]
                // var adid = formData["adid"];
                // var adreason = formData["adreason"]
                // var url = $('form[id=editImageForm]').attr('action')+'/'+adid;
                // console.log(adreason)
                $.ajax({
                    url: '{{route('application.disConfirm.admin')}}',
                    method: "POST",
                    data: new FormData(this),

                    // data: {
                    //     'FormData':new FormData(this),
                    //     'adreason' : adreason,
                    //     'adid' : adid
                    // },
                    {{--data: {--}}
                    {{--    "formData": formData,--}}
                    {{--    "_token" : "{{csrf_token()}}",--}}
                    {{--    "id":adid--}}
                    {{--},--}}
                    // data: {
                    //     'adreason' : adreason,
                    //     'adid' : adid
                    // },
                    type: "POST",
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        // console.log(data)
                        if (data.errorValidation) {
                            $('#error').empty();
                            $('#error').append('<small class="text-danger">' + data.errorValidation + '</small>');
                        }
                        if (data.success) {
                            $('#success').empty();
                            $('#success').append(data.success);
                            window.setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }
                    },
                })
            });
        });
    </script>
@endsection
