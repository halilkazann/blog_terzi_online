@extends('front.layouts.master')
@section('title','Blog Sitesi')
@section('content')
<!-- Main Content-->

<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center ">

        <div class="col-md-9">
            <!-- Post preview-->

            @foreach($articles as $article)

                <div class="post-preview">
                    <a href="{{route('singleContent',$article->slug)}}">
                        <h2 class="post-title">{{$article->title}}</h2>
                        <img src="{{$article->image}}">
                        <h3 class="post-subtitle">{{\Illuminate\Support\Str::limit($article->content,200)}}</h3>
                        <p class="post-meta">
                            <a href="#">{{$article->getCategory->name}}</a>
                            {{$article->created_at}}
                        </p>
                    </a>
                </div>
                @if(!$loop->last)
                    <hr>
                @endif
            @endforeach


            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
        </div>

        @include('front.Widgets.categoryWidget')
        </div>
    </div>
</div>

@endsection
