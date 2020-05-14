{{-- Modal Form Delete task --}}
<div id="myModal" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="deleteContent">
                    Êtes-vous sûr de vouloir supprimer la tâche N° <span class="title"></span>
                    <span class="hidden id"></span>
                </div>
                <div class="modal-footer">
                    <button class="btn actionBtn" type="button" data-dismiss="modal">
                        <span id="footer_action_button" class="glyphicon glyphicon-plus">Supprimer</span>
                    </button>
                    <button class="btn btn-warning" type="button" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remobe"></span>Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>