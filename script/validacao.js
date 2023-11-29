function validarForm(e){
// e.preventDefault();
// determina se o form pode ser submetido ou não
var canSubmit = true;
 
// faz uma busca por todos elementos que especificam o atributo req=true
$("#formulario [req=true]").each(
    function(){
        if($(this).val().length < 1){
            canSubmit = false;
            //messages += "<li>" + $(this).attr("label") + " é obrigatório</li>";
            $(this).css('border-color', '#F00');
        }
        else{
            $(this).css('border-color','gray');
        }       
        
    }
);
    if(canSubmit == true) document.formulario.submit();
    else e.preventDefault();    
}

function formatacao(campo)
{
    var res = campo.replace(".", ""); 
    var res = res.replace(".", ""); 
    var res = res.replace(".", ""); 
    var novoValor = res.replace(",", "."); 
    return novoValor;
}

function validarForm2(e){
// e.preventDefault();
// determina se o form pode ser submetido ou não
var canSubmit = true;
 
// faz uma busca por todos elementos que especificam o atributo req=true
$("#formulario2 [req=true]").each(
    function(){
        if($(this).val().length < 1){
            canSubmit = false;
            //messages += "<li>" + $(this).attr("label") + " é obrigatório</li>";
            $(this).css('border-color', '#F00');
        }
        else{
            $(this).css('border-color','gray');
        }       
        
    }
);

    if(canSubmit == true) document.formulario2.submit();
    else e.preventDefault();    
}