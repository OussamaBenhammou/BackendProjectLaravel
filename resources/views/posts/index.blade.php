@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alle Posts</div>

                <div class="card-body">


                    @foreach($posts as $post)
                    @if($post->image)
                    <div class="post-image text-center" style="height: 400px; overflow: hidden; background-image: url('{{ $post->image }}'); background-size: cover; background-position: center;"></div>

                @endif
                <br>
                    <h3> <a href="{{ route('posts.show', $post->id)}}">{{ $post->title }}</a></h3>
                    <p>{{ $post->message }}</p>
                    <small>Gepost door <a href="{{ route('profile', $post->user->name) }}"> {{ $post->user->name }}</a> op {{ $post->created_at->format('d/m/y \o\m H:i') }}</small><br>
                    @auth
                    @if ($post->user_id == Auth::user()->id || Auth::user()->isAdmin())
                    <br>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">
                            <a class="text-white" style="text-decoration: none" href="{{ route('posts.edit', $post->id) }}">Edit Post</a>
                        </button>
                    </div>
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

