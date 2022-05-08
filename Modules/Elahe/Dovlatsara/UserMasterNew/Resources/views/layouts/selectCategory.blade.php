<input hidden name="chooseAdType" id="chooseAdType" value="{{$type}}">
<input hidden name="panel" id="panel" value="{{$panel}}">
<section class="category-page">
    <div class="row show-category">
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="show-category-bg">
                <h2>لطفا دسته بندی خود را انتخاب نمایید</h2>
                <div class="show-category-box">
                    <ul>
                        <div id="content-cats">
                            @foreach($cats as $key=>$c)
                                @if($key%2==0)
                                    <li class="li-bg-light-gray" onclick="nextCats(this.id)" id="{{$c->id}}">
                                <span>
                                    {{$c->title}}
                                 </span>
                                        <i class="fa fa-angle-left"></i>

                                    </li>
                                @else
                                    <li class="li-bg-gray" onclick="nextCats(this.id)" id="{{$c->id}}">
                                <span>
                                    {{$c->title}}

                                </span>
                                        <i class="fa fa-angle-left"></i>
                                    </li>
                                @endif
                            @endforeach
                        </div>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-12 d-flex justify-content-end align-items-end mb-3 mt-3">
            <div class="show-category-bg">

                <div id="content-backbutton">

                    {{--                        <a class="btn btn-danger" onclick="prevCats(this.id)" id="1235">hjh</a>--}}
                </div>
            </div>
        </div>
    </div>
</section>
