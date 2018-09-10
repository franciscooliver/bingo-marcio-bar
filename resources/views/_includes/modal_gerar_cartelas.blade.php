<!-- Modal -->
<div class="modal fade" id="modal_qtd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog .modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Digite o número de cartelas a ser gerado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" id="modal-body">
                <p class="text-secondary" id="msg-retorno"></p>
                <form>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="qtd" class="col-form-label">Quantidade:</label>
                        <input type="text" name="qtd" id="qtd" placeholder="Quantidade" class="form-control">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btn_enviar">Gerar</button>
            </div>
        </div>
    </div>
</div>