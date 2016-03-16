@include('layout.header')
<h1 class="center">News</h1>
<hr>
<section class="articles">
    @foreach ($listPosts as $post)
        <article>
            <h2>{!! $post->title !!}</h2>
            <p>
                Autor: <span class="author">{!! $post->name  !!}</span><br>
                <time pubdate={!! $post->start_post  !!}>{!! $post->start_post  !!}</time>
            </p>
            <p>
                {!! $post->preview !!}
            </p>
            <div>
                <a class="btn btn-primary" href="{{ URL::to("posts/$post->id") }}" alt="More >">
                    More >
                </a>
            </div>
        </article>
    @endforeach
</section>
<div class="pagination"> {{ $listPosts->links() }} </div>
@include('layout.footer')
