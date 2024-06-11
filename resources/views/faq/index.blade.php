@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>FAQ Page</h1>

        <ul>
            @foreach($faqs as $faq)
                <li>
                    <h4>{{ $faq->question }}</h4>
                    <p>{{ $faq->answer }}</p>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
