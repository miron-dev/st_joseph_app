{{-- Modal Form Edit and Delete Post --}}
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    @csrf                    
                    <div class="form-group">
                        <label for="user">Demande de</label>
                        <input type="text" class="form-control" id="user_edit" name="user_edit" placeholder="Nom du demandeur" disabled value={{ Auth::user()->name}}>
                        <input type="hidden" class="form-control" name="user_id" id="user_id_edit" value={{ Auth::id()}}>
                        <input type="hidden" class="form-control" name="task_id" id="task_id_edit" value={{ $task->id }}>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description_edit" name="description" placeholder="Your description Here" value="" required>
                    </div>

                    <div class="form-group">
                        <label for="date">date</label>
                        <input class="form-control" id="datepicker_edit" name="date" placeholder="Your date Here" value="" required>
                    </div>  

                    <label for="buildings_id">Bâtiment(s)</label>
                    <div class="form-group">
                        <select class="form-control js-example-basic-multiple" id="buildings_id_edit" name="buildings_id[]" style="width:100%" multiple="multiple">
                            @foreach(App\Building::all() as $building)
                            <option class="building{{$building->id}}" value="{{$building->id}}">{{$building->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="classrooms_id">Salle(s)</label>
                    <div class="form-group">
                        <select class="form-control js-example-basic-multiple" id="classrooms_id_edit" name="classrooms_id[]" style="width:100%" multiple="multiple">
                            @foreach(App\Classroom::all() as $classroom)
                                <option class="classroom{{$classroom->id}}" value="{{$classroom->id}}">{{$classroom->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="users_id">Traitant(s)</label>
                    <div class="form-group">
                        <select class="form-control js-example-basic-multiple" id="users_id_edit" name="users_id[]" style="width:100%" multiple="multiple">
                            @foreach(App\User::all() as $user)
                            <option class="user_task{{$user->id}}" value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- ne pas oublier de deplacer --}}
                </form> 
                    <div class="modal-footer">
                        <button class="btn btn-warning actionBtn_edit">
                            <span id="footer_action_button_edit" class="glyphicon"></span>
                        </button>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remobe"></span>Close
                        </button>
                    </div>
            </div>
        </div>
    </div>
</div>