$(document).ready(function(){
    $('.tree').treegrid();
    

    $('.radio-total').click(function(){
        let tr = $(this).parents('tr');
        tr.find('.check').prop( "checked", true );
        tr.find('.radio-none').prop( "checked", false );
    });

    $('.radio-none').click(function(){
        let tr = $(this).parents('tr');
        tr.find('.check').prop( "checked", false );
        tr.find('.radio-total').prop( "checked", false );
    });

    $('.check-create, .check-update, .check-delete').click(function(){
        let tr = $(this).parents('tr');
        if($(this).prop("checked") == true){
            tr.find('.check-read').prop( "checked", true );
        }
        
        verificachekeds(tr); 
    });

    $('.check-read').click(function(){
        let tr = $(this).parents('tr');
        verificachekeds(tr); 
    });
});

function verificachekeds(tr){
    var n = tr.find('.check:checked').length;
    
    if(n == tr.find('.check').length){
        tr.find('.radio-total').click();
    }else if(n == 0){
        tr.find('.radio-none').click();
    }else{
        tr.find('.radio-total').prop( "checked", false );
        tr.find('.radio-none').prop( "checked", false );
    }
}