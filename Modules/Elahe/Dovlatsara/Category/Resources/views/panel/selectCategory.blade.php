@extends('RealestateMaster::master')
@section('title_realestate')انتخاب دسته بندی
@endsection
@section('card_title')انتخاب دسته بندی
@endsection
@section('css')
    @include('UserMasterNew::layouts.selectCategory-css')
@endsection
@section('content_realestateMaster')
    @include('UserMasterNew::layouts.selectCategory')
@endsection
@section('js_realestate')
    @include('UserMasterNew::layouts.selectCategory-js')
@endsection
