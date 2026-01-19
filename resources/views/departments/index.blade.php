@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold text-white mb-8">Departments and Their Tasks</h1>

@foreach ($departments as $department)
<div class="mb-12">
  <h2 class="text-2xl font-semibold text-gray-100 mb-4">
    {{ $department->name }}
  </h2>

  @if($department->tasks->isEmpty())
  <p class="text-gray-400">No tasks are assigned to this department</p>
  @else
  <div class="overflow-x-auto rounded-lg border border-gray-700 shadow">
    <table class="min-w-full divide-y divide-gray-700 bg-gray-800 text-sm text-left text-gray-300">
      <thead class="bg-gray-700 text-gray-200">
        <tr>
          <th class="px-4 py-2 font-semibold">Task</th>
          <th class="px-4 py-2 font-semibold">Assigned To</th>
          <th class="px-4 py-2 font-semibold">Status</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-700">
        @foreach ($department->tasks as $task)
        <tr>
          <td class="px-4 py-2">{{ $task->title }}</td>
          <td class="px-4 py-2">{{ $task->user->name }}</td>
          <td class="px-4 py-2">{{ $task->status }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
</div>
@endforeach



@endsection
