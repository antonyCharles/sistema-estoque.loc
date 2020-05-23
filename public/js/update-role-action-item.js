$(document).ready(function(){
    
    $('#add-role-action-item').click(function(){
        let template = $('#temp-action-item').html();
        let create = document.createElement("tr");
        create.innerHTML = template;
        //$(create).find('.role_number').val(genereteRole());
        $('.table-action-item tbody').prepend(create);
    });

    $(document).on('click','.button-remove', function(){
        let tr = $(this).parents('tr');
        if(tr.find('.role-action-item-id').val()){
            tr.find('.item_remove').val('true');
            tr.hide();
        }else{
            tr.remove();
        }
    });

});