@extends('adfee::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('adfee.name') !!}
    </p>
@endsection
