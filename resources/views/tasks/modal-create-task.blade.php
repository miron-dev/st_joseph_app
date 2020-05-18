{{-- Modal Form Create task --}}
<div id="create" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    @csrf
                    <div class="form-group add">
                        <label for="user">Demande de</label>
                        <input type="text" class="form-control" id="user" placeholder="Nom du demandeur" disabled value={{ Auth::user()->name}}>
                        <input type="hidden" class="form-control" name="user_id" id="user_id" value={{ Auth::id()}}>
                    </div>

                    <div class="form-group">
                        <label for="description">Description <span style="color:red">*</span></label>
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Your description Here" rows="6" cols="150" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="date">Date<span style="color:red">*</span></label>
                        <input class="form-control" id="datepicker" name="date" placeholder="Your date Here" required>
                    </div>  

                    <label for="buildings_id">Bâtiment(s)</label>
                    <div class="form-group">
                        <select class="form-control js-example-basic-multiple" id="buildings_id" name="buildings_id[]" style="width:100%" multiple="multiple">
                            @foreach(App\Building::all() as $building)
                                <option value="{{$building->id}}">{{$building->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="classrooms_id">Salle(s)</label>
                    <div class="form-group">
                        <select class="form-control js-example-basic-multiple" id="classrooms_id" name="classrooms_id[]" style="width:100%" multiple="multiple">
                            @foreach(App\Classroom::all() as $classroom)
                                <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="users_id">Traitant(s)</label>
                    <div class="form-group">
                        <select class="form-control js-example-basic-multiple" id="users_id" name="users_id[]" style="width:100%" multiple="multiple">
                            @foreach(App\User::all() as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-warning" type="submit" id="add">
                            <span class="glyphicon glyphicon-plus"></span>Enregistrer
                        </button>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remobe"></span>Fermer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>