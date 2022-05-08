@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد تبلیغ جدید
@endsection
@section('header')
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1" ></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start" >

                        <h1 class="card-title">تبلیغ جدید</h1>
                    </div>
                    <form action="{{ route('advertisings.store.admin') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="orderPage">مکان تبلغ</label>
                                <select type="text" name="orderPage" class="form-control"
                                        autofocus >
                                    <option value="">
                                    </option>
                                    @foreach($pageOrders as $order)
                                        <option value="{{$order->id}}" @if($order->id==old('oderPage')) selected @endif>{{$order->fa_title}}-{{$order->page->fa_title}}
                                        </option>
                                        @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('orderPage') }}</small>

                            </div>

                            <div class="form-group">
                                <label for="title">عنوان تبلیغ</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus >
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>

                            {{--                            @if($parentId == 0)--}}
                            <div class="form-group">
                                <label for="price">هزینه تبلیغ</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="price" class="form-control" value="{{old('price')}}"
{{--                                       autofocus onkeyup="separateNum(this.value,this);"--}}
                                       onkeyup="document.getElementById('demo_out3').innerHTML = Num2persian(this.value)">
                                <small class="text-danger">{{ $errors->first('price') }}</small>

                            </div>
                            <small id="demo_out3"></small>

                            <div class="form-group">
                                <label for="description">توضیحات تبلیغ</label><br>

                                <textarea type="text" name="description" class="form-control" rows="5"
                                         >{{old('description')}}</textarea>
                                <small class="text-danger">{{ $errors->first('description') }}</small>

                            </div>

                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد تبلیغ</button>
                            <a href="{{route('advertisings.index.admin')}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{asset('files/adminMaster/dist/js/numtostr.js')}}"></script>

@endsection
