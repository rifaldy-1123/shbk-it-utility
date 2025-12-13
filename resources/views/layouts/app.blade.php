<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="{{ asset('assets/icons/Santosa.png') }}" />
  <title>Utility</title>
  @vite('resources/css/app.css')
  @stack('styles')
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>

<!-- Menu Nav Header-->
<div class="min-h-full">

  @include('components.sidebar')
  <!--<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      @-yield('content')
    </div>
  </main>-->
</div>

</body>
</html>
