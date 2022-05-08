@extends('AdminMasterNew::master')
@section('urlHeader') فروشگاه ها
@endsection
@section('header')
    {{--    {!! $map !!}--}}
    {{--    @foreach($categories as $category->iteme)--}}
    {{--    <li><a href="{{route('category.index.admin',0)}}" title="categories">Categories</a></li>--}}
    {{--    @endforeach--}}
@endsection
@section('content')
    <section class="content">
        <form action="{{route('shops.filter.admin')}}" method="post">
            @csrf
            <input name="t" value="1" hidden/>
            <div class="p-2">
                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>اصناف:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="fa fa-list"></i>
                                              </span>
                                                </div>
                                                <select class="form-control" name="union" readonly>
                                                    <option value=""></option>
                                                    @foreach($unions as $union)
                                                        <option value="{{$union->id}}">
                                                            {{$union->title}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>شهر:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fa fa-building"></i>
                          </span>
                                </div>
                                <select class="form-control" name="city" readonly>
                                    <option value=""></option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">
                                            {{$city->title}}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>محله:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-building"></i>
                      </span>
                                </div>
                                <select class="form-control" name="neighborhood" id="neighborhood" readonly>
                                </select>
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    {{--                    <div class="col-md-3">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <label>محله:</label>--}}

                    {{--                            <div class="input-group">--}}
                    {{--                                <div class="input-group-prepend">--}}
                    {{--                          <span class="input-group-text">--}}
                    {{--                            <i class="fa fa-building"></i>--}}
                    {{--                          </span>--}}
                    {{--                                </div>--}}
                    {{--                                <select class="form-control" name="neighborhood" readonly>--}}
                    {{--                                    <option value=""></option>--}}
                    {{--                                    @foreach($neighborhoods as $neighborhood)--}}
                    {{--                                        <option value="{{$neighborhood->id}}">--}}
                    {{--                                            {{$neighborhood->title}}--}}
                    {{--                                        </option>--}}
                    {{--                                    @endforeach--}}
                    {{--                                </select>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.input group -->--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}


                </div>
            </div>
            <div class="p-2">
                <div class="row">
                    <div class="col-md-12 text-left">

                        <button type="submit" class="btn btn-info btn-sm">فیلتر</button>
                        <a href="{{route('shops.index.admin')}}" class="btn btn-secondary btn-sm">برگشت به حالت
                            اولیه</a>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-2  mt-2 ">
                <p>فیلتر های اعمال شده :</p>
            </div>
            <div class="col-md-10  mt-2 ">

                @foreach($tags as $key=>$tag)
                    <span class="badge badge-danger text-white mx-2"> {{$tag}}</span>
                @endforeach
            </div>
        </div>
        <div class="modal fade" id="disConfirmShop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="disConfirmShopForm" method="post">
                        @csrf
                        {{--                    <div id="nnn"></div>--}}
                        @if(session()->has('message'))
                            <div class="alert alert-danger " style="color:darkred">{{ session()->get('message') }}</div>
                        @endif
                        {{csrf_field()}}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">علت عدم تایید فروشگاه</h5>
                        </div>
                        <div class="modal-body">
                            <div id="success" class="w-100"></div>
                            <div id="error"></div>
                            <div class="row">
                                <input hidden class="form-control" name="shopid" id="modal-Id">
                                <div class="col-md-12 mb-3">
                                <textarea class="form-control" name="shopreason" id="modal-Id"
                                          placeholder="توضیحات خود را برای صاحب فروشگاه در این قسمت بنویسید."></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger text-white btn-sm" data-dismiss="modal">انصراف
                                </button>
                                <button type="submit" class="btn btn-success btn-sm " id="disConfirmShop">ثبت</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
{{--                <a href="{{route('neighborhood.add.admin', $city->id)}}"--}}
{{--                   class="btn btn-sm btn-primary" style="float: left">ایجاد محله جدید</a>--}}
                <h1 class="card-title" style="float: right">فروشگاه ها</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>لوگو</th>
                        <th>صنف</th>
                        <th>عنوان</th>
                        <th>تلفن</th>
                        <th>سال شروع فعالیت</th>
                        <th>شهر-محله</th>
                        <th>وضعیت</th>
                        <th>جزییات فروشگاه</th>
                        <th>تایید/عدم تایید/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shops as $key=>$shop)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            @if(isset($shop->logo))
                                <td width="80" height="40">
                                    <img src="{{asset($shop->logo)}}" width="80" height="40">
                                </td>
                            @else
                                <td width="80" height="40">
                                    <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">
                                </td>
                            @endif
                            <td>{{$shop->union->title}}</td>
                            <td>{{$shop->title}}</td>
                            <td>{{$shop->phone}}</td>
                            <td>{{$shop->yearOfOperation}}</td>

                            <td>{{$shop->city->title}}-
                                @if(isset($shop->neighborhood_id))
                                    {{$shop->neighborhood->title}}
                                @endif
                            </td>
                            <td>
                                @if($shop->active=='confirm')
                                     <span style="color: #00B74A">تایید</span>
                                    @elseif($shop->active=='disConfirm')
                                    <span style="color: #F93154">عدم تایید</span>
                                    @elseif($shop->active=='diActivation')
                                    غیرفعال
                                    @endif

                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                   href="{{ route('shops.detail.admin', $shop->id)}}">
                                    <i class="fa fa-info-circle"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('shops.destroy.admin' ,$shop->id) }}" method="POST">
                                    @csrf
                                    <a class="btn btn-success btn-sm"
                                       href="{{ route('shops.confirm.admin', $shop->id)}}">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#disConfirmShop" data-id="{{$shop->id}}"
                                       data-reason="{{$shop->reasonOfDeactivation}}"
                                       class="btn btn-secondary btn-sm"><i class="fa fa-close"></i></a>
{{--                                    <a class="btn btn-secondary btn-sm"--}}
{{--                                       href="{{ route('shops.confirm.admin', $shop->id)}}">--}}
{{--                                        <i class="fa fa-close"></i>--}}
{{--                                    </a>--}}

                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف فروشگاه {{$shop->title}} اطمینان دارید؟')">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        {{--    {!! $categories->links() !!}--}}
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
    <script>
        $('#disConfirmShop').on('show.bs.modal', function (e) {
            var opener = e.relatedTarget;
            var id = $(opener).attr('data-id');
            var reason = $(opener).attr('data-reason');
            $('#disConfirmShopForm').find('[name="shopid"]').val(id);
            $('#disConfirmShopForm').find('[name="shopreason"]').val(reason);
        });

    </script>
    <script>
        $(document).ready(function () {
            $('#disConfirmShopForm').on('submit', function (event) {
                event.preventDefault();
                var formData = {
                    'shopid': $('input[name=shopid]').val(),
                    'shopreason': $('textarea[name=shopreason]').val(),
                };
                var shopid = formData["shopid"];
                var shopreason = formData["shopreason"]
                $.ajax({
                    url: '{{route('shops.disconfirm.admin')}}',
                    method: "POST",
                    data: new FormData(this),
                    type: "POST",
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
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
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="city"]').on('change', function () {
                var cityId = jQuery(this).val();
                // alert(cityId)
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
                            // console.log(data);
                            jQuery('select[name="neighborhood"]').empty();
                            $('select[name="neighborhood"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="neighborhood"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="neighborhood"]').empty();
                }
            });
        });
    </script>
    @endsection
