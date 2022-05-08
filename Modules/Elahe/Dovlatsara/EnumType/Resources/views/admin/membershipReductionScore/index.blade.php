@extends('AdminMasterNew::master')
@section('urlHeader')کسر امتیازها در حق اشتراک ها
@endsection
@section('header')
    کسر امتیازها در حق اشتراک ها
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title" style="float: right">کسر امتیازها در حق اشتراک ها</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان </th>
                        <th>امتیاز </th>
                        <th>ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $membership_reduction_scores as $key=>$membership_reduction_score)
                        <tr>

                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>
                                {{$membership_reduction_score->description}}
                            </td>
                            <td>
                                {{$membership_reduction_score->link}}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('membership_reduction_score.edit.admin', $membership_reduction_score->id)}}" class="btn btn-sm btn-info"><i class="fa fa-edit text-white "></i></a>
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
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
@endsection
