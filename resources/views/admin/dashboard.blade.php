@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tableau de Bord</div>

                <div class="card-body">
                    <h2>Liste des Utilisateurs</h2>
                    <ul class="list-group">
                        @foreach($users as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                {{ $user->name }} ({{ $user->email }})
                            </div>

                            @if(!$user->isAdmin())
                            <form action="{{ route('promote', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">promote</button>
                            </form>
                            @else
                            <span class="badge badge-success text-black">Admin</span>

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
