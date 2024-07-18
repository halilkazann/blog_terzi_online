@extends('front.layouts.master')
@section('title',$page->title)
@section('content')
    @section('image',$page->image)

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center ">
            <div class="col-md-9 mx-auto">

              {{$page->content}}


            </div>
            @include('front.Widgets.categoryWidget')
        </div>

    </div>






@endsection
