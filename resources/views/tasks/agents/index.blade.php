@extends('layouts.basic')
@section('content')
<div class="container">

  <div class="row justify-content-center my-3">
      <h1>Travaux</h1>
  </div>

  <div class="row">
    <table class="table table-bordered table-hover" id="table">
      <thead>
      <tr class="">
        <th>Priorité</th>
        <th scope="cols">No</th>
        {{-- <th>Auteur</th> --}}
        <th>Description</th>
        <th>Date</th>
        <th>Bâtiment(s)</th>
        <th>Salle(s)</th>
        <th>Traitant(s)</th>
        <th>Image(s)</th>
        <th>Fini</th>
      </tr>
      </thead>
      {{ csrf_field() }}
      <?php  $no=1; ?>
      <tbody>
      @foreach ($tasks as $task)
        <tr class="task{{$task->id}}">
            <td>{{ $task->priority->name }}</td>
            <td>{{ $task->id }}</td>
            {{-- <td>{{ $task->user->name }}</td> --}}
            <td class="task_description">{{ $task->description }}</td>
            <td>{{ $task->date }}</td>
            <td>
              <ul style="list-style: none" class="flex justify-content">
              @foreach(App\Task::find($task->id)->buildings as $building)
                <li class="b"> {{ $building->name}} </li>  
              @endforeach
              </ul>
            </td>
            <td>
              <ul style="list-style: none" class="flex justify-content">
              @foreach(App\Task::find($task->id)->classrooms as $classroom)
                <li> {{ $classroom->name}} </li>  
              @endforeach
              </ul>
            </td>
            <td>
              <ul style="list-style: none" class="flex justify-content">
              @foreach(App\Task::find($task->id)->users as $user)
                  <li> {{ $user->name}} </li>  
              @endforeach
              </ul>
              <td>
                <a class="show-image btn pl-3" 
                  data-task_id={{$task->id}} 
                  data-images="{{ App\Image::where('imageable_id',$task->id)->get() }}">
                  <svg class="mr-2 bi bi-images" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.002 4h-10a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-10-1a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-10z"/>
                    <path d="M10.648 8.646a.5.5 0 0 1 .577-.093l1.777 1.947V14h-12v-1l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71z"/>
                    <path fill-rule="evenodd" d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM4 2h10a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1v1a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2h1a1 1 0 0 1 1-1z"/>
                  </svg>
                  Voir
                </a>
              </td>
            </td>
            <td class="text-center done">
              <input type="checkbox" name="done_worker" class="done_worker" @if(App\Stat_Task::where('task_id',$task->id)->where('done_worker', 1)->first()) {{ "checked" }} @endif
                data-user_id="{{Auth::id()}}"
                data-task_id="{{$task->id}}">
            </td>
        </tr>
      @endforeach
      </tbody>
      </table>
    </div>
  </div>

</div>
@include('tasks.modal-image-task')
@endsection
