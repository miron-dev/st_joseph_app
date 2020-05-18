@extends('layouts.template')
@section('content')
<div class="container">

  <div class="row">
      <h1>Travaux</h1>
  </div>

  <div class="row">
    <table class="table table-bordered table-hover" id="table">
      <thead>
      <tr class="text-center">
        <th width="150px">No</th>
        <th>Demandeur</th>
        <th>Description</th>
        <th>Date</th>
        <th>Bâtiment(s)</th>
        <th>Salle(s)</th>
        <th>Traitant(s)</th>
        <th>valider</th>
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
        </tr>
      @endforeach
      </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
