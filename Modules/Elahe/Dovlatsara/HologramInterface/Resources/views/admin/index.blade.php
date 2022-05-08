@extends('AdminMasterNew::master')
@section('urlHeader')هولوگرام های درخواستی
@endsection
@section('header')
    هولوگرام های درخواستی
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <form action="{{route('hologramInterface.filter.admin')}}" method="post">
                @csrf
                <input name="t" value="1" hidden/>
                <div class="p-2">
                    <div class="row">
{{--                        <div class="col-md-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Category:</label>--}}

{{--                                <div class="input-group">--}}
{{--                                    <div class="input-group-prepend">--}}
{{--                                      <span class="input-group-text">--}}
{{--                                        <i class="fa fa-list"></i>--}}
{{--                                      </span>--}}
{{--                                    </div>--}}
{{--                                    <select class="form-control" name="category" readonly>--}}
{{--                                        <option value=""></option>--}}
{{--                                        @foreach($categories as $category)--}}
{{--                                            <option value="{{$category->id}}">--}}
{{--                                                {{$category->createStringAsParents()}}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <!-- /.input group -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>نوع درخواست:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-paperclip"></i>
                      </span>
                                    </div>
                                    <select class="form-control" name="type" readonly>
                                        <option value=""></option>
                                        <option value="ad">آگهی</option>
                                        <option value="user">کاربر</option>
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>هولوگرام:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-certificate"></i>
                      </span>
                                    </div>
                                    <select class="form-control" name="hologram" readonly>
                                        <option value=""></option>
                                        @foreach($holograms as $hologram)
                                            <option value="{{$hologram->id}}">
                                                {{$hologram->title}}-@if($hologram->type=='ad') آگهی  @elseif($hologram->type=='user') کاربر @endif
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>وضعیت:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-puzzle-piece"></i>
                      </span>
                                    </div>
                                    <select class="form-control" name="status" readonly>
                                        <option value=""></option>
                                        <option value="pending">در انتظار بررسی</option>
                                        <option value="approved">تایید شده</option>
                                        <option value="notApproved">تایید نشده</option>
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
{{--                        <div class="col-md-3">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>From:</label>--}}

{{--                                <div class="input-group">--}}
{{--                                    <div class="input-group-prepend">--}}
{{--                      <span class="input-group-text">--}}
{{--                        <i class="fa fa-calendar"></i>--}}
{{--                      </span>--}}
{{--                                    </div>--}}
{{--                                    <input class="datePicker form-control" name="startDate" readonly/>--}}
{{--                                </div>--}}
{{--                                <!-- /.input group -->--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-3">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>To:</label>--}}

{{--                                <div class="input-group">--}}
{{--                                    <div class="input-group-prepend">--}}
{{--                      <span class="input-group-text">--}}
{{--                        <i class="fa fa-calendar"></i>--}}
{{--                      </span>--}}
{{--                                    </div>--}}
{{--                                    <input class="datePicker form-control" name="endDate" readonly/>--}}
{{--                                </div>--}}
{{--                                <!-- /.input group -->--}}
{{--                            </div>--}}
{{--                        </div>--}}


                    </div>
                </div>
                <div class="p-2">
                    <div class="row">

                        <div class="col-md-12 text-left">

                            <button type="submit" class="btn btn-info btn-sm">فیلتر</button>
                            <a href="" class="btn btn-secondary btn-sm">برگشت به حالت اولیه</a>
                        </div>
                    </div>
                </div>
            </form>
            @if(count($tags)>0)
            <div class="row p-2">
                <div class="col-md-1  mt-2 ">
                    <p>فیلتر براساس:</p>
                </div>
                <div class="col-md-10  mt-2 ">

                    @foreach($tags as $key=>$tag)
                        <span class="badge badge-danger text-white mx-2"> {{$tag}}</span>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="card-header">
{{--                <a href="{{route('holograms.create.admin')}}"--}}
{{--                   class="btn btn-sm btn-primary" style="float: left">ایجاد هولوگرام جدید</a>--}}

                <h1 class="card-title" style="float: right">هولوگرام های درخواستی</h1>

            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>لوگو</th>
                        <th>نوع درخواست</th>
                        <th>عنوان</th>
                        <th>وضعیت</th>
                        <th>هزینه</th>
                        <th>نام کارشناس</th>
                        <th>جزییات</th>
                        <th>ویرایش کارشناس</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($hologram_interfaces as $key=>$hologram)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            {{--                            <td>{{$hologram->title}}</td>--}}
                            {{--                            @if(isset($category->image))--}}
                            {{--                                <td width="80" height="40">--}}
                            {{--                                    <img src="{{asset($category->image)}}" width="80" height="40">--}}
                            {{--                                </td>--}}
                            {{--                            @else--}}
                            {{--                                <td width="80" height="40">--}}
                            {{--                                    <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                            {{--                                </td>--}}
                            {{--                            @endif--}}
                            @if(isset($hologram->hologram->logo))
                                <td width="80" height="40">
                                    <img src="{{asset($hologram->hologram->logo)}}" width="80" height="40">
                                </td>
                            @else
                                <td width="80" height="40">
                                    {{--                                    <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                                </td>
                            @endif
                            <td>
                                @if($hologram->hologram->type=='ad')
                                    آگهی
                                @elseif($hologram->hologram->type=='user')
                                    کاربر
                                @endif
                            </td>
                            <td>
                                @if($hologram->hologram->type=='ad')
                                    {{$hologram->ad->title}}
                                @elseif($hologram->hologram->type=='user')
                                    @if(\Modules\User\Entities\User::find($hologram->type_id)->hasRole('real-state-administrator'))
                                        {{$hologram->user->shop_title}}
                                    @else
                                        {{$hologram->user->name}} {{$hologram->user->sirName}}
                                    @endif
                                @endif
                            </td>

                            <td>
                                @if($hologram->status=='pending')
                                    <span class="badge badge-warning">در انتظار بررسی</span>
                                @elseif($hologram->status == 'approved')
                                    <span class="badge badge-success"> تایید شده</span>
                                @elseif($hologram->status == 'notApproved')
                                   <span class="badge badge-secondary"> تایید نشده</span>
                                @endif
                            </td>
                            <td>
                                {{number_format($hologram->hologram_price)}}

                            </td>
                            <td>
                                @if(isset($hologram->expert_id))
                                    {{\Modules\User\Entities\User::find($hologram->expert_id)->name}} {{\Modules\User\Entities\User::find($hologram->expert_id)->sirName}}
{{--                                <form action="{{ route('holograms.destroy.admin' ,$hologram->id) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <a class="btn btn-info btn-sm"--}}
{{--                                       href="{{ route('holograms.edit.admin', $hologram->id)}}">--}}
{{--                                        <i class="fa fa-edit"></i>--}}
{{--                                    </a>--}}

{{--                                    --}}{{--                                    <a class="btn btn-danger btn-sm"--}}
{{--                                    --}}{{--                                       href="{{ route('category.destroy.admin', $category->id)}}">--}}
{{--                                    --}}{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    --}}{{--                                    </a>--}}
{{--                                    <button type="submit" class="btn btn-danger btn-sm"--}}
{{--                                            onclick="return confirm('آیا از حذف هولوگرام {{$hologram->title}} اطمینان دارید؟ در صورت حذف تمام مشخصات زیر مجموعه این گروه نیز حذف می شوند.')">--}}
{{--                                        <i class="fa fa-trash-o"></i>--}}
{{--                                    </button>--}}
{{--                                </form>--}}
                                @else
                                    <span class="badge badge-danger">انتخاب نشده</span>
                                    @endif

                            </td>
                            <td>
                                <a type="button" href="{{route('hologramInterface.show.admin', $hologram->id)}}"
                                   class="btn btn-sm btn-primary"><i
                                        class="fa fa-plus text-white"></i>
                                </a>
                            </td>
                            <td>
                                @if($hologram->status=='pending')
{{--                                <input type="number" class="form-control-sm form-control w-25 orderInput"--}}
{{--                                       id="{{$groupAttr->id}}"--}}
{{--                                       value="{{$groupAttr->order}}">--}}
                                <select class="form-control-sm form-control expertChoose" name="expert_name" id="{{$hologram->id}}">
                                    <option value="">انتخاب نشده</option>
                                    @foreach($experts as $user)
                                        <option value="{{$user->id}}" @if($user->id==$hologram->expert_id) selected @endif>
                                            {{$user->name}} {{$user->sirName}} ({{$user->user_id}})
                                    @endforeach

                                </select>
                                @else
                                    <span class="badge badge-info">امکان تغییر کارشناس نیست</span>

                                @endif
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
        $('.expertChoose').change(function () {
            var expert_id = $(this).val();
            var hologram_interface_id = $(this).attr('id');
            $.ajax({
                url: "{{route('changeExpertInHologramInterface')}}",
                data: {
                    'expert_id': expert_id,
                    'hologram_interface_id': hologram_interface_id,
                },
                method: "GET",
                dataType: 'JSON',

                success: function (data) {
                    location.reload();
                }
            })
        });
    </script>
@endsection
