function redesenharTable(){
    return $('#dataTables').DataTable({       
         "language"  : {
             "sEmptyTable": "Nenhum registro encontrado",
             "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
             "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
             "sInfoFiltered": "(Filtrados de _MAX_ registros)",
             "sInfoPostFix": "",
             "sInfoThousands": ".",
             "sLengthMenu": "_MENU_ Resultados por página",
             "sLoadingRecords": "Carregando...",
             "sProcessing": "Processando...",
             "sZeroRecords": "Nenhum registro encontrado",
             "sSearch": "Pesquisar",
             "oPaginate": {
                 "sNext": "Próximo",
                 "sPrevious": "Anterior",
                 "sFirst": "Primeiro",
                 "sLast": "Último"
             },
             "oAria": {
                 "sSortAscending": ": Ordenar colunas de forma ascendente",
                 "sSortDescending": ": Ordenar colunas de forma descendente"
             },
          
         },       
         "dom": '<"row"<"col-lg-3"l><"col-lg-5"<"toolbar">><"col-lg-4"f>>rtip',
         "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Tudo"] ],        
         "processing": true,
         "serverSide": true,	
         "ajax": {
                 url: "actions/serverSide.php",
                 //ao aplicar o reload no datatables, passamos o valor do radio button para aplicar um novo filtro
                 data: function ( d ) {
                        d.rAtivo = $("input[name='rAtivo']:checked").val();
                },
                 type: "POST",
                 error: function (){
                     $('#post_list_processing').css('display','none');
                 }
            
         },
         "order": [[0, "asc" ]], //ordena pelo cliente
         "columns":[        
             { "data": "nome" },
             { "data": "documento", "orderable": false },
             { "data": "telefone", "orderable": false },
             { "data": "celular", "orderable": false },
          //   { "data": "ativo" },
             { "defaultContent": [ 
                             "<button id='altera' type='button' class='btn btn-success fa fa-pencil-square-o' alt='Alterar Registro'></button> <button id='remover' type='button' class='btn btn-danger fa fa-trash' alt='Remover Registro'></button>"
                              ],
                              "orderable": false,
                              "width": "13%",
                              "className": "text-center"   
                 
             },
              
         ],
         
         
    })  
}



$("input[name='rAtivo']").click(function(){
    //redesenha o datatables a cada clique no radio button
     table.ajax.reload();  
});
$(document).ready(function () {
    table = redesenharTable(); 
    $("div.toolbar").html('<form id="formFiltro" class="form-inline"> '+
        
            '<button id="btn-print" class="btn btn-primary btn-sm fa fa-print"></button>  '+                            
     
        '</form>');   
        $("#btn-print").off('click').on('click', function(e){
            e.preventDefault();
        
            $.ajax({
                type: 'POST',
                url: '../relatorios/imprimeCliente.php',
              //  dataType: "application/json",
                data: { 
                    start :table.page.info()['start']+1,
                    end :table.page.info()['end'],
                    length: table.page.len(),
                    pages: table.page.info()['pages'],
                    page: table.page.info()['page']+1,
                    order: table.order()[0][0],
                    dir: table.order()[0][1],
                    search: table.search(),
                    rFiltro: $("input[name='rAtivo']:checked").val(), 
                }
            }).done(function(data){
                var data = $.parseJSON(data);    
                var fileName = data.filename;
                $('#modalRel').modal('show');
                var object = "<object data=\"{FileName}\" type=\"application/pdf\" width=\"100%\" height=\"500px\">";
                                object += "Se você não está visualizando esse relatório, você pode baixar clicando aqui <a href = \"{FileName}\">here</a>";
                                object += " ou fazer o donwload do <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> para visualizar.";
                                object += "</object>";
                                object = object.replace(/{FileName}/g, "../relatorios/pdf/" + fileName);
                                $("#body-rel").html(object);
        
               
            })
           
        })
    $('#dataTables tbody').on( 'click', '#altera', function () {
       var data = table.row( $(this).parents('tr') ).data();        
       location.href = "edit.php?id="+data['id'];

     } );

     $('#dataTables tbody').on( 'click', '#remover', function (event) {
        event.preventDefault(); 
        var data = table.row( $(this).parents('tr') ).data();
        $('#msgDeRemocao').html('Confirma a exclusão do Cliente '+data['nome']+'? <br> Essa operação não poderá ser desfeita.');
        $('#confirm-delete').modal('show'); 
        $("#confirm-delete").modal().find("#btn-remove").off('click').on("click", function(){                                                
            $.ajax ({
                    type: 'POST',
                    url: "actions/delete.php",
                    data: {id : data['id']},
                    async: false,
                    dataType: "text"                                    
            }).done(function (data) { 
               // console.log(data)
                var data = $.parseJSON(data);     
                if(data.sucesso){                    
                    $('#confirm-delete').modal('hide');  
                     //remove a linha mas reseta a paginação                         
                       // table.row($(this).parents('tr')).remove().draw(false);
                       //remove a linha mas mantem a paginação atual                      
                    table.row($(this).parents('tr')).draw(false); 
                } else {                  
                   // $('#retornoHTML').show();         
                    $('#retornoHTML').addClass('alert alert-danger');
                    $('#retornoHTML').html(data.mensagem); /* imprime o retorno no HTML */                           
                    $("#confirm-delete").modal().find(".btn-cancel").hide();
                    $("#confirm-delete").modal().find(".btn-remove").hide();
                    $("#confirm-delete").modal().find(".btn-entendi").show();
                    $("#confirm-delete").modal().find(".btn-entendi").off("click").on("click", function(){ 
                        $("#confirm-delete").modal().find(".btn-cancel").show();
                        $("#confirm-delete").modal().find(".btn-remove").show();
                        $("#confirm-delete").modal().find(".btn-entendi").hide();
                        $('#confirm-delete').modal('hide');  
                        $('#retornoHTML').removeClass('alert alert-danger');
                        $('#retornoHTML').html("");                                         
                    })
                   
                }
            }) 
       })
    })

})
//usuario clicar fora da caixa do modal
$(document).click(function(event) {
    //if you click on anything except the modal itself or the "open modal" link, close the modal
    if ($(event.target).closest("#modalRel").length) {
        $("body").find("#modalRel").modal('hide');
       
    }
  });



