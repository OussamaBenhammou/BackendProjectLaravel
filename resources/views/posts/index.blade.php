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
                <h3 class="post-title" >
                    <a href="{{ route('posts.show', $post->id)}}" class="text-decoration-none text-dark">{{ $post->title }}</a>
                </h3>                    <p>{{ $post->message }}</p>
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

                    @endif
                    <br>
                    <form action="{{ route('like', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" style="border: none; background: none;">
                            @if($post->likedBy(auth()->user()))
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                              </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            @endif
                        </button>
                    </form>


                    @endauth
                    <br>
                    {{ $post->likes()->count() }} likes
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

