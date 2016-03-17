@include('layout.header')
<section class="article">
    <article>
        <h1>{!! $singlePost[0]->title !!}</h1>
        <hr>
        <p>
            Autor: <span class="author">{!! $singlePost[0]->name  !!}</span><br>
            <time pubdate={!! $singlePost[0]->start_post  !!}>{!! $singlePost[0]->start_post  !!}</time>
        </p>
        <div>
            {!! stripslashes($singlePost[0]->description) !!}
        </div>
        <div>
            <a class="btn btn-primary" href="{{ URL::previous() }}" alt="back">
                < back
            </a>
        </div>
    </article>
</section>
@include('layout.footer')
