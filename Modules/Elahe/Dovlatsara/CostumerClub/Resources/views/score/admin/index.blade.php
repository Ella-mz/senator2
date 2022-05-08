@extends('AdminMasterNew::master')
@section('urlHeader')امتیازها
@endsection
@section('header')
    امتیازها
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
{{--                <a href="{{route('memberships.create')}}"--}}
{{--                   class="btn btn-sm btn-primary" style="float: left">ایجاد امتیاز جدید</a>--}}
                <h1 class="card-title" style="float: right">امتیازها</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>عنوان</th>
                        <th>امتیاز ریالی</th>
                        <th>امتیاز غیرریالی</th>
                        <th>نوع امتیاز</th>
                        <th>متن ارسالی به کاربران</th>
                        <th>فعالسازی/غیرفعالسازی</th>
                        <th>ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $scores as $key=>$score)
                        <tr>
                            <td>{{$score->title}}</td>
                            <td>{{$score->bonus}}</td>
                            <td>{{$score->grant}}</td>

                            <td>
                                @if($score->type=='increase')
                                    <span class="badge badge-success">افزایشی</span>
                                @elseif($score->type=='decrease')
                                    <span class="badge badge-danger">گاهشی</span>
                                @endif

                            </td>
                            <td>{{$score->description}}</td>
                            <td>
                                <input class="form-control form-control-sm statusInput" type="checkbox"  value="1" id="{{$score->id}}" {{$score->status=='active'?"checked":""}}>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('score.edit.admin', $score->id)}}"><i
                                            class="fa fa-edit text-info m-2"></i></a>
                                </div>
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
        $('.statusInput').change(function(){
            var score_id= $(this).attr('id');
            if ($(this).is(":checked")) {
                var status ='active';
            } else {
                var status ='deactivate';
            }
            $.ajax({
                url:"{{route('change_score_status')}}",
                data:{
                    'status':status,
                    'score_id':score_id,
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
