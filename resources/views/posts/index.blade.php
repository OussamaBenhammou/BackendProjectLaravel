@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alle Posts</div>

                <div class="card-body">


                    @foreach($posts as $post)
                    <h3> <a href="{{ route('posts.show', $post->id)}}">{{ $post->title }}</a></h3>
                    <p>{{ $post->message }}</p>
                    <small>Gepost door <a href="{{ route('profile', $post->user->name) }}"> {{ $post->user->name }}</a> op {{ $post->created_at->format('d/m/y \o\m H:i') }}</small><br>
                    @auth
                    @if ($post->user_id == Auth::user()->id)
                    <a href="{{ route('posts.edit', $post->id) }}">Edit Post</a>
                    @else
                        <a href="{{ route('like', $post->id) }}">Like Post</a>
                    @endif

                    <br>
                    @endauth
                    Post heeft {{ $post->likes()->count()}} likes
                    <hr>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    @if (session('status'))
    <div class="alert alert-success mt-4" role="alert">
        {{ session('status') }}
    </div>
@endif
</div>
@endsection

