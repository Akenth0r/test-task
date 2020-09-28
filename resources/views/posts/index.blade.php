@extends('layouts.app')
@section('content')
    <div class="container shadow p-4 rounded">
        <h2>Recent posts</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Posted</th>
                    <th>Author</th>
                </tr>
            </thead>
            @foreach ($posts as $post)
                <tr>
                    <td>
                        <a href="{{route('posts.show', ['post' => $post->id])}}">{{$post->title}}</a>
                        @if($user->id == $post->user->id)
                            <a href="{{route('posts.edit', compact('post'))}}" class="mx-1"><span class="fas fa-edit text-dark"></span></a>
                            <a href="" onclick="event.preventDefault(); document.getElementById('delete-form').submit()">
                                <span class="fas fa-trash text-dark"></span>
                            </a>
                            <form action="{{route('posts.destroy', compact('post'))}}" method="post" id="delete-form" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                        @endif
                    </td>
                    <td>
                        {{$post->created_at->diffForHumans()}}
                    </td>
                    <td>
                        {{$post->user->name}}
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="row">
            <div class="col-12">
                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection
