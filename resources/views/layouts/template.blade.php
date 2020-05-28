<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <title>Document</title>
</head>
<body>
    <div id="app">
        @include('layouts.navbar-template')
        <main class="">
            @yield('content')
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
      $( "#datepicker" ).datepicker({minDate: 0});
      $( "#datepicker_edit" ).datepicker({minDate: 0});
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

<script type="text/javascript">

    // ========================================== Modal Create Task ==========================================
        $(document).on('click','.create-modal', function() {
            $('#create').modal('show');
            $('.form-horizontal').show();
            $('.modal-title').text('Créer une tâche');
            console.log('form',$('#create[input]'))
        });
        
        $(document).on('click','#add',function() {
            console.log('init');
            $.ajax({
                type: 'POST',
                url: 'addTask',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'user_id': $('input[name=user_id]').val(),
                    'description': $('#description').val(),
                    'date': $('input[name=date]').val(),
                    'buildings_id': $('#buildings_id').val(),
                    'classrooms_id': $('#classrooms_id').val(),
                    'users_id': $('#users_id').val()
                },
                success: function(data){
                    console.log("CREATION DE TACHE", data);
                    console.log($.isEmptyObject(data.errors));
                    if (!$.isEmptyObject(data.errors)) {
                        alert('Les champs Description et Date sont requisent');
                    } else {
                        if(data.userTypeId == 1)
                        {
                            $('#table').append(
                                "<tr class='task" + data.id + "'>"+
                                    "<td>" + data.id + "</td>"+
                                    "<td>" + data.user + "</td>"+
                                    "<td>" + data.description + "</td>"+
                                    "<td>" + data.date + "</td>"+
                                    "<td>" + data.buildingsNames + "</td>"+
                                    "<td>" + data.classroomsNames + "</td>"+
                                    "<td>" + data.usersNames + "</td>"+
                                    "<td class='text-center'>"+
                                        `<span class="show-modal btn btn-info btn-sm" 
                                            data-id="`+data.id+`" 
                                            data-user="`+data.user+`" 
                                            data-description="`+data.description+`" 
                                            data-date="`+data.date+`"
                                            data-buildings="`+data.buildingsNames+`"
                                            data-classrooms="`+data.classroomsNames+`"
                                            data-users_task="`+data.usersNames+`">
                                            <svg class="bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 001.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0014.828 8a13.133 13.133 0 00-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 001.172 8z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </span>
                                        <span class="edit-modal btn btn-warning btn-sm" 
                                            data-id="`+data.id+`" 
                                            data-user="`+data.user+`" 
                                            data-description="`+data.description+`" 
                                            data-date="`+data.date+`"
                                            data-buildings="[` + data.buildings_id + `]"
                                            data-classrooms="[`+data.classrooms_id+`]"
                                            data-users_task="[`+data.users_id+`]">
                                            <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                                            </svg>   
                                        </span>
                                        <span class="delete-modal btn btn-danger btn-sm" 
                                            data-id="`+data.id+`"
                                            data-buildings="[`+data.buildings_id+`]"
                                            data-classrooms="[`+data.classrooms_id+`]"
                                            data-users_task="[`+data.users_id+`]">
                                            <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                            </svg>
                                        </span>`
                                    +"</td>"+
                                    `<td class="text-center" id="approveName" data-approveName="`+data.approveName+`">`+data.approveName+`</td>`+
                                    `<td class="text-center">
                                        <span class="edit-approve-modal btn btn-warning btn-sm" 
                                        data-id="`+data.id+`" 
                                        data-description="`+data.description+`"
                                        data-approve_id="`+data.approve_id+`">
                                        Valider<i class="fa fa-check" style="color:white"></i>
                                        </span>
                                    </td>`+
                                "</tr>"
                            );
                            $('#err').remove();
                        } 
                        else
                        {
                            $('#table').append(
                                "<tr class='task" + data.id + "'>"+
                                    "<td>" + data.id + "</td>"+
                                    "<td>" + data.user + "</td>"+
                                    "<td>" + data.description + "</td>"+
                                    "<td>" + data.date + "</td>"+
                                    "<td>" + data.buildingsNames + "</td>"+
                                    "<td>" + data.classroomsNames + "</td>"+
                                    "<td>" + data.usersNames + "</td>"+
                                    "<td class='text-center'>"+
                                        `<span class="show-modal btn btn-info btn-sm" 
                                            data-id="`+data.id+`" 
                                            data-user="`+data.user+`" 
                                            data-description="`+data.description+`" 
                                            data-date="`+data.date+`"
                                            data-buildings="`+data.buildingsNames+`"
                                            data-classrooms="`+data.classroomsNames+`"
                                            data-users_task="`+data.usersNames+`">
                                            <svg class="bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 001.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0014.828 8a13.133 13.133 0 00-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 001.172 8z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </span>
                                        <span class="edit-modal btn btn-warning btn-sm" 
                                            data-id="`+data.id+`" 
                                            data-user="`+data.user+`" 
                                            data-description="`+data.description+`" 
                                            data-date="`+data.date+`"
                                            data-buildings="`+data.buildingsNames+`"
                                            data-classrooms="`+data.classroomsNames+`"
                                            data-users_task="`+data.usersNames+`">
                                            <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                                            </svg>   
                                        </span>
                                        <span class="delete-modal btn btn-danger btn-sm" 
                                            data-id="`+data.id+`" 
                                            data-user="`+data.user+`" 
                                            data-description="`+data.description+`" 
                                            data-date="`+data.date+`"
                                            data-buildings="`+data.buildingsNames+`"
                                            data-classrooms="`+data.classroomsNames+`"
                                            data-users_task="`+data.usersNames+`">
                                            <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                            </svg>
                                        </span>`
                                    +"</td>"+
                                    "<td class='text-center'>" + data.approveName + "</td>"+
                                "</tr>"
                            );
                            $('#err').remove();
                        }
                        
                    }
                },
            });
            
            $('#description').val('');
            $('#datepicker').val('');
            $("#buildings_id").val(null).trigger('change') ;
            $("#classrooms_id").val('').trigger('change') ;
            $("#users_id").val('').trigger('change') ;
        });
        function removeErr(){ $('#err').hide();}

    // ========================================== End Modal Create Task ==========================================
        
    // ========================================== Modal Edit Task ==========================================
        $(document).on('click', '.edit-modal', function() {

            $('#footer_action_button_edit').text("Modifier");
            $('#footer_action_button_edit').addClass('glyphicon-check');
            $('#footer_action_button_edit').removeClass('glyphicon-trash');
            $('.actionBtn_edit').addClass('btn-success');
            $('.actionBtn_edit').removeClass('btn-danger');
            $('.actionBtn_edit').addClass('edit');
            $('.modal-title').text('Modifier la tâche');
            $('.form-horizontal').show();

            // On récupère les valeurs passées dans le buton => data-
            // Puis on les affectes dans le formulaire d'édition
            $('#user_id_edit').val($(this).data('user'));
            $('#description_edit').val($(this).data('description'));
            $('#datepicker_edit').val($(this).data('date'));
            $('#buildings_id_edit').val($(this).data('buildings')).trigger('change');
            $('#classrooms_id_edit').val($(this).data('classrooms')).trigger('change');
            $('#users_id_edit').val($(this).data('users_task')).trigger('change');
            $('#task_id_edit').val($(this).data('id'));
            $('#edit').modal('show');
            console.log('buildings', $(this).data('buildings'))
        });
        
        $('.modal-footer').on('click', '.edit', function() {
            var id = $('#task_id_edit').val();
            console.log('task id', id);
            $.ajax({
                type: 'POST',
                url: 'editTask',
                data: {
                    // on récupère les données du formulaire
                    // on envoie dans le controller editTask
                    '_token': '{{ csrf_token() }}',
                    'id': $('#task_id_edit').val(), 
                    'user_id': $('#user_id').val(),
                    'description': $('#description_edit').val(),
                    'date': $('#datepicker_edit').val(),
                    'userName': $('#user_edit').val(),
                    'buildingsNames': $('.edit-modal').data('buildings'),
                    'classroomsNames': $('.edit-modal').data('classrooms'),
                    'usersNames': $('.edit-modal').data('users_task'),
                    'approveName': $('.edit-modal').data('approve'),
                    'userTypeId': $('.edit-modal').data('type_id'),
                    'buildings_id': $('#buildings_id_edit').val(),
                    'classrooms_id': $('#classrooms_id_edit').val(),
                    'users_id': $('#users_id_edit').val(),
                },
                success: function(data) {
                    console.log('EDIT :', data)
                    console.log($.isEmptyObject(data.errors));
                    if(!$.isEmptyObject(data.errors))
                    {
                        alert('Les champs Description et Date sont requisent');
                    } 
                    else
                    {
                        if(data.userTypeId == 1)
                        {
                            $('.task' + data.id).replaceWith(" "+
                            "<tr class='task" + data.id + "'>"+
                                "<td>" + data.id + "</td>"+
                                "<td>" + data.userName + "</td>"+
                                "<td>" + data.description + "</td>"+
                                "<td>" + data.date + "</td>"+
                                "<td>" + data.buildingsNames + "</td>"+
                                "<td>" + data.classroomsNames + "</td>"+
                                "<td>" + data.usersNames + "</td>"+
                                `<td class="text-center">`+
                                    `<span class="show-modal btn btn-info btn-sm" 
                                        data-id="`+data.id+`" 
                                        data-user="`+data.user+`" 
                                        data-description="`+data.description+`" 
                                        data-date="`+data.date+`"
                                        data-buildings="`+data.buildingsNames+`"
                                        data-classrooms="`+data.classroomsNames+`"
                                        data-users_task="`+data.usersNames+`">
                                        <svg class="bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 001.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0014.828 8a13.133 13.133 0 00-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 001.172 8z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                                    <span class="edit-modal btn btn-warning btn-sm" 
                                        data-id="`+data.id+`" 
                                        data-user="`+data.user+`" 
                                        data-description="`+data.description+`" 
                                        data-date="`+data.date+`"
                                        data-buildings="[`+ data.buildings_id+ `]"
                                        data-classrooms="[`+data.classrooms_id+`]"
                                        data-users_task="[`+data.users_id+`]">
                                        <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                                        </svg>   
                                    </span>
                                    <span class="delete-modal btn btn-danger btn-sm" 
                                        data-id="`+data.id+`"
                                        data-buildings="[`+data.buildings_id+`]"
                                        data-classrooms="[`+data.classrooms_id+`]"
                                        data-users_task="[`+data.users_id+`]">
                                        <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                        </svg>
                                    </span>`
                                +"</td>"+
                                `<td class="text-center" id="approveName" data-approveName="`+data.approveName+`">`+data.approveName+`</td>`+
                                `<td class="text-center">
                                    <span class="edit-approve-modal btn btn-warning btn-sm" 
                                    data-id="`+data.id+`" 
                                    data-description="`+data.description+`"
                                    data-approve_id="`+data.approve_id+`">
                                    Valider<i class="fa fa-check" style="color:white"></i>
                                    </span>
                                </td>`+
                            "</tr>"
                        );
                        } else 
                        {
                            $('.task' + data.id).replaceWith(" "+
                                "<tr class='task" + data.id + "'>"+
                                    "<td>" + data.id + "</td>"+
                                    "<td>" + data.userName + "</td>"+
                                    "<td>" + data.description + "</td>"+
                                    "<td>" + data.date + "</td>"+
                                    "<td><ul>"+
                                        $.each(data.buildingsNames, function( index, value ) {
                                            "<li>"+ value +"</li>"
                                        })
                                    +"</ul></td>"+
                                    "<td><ul>"+
                                        $.each(data.classroomsNames, function( index, value ) {
                                            "<li>"+ value +"</li>"
                                        })
                                    +"</ul></td>"+
                                    "<td><ul>"+
                                        $.each(data.usersNames, function( index, value ) {
                                            "<li>"+ value +"</li>"
                                        })
                                    +"</ul></td>"+
                                    `<td class="text-center">`+
                                        `<span class="show-modal btn btn-info btn-sm" 
                                            data-id="`+data.id+`" 
                                            data-user="`+data.user+`" 
                                            data-description="`+data.description+`" 
                                            data-date="`+data.date+`"
                                            data-buildings="`+data.buildingsNames+`"
                                            data-classrooms="`+data.classroomsNames+`"
                                            data-users_task="`+data.usersNames+`">
                                            <svg class="bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 001.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0014.828 8a13.133 13.133 0 00-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 001.172 8z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </span>
                                        <span class="edit-modal btn btn-warning btn-sm" 
                                            data-id="`+data.id+`" 
                                            data-user="`+data.user+`" 
                                            data-description="`+data.description+`" 
                                            data-date="`+data.date+`"
                                            data-buildings="[`+ data.buildings_id+ `]"
                                            data-classrooms="[`+data.classrooms_id+`]"
                                            data-users_task="[`+data.users_id+`]">
                                            <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                                            </svg>   
                                        </span>
                                        <span class="delete-modal btn btn-danger btn-sm" 
                                            data-id="`+data.id+`"
                                            data-buildings="[`+data.buildings_id+`]"
                                            data-classrooms="[`+data.classrooms_id+`]"
                                            data-users_task="[`+data.users_id+`]">
                                            <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                            </svg>
                                        </span>`
                                    +"</td>"+
                                    `<td class="text-center" id="approveName" data-approveName="`+data.approveName+`">`+data.approveName+`</td>`+
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
        $(document).on('click', '.delete-modal', function() {
            console.log('click delete')
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
            console.log($(this).data('buildings'));
        });
        
        $('.modal-footer').on('click', '.delete', function(){
            $.ajax({
                type: 'DELETE',
                url: 'deleteTask',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': $('.id').text(),
                    'buildings_id' : $(this).data('buildings'),
                    'classrooms_id' : $(this).data('classrooms'),
                    'users_id' : $(this).data('users_task'),
                },
                success: function(data){
                    console.log("supp data", data)
                    $('.task' + $('.id').text()).remove();
                }
            });
        });
    // ========================================== End Modal Delete Approve ==========================================

    // ========================================== Modal Show ==========================================
        $(document).on('click', '.show-modal', function() {
            $('#show').modal('show');
            $('#user_show').val($(this).data('user'));
            $('#description_show').text($(this).data('description'));
            $('#date_show').val($(this).data('date'));
            $('#buildingsName_show').val($(this).data('buildings'));
            $('#classroomsName_show').val($(this).data('classrooms'));
            $('#usersName_show').val($(this).data('users_task'));
            $('.modal-title').text('Show Post');
        });
    // ========================================== End Modal Show ==========================================

    // ========================================== Modal Edit Approve ==========================================
        $(document).on('click', '.edit-approve-modal', function() {
            $('#footer_action_button_approve').text("Confirmer");
            $('#footer_action_button_approve').addClass('fa-check');
            $('#footer_action_button_approve').removeClass('fa-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('editApprove');
            $('.modal-title').text('Approuver la tâche');
            // $('.deleteContent').hide();
            $('.form-horizontal').show();
            $('.id').text($(this).data('id'));
            $('#aid').val($(this).data('description'));
            $('#approveID').val($(this).data('approve_id'));
            $('#modalApproveTask').modal('show');
        });

        $('.modal-footer').on('click', '.editApprove', function() {
            console.log('approve id', $("#approveID").val())
            $.ajax({
                type: 'POST',
                url: 'approveTask',
                data: 
                {
                    '_token': '{{ csrf_token() }}',
                    'id': $('.id').text(),
                    'approve_id': $("#approveID").val()
                },
                success: function(data) {
                    console.log('approve modal', data);
                    $('.task' + data[0].id).find("td[id='approveName']").replaceWith(" "+
                        `<td class="text-center" id="approveName" data-approveName="`+data[0].approveName+`">`+data[0].approveName+`</td>`
                    );
                }
            });
        });
    // ========================================== End Modal Edit Approve ==========================================
</script>

</html>