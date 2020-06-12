<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>St Joseph</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- datepicker --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    {{-- Select2 Styles --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    {{-- Toggle menu style --}}
    <style>
        /*!
        * Start Bootstrap - Simple Sidebar (https://startbootstrap.com/template-overviews/simple-sidebar)
        * Copyright 2013-2019 Start Bootstrap
        * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-simple-sidebar/blob/master/LICENSE)
        */
        body {
        overflow-x: hidden;
        }

        #sidebar-wrapper {
        min-height: 100vh;
        margin-left: -15rem;
        -webkit-transition: margin .25s ease-out;
        -moz-transition: margin .25s ease-out;
        -o-transition: margin .25s ease-out;
        transition: margin .25s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
        }

        #sidebar-wrapper .list-group {
        width: 15rem;
        }

        #page-content-wrapper {
        min-width: 100vw;
        }

        #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
        }

        @media (min-width: 768px) {
        #sidebar-wrapper {
            margin-left: 0;
        }

        #page-content-wrapper {
            min-width: 0;
            width: 100%;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: -15rem;
        }
        }
    </style>

    {{-- Datatables styles --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/r-2.2.5/datatables.min.css"/>

    <style>

        /* div.sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        background-color: yellow;
        padding: 50px;
        font-size: 20px;
        } */

        
    </style>

    <title>Document</title>
</head>
<body>
    <div class ="container-fluid px-0" id="app">
        <main class="d-flex" id="wrapper">

          <!-- Sidebar -->
          <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">{{Auth::user()->name}}</div>
            <div class="list-group list-group-flush">
                <a href="{{url('home')}}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                <a href="{{url('users/'.Auth::id())}}" class="list-group-item list-group-item-action bg-light">Profile</a>
                @if(Auth::user()->type_id !== 1)
                <a href="{{url('task')}}" class="list-group-item list-group-item-action bg-light">Travaux</a>
                @endif

                @if(Auth::user()->type_id == 1)
                    <span class="text-center text-muted text-light align-middle pt-2">Admin</span>
                    <div class="dropdown-divider"></div>
                    <a href="{{url('approve')}}" class="list-group-item list-group-item-action bg-light">Approuver utilisateurs 
                        @if(App\User::where('approved_at', null)->count() > 0)
                        <span class="badge badge-danger">{{App\User::where('approved_at', null)->count()}}</span>
                        @endif
                    </a>
                    <a href="{{url('users')}}" class="list-group-item list-group-item-action bg-light">Utilisateurs</a>
                    <div class="accordion" id="accordionExample">
                        <div class="card bg-light" style="border: none">
                          <div class="card-header bg-light p-0 ml-2" id="headingOne">
                            <h2 class="mb-0">
                              <a class="btn collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Travaux
                              </a>
                            </h2>
                          </div>
                      
                          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body bg-light">
                                <a href="{{url('task')}}" class="list-group-item list-group-item-action bg-light">Liste des travaux</a>
                                <a href="{{url('indexTasksDones')}}" class="list-group-item list-group-item-action bg-light">Travaux terminés</a> 
                            </div>
                          </div>
    
                        </div>
                    </div>
                @endif
            </div>
          </div>
          <!-- /#sidebar-wrapper -->
      
          <!-- Page Content -->
          <div id="page-content-wrapper">
      
            <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top border-bottom ">
                <a class="btn" id="menu-toggle">
                    Menu
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
      
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
        
                    </ul>
        
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Se deconnecter') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
      
            <div class="container-fluid">
            </div>
              @yield('content')
          </div>
          <!-- /#page-content-wrapper -->
      
        </main>
    </div>
</body>


{{-- Bootstrap Scripts --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

{{-- toggle button / basic.blade.php --}}
<script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
</script>

{{-- Datepicker --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
      $( "#datepicker" ).datepicker({minDate: 0, dateFormat: 'dd/mm/yy'});
      $( "#datepicker_edit" ).datepicker({minDate: 0, dateFormat: 'dd/mm/yy'});
    } );
</script>

{{-- Select2 Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    //Select2
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            theme:"classic",
            tags: true,
        });
    });
</script>

{{-- Datatables --}}
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/r-2.2.5/datatables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#table').DataTable();
    } );
