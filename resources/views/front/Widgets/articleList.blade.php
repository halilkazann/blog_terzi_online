@foreach($articles as $article)

    <div class="post-preview">
        <a href="{{route('singleContent',[$article->getCategory->slug,$article->slug])}}">
            <h2 class="post-title">{{$article->title}}</h2>
            <img src="{{$article->image}}">
            <h3 class="post-subtitle">{!! \Illuminate\Support\Str::limit($article->content,200) !!}</h3>
            <p class="post-meta">
                <a href="{{route('category' , $article->getCategory->slug)}}">{{$article->getCategory->name}}</a>
                {{$article->created_at}}
            </p>
        </a>
    </div>
    @if(!$loop->last)
        <hr>
    @endif
@endforeach

{{$articles->links('pagination::bootstrap-4')}}
