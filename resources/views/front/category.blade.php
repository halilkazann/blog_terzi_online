

@extends('front.layouts.master')
@section('title','Blog Sitesi')
@section('content')
<!-- Main Content-->

<div class="container px-4 px-lg-5">

    <div class="row gx-4 gx-lg-5 justify-content-center ">

        <div class="col-md-9">
            @if(count($articles)>0) <!-- Post preview-->

            @include('front.Widgets.articleList')
            @else
                <div class="alert alert-danger"> Kategoriye ait veri bulunamadı.</div>
            @endif
            <!-- Pager-->

        </div>

        @include('front.Widgets.categoryWidget')
        </div>
    </div>
</div>





@endsection

