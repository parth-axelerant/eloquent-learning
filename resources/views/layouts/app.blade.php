<!DOCTYPE html>
<html lang="en" class="dark">

<head>
  <meta charset="UTF-8">
  <title>{{ $title ?? 'Laravel App' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen antialiased">

  <header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Team Manager</h1>
      <nav class="space-x-4">
        <a href="{{ route('teams.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Teams</a>
        <a href="{{ route('users.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Users</a>
      </nav>
    </div>
  </header>

  <main class="py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

      @if (session('status'))
      <div class="mb-6 bg-green-100 dark:bg-green-900 border border-green-300 dark:border-green-700 text-green-800 dark:text-green-100 px-4 py-3 rounded">
        {{ session('status') }}
      </div>
      @endif

      @yield('content')
    </div>
  </main>

</body>

</html>
