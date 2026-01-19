@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold">Users</h2>
</div>

<div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
  <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead class="bg-gray-50 dark:bg-gray-700">
      <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Name</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Teams</th>
        <th class="px-6 py-3"></th>
      </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
      @foreach ($users as $user)
      <tr>
        <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
        <td class="text-center group">
          <div class="relative inline-block cursor-pointer">
            <span class="text-blue-500 underline">
              {{ $user->teams_count }}
            </span>

            <!-- Tooltip -->
            <div class="absolute left-1/2 top-full z-10 mt-1 w-48 -translate-x-1/2 rounded-lg bg-gray-800 p-2 text-sm text-white opacity-0 group-hover:opacity-100 group-hover:visible invisible transition-opacity duration-200 border-1 border-gray-700">
              <ul class="list-inside">
                @foreach ($user->teams as $team)
                <li>{{ $team->name }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </td>
        <td class="px-6 py-4 text-right">
          <a href="{{ route('users.teams.edit', $user) }}"
            class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
            Assign Teams
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
