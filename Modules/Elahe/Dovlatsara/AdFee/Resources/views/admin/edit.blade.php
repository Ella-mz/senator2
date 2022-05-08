@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش هزینه
@endsection
@section('header')
    <ol class="breadcrumb float-sm-right">
{{--        <li class="breadcrumb-item"><a href="{{ route('category.index.admin',$category->parent_id)}}">دسته بندی ها</a></li>--}}
{{--        <li class="breadcrumb-item"><a href="{{ route('category.edit.admin',$category->id)}}">ویرایش</a></li>--}}
    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start">
                        <h1 class="card-title">ویرایش هزینه</h1>
                    </div>
                    <form action="{{ route('advertising-fees.update', $adFee->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">مدت زمان انقضای آگهی ها</label><br>
                                <small class="text-secondary">تعداد روز وارد شود.</small>

                                <input type="text" name="expireTimeOfAds" class="form-control" value="{{$adFee->expireTimeOfAds}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('expireTimeOfAds') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="title">هزینه به ازای هر آگهی عادی</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="generalAdFee" class="form-control" value="{{$adFee->generalAdFee}}"
{{--                                       autofocus onkeyup="separateNum(this.value,this);"--}}
                                       onkeyup="document.getElementById('demo_out3').innerHTML = Num2persian(this.value)">
                                <small class="text-danger">{{ $errors->first('generalAdFee') }}</small>

                            </div>
                            <small id="demo_out3"></small>

                        @if($hasScalar)

                            <div class="form-group">
                                <label for="title">هزینه به ازای هر آگهی نردبانی</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="scalarAdFee" class="form-control" value="{{$adFee->scalarAdFee}}"
{{--                                       autofocus onkeyup="separateNum(this.value,this);"--}}
                                       onkeyup="document.getElementById('demo_out2').innerHTML = Num2persian(this.value)">
                                <small class="text-danger">{{ $errors->first('scalarAdFee') }}</small>

                            </div>
                                <small id="demo_out2"></small>

                            @endif
                            @if($hasSpecial)
                            <div class="form-group">
                                <label for="title">هزینه به ازای هر آگهی ویژه</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="specialAdFee" class="form-control" value="{{$adFee->specialAdFee}}"
{{--                                       autofocus onkeyup="separateNum(this.value,this);"--}}
                                       onkeyup="document.getElementById('demo_out1').innerHTML = Num2persian(this.value)">
                                <small class="text-danger">{{ $errors->first('specialAdFee') }}</small>

                            </div>
                                <small id="demo_out1"></small>

                            @endif
                            @if($hasEmergency)
                            <div class="form-group">
                                <label for="title">هزینه به ازای هر آگهی فوری</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="emergencyAdFee" class="form-control" value="{{$adFee->emergencyAdFee}}"
{{--                                       autofocus onkeyup="separateNum(this.value,this);"--}}
                                       onkeyup="document.getElementById('demo_out').innerHTML = Num2persian(this.value)">
                                <small class="text-danger">{{ $errors->first('emergencyAdFee') }}</small>

                            </div>
                                <small id="demo_out"></small>

                            @endif
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش هزینه</button>
                            <a href="{{ route('advertisingFee.index.admin', $adFee->category_id)}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
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

