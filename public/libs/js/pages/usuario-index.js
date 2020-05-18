$(function() {
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        modal.find('input[name="id"]').val(button.data('id'));
        modal.find('.modal-body .nomeUsuario').html(button.data('nome'));
      });
});