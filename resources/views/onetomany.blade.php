<div style="background:black;color:white;">

  @foreach ($users as $user)
  <h2>{{ $user->name }}</h2>
  <p>Handle: {{ $user->profile->handle }}</p>
  @foreach ($user->tasks as $task)
  <p>Task: {{ $task->title }}</p>
  <p>Status : {{ $task->status }}</p>
  @endforeach
  @endforeach

</div>
