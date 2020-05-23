$(document).ready(function(){
    $('.tree').treegrid();

    $('#add-item-list-roles').click(function(){
        let template = $('#temp-item-role-list').html();
        let create = document.createElement("tr");
        create.innerHTML = template;
        $(create).find('.role_number').val(genereteRole());


        $('.tree').treegrid('add', [create]);
    });

    $('.add-children').click(function(){
        let template = $('#temp-item-role-list').html();

        let tr = $(this).parents('tr');
        let create = document.createElement("tr");
        create.innerHTML = template;

        $(create).find('.role_father_id').val(tr.attr('data-role-id'));
        $(create).find('.role_number').val(genereteRole());

        $(tr).treegrid('add', [create]);
    });

    $(document).on("keyup",".input-name",function(){
        let tr = $(this).parents('tr');
        tr.find('.text-name').html($(this).val());
    });

    $(document).on('click','.button-remove', function(){
        let tr = $(this).parents('tr');

        if(tr.find('.input-role_id').val()){
            tr.find('.item_status').val('remove');
            tr.addClass('d-none');
        }else{
            tr.remove();
        }
    });

    $("#form-roles").submit(function(){
        $('select').removeAttr("disabled");
    });
});

function genereteRole(){
    let roles = [];
    $(".role_number").each(function(){
        roles.push(parseInt($(this).val()));
    });

    $i = 1;
    $lenRoles = $(".role_number").length + 10;
    for($i; $i < $lenRoles; $i++){
        if(roles.indexOf($i) == -1){
            break;
        }
    }

    return $i
}