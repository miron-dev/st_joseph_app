@extends('layouts.basic')
@section('content')

<div class="container-fluid">

  <div class="row justify-content-center my-3">
      <h2 class="text-center font-weight-light">Liste des travaux</h2>
  </div>

  

  <div class="justify-content-center">

    <div>
      <a class="create-modal btn mb-3 d-flex align-items-center pl-0">
        <div class="mr-2 pb-1">
          <svg class="bi bi-plus-circle" width="1.1em" height="1.1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
          </svg>
        </div>
        <div>
          Ajouter une tâche
        </div>
      </a>
    </div>

    <table class="table table-bordered table-hover" id="table">
      <thead>
        <tr class="text-center font-weight-light">
          @if(Auth::user()->type_id == 1)
          <th>Crée le</th>
          <th>Priorité</th>
          @endif
          <th>No</th>
          <th>Auteur</th>
          <th>Description</th>
          <th>Date</th>
          <th>Bât</th>
          <th>Sal</th>
          @if(Auth::user()->type_id === 1)
          <th>Traitant(s)</th>
          @endif
          <th>Action</th>
          <th>Approuvée</th>
          @if(Auth::user()->type_id == 1)
          <th>Fini</th>
          <th>+info</th>
          @endif
        </tr>
      </thead>
      {{ csrf_field() }}
      <?php  $no=1; ?>
      <tbody class="text-center">
        @foreach ($tasks as $task)
          <tr class="task{{$task->id}}">
              @if(Auth::user()->type_id == 1)
                <td class="align-middle">{{ $task->created_at->format('d/m/Y') }}</td>
                <td class="align-middle">
                  <input type="text" class="form-control select_priority text-center" id="select_priority{{$task->id}}" value="{{$task->priority->name}}" disabled>
                  <a class="edit-priority-modal btn btn-sm"
                      data-id="{{$task->id}}"
                      data-priorityName="{{ $task->priority->name }}" 
                      data-priority_id="{{$task->priority_id}}"><u>
                      Priorité<i class="fa fa-check" style="color:white"></i>
                    </u></a>
                </td>
              @endif
              <td class="align-middle">{{ $task->id }}</td>
              <td class="align-middle">{{ $task->user->name }}</td>
              <td class="align-middle text-truncate" style="max-width: 150px;">{{ $task->description }}</td>
              <td class="align-middle">{{ $task->date }}</td>
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
              @if(Auth::user()->type_id == 1)
              <td class="align-middle">
                @foreach(App\Task::find($task->id)->users as $user)
                  <span> {{ $user->name}} </span>  
                @endforeach
              </td>
              @endif
              <td class="align-middle">
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
                      data-date_create="{{ $task->created_at->format('d/m/Y') }}"
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
                    @if($task->approve_id == 1 || Auth::user()->type_id == 1)
                    <a class="dropdown-item edit-modal btn pl-3" 
                      data-approve_id="{{$task->approve_id}}" 
                      data-type_id="{{$task->type_id}}" 
                      data-id="{{$task->id}}" 
                      data-user_id="{{$task->user->id}}" 
                      data-user="{{$task->user->name}}" 
                      data-description="{{$task->description}}" 
                      data-date="{{$task->date}}"
                      data-date_create="{{ $task->created_at->format('d/m/Y') }}"
                      data-buildings_name="{{ $task->buildings->pluck('name') }}"
                      data-buildings="{{ $task->buildings->pluck('id') }}"
                      data-classrooms="{{ $task->classrooms->pluck('id') }}"
                      data-users_task="{{ $task->users->pluck('id') }}"
                      @if(Auth::user()->type_id == 1)
                      data-is_admin="{{ Auth::user()->type_id }}"
                      @endif
                      data-images="{{ App\Image::where('imageable_id',$task->id)->get() }}">
                      <svg class="mr-2 bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                      </svg>
                      Modifier
                    </a>
                    <a class="dropdown-item delete-modal btn pl-3" 
                      data-id="{{$task->id}}"
                      data-buildings="{{ $task->buildings->pluck('id') }}"
                      data-classrooms="{{ $task->classrooms->pluck('id') }}"
                      data-users_task="{{ $task->users->pluck('id') }}">
                      <svg class="mr-2 bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg>
                      Supprimer
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
                    @endif
                  </div>
                </div>
              </td>
              <td class="align-middle">
                <input class="form-control text-center" id="approveName{{$task->id}}" data-approveName="{{ $task->approve->name }}" value="{{ $task->approve->name }}" disabled>
                @if(Auth::user()->type_id == 1)
                  <a class="edit-approve-modal btn btn-sm approve{{$task->id}}" 
                    data-id="{{$task->id}}"
                    data-description="{{ $task->description }}" 
                    data-approve_id="{{$task->approve_id}}"><u>
                    Valider<i class="fa fa-check" style="color:white"></i>
                    </u></a>
                @endif
              </td>
              @if(Auth::user()->type_id == 1)
                <td id="done_admin" class="align-middle">
                  @if(App\Stat_Task::where('task_id',$task->id)->where('done_worker',1)->first())
                  Vérifier
                  <input type="checkbox" name="done_admin" class="done_admin" @if(App\Stat_Task::where('task_id',$task->id)->where('done_admin', 1)->first()) {{ "checked" }} @endif
                    data-user_id="{{Auth::id()}}"
                    data-task_id="{{$task->id}}">
                  @else
                  Non
                  @endif
                </td>
                <td class="align-middle">i</td>
              @endif
          </tr>
        @endforeach
      </tbody>
    </table>
    {{-- {{$tasks->links()}} --}}
  </div>

  {{-- <div id="includeData">
  </div> --}}
  
  @include('tasks.modal-create-task')
  @include('tasks.modal-show-task')
  @include('tasks.modal-edit-task')
  @include('tasks.modal-delete-task')
  @include('tasks.modal-approve-task')
  @include('tasks.modal-priority-task')
  @include('tasks.modal-image-task')

</div>
@endsection
