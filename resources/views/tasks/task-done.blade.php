@extends('layouts.basic')
@section('content')

<div class="container">

  <div class="row justify-content-center mt-3">
      <h2 class="text-center font-weight-light my-3">Travaux terminés</h2>
  </div>

  <div class="row">
    <table class="table table-bordered table-hover" id="table">
      <thead>
        <tr class="text-center font-weight-light">
          <th>No</th>
          <th>Auteur</th>
          <th>Description</th>
          <th>Date</th>
          <th>Bâtiment(s)</th>
          <th>Salle(s)</th>
          <th>Traitant(s)</th>
          <th>Action</th>
          <th>Infos</th>
          {{-- <th>Etat</th> --}}
        </tr>
      </thead>
      {{ csrf_field() }}
      <?php  $no=1; ?>
      <tbody class="text-center">
        @foreach($stat_task as $task_id)
        @foreach (App\Task::find($task_id) as $task)
            <tr class="task{{$task->id}}">
                <td>{{ $task->id }}</td>
                <td>{{ $task->user->name }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->date }}</td>
                <td class="align-middle">
                    @foreach(App\Task::find($task->id)->buildings as $building)
                    <span class="text-center"> {{ $building->name}} </span><br>
                    @endforeach
                </td>
                <td class="align-middle">
                    @foreach(App\Task::find($task->id)->classrooms as $classroom)
                    <span> {{ $classroom->name}} </span><br>
                    @endforeach
                </td>
                <td class="align-middle">
                    @foreach(App\Task::find($task->id)->users as $user)
                    <span> {{ $user->name}} </span>  
                    @endforeach
                </td>
                <td>
                    <div class="btn-group">
                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item show-modal btn pl-3" 
                        data-approve_id="{{$task->approve_id}}" 
                        data-type_id="{{$task->type_id}}" 
                        data-id="{{$task->id}}" 
                        data-user="{{$task->user->name}}"
                        data-description="{{$task->description}}" 
                        data-date="{{$task->date}}"
                        data-buildings="{{ $task->buildings->pluck('name') }}"
                        data-classrooms="{{ $task->classrooms->pluck('name') }}"
                        data-users_task="{{ $task->users->pluck('name') }}"
                        data-images="{{ App\Image::where('imageable_id',$task->id)->get() }}">
                        <svg class="mr-2 bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                            <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                        Voir
                        </a>
                        <a class="dropdown-item show-image btn pl-3" 
                        data-task_id={{$task->id}} 
                        data-images="{{ App\Image::where('imageable_id',$task->id)->get() }}">
                        <svg class="mr-2 bi bi-images" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.002 4h-10a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-10-1a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-10z"/>
                            <path d="M10.648 8.646a.5.5 0 0 1 .577-.093l1.777 1.947V14h-12v-1l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71z"/>
                            <path fill-rule="evenodd" d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM4 2h10a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1v1a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2h1a1 1 0 0 1 1-1z"/>
                        </svg>
                        Image(s)
                        </a>
                    </div>
                    </div>
                </td>
                <td>
                    bouton pour plus d'infos
                </td>
            </tr>
        @endforeach
        @endforeach
      </tbody>
    </table>
</div>

@include('tasks.modal-show-task')
@include('tasks.modal-image-task')
</div>
@endsection
