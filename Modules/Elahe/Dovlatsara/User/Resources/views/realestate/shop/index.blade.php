@extends('RealestateMaster::master')
@section('title_realestate')کسب و کار من
@endsection
@section('card_title') اطلاعات کسب و کار
@endsection
@section('content_realestateMaster')
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold">اطلاعات کسب و کار</h3>
                    <div class="card-tools">
                        <div class="input-group-append">
                            @if($user->hasRole('real-state-administrator'))

                                <a
                                    href="{{route('realEstate.show.user' ,$user->slug)}}"
                                    class="btn" target="_blank"
                                    style="background-color: #fff;color: #3c3cce;border-color: #3c3cce">مشاهده صفحه</a>
                            @else
                                <a
                                    href="{{route('realEstate.show.user' ,\Modules\User\Entities\User::find($user->real_estate_admin_id)->slug)}}"
                                    class="btn" target="_blank"
                                    style="background-color: #fff;color: #3c3cce;border-color: #3c3cce">مشاهده صفحه</a>
                            @endif
                            @can('EditShopInPanel')
                                <a
                                    href="{{route('user.shop.edit.realestate' ,$user->id)}}"
                                    class="btn"
                                    style="background-color: #3c3cce;color: #fff">ویرایش اطلاعات کسب و کار</a>
                            @endcan
                            @can('QuitFromAgency')
                                <a
                                    href="{{route('user.shop.quitFromAgency.panel' , auth()->id())}}"
                                    class="btn"
                                    onclick="return confirm('آیا از خروج از کسب و کار اطمینان دارید؟ درصورت خروج از کسب و کار امکان لاگین در پنل را ندارید')"
                                    style="background-color: #3c3cce;color: #fff">خروج از کسب و کار</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tr>
                            <th>نام کسب و کار</th>
                            <td>
                                @if($user->hasRole('real-state-administrator'))
                                    {{$user->shop_title}}
                                @else
                                    {{\Modules\User\Entities\User::find($user->real_estate_admin_id)->shop_title}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>شهر و محله</th>
                            <td>
                                @if($user->hasRole('real-state-administrator'))
                                    {{$user->city->title}} @if(isset($user->shop_neighborhood_id))
                                        - {{$user->neighborhood->title}}@endif
                                @else
                                    {{\Modules\User\Entities\User::find($user->real_estate_admin_id)->city->title}}
                                    @if(isset(\Modules\User\Entities\User::find($user->real_estate_admin_id)->shop_neighborhood_id))
                                        - {{\Modules\User\Entities\User::find($user->real_estate_admin_id)->neighborhood->title}}@endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>تلفن</th>
                            <td>
                                @if($user->hasRole('real-state-administrator'))
                                    {{$user->shop_phone}}
                                @else
                                    {{\Modules\User\Entities\User::find($user->real_estate_admin_id)->shop_phone}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>وضعیت</th>
                            <td>
                                @if($user->hasRole('real-state-administrator'))
                                    @if($user->shop_active=='active')
                                        <span style="color: #00B74A">تایید</span>
                                    @elseif($user->shop_active=='disConfirm')
                                        <span style="color: #F93154">عدم تایید</span>
                                    @elseif($user->shop_active=='inactive')
                                        غیرفعال
                                    @endif
                                @else
                                    @if(\Modules\User\Entities\User::find($user->real_estate_admin_id)->shop_active=='active')
                                        <span style="color: #00B74A">تایید</span>
                                    @elseif(\Modules\User\Entities\User::find($user->real_estate_admin_id)->shop_active=='disConfirm')
                                        <span style="color: #F93154">عدم تایید</span>
                                    @elseif(\Modules\User\Entities\User::find($user->real_estate_admin_id)->shop_active=='inactive')
                                        غیرفعال
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>تاریخ شروع فعالیت</th>
                            <td>
                                @if($user->hasRole('real-state-administrator'))
                                    {{$user->yearOfOperation}}
                                @else
                                    {{\Modules\User\Entities\User::find($user->real_estate_admin_id)->yearOfOperation}}
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <th>آدرس صفحه ی شما</th>
                            <td>
                                @if($user->hasRole('real-state-administrator'))
                                    <a href="{{(route('realEstate.show.user', $user->slug))}}" target="_blank">{{url(route('realEstate.show.user', $user->slug))}}</a>

                                @else
                                    <a href="{{(route('realEstate.show.user', \Modules\User\Entities\User::find($user->real_estate_admin_id)->slug))}}" target="_blank">
                                        {{url(route('realEstate.show.user',  \Modules\User\Entities\User::find($user->real_estate_admin_id)->slug))}}</a>

                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>وبسایت</th>
                            <td>
                                @if($user->hasRole('real-state-administrator'))
                                    <a href="{{$user->shop_website}}" target="_blank">{{$user->shop_website}}</a>
                                @else
                                    <a href="{{$user->shop_website}}"
                                       target="_blank">{{\Modules\User\Entities\User::find($user->real_estate_admin_id)->shop_website}}</a>
                                @endif
                            </td>
                        </tr>
                        @foreach($user->socialMedias as $socialMedia)
                            <tr>
                                <th>{{$socialMedia->type_persian}}</th>
                                <td>
                                    <a href="{{$socialMedia->link}}" target="_blank">{{$socialMedia->link}}</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>آدرس</th>
                            <td>
                                @if($user->hasRole('real-state-administrator'))
                                    {{$user->shop_address}}
                                @else
                                    {{\Modules\User\Entities\User::find($user->real_estate_admin_id)->shop_address}}
                                @endif
                            </td>

                        </tr>
                    </table>
                </div>
                <hr>
                <div class="card-body">
                    <div class="callout callout-costumBlue">
                        <h5>درباره ما</h5>
                        <p class="text text-danger">اینجا هر متنی را بنویسید کاربران بعنوان معرفی شما خواهند دید</p>
                        <p>
                            @if($user->hasRole('real-state-administrator'))
                                {{$user->shop_description}}
                            @else
                                {{\Modules\User\Entities\User::find($user->real_estate_admin_id)->shop_description}}
                            @endif
                        </p>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@section('js_realestate')
@endsection
