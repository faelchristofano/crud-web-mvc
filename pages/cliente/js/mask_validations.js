function mask_validation(){
    $('#cpf').mask('999.999.999-99');
    $('#cnpj').mask('99.999.999/0001-99');
    $('#datanasc').mask('99/99/9999');
    $("#telefone").mask('(99) 9999-9999')
    $("#celular")
        .click( function(){
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();
            element.mask("(00) 00000-0000")         
        })
        .mask("(00) 00000-0000")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
            if(phone.length > 10) {  
                element.mask("(00) 00000-0000");  
            } else {  
                element.mask("(00) 0000-0000");  
            }  
            
        });
    $('#cpf').focusout

    $('#form').validate({
        rules:{
            nome: {
                required: true,
                maxlength: 100,
                minlength: 7,
                minWords: 2
                
            },
            email: {
                required: true,
                email: true            
            },
            cpf: {
                required: true,
                cpfBR: true,              
            },
            cnpj: {
                required: true,
                cnpj: true              
            },
            cidade: {
                required: true,   
            },
           
            datanasc: {
               // required: true,
                dateITA : true           
            }
        },
        
        onkeyup: false,    
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
            
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');    
        },
        errorElement: 'span',
        errorClass: 'label label-danger',
        errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
        }
    }) 

}