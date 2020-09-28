@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>
                    {{$post->title}}
                </h4>
            </div>
            <div class="card-body">
                <p>{{$post->content}}</p>
            </div>
        </div>
    </div>
@endsection
