@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold">Teams</h2>
</div>

<div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
  <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead class="bg-gray-50 dark:bg-gray-700">
      <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Name</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Users</th>
        <th class="px-6 py-3"></th>
      </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
      @foreach ($teams as $team)
      <tr>
        <td class="px-6 py-4 font-medium">{{ $team->name }}</td>
        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
          {{ $team->users_count }}
        </td>
        <td class="px-6 py-4 text-right">
          <a href="{{ route('teams.users.edit', $team) }}"
            class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
            Assign Users
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
