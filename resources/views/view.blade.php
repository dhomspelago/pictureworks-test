@extends('app')

@section('content')
<section id="main">
  <header>
    <span class="avatar"><img src="/images/users/{{ $user->id }}.jpg" alt="{{ $user->name }}" /></span>
    <h1>{{ $user->name }}</h1>
    <p>{{ nl2br($user->comments) }}</p>
  </header>
</section>
@endsection
