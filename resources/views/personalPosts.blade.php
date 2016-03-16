@include('layout.header')
<h1 class="center">News</h1>
<hr>
<a class="btn btn-primary" href="{{ URL::to('personal/post/create') }}" role="button">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New post
</a>
<table class="table">
    <thead>
        <th>
            Name
        </th>
        <th>
            Start post
        </th>
        <th>
            Autor
        </th>
        <th>
            Controls
        </th>
    </thead>
    @foreach ($listPosts as $post)
        <tr class="<?php if ($post->name != Auth::user()->name){ echo 'danger'; }?>" >
            <td>
                {!! $post->title  !!}
            </td>
            <td>
                {!! $post->start_post  !!}
            </td>
            <td>
                {!! $post->name  !!}
            </td>
            <td>
                <a href="{{ URL::to('personal/post/' . $post->id . '/edit') }}" alt="edit post">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a href="{{ URL::to('personal/post/' . $post->id . '/delete') }}" alt="delete post">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>

            </td>
        </tr>
    @endforeach
</table>
<div class="pagination"> {{ $listPosts->links() }} </div>
@include('layout.footer')