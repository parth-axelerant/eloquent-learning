@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Assign Users to {{ $team->name }}</h2>

<form method="POST" action="{{ route('teams.users.update', $team) }}">
  @csrf
  @method('PUT')

  <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700 mb-6 bg-white dark:bg-gray-800 rounded shadow">
    <thead class="bg-gray-50 dark:bg-gray-700">
      <tr>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">User</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Assign</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Role</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
      @foreach ($users as $user)
      @php
      $isChecked = in_array($user->id, $assigned);
      $currentRole = $isChecked ? $team->users->firstWhere('id', $user->id)->pivot->role : 'member';
      @endphp
      <tr>
        <td class="px-6 py-4">{{ $user->name }}</td>
        <td class="px-6 py-4">
          <input type="checkbox" name="users[{{ $user->id }}][assigned]" value="1"
            {{ $isChecked ? 'checked' : '' }}
            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
        </td>
        <td class="px-6 py-4">
          <select name="users[{{ $user->id }}][role]"
            class="rounded border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-blue-500 p-2">
            @foreach (['owner', 'member', 'guest'] as $role)
            <option value="{{ $role }}" {{  $currentRole === $role ? 'selected' : '' }}>
              {{ $role }}
            </option>
            @endforeach
          </select>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
    Save
  </button>
</form>
@endsection
