@extends('AdminMasterNew::master')
@section('urlHeader') مقالات پوزیشن {{$position->name}}
@endsection
@section('header')
    مقالات پوزیشن {{$position->name}}
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('admin-position-article-list',$position->id)}}"
                   class="btn btn-sm btn-primary" style="float: left">افزودن مقاله</a>

                <h1 class="card-title" style="float: right">مقالات پوزیشن <a class="" href="{{route('position.index.admin')}}">{{$position->name}}</a></h1>

            </div>
            <div class="card-body p-0">
                <table  class="table table-bordered table-sm   display responsive nowrap "
                        style="width: 100%">
                    <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th>گروه</th>
                        <th>نویسنده</th>
                        <th>ترتیب</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $articles as $key=>$article)
                        <tr>
                            <td>
                                @if(!is_null($article->image_id))
                                    <img src="{{custom_asset($article->image->link )}}" height="40px" width="40px"
                                         class="img-circle">
                                @endif
                            </td>
                            <td>{{$article->title}}</td>
                            <td>{{$article->group->title}}</td>
                            <td>{{$article->user->firstName}} {{$article->user->lastName}}</td>
                            <td>
                                <input class="form-control form-control-sm text-center orderInput"  type="number" value="{{$article->pivot->order}}" id="{{$article->id}}" min="1">

                            </td>

                            <td>
                                <div class="btn-group">
                                    <a href="{{route('admin-detach-position-article',['article'=>$article->id,'position'=>$position->id])}}"><i
                                            class="fa fa-trash text-danger m-2"></i></a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>

                <!-- Modal -->
                <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered    modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"> تصویر جایگاه</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body d-flex justify-content-center align-content-center" id="modal-image-box">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
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
        function position_image(image)
        {
            let url = `{{asset('')}}`

            $('#modal-image-box').empty();
            $('#modal-image-box').append(`<img src=`+url.concat(image)+` style="max-width: 700px;max-height: 400px;min-width: 300px">`);

        }
    </script>
    <script>
        $('.orderInput').change(function () {
            var order = $(this).val();
            var position ={{$position->id}};
            var article = $(this).attr('id');
            $.ajax({
                url: "{{route('change-order-position-article')}}",
                data: {
                    'article': article,
                    'position': position,
                    'order': order,
                },
                method: "GET",
                dataType: 'JSON',

                success: function (data) {
                    alert("تغییرات با موفقیت اعمال شد")
                    location.reload();
                }
            })
        });


    </script>
@endsection
