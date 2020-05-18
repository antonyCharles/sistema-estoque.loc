$(document).ready(function(){
    'use strict';
    showSelectNotaFiscal();
    if($('#lista-produtos').children().length == 0){
        let template = $('#temp-item-produto-lista').html();
        $('#lista-produtos').html(template);
    }

    $('#add-item-lista').click(function(){
        let template = $('#temp-item-produto-lista').html();
        $('#lista-produtos').append(template);
    });

    $(document).on("click", ".remove-item-lista", function(){
        if($('#lista-produtos').children().length > 1){
            $(this).parents("tr").remove();
        }
    });

    $(document).on("change", ".sel-lista-produtos", function(){
        showPrecoUnicoAndValortotal(this);
    });

    $(document).on("change",".inp-quantidade",function(){
        showPrecoUnicoAndValortotal(this);
    });

    $(document).on("change",".inp-desconto",function(){
        showPrecoUnicoAndValortotal(this);
    });

    $(document).on("change",".create-nota-fiscal",function(){
        showSelectNotaFiscal();
    });
});

function showPrecoUnicoAndValortotal(item){
    let tr = $(item).parents('tr');
    let select = tr.find('.sel-lista-produtos');
    let quant = tr.find('.inp-quantidade');
    let desconto = converterInNumber(tr.find('.inp-desconto').val());
    let precoUnico = tr.find('.td-preco-unico');
    let valorTotal = tr.find('.td-valor-total');

    if(select.find('option:selected').data('precovenda') != undefined){
        precoUnico.html('R$ ' + select.find('option:selected').data('precovenda'));
        let resultado = ((converterInNumber(select.find('option:selected').data('precovenda')) * parseInt(quant.val())) - desconto).toFixed(2);
        
        if(resultado >= 0){
            valorTotal.data("valor-total", resultado);
            valorTotal.html('R$ ' + valorMonetario(resultado));
        }else{
            valorTotal.data("valor-total", '0,00');
            valorTotal.html('R$ 0,00');
        }

        showValorTotalTable();
    }
    
}

function showSelectNotaFiscal(){
    if($(".create-nota-fiscal:checked").length > 0){
        $('.select-nota-fiscal').hide();
    }else{
        $('.select-nota-fiscal').show();
    }
}

function showValorTotalTable(){
    let valorTotal = 0;
    $('#lista-produtos').children('tr').each(function () {
        valorTotal = valorTotal + parseFloat($(this).find('.td-valor-total').data('valor-total'));
    });

    $('tfoot').find('tr th:eq(1)').html('R$ ' + valorMonetario(valorTotal.toFixed(2)));
}

function converterInNumber(valor){
    let result = 0;
    if(valor != undefined && valor != ""){
        result = valor.replace(/\./g, "");
        result = result.replace(/\,/g, ".");
        result = parseFloat(result);
    }

    return result;
}