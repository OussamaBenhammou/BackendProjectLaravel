@extends('layouts.app')

@section('content')
<div class="container">
    <h1>FAQ</h1>

    <div class="accordion" id="faqAccordion">
        @foreach ($categories as $category)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $category->id }}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="true" aria-controls="collapse{{ $category->id }}">
                    {{ $category->name }}
                </button>
            </h2>
            <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <ul>
                        @foreach ($category->questions as $question)
                        <li class="faq-question">
                            <strong>{{ $question->question }}</strong><br>
                            <div class="answer">
                                {{ $question->answer }}
                            </div>
                            <div class="button-group">
                                <form action="{{ route('faq.storeAnswer', ['id' => $question->id]) }}" method="POST">
                                    @csrf
                                    <h4 style="font-size: smaller; color: green;">Reponse Admin:</h4>
                                    <textarea name="admin_answer" rows="4" cols="50"></textarea>
                                    <button type="submit" class="btn btn-primary" style="background-color: lightgreen;">Opslaan</button>
                                </form>
                                @if (auth()->user()->isAdmin())
                                    <form action="{{ route('faq.destroy', ['id' => $question->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Verwijderen</button>
                                    </form>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

