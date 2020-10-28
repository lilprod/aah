<div class="modal fade" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation de Suppression</h4>
              </div>
              <div class="modal-body">
                <p>Etes-vous sûr(e) de vouloir supprimer cet enregistrement?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-danger" id="delete-btn" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();"><i class="fa fa-trash"></i> Supprimer</button>
                <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
             </div>
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>