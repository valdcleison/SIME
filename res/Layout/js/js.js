
$(document).ready(function() {
    $("#nomeescola").blur(function(){
        if($("#nomeescola").val() == ""){
            $("#fg-nomeescola").addClass("has-error");
        }else{
            $("#fg-nomeescola").removeClass("has-error");
        }
        
    });
    function validaCep(){
        $("#btnEscola").click(function() {
        alert("OK");
        return false;
        
        //Nova variável "cep" somente com dígitos.
        var cep = $("#cep").val();
        var options = $('#estado');
        
        //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            return true;
                        } 
                        else {
                            alert("CEP não encontrado.");
                            return false;
                        }
                    });
                } 
                else {
                    alert("Formato de CEP inválido.");
                    return false;
                }
            } 
            else {
                limpa_formulário_cep();
                return false;
            }
        });
    }

    

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#log").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');
        var options = $('#estado');
        
        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#log").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#estado").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#log").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#estado").val(dados.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });





});

