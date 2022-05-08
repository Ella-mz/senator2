@extends('AdminMasterNew::master')
@section('urlHeader') مشخصات {{$groupAttribute->title}}
@endsection
@section('header')
 مشخصات {{$groupAttribute->title}}

@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('attrs.add.admin', $groupAttribute->id)}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد مشخصه جدید</a>
                <h1 class="card-title" style="float: right">مشخصات <a
                        href="{{route('groupAttrs.index.admin', $groupAttribute->category_id)}}">{{$groupAttribute->title}}</a>
                </h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        @if($groupAttribute->advertiser=='supplier')

                        <th>عنوان جایگزین</th>
                        @endif
                        <th>نوع مشخصه</th>
                        @if($groupAttribute->advertiser=='supplier')
                            <th>نحوه نمایش</th>
                        @endif
                        <th>Place holder</th>
                        <th>واحد</th>
                        <th>آیتم مشخصات</th>
                        <th>دارای الویت</th>
                        <th>آیتم فیلتر</th>
                        @if($groupAttribute->advertiser=='applicant')

                            <th>دارای بازه</th>
                        @endif
                        <th>ویرایش/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attributes as $key=>$attribute)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$attribute->title}}</td>
                            @if($groupAttribute->advertiser=='supplier')

                            <td>{{$attribute->alt_value}}</td>
                            @endif
                            <td>
                                @if($attribute->attribute_type=='select')
                                    چند گزینه ای
                                @elseif($attribute->attribute_type=='bool')
                                    دو گزینه ای
                                @elseif($attribute->attribute_type=='int')
                                    عدد
                                @elseif($attribute->attribute_type=='string')
                                    کاراکتر
                                @elseif($attribute->attribute_type=='description')
                                    متن
                                @endif
                            </td>
                            @if($groupAttribute->advertiser=='supplier')

                                <td>
                                    @if($attribute->input_type=='checkbox')
                                        سلکت افقی
                                    @elseif($attribute->input_type=='select')
                                        دراپ دان
                                    @endif

                                </td>
                            @endif
                            <td>
                                {{$attribute->placeHolder}}
                            </td>
                            <td>
                                @if(isset($attribute->unit))
                                    {{$attribute->unit}}
                                @else
                                    <span class="badge badge-info">واحد ندارد</span>

                                @endif

                            </td>
                            <td>
                                @if($attribute->attribute_type == 'select')
                                    <a href="{{route('show.items.admin', $attribute->id)}}"
                                       class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus-circle nav-icon text-white"></i></a>
                                @else
                                    <span class="badge badge-info">آیتم ندارد</span>
                                @endif
                            </td>
                            <td>
                                @if($attribute->isSignificant==1)
                                    <i class="fa fa-check"></i>
                                @else
                                    <i class="fa fa-close"></i>

                                @endif
                            </td>
                            <td>
                                @if($attribute->isFilterField==1)
                                    <i class="fa fa-check"></i>
                                @else
                                    <i class="fa fa-close"></i>

                                @endif
                            </td>
                            @if($groupAttribute->advertiser=='applicant')

                                <td>
                                    @if($attribute->hasScale==1)
                                        <i class="fa fa-check"></i>
                                    @else
                                        <i class="fa fa-close"></i>
                                    @endif
                                </td>
                            @endif
                            <td>
                                <form action="{{ route('attributes.destroy' ,$attribute->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('attributes.edit', $attribute->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف مشخصه {{$attribute->title}} اطمینان دارید؟')">
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
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
@endsection
