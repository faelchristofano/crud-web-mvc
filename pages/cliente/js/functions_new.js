$(document).ready(function () {
    mask_validation();
    $('#btnNovo').off('click').on('click', function(){
        $('#btnGravar').show();
        $(this).hide();
    })
    $("#btnGravar").off('click').on('click', function(){
        event.preventDefault();
        gravarDados();
        
    })   
})
//usuario clicar fora da caixa do modal
$(document).click(function(event) {
    //if you click on anything except the modal itself or the "open modal" link, close the modal
    if ($(event.target).closest("#confirm").length) {
        $("body").find("#confirm").modal('hide');
       
    }
  });

function gravarDados(){
    if($('#form').valid()){//valida os dados preenchidos no formulário 
        var dadosForm = new FormData($("form[name='form']")[0]); 
    //   var vetCheckboxes = caputurarCheckboxChecked();
    //    dadosForm.append('vetCheckboxes', vetCheckboxes);  
    //   dadosForm.append('ativo', $("#ativo").val());  
        $.ajax({
            type: "POST", /* tipo post */
            url: 'actions/insert.php',
            data: dadosForm, /* informa Dados */
            dataType:'text', 
            contentType: false,
            processData: false,
            success: function(data) { /* sucesso */   
                var data = $.parseJSON(data);    
                $('#confirm').modal('show');               
                if(data.sucesso){                      
                    $('#msg').removeClass('alert alert-danger text-center').addClass('alert alert-success text-center');   
                    $('#btnGravar').hide();
                    $(btnNovo).show();
                } else {
                    $('#msg').addClass('alert alert-danger text-center');
                }   
                $('#msg').html(data.mensagem);                                         
            }
        })
    }
}
/*
$('#tipopf').click(function () {
    $('#pessoa-juridica').css('display','none');
    $('#pessoa-fisica').css('display','block');
    $('#cnpj').val('');
    $('#ie').val('');
    //sairCnpj();
});
$('#tipopj').click(function () {
    $('#pessoa-juridica').css('display','block');
    $('#pessoa-fisica').css('display','none');
    $('#cpf').val('');
    $('#rg').val('');
   // sairCpf();
});
*/
function selecionaCidadeAtribuiUf(e){
    //$('#uf').val($('#cidade option:selected').text());
    $('#uf').val($(e).children(':selected').data("valor"));
}
