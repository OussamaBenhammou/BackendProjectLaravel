<form action="{{ route('faq.store') }}" method="POST">
  @csrf

  <div>
    <label for="question">Question</label>
    <input type="text" name="question" id="question" required>
  </div>

  <div>
    <label for="answer">Answer</label>
    <textarea name="answer" id="answer" rows="4" required></textarea>
  </div>

  <button type="submit">Submit</button>
</form>
