@extends('front.layouts.master')
@section('title',$articles->title)
@section('content')
    @section('image'){{asset('').$articles->image}}@endsection

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center ">
                    <div class="col-md-9 mx-auto">

                       {!! $articles->content !!}


                    </div>
@include('front.Widgets.categoryWidget')
        </div>
        <span class="text-danger"> Okunma Sayısı : {{$articles->hit}}</span>
    </div>






@endsection
