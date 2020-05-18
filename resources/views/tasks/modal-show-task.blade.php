{{-- Modal Form Show task --}}
<div id="show" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group add">
                    <label for="user_show">Demandé par</label>
                    <input type="text" class="form-control" id="user_show" value="" disabled>
                </div>

                <div class="form-group add">
                    <label for="description_show">Description</label>
                    <textarea type="text" class="form-control" id="description_show" value="" rows="6" cols="150" disabled></textarea>
                </div>

                <div class="form-group add">
                    <label for="date_show">Date</label>
                    <input type="text" class="form-control" id="date_show" value="" disabled>
                </div>

                <div class="form-group add">
                    <label for="buildingsName_show">Bâtiment(s)</label>
                    <input type="text" class="form-control" id="buildingsName_show" value="" disabled>
                </div>

                <div class="form-group add">
                    <label for="classroomsName_show">Salle(s)</label>
                    <input type="text" class="form-control" id="classroomsName_show" value="" disabled>
                </div>

                <div class="form-group add">
                    <label for="usersName_show">Traitant(s)</label>
                    <input type="text" class="form-control" id="usersName_show" value="" disabled>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-warning" type="button" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remobe"></span>Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>