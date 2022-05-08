@extends('UserMasterNew::master')
@section('title_user')سوالات متداول
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/F&Q.css')}}">

@endsection
@section('content_userMasterNew')
    <main>
        <div class="qusetion-page">
            <div class="qusetion-header">
                <div class="qusetion-header-show">
                    <div class="qusetion-header-title">
                        <h2>
                            پاسخ پرسش های پر تکرار
                        </h2>
                    </div>
                    <div class="qusetion-header-search-box">
                        <form action="{{route('commonQuestions.search.user')}}" method="post">
                            @csrf
                            <input name="search" type="text" placeholder="پرسش خود را جستجو کنید">
                            <button>
                                جستجو
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="container">
                <div class="qusetion-box">
                    <div class="qusetion-box-show">
                        <div class="qusetion-box-show-title">
                            <h2>
                                پاسخ پرسش های پر تکرار
                            </h2>
                        </div>
                        <div class="qusetion-box-show-item">
                            <div class="qusetion-box-show-item-box">
                                <div class="accordion" id="accordionExample">
                                    @foreach($commonQuestions as $question)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo{{$question->id}}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{$question->id}}" aria-expanded="false" aria-controls="collapseTwo">
                                                <h3>{{$question->title}}</h3>
                                            </button>
                                        </h2>
                                        <div id="collapseTwo{{$question->id}}" class="accordion-collapse collapse" aria-labelledby="headingTwo{{$question->id}}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {{$question->description}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
@section('js_user')
@endsection
