@extends('layouts.template')
@section('content')
<div class="container">

  <div class="row">
      <h1>Travaux</h1>
  </div>

  <div class="row">
    <button class="create-modal btn btn-outline-success btn-sm mb-3">
      Créer
    </button>
  </div>

  <div class="row">
    <table class="table table-bordered table-hover" id="table">
      <thead>
        <tr class="text-center">
          <th>No</th>
          <th>Demandeur</th>
          <th>Description</th>
          <th>Date</th>
          <th>Bâtiment(s)</th>
          <th>Salle(s)</th>
          <th>Traitant(s)</th>
          <th>Action</th>
          <th>Approuvée</th>
          @if(Auth::user()->type_id == 1)
          <th>Valider</th>
          @endif
        </tr>
      </thead>
      {{ csrf_field() }}
      <?php  $no=1; ?>
      <tbody>
        @foreach ($tasks as $task)
          <tr class="task{{$task->id}}">
              <td>{{ $task->id }}</td>
              <td>{{ $task->user->name }}</td>
              <td>{{ $task->description }}</td>
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
              </td>
              <td class="text-center">
                <span class="show-modal btn btn-info btn-sm" 
                  data-approve_id="{{$task->approve_id}}" 
                  data-type_id="{{$task->type_id}}" 
                  data-id="{{$task->id}}" 
                  data-user="{{$task->user->name}}"
                  data-description="{{$task->description}}" 
                  data-date="{{$task->date}}"
                  data-buildings="{{ $task->buildings->pluck('name') }}"
                  data-classrooms="{{ $task->classrooms->pluck('name') }}"
                  data-users_task="{{ $task->users->pluck('name') }}">
                  <svg class="bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 001.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0014.828 8a13.133 13.133 0 00-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 001.172 8z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd"/>
                  </svg>
                </span>
                @if($task->approve_id == 1 || Auth::user()->type_id == 1)
                <span class="edit-modal btn btn-warning btn-sm" 
                  data-approve_id="{{$task->approve_id}}" 
                  data-type_id="{{$task->type_id}}" 
                  data-id="{{$task->id}}" 
                  data-user="{{$task->user->name}}" 
                  data-description="{{$task->description}}" 
                  data-date="{{$task->date}}"
                  data-buildings_name="{{ $task->buildings->pluck('name') }}"
                  data-buildings="{{ $task->buildings->pluck('id') }}"
                  data-classrooms="{{ $task->classrooms->pluck('id') }}"
                  data-users_task="{{ $task->users->pluck('id') }}">
                  <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                  </svg>   
                </span>
                <span class="delete-modal btn btn-danger btn-sm" 
                  data-id="{{$task->id}}"
                  data-buildings="{{ $task->buildings->pluck('id') }}"
                  data-classrooms="{{ $task->classrooms->pluck('id') }}"
                  data-users_task="{{ $task->users->pluck('id') }}">
                  <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                  </svg>
                </span>
                @endif
              </td>
              <td class="text-center" id="approveName" data-approveName="{{ $task->approve->name }}">{{ $task->approve->name }}</td>
              @if(Auth::user()->type_id == 1)
                <td class="text-center">
                  <span class="edit-approve-modal btn btn-warning btn-sm" 
                    data-id="{{$task->id}}"
                    data-description="{{ $task->description }}" 
                    data-approve_id="{{$task->approve_id}}">
                    Valider<i class="fa fa-check" style="color:white"></i>
                  </span>
                </td>
              @endif
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$tasks->links()}}
  </div>

  @include('tasks.modal-create-task')
  @include('tasks.modal-show-task')
  @include('tasks.modal-edit-task')
  @include('tasks.modal-delete-task')
  @include('tasks.modal-approve-task')

</div>
@endsection
