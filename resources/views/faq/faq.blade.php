@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>FAQ</h1>
<br>
        <div class="row">

          <div class="col-md-6">
            <h2>After-sales</h2>

            <form method="POST" action="{{ route('faq.store') }}">
                @csrf
                <input type="hidden" name="category" value="After-service">
                <div class="mb-3">
                    <label for="question">Title</label>
                    <input type="text" name="question" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="answer">Question</label>
                    <textarea name="answer" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            <br>
            <br>
            <h3>Questions and Answers</h3>
            <ul>
                @foreach ($categories as $category)
                    @if ($category->name === 'After-service')
                        @foreach ($category->questions as $question)
                            <li>
                                <h4>{{ $question->question }}</h4>
                                <p><strong>User's Question:</strong> {{ $question->answer }}</p>
                                @if ($question->admin_answer)
                                    <p class="admin-answer"><strong>Admin's Answer:</strong> {{ $question->admin_answer }}</p>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </div>

            <div class="col-md-6">
                <h2>Question about us</h2>

                <form method="POST" action="{{ route('faq.store') }}">
                  @csrf
                  <input type="hidden" name="category" value="Vragen over ons">
                  <div class="mb-3">
                      <label for="question">Titre</label>
                      <input type="text" name="question" class="form-control" required>
                  </div>
                  <div class="mb-3">
                      <label for="answer">Question</label>
                      <textarea name="answer" class="form-control" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
              </form>
                <br>
                <br>

                <h3>Questions and Answers</h3>
                <ul>
                    @foreach ($categories as $category)
                        @if ($category->name === 'Vragen over ons')
                            @foreach ($category->questions as $question)
                                <li>
                                    <h4>{{ $question->question }}</h4>
                                    <p><strong>User's Question:</strong> {{ $question->answer }}</p>
                                    @if ($question->admin_answer)
                                        <p class="admin-answer"><strong>Admin's Answer:</strong> {{ $question->admin_answer }}</p>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

