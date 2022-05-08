<ul class="catalog-list">
    {{$categories}}
    @foreach($categories as $key=>$cat1)
        <li>
            <div class="type-category accordion-item">
                <form action="{{route('supplierFilterPage.user')}}" method="get"
                      id="level1{{$cat1->id}}">
                    <input hidden name="category"
                           value="{{$cat1->id}}">
                    <a onclick="document.getElementById('level1{{$cat1->id}}').submit()"
                       style="cursor: pointer"> <span
                            style="margin-right: 10px">{{$cat1->title}}</span></a>
                </form>
                @if($cat1->categories->count()>0)
                    <button type="button"
                            class="catalog-link main accordion-button  @if($category1 && $category1->id!=$cat1->id) collapsed @else collapsed @endif"
                            data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne{{$cat1->id}}"
                            aria-expanded=" @if($category1 && $category1->id==$cat1->id) true @elseif($key==0 && !$category1) true @endif"
                            aria-controls="panelsStayOpen-collapseOne">
                        <i class="fas fa-chevron-down"></i>

                    </button>
                @endif
            </div>
            @if($cat1->categories->count()>0)
                <ul class="show-more accordion-collapse collapse @if($category1 && $category1->id==$cat1->id) show @endif"
                    id="panelsStayOpen-collapseOne{{$cat1->id}}"
                    aria-labelledby="panelsStayOpen-headingOne">
                    @foreach($cat1->categories()->orderBy('order', 'asc')->get() as $cat_sub_1)
                        <li class="catalog-cat-item ">
                            <div class="type-category accordion-item">
                                <form action="{{route('supplierFilterPage.user')}}"
                                      method="get"
                                      id="level1{{$cat_sub_1->id}}"
                                      class="catalog-cat-item">

                                    <input hidden name="category"
                                           value="{{$cat_sub_1->id}}">
                                    <a style="cursor: pointer"
                                       onclick="document.getElementById('level1{{$cat_sub_1->id}}').submit()">{{$cat_sub_1->title}}</a>
                                </form>
                                @if($cat_sub_1->categories->count()>0)
                                    <button
                                        class="middle-div active accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTwo{{$cat_sub_1->id}}"
                                        aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseTwo">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                @endif
                            </div>
                            @if($cat_sub_1->categories->count()>0)
                                <ul class="catalog-list inner-div accordion-collapse collapse show"
                                    id="panelsStayOpen-collapseTwo{{$cat_sub_1->id}}"
                                    aria-labelledby="panelsStayOpen-headingTwo">
                                    @foreach($cat_sub_1->categories()->orderBy('order', 'asc')->get() as $cat_sub_2)
                                        <li>
                                            <form
                                                action="{{route('supplierFilterPage.user')}}"
                                                method="get"
                                                id="level1{{$cat_sub_2->id}}">
                                                <input hidden name="category"
                                                       value="{{$cat_sub_2->id}}">
                                                <a style="cursor: pointer"
                                                   onclick="document.getElementById('level1{{$cat_sub_2->id}}').submit()"
                                                   class="catalog-link active">{{$cat_sub_2->title}}</a>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
