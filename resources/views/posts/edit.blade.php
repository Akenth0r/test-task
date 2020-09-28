@extends('layouts.app')
@section('content')
    <div class="container card">
        <form action="{{route('posts.update', compact('post'))}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <div class="row card-header">
                <h3>Update the post</h3>
            </div>

            <div class="card-body">
                <!-- Title -->
                <div class="form-group row">
                    <div class="col-md-6 p-0">
                        <label for="title">Title</label>
                        <input type="text"
                               id="title"
                               class="form-control @error('content') is-invalid @enderror"
                               name="title"
                               value="{{$post->title}}"
                               autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                        @enderror
                    </div>
                </div>

                <!-- Content -->
                <div class="form-group row form-check">
                    <input class="form-check-input" type="checkbox" name="private" id="private" {{$post->private ? 'checked' : ''}}>
                    <label class="form-check-label" for="private">Private</label>
                </div>

                <div class="form-group row">
                    <label for="content">Content</label>
                    <textarea
                              id="content"
                              class="form-control @error('content') is-invalid @enderror"
                              name="content"
                              autofocus
                              rows="10">{{$post->content}}
                    </textarea>
                    @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="row pt-2">
                    <button class="btn btn-primary" type="submit" >Update the post</button>
                </div>
            </div>
        </form>
    </div>
@endsection
