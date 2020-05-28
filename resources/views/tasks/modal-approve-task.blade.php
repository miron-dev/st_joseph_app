{{-- Modal Form approve task --}}
<div id="modalApproveTask" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    <div class="form-group">
                      <label class="control-label col-sm-2"for="approveID">Approuver</label>
                      <div class="col-sm-10">
                          <select class="form-control" id="approveID">
                              @foreach(App\Approve::all() as $approveTask)
                                  <option value="{{ $approveTask->id }}">{{ $approveTask->name }}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="aid">Tâche</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="aid" disabled>
                        </div>
                    </div>
                    <input type="hidden" id="task_id" name="task_id">
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn_approve" data-dismiss="modal">
                        <span id="footer_action_button_approve" class="fa"></span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="fa fa"></span>Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>