</script>

{{-- <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script> --}}
<script type="text/javascript">

   $.ajaxSetup({
        headers: {
            // 'X-CSRF-Token': "{{ csrf_token() }}"
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //========================================== Image preview ==========================================
        $('#files').change(function(){
            $('#image_preview').html("");
            var total_file=document.getElementById("files").files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#image_preview').append(
                    "<img name='test' id='test' class='mr-3 img"+i+"' width='100' src='"+URL.createObjectURL(event.target.files[i])+"'>"
                    // +`<span class="badge badge-pill badge-danger position-absolute remove" style="margin: -5px -25px">x</span>`
                );
            }
        });
    //========================================== End ==========================================

    // ========================================== Modal Create Task ==========================================
        $(document).on('click','.create-modal', function() {
            $('#create').modal('show');
            $('.form-horizontal').show();
            $('.modal-title').text('Créer une tâche');
        });
        
        $(document).on('click','#add',function() {
            var formData = new FormData();
            var getFiles = $('#files')[0].files;
            for (let i = 0; i < getFiles.length; i++) {
                formData.append('files['+i+']', files.files[i]);
                console.log(files.files[i])
            }
            formData.append('user_id', $('#user_id').val());
            formData.append('description', $('#description').val());
            formData.append('date', $('input[name=date]').val());
            formData.append('buildings_id', $('#buildings_id').val());
            formData.append('classrooms_id', $('#classrooms_id').val());
            formData.append('users_id', $('#users_id').val());
            // formData.append('files', $('#files')[0].files[0]);

            $.ajax({
                type: 'POST',
                url: 'addTask',
                contentType: false,
                processData: false,
                data: formData,
                success: function(data){
                    console.log('data',data)
                    data.description = data.description.replace(/'/g, "&#39;").replace(/"/g,"&#34;");   
                    if (!$.isEmptyObject(data.errors)) {
                        alert('Le champ Description est requis');
                    } else {
                        if(data.userTypeId == 1)
                        {
                            $('#table').append(
                                "<tr class='task" + data.id + "'>"+
                                    "<td class='align-middle'>" + data.date_create + "</td>"+
                                    "<td>" + 
                                        `<input type="text" class="form-control select_priority text-center" id="select_priority`+ data.id +`" value="`+data.priorityName+`" disabled>
                                        <a class="edit-priority-modal btn btn-sm" 
                                            data-id="`+ data.id +`"
                                            data-priorityName="`+ data.priorityName +`" 
                                            data-priority_id="`+ data.priority_id +`"><u>
                                            Priorité<i class="fa fa-check" style="color:white"></i>
                                        </u></a>`
                                    +"</td>"+
                                    "<td class='align-middle'>" + data.id + "</td>"+
                                    "<td class='align-middle'>" + data.user + "</td>"+
                                    "<td class='align-middle text-truncate' style='max-width: 150px;'>" + data.description + "</td>"+
                                    "<td class='align-middle'>" + data.date + "</td>"+
                                    "<td class='align-middle'>" + data.buildingsNames + "</td>"+
                                    "<td class='align-middle'>" + data.classroomsNames + "</td>"+
                                    "<td class='align-middle'>" + data.usersNames + "</td>"+
                                    "<td class='align-middle'>"+
                                        `<div class="btn-group">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item show-modal btn btn-light" 
                                                    data-id="`+data.id+`" 
                                                    data-user="`+data.user+`" 
                                                    data-description="`+data.description+`" 
                                                    data-date="`+data.date+`"
                                                    data-buildings="`+data.buildingsNames+`"
                                                    data-classrooms="`+data.classroomsNames+`"
                                                    data-date_create="`+data.date_create+`"
                                                    data-users_task="`+data.usersNames+`">
                                                    <svg class="mr-2 bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 001.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0014.828 8a13.133 13.133 0 00-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 001.172 8z" clip-rule="evenodd"/>
                                                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Voir
                                                </a>
                                                <a class="dropdown-item edit-modal btn btn-light" 
                                                    data-id="`+data.id+`" 
                                                    data-user="`+data.user+`" 
                                                    data-user_id="`+data.user_id+`" 
                                                    data-description="`+data.description+`" 
                                                    data-date="`+data.date+`"
                                                    data-buildings="[` + data.buildings_id + `]"
                                                    data-classrooms="[`+data.classrooms_id+`]"
                                                    data-users_task="[`+data.users_id+`]"
                                                    data-date_create="`+data.date_create+`"
                                                    data-images=`+ JSON.stringify(data.files) +`>
                                                    <svg class="mr-2 bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                                                    <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                                                    </svg> 
                                                    Modifier  
                                                </a>
                                                <a class="dropdown-item delete-modal btn btn-light" 
                                                    data-id="`+data.id+`"
                                                    data-buildings="[`+data.buildings_id+`]"
                                                    data-classrooms="[`+data.classrooms_id+`]"
                                                    data-users_task="[`+data.users_id+`]">
                                                    <svg class="mr-2 bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Supprimer
                                                </a>
                                                <a class="dropdown-item show-image btn btn-light" 
                                                    data-task_id=`+data.id+` 
                                                    data-images=[`+JSON.stringify(data.files)+`]>
                                                    <svg class="mr-2 bi bi-images" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M12.002 4h-10a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-10-1a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-10z"/>
                                                        <path d="M10.648 8.646a.5.5 0 0 1 .577-.093l1.777 1.947V14h-12v-1l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71z"/>
                                                        <path fill-rule="evenodd" d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM4 2h10a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1v1a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2h1a1 1 0 0 1 1-1z"/>
                                                    </svg>
                                                    Image(s)
                                                </a>
                                            </div>
                                        </div>`
                                    +"</td>"+
                                    `<td>
                                        <input class="form-control text-center" id="approveName`+ data.id +`" data-approveName="`+ data.approveName +`" value="`+ data.approveName +`" disabled>
                                        <a class="edit-approve-modal btn btn-sm approve`+ data.id +`" 
                                            data-id="`+ data.id +`"
                                            data-description="`+ data.description +`" 
                                            data-approve_id="`+ data.approve_id +`"><u>
                                            Valider<i class="fa fa-check" style="color:white"></i>
                                        </u></a>
                                    </td>`+
                                    `<td class='align-middle'> Non </td>`+
                                    `<td class='align-middle'> i </td>`+
                                "</tr>"
                            );
                            // $('#err').remove();
                        } 
                        else
                        {
                            $('#table').append(
                                "<tr class='task" + data.id + "'>"+
                                    "<td class='align-middle'>" + data.id + "</td>"+
                                    "<td class='align-middle'>" + data.user + "</td>"+
                                    "<td class='align-middle'>" + data.description + "</td>"+
                                    "<td class='align-middle'>" + data.date + "</td>"+
                                    "<td class='align-middle'>" + data.buildingsNames + "</td>"+
                                    "<td class='align-middle'>" + data.classroomsNames + "</td>"+
                                    "<td class='align-middle'>"+
                                        `<div class="btn-group">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item show-modal btn btn-light" 
                                                    data-id="`+data.id+`" 
                                                    data-user="`+data.user+`" 
                                                    data-description="`+data.description+`" 
                                                    data-date="`+data.date+`"
                                                    data-buildings="`+data.buildingsNames+`"
                                                    data-classrooms="`+data.classroomsNames+`">
                                                    <svg class="mr-2 bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 001.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0014.828 8a13.133 13.133 0 00-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 001.172 8z" clip-rule="evenodd"/>
                                                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Voir
                                                </a>
                                                <a class="dropdown-item edit-modal btn btn-light" 
                                                    data-id="`+data.id+`" 
                                                    data-user="`+data.user+`" 
                                                    data-user_id="`+data.user_id+`" 
                                                    data-description="`+data.description+`" 
                                                    data-date="`+data.date+`"
                                                    data-buildings="[` + data.buildings_id + `]"
                                                    data-classrooms="[`+data.classrooms_id+`]"
                                                    data-images=[`+ JSON.stringify(data.files) +`]>
                                                    <svg class="mr-2 bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                                                    <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                                                    </svg> 
                                                    Modifier  
                                                </a>
                                                <a class="dropdown-item delete-modal btn btn-light" 
                                                    data-id="`+data.id+`"
                                                    data-buildings="[`+data.buildings_id+`]"
                                                    data-classrooms="[`+data.classrooms_id+`]"
                                                    data-users_task="[`+data.users_id+`]">
                                                    <svg class="mr-2 bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Supprimer
                                                </a>
                                                <a class="dropdown-item show-image btn btn-light" 
                                                    data-task_id=`+data.id+` 
                                                    data-images=[`+JSON.stringify(data.files)+`]>
                                                    <svg class="mr-2 bi bi-images" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M12.002 4h-10a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-10-1a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-10z"/>
                                                        <path d="M10.648 8.646a.5.5 0 0 1 .577-.093l1.777 1.947V14h-12v-1l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71z"/>
                                                        <path fill-rule="evenodd" d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM4 2h10a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1v1a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2h1a1 1 0 0 1 1-1z"/>
                                                    </svg>
                                                    Image(s)
                                                </a>
                                            </div>
                                        </div>`
                                    +"</td>"+
                                    `<td><input class=" form-control text-center" id="approveName" data-approveName="`+data.approveName+`" value="`+data.approveName+`" disabled></td>`+
                                "</tr>"
                            );
                        }
                        
                    }
                },
            });
                        
            $('#description').val('');
            $('#datepicker').val('');
            $("#buildings_id").val(null).trigger('change') ;
            $("#classrooms_id").val('').trigger('change') ;
            $("#users_id").val('').trigger('change') ;
            $('#files').val('');
            $('#image_preview img').remove();
        });

    // ========================================== End Modal Create Task ==========================================
        
    // ========================================== Modal Edit Task ==========================================
        $(document).on('click', '.edit-modal', function() {

            // On affiche les images de la tache actuelle
            $('#image_preview_edit').html("");
            var images = $(this).data('images');
            $.each(images, function(i, value){
                $('#image_preview_edit').append(
                    "<img name='test' id='test' class='mr-3 img"+i+"' width='100' src='uploads/"+ value.filename+"'>"
                );
            });
            
            // Une fois le bouton Upload est cliqué, on supp tous les images
            // Et on recharge de nouvelles images
            $('#files_edit').change(function(){
                $('#image_preview_edit img').remove();
                $('#image_preview_edit').html("");
                var total_file=document.getElementById("files_edit").files.length;
                for(var i=0;i<total_file;i++)
                {
                    $('#image_preview_edit').append(
                        "<img name='test' id='test' class='mr-3 img"+i+"' width='100' src='"+URL.createObjectURL(event.target.files[i])+"'>"
                    );
                }
            });

            $('#footer_action_button_edit').text("Modifier");
            $('#footer_action_button_edit').addClass('glyphicon-check');
            $('#footer_action_button_edit').removeClass('glyphicon-trash');
            $('.actionBtn_edit').addClass('btn-success');
            $('.actionBtn_edit').removeClass('btn-danger');
            $('.actionBtn_edit').addClass('edit');
            $('.modal-title').text('Modifier la tâche');
            $('.form-horizontal').show();

            // On récupère les valeurs dans le buton => data-
            // Puis on les affectes dans le formulaire d'édition
            $('#user_id_edit').val($(this).data('user_id'));
            $('#description_edit').val($(this).data('description'));
            $('#datepicker_edit').val($(this).data('date'));
            $('#buildings_id_edit').val($(this).data('buildings')).trigger('change');
            $('#classrooms_id_edit').val($(this).data('classrooms')).trigger('change');
            $('#users_id_edit').val($(this).data('users_task')).trigger('change');
            $('#task_id_edit').val($(this).data('id'));
            $('#image_preview_edit').val(JSON.stringify($(this).data('images')));
            $('#edit').modal('show');
        });
        
        $('.modal-footer').on('click', '.edit', function() {
            var formDataEdit = new FormData();
            formDataEdit.set('id', $('#task_id_edit').val()); 
            formDataEdit.set('user_id', $('#user_id_edit').val());
            formDataEdit.set('description', $('#description_edit').val());
            formDataEdit.set('date', $('#datepicker_edit').val());
            formDataEdit.set('userName', $('#user_edit').val());
            formDataEdit.set('buildingsNames', $('.edit-modal').data('buildings'));
            formDataEdit.set('classroomsNames', $('.edit-modal').data('classrooms'));
            formDataEdit.set('usersNames', $('.edit-modal').data('users_task'));
            formDataEdit.set('approveName', $('.edit-modal').data('approve'));
            formDataEdit.set('userTypeId', $('.edit-modal').data('type_id'));
            formDataEdit.set('buildings_id', $('#buildings_id_edit').val());
            formDataEdit.set('classrooms_id', $('#classrooms_id_edit').val());
            formDataEdit.set('users_id', $('#users_id_edit').val());
            formDataEdit.set('file', $('#image_preview_edit').val());

            $.ajax({
                type: 'POST',
                url: 'editTask',
                contentType: false,
                processData: false,
                data: formDataEdit,
                success: function(data) {
                    data.description = data.description.replace(/'/g, "&#39;").replace(/"/g,"&#34;");   
                    if(!$.isEmptyObject(data.errors))
                    {
                        alert('Le champs Description est requis');
                    } 
                    else
                    {
                        if(data.is_admin == 1)
                        {
                            $('.task' + data.id).replaceWith(" "+
                            "<tr class='task" + data.id + "'>"+
                                "<td class='align-middle'>" + data.date_create + "</td>"+
                                "<td>" +
                                    `<input type="text" class="form-control select_priority text-center" id="select_priority`+ data.id +`" value="`+data.priorityName+`" disabled>
                                    <a class="edit-priority-modal btn btn-sm" 
                                        data-id="`+ data.id +`"
                                        data-priorityName="`+ data.priorityName +`" 
                                        data-priority_id="`+ data.priority_id +`"><u>
                                        Priorité<i class="fa fa-check" style="color:white"></i>
                                    </u></a>`
                                +"</td>"+
                                "<td class='align-middle'>" + data.id + "</td>"+
                                "<td class='align-middle'>" + data.userName + "</td>"+
                                "<td class='align-middle'>" + data.description + "</td>"+
                                "<td class='align-middle'>" + data.date + "</td>"+
                                "<td class='align-middle'>" + data.buildingsNames + "</td>"+
                                "<td class='align-middle'>" + data.classroomsNames + "</td>"+
                                "<td class='align-middle'>" + data.usersNames + "</td>"+
                                `<td class='align-middle'>`+
                                    `<div class="btn-group">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item pl-3 show-modal btn btn-light" 
                                                data-id="`+data.id+`" 
                                                data-user="`+data.userName+`" 
                                                data-description="`+data.description+`" 
                                                data-date="`+data.date+`"
                                                data-date_create="`+data.date_create+`"
                                                data-buildings="`+data.buildingsNames+`"
                                                data-classrooms="`+data.classroomsNames+`"
                                                data-users_task="`+data.usersNames+`">
                                                <svg class="bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 001.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0014.828 8a13.133 13.133 0 00-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 001.172 8z" clip-rule="evenodd"/>
                                                <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Voir
                                            </a>
                                            <a class="dropdown-item pl-3 edit-modal btn btn-light" 
                                                data-id="`+data.id+`" 
                                                data-user="`+data.userName+`" 
                                                data-user_id="`+data.user.id+`" 
                                                data-description="`+data.description+`" 
                                                data-date="`+data.date+`"
                                                data-date_create="`+data.date_create+`"
                                                data-buildings="[`+ data.buildings_id+ `]"
                                                data-classrooms="[`+data.classrooms_id+`]"
                                                data-users_task="[`+data.users_id+`]"
                                                data-images=`+ JSON.stringify(data.file) +`>
                                                <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                                                <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                                                </svg>  
                                                Modifier 
                                            </a>
                                            <a class="dropdown-item pl-3 delete-modal btn btn-light" 
                                                data-id="`+data.id+`"
                                                data-buildings="[`+data.buildings_id+`]"
                                                data-classrooms="[`+data.classrooms_id+`]"
                                                data-users_task="[`+data.users_id+`]">
                                                <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                                </svg>
                                                Supprimer
                                            </a>
                                            <a class="dropdown-item pl-3 show-image btn btn-light" 
                                                data-task_id=`+ data.id +` 
                                                data-images=`+ JSON.stringify(data.file) +`>
                                                <svg class="bi bi-images" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M12.002 4h-10a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-10-1a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-10z"/>
                                                    <path d="M10.648 8.646a.5.5 0 0 1 .577-.093l1.777 1.947V14h-12v-1l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71z"/>
                                                    <path fill-rule="evenodd" d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM4 2h10a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1v1a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2h1a1 1 0 0 1 1-1z"/>
                                                </svg>
                                                Image(s)
                                            </a>
                                        </div>
                                    </div>`
                                +"</td>"+
                                `<td>
                                    <input class="form-control text-center" id="approveName`+ data.id +`" data-approveName="`+ data.approveName +`" value="`+ data.approveName +`" disabled>
                                    <a class="edit-approve-modal btn btn-sm approve`+ data.id +`" 
                                        data-id="`+ data.id +`"
                                        data-description="`+ data.description +`" 
                                        data-approve_id="`+ data.approve_id +`"><u>
                                        Valider<i class="fa fa-check" style="color:white"></i>
                                    </u></a>
                                </td>`+
                                `<td class='align-middle'> Non </td>`+
                                `<td class='align-middle'> i </td>`+
                            "</tr>"
                        );
                        } else 
                        {
                            $('.task' + data.id).replaceWith(" "+
                                "<tr class='task" + data.id + "'>"+
                                    "<td class='align-middle'>" + data.id + "</td>"+
                                    "<td class='align-middle'>" + data.userName + "</td>"+
                                    "<td class='align-middle'>" + data.description + "</td>"+
                                    "<td class='align-middle'>" + data.date + "</td>"+
                                    "<td class='align-middle'>" + data.buildingsNames + "</td>"+
                                    "<td class='align-middle'>" + data.classroomsNames + "</td>"+
                                    `<td class="text-center">`+
                                        `<div class="btn-group">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item pl-3 show-modal btn btn-light" 
                                                    data-id="`+data.id+`" 
                                                    data-user="`+data.userName+`" 
                                                    data-description="`+data.description+`" 
                                                    data-date="`+data.date+`"
                                                    data-buildings="`+data.buildingsNames+`"
                                                    data-classrooms="`+data.classroomsNames+`"
                                                    <svg class="bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 001.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0014.828 8a13.133 13.133 0 00-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 001.172 8z" clip-rule="evenodd"/>
                                                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Voir
                                                </a>
                                                <a class="dropdown-item pl-3 edit-modal btn btn-light" 
                                                    data-id="`+data.id+`" 
                                                    data-user="`+data.userName+`" 
                                                    data-user_id="`+data.user.id+`" 
                                                    data-description="`+data.description+`" 
                                                    data-date="`+data.date+`"
                                                    data-buildings="[`+ data.buildings_id+ `]"
                                                    data-classrooms="[`+data.classrooms_id+`]"
                                                    data-images=`+ JSON.stringify(data.file) +`>
                                                    <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                                                    <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                                                    </svg>  
                                                    Modifier 
                                                </a>
                                                <a class="dropdown-item pl-3 delete-modal btn btn-light" 
                                                    data-id="`+data.id+`"
                                                    data-buildings="[`+data.buildings_id+`]"
                                                    data-classrooms="[`+data.classrooms_id+`]"
                                                    data-users_task="[`+data.users_id+`]">
                                                    <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Supprimer
                                                </a>
                                                <a class="dropdown-item pl-3 show-image btn btn-light" 
                                                    data-task_id=`+ data.id +` 
                                                    data-images=`+ JSON.stringify(data.file) +`>
                                                    <svg class="bi bi-images" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M12.002 4h-10a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-10-1a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-10z"/>
                                                        <path d="M10.648 8.646a.5.5 0 0 1 .577-.093l1.777 1.947V14h-12v-1l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71z"/>
                                                        <path fill-rule="evenodd" d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM4 2h10a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1v1a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2h1a1 1 0 0 1 1-1z"/>
                                                    </svg>
                                                    Image(s)
                                                </a>
                                            </div>
                                        </div>`
                                    +"</td>"+
                                    `<td><input class=" form-control text-center" id="approveName" data-approveName="`+data.approveName+`" value="`+data.approveName+`" disabled></td>`+
                                "</tr>"
                            );
                        }
                    }

                },
            });
            return false;
        });
    // ========================================== End Modal Edit Task ==========================================

    // ========================================== Modal Delete Task ==========================================
        $(document).on('click', '.delete-modal', function(e) {
            e.preventDefault();
            $('#footer_action_button').text("Delete");
            $('#footer_action_button').removeClass('glyphicon-check');
            $('#footer_action_button').addClass('glyphicon-trash');
            $('.actionBtn').removeClass('btn-success');
            $('.actionBtn').addClass('btn-danger');
            $('.actionBtn').addClass('delete');
            $('.modal-title').text('Supprimer une tâche');
            $('.id').text($(this).data('id'));
            $('.deleteContent').show();
            $('.title').html($(this).data('title'));
            $('#myModal').modal('show');
        });
        
        $('.modal-footer').on('click', '.delete', function(e){
            e.preventDefault();
            $.ajax({
                type: 'DELETE',
                url: 'deleteTask',
                dataType: 'json',
                data: {
                    'id': $('.id').text(),
                    'buildings_id' : $(this).data('buildings'),
                    'classrooms_id' : $(this).data('classrooms'),
                    'users_id' : $(this).data('users_task'),
                },
                success: function(data){
                    $('.task' + $('.id').text()).remove();
                }
            });
        });
    // ========================================== End Modal Delete ==========================================

    // ========================================== Modal Show ==========================================
        $(document).on('click', '.show-modal', function() {
            $('#show').modal('show');
            $('#user_show').val($(this).data('user'));
            $('#description_show').text($(this).data('description'));
            $('#date_show').val($(this).data('date'));
            $('#buildingsName_show').val($(this).data('buildings'));
            $('#classroomsName_show').val($(this).data('classrooms'));
            $('#usersName_show').val($(this).data('users_task'));
            $('.modal-title').text('Voir la tâche');
        });
    // ========================================== End Modal Show ==========================================

    // ========================================== Modal Edit Approve ==========================================
        $(document).on('click', '.edit-approve-modal', function(e) {
            e.preventDefault();
            $('#footer_action_button_approve').text("Confirmer");
            $('#footer_action_button_approve').addClass('fa-check');
            $('#footer_action_button_approve').removeClass('fa-trash');
            $('.actionBtn_approve').addClass('btn-success');
            $('.actionBtn_approve').removeClass('btn-danger');
            $('.actionBtn_approve').addClass('editApprove');
            $('.modal-title').text('Approuver la tâche');
            // $('.deleteContent').hide();
            $('.form-horizontal').show();
            $('.id').text($(this).data('id'));
            $('#aid').val($(this).data('description'));
            $('#approveID').val($(this).data('approve_id'));
            $('#modalApproveTask').modal('show');
        });

        $('.modal-footer').on('click', '.editApprove', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'approveTask',
                data: 
                {
                    'id': $('.id').text(),
                    'approve_id': $("#approveID").val()
                },
                success: function(data) {
                    $('#approveName'+data[0].id).replaceWith(" "+
                        `<input type="text" class="form-control select_priority text-center" id="approveName`+ data[0].id +`" data-approveName="`+data[0].approveName+`" value="`+ data[0].approveName +`" disabled>`
                    );
                }
            });
        });
    // ========================================== End Modal Edit Approve ==========================================

    // ========================================== Edit checkbox worker ==========================================

        $(document).ready(function(){
            $(".done_worker").click(function() { 
                if($(this).is(":checked")) { 
                    $.ajax({
                        type:'POST',
                        url:'taskDone',
                        data: { 
                            'task_id': $(this).data('task_id'),
                            'worker_id': $(this).data('user_id'),
                            'done_worker': $('input[name="done_worker"]').val(),
                            'stat_id': $(this).data('stat_id'),
                        },
                        success: function(data){
                            console.log('checked');
                        }
                    });
                } else if(!$(this).is(":checked")){
                    $.ajax({
                        type:'POST',
                        url:'taskDone',
                        data: { 
                            'task_id': $(this).data('task_id'),
                            'worker_id': $(this).data('user_id'),
                            'done_worker': null,
                            'stat_id': $(this).data('stat_id'),
                        },
                        success: function(data){
                            console.log('unchecked');
                        }
                    });
                } else {
                    console.log('rien');
                }
            }); 

            // setInterval(function(){
            //     $('#done_admin').load('{{ route("task.index") }}').fadeIn('slow');
            // }, 1000);
        });

    // ========================================== End checkbox worker ==========================================

    // ========================================== Edit checkbox admin ==========================================

        $(document).ready(function(){
            $(".done_admin").click(function() { 
                if($(this).is(":checked")) { 
                    $.ajax({
                        type:'POST',
                        url:'taskDoneAdmin',
                        data: { 
                            'task_id': $(this).data('task_id'),
                            'admin_id': $(this).data('user_id'),
                            'done_admin': 1,
                            'stat_id': $(this).data('stat_id'),
                        },
                        success: function(data){
                            console.log('checked');
                        }
                    });
                } else if(!$(this).is(":checked")){
                    $.ajax({
                        type:'POST',
                        url:'taskDoneAdmin',
                        data: { 
                            'task_id': $(this).data('task_id'),
                            'admin_id': $(this).data('user_id'),
                            'done_admin': 0,
                            'stat_id': $(this).data('stat_id'),
                        },
                        success: function(data){
                            console.log('unchecked');
                        }
                    });
                } else {
                    console.log('rien');
                }
            }); 
        });
    // ========================================== End checkbox admin ==========================================

    // ========================================== Modal priority ==========================================
        $(document).on('click', '.edit-priority-modal', function() {
                $('#footer_action_button_priority').text("Confirmer");
                $('#footer_action_button_priority').addClass('fa-check');
                $('#footer_action_button_priority').removeClass('fa-trash');
                $('.actionBtn_priority').addClass('btn-success');
                $('.actionBtn_priority').removeClass('btn-danger');
                $('.actionBtn_priority').addClass('editPriority');
                $('.modal-title').text('Priorité');
                $('.form-horizontal').show();
                $('.id').text($(this).data('id'));
                $('#priorityID').val($(this).data('priority_id'));
                $('#modalPriorityTask').modal('show');
            });

            $('.modal-footer').on('click', '.editPriority', function() {
                $.ajax({
                    type: 'POST',
                    url: 'editPriority',
                    data: 
                    {
                        'id': $('.id').text(),
                        'priority_id': $("#priorityID").val()
                    },
                    success: function(data) {
                        // $('input[id=select_priority'+data.id+']').val(data.priorityName);
                        $('#select_priority'+data[0].id).replaceWith(" "+
                            `<input type="text" class="form-control select_priority text-center" id="select_priority`+ data[0].id +`" value="`+ data[0].priorityName +`" disabled>`
                        );
                    }
                });
            });
    // ========================================== End Modal priority ==========================================

    // ========================================== Modal image ==========================================
        $(document).on('click', '.show-image', function() {
            $('#imageModal').modal('show');
            
            var taskId = $(this).data('task_id');

            $('#indicators li').remove();
            $('.carousel-item').remove();

            $.each($(this).data('images'), function(index, value){
                var active = '';
                if(index == 0) active = "active";

                $('#indicators').append(`
                    <li data-target="#carousel`+index+`" data-slide-to="`+index+`" class="`+active+`"></li>
                `);

                $('#display_image').append(`
                    <div class="carousel-item `+active+`">
                        <img id="carousel`+index+`" class="d-block w-100" src="uploads/`+value.filename+`" alt="`+value.filename+`">
                    </div>
                `);
            });

            $('.modal-title').text('Voir les images');
        });
    // ========================================== End Modal image ==========================================

</script>


</html>
