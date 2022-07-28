<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>User Card - {{ $user->name }} </title>
  @vite(['resources/css/app.css', 'resources/css/noscript.css', 'resources/js/app.js'])
</head>

<body class="is-preload">
  <div id="wrapper">
    <section id="main">
      <header>
        <span class="avatar"><img src="images/users/{{ $user->id }}.jpg" alt="{{ $user->name }}" /></span>
        <h1>{{ $user->name }}</h1>
        <p>{{ nl2br($user->comments) }}</p>
      </header>
    </section>
    <footer id="footer">
      <ul class="copyright">
        <li>&copy; Pictureworks</li>
      </ul>
    </footer>

  </div>
  <script>
    if ('addEventListener' in window) {
      window.addEventListener('load', function () {
        document.body.className = document.body.className.replace(/\bis-preload\b/, '');
      });
      document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
    }

  </script>
</body>
</html>
