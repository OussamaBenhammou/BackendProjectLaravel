@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">profiel van {{ $user->name }} </div>

                <div class="card-body">
                    <h2>Gemaakt Posts</h2>

                    @foreach($user->posts as $post)
                     <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a><br>
                    @endforeach

                    <hr>

                    <h2>Liked Posts</h2>

                    @foreach($user->likes as $like)
                     <a href="{{ route('posts.show', $like->post_id) }}">{{ $like->post->title }}</a><br>
                    @endforeach

                    <hr>

                    <h2>Edit Profile</h2>
                    <form method="POST" action="{{ route('profile.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>


                </div>
            </div>
            @if(session('success'))
    <div class="alert alert-success mt-5">
        {{ session('success') }}
    </div>
@endif
        </div>
    </div>
</div>
@endsection
