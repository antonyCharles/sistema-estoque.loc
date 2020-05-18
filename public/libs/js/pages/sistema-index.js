$(function() {

  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    modal.find('input[name="id"]').val(button.data('id'));
    modal.find('.modal-body .nomeRole').html(button.data('nome'));
    modal.find('.modal-body .valorRole').html(button.data('role'));
  });


  $('#deleteGrupoModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    modal.find('input[name="id"]').val(button.data('id'));
    modal.find('.modal-body .nomeRole').html(button.data('nome'));
  });


});