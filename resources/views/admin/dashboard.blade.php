@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <h2>users list </h2>
                    <ul class="list-group">
                        @foreach($users as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                {{ $user->name }} ({{ $user->email }})
                                @if($user->isAdmin())
                                    <span class="badge badge-success text-black">Admin</span>
                                @endif
                            </div>
                            @if($user->isAdmin() && $user->id !== auth()->user()->id)
                            <form action="{{ route('remove.admin', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Remove Admin</button>
                            </form>
                            @endif
                            @if(!$user->isAdmin() && $user->id !== auth()->user()->id)
                            <form action="{{ route('promote', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Add Admin</button>
                            </form>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
