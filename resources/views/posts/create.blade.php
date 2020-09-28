@extends('layouts.app')
@section('content')
    <div class="container card">
        <form action="{{route('posts.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row card-header">
                <h3>Create new post</h3>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6 p-0">
                        <label for="title">Title</label>
                        <input type="text"
                               id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               name="title"
                               value="{{old('title')}}"
                               autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content">Content</label>
                    <textarea type=""
                              id="content"
                              class="form-control @error('content') is-invalid @enderror"
                              name="content"
                              autofocus
                              rows="10">
                    {{old('content')}}
                    </textarea>
                    @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row pt-2">
                    <button class="btn btn-primary">Create new post</button>
                </div>
            </div>
        </form>
    </div>
@endsection
