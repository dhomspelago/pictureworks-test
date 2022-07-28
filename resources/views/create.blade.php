@extends('app')

@section('content')
  <section id="main">
    <form action="{{ route('users.update', $user) }}" method="POST">
      @csrf
      <label for="password">Password</label>
      <input type="text" name="password" value="" id="password">
      <label for="comment">Comment</label>
      <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
      <br>
      <button type="submit">Submit</button>
    </form>
  </section>
@endsection
