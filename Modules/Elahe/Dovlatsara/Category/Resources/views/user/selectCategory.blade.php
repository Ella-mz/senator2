@extends('UserMasterNew::master')
@section('title_user')انتخاب دسته بندی
@endsection
@section('css_user')
    @include('UserMasterNew::layouts.selectCategory-css')
@endsection
@section('content_userMasterNew')
    @include('UserMasterNew::layouts.selectCategory')
@endsection
@section('js_user')
    @include('UserMasterNew::layouts.selectCategory-js')
@endsection
