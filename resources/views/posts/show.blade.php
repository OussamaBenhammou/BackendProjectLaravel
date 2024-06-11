@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post->title  }}</div>

                <div class="card-body">



                    <small>Gepost door <a href="{{ route('profile', $post->user->name) }}"> {{ $post->user->name }}</a> op {{ $post->created_at->format('d/m/y \o\m H:i') }}</small><br>
                    {{ $post->message}}
                    <br><br>
                    @auth
                    @if ($post->user_id == Auth::user()->id)
                    <a href="{{ route('posts.edit', $post->id) }}">Edit Post</a>
                    @else
                        <a href="{{ route('like', $post->id) }}">Like Post</a>
                    @endif

                    <br>
                    @endauth
                    Post heeft {{ $post->likes()->count()}} likes
                    @auth
                    @if(Auth::user()->is_admin)
                    <br><br>
                    <form method="post" action="{{route('posts.destroy', $post->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mb-2 mt-2">DELETE !</button>

                    </form>
                    @endif
                    @endauth
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

