<div class="dialog-backdrop" data-confirm-dialog role="alertdialog" aria-modal="true" aria-labelledby="confirm-title">
    <div class="dialog">
        <div class="dialog-icon"><?= icon('warning') ?></div>
        <h3 id="confirm-title" data-confirm-title>Confirmar ação</h3>
        <p data-confirm-body>Essa ação não pode ser desfeita.</p>
        <div class="dialog-actions">
            <button type="button" class="btn btn-secondary" data-confirm-cancel>Cancelar</button>
            <button type="button" class="btn btn-danger" data-confirm-accept><?= icon('trash') ?> Confirmar</button>
        </div>
    </div>
</div>
