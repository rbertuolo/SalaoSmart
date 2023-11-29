function AtribuirMascaras() {

    $(".campoFormD2").unmask();
    $(".campoFormD2").mask("99");

    $(".campoQuantidade").unmask();
    $(".campoQuantidade").mask("9999");

    $(".campoQuantidadeFuncionarios").unmask();
    $(".campoQuantidadeFuncionarios").mask("9999");

    $(".campoFormValor").unmask();
    $(".campoFormValor").mask("999.999,99");
    
    $(".campoFormData").unmask();
    $(".campoFormData").mask("99/99/9999");

    $(".campoFormBase").unmask();
    $(".campoFormBase").mask("99/9999");

    $(".campoFormCEP").unmask();
    $(".campoFormCEP").mask("99999-999");

    $(".campoFormTel").unmask();
    $(".campoFormTel").mask("99999999");

    $(".campoFormHora").unmask();
    $(".campoFormHora").mask("99:99");

    $(".campoFormTelDDD").unmask();
    $(".campoFormTelDDD").mask("(99) 9999-9999?9");

    $(".campoFormTelResidencial").unmask();
    $(".campoFormTelResidencial").mask("(99) 99999999");

    $(".campoFormDDD").unmask();
    $(".campoFormDDD").mask("99");

    $(".campoFormPorcentagem").unmask();
    $(".campoFormPorcentagem").mask("99,99");

    $(".campoFormCPF").unmask();
    $(".campoFormCPF").mask("999.999.999-99");

    $(".campoFormCNPJ").unmask();
    $(".campoFormCNPJ").mask("99.999.999/9999-99");
    
    $(".campoFormRG").unmask();
    $(".campoFormRG").mask("9.999.999-9");
    
    $(".campoFormIE").unmask();
    $(".campoFormIE").mask("");
}

function mascaraValor(valor) {
    valor = valor.toString().replace(/\D/g,"");
    valor = valor.toString().replace(/(\d)(\d{8})$/,"$1.$2");
    valor = valor.toString().replace(/(\d)(\d{5})$/,"$1.$2");
    valor = valor.toString().replace(/(\d)(\d{2})$/,"$1,$2");
    return valor                    
}