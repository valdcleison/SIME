$("#salvarsenha").attr("disabled", "true");
$(document).ready(function() {
    $(".obrigate").blur(function(){
        if($(".obrigate").val() == ""){
            $(".obrigate").addClass("has-error");
        }else{
            $(".obrigate").removeClass("has-error");
        }
        
    });  
   
    
    
    $("#senhaaluno").keyup(function(){
        var senha = $(this).val();
        var resenha = $("#resenhaaluno").val();
        console.log($("#salvarsenha").prop("disabled"));
        if(senha == resenha ){
            $("#salvarsenha").removeAttr("disabled");
            console.log(senha + " " + resenha);
        }else{
            console.log("senha 1");
            $("#salvarsenha").attr("disabled", "true");

        }

    });

    $("#resenhaaluno").keyup(function(){
        var senha = $("#senhaaluno").val();
        var resenha = $(this).val();;
        console.log($("#salvarsenha").prop("disabled"));
        if(senha == resenha){
            $("#salvarsenha").removeAttr("disabled");
            console.log(senha + " " + resenha);
        }else{
            console.log("senha 2");
            $("#salvarsenha").attr("disabled", "true");
        }

    });

    $("#cpf").mask("999.999.999-99");
    $("#cpf2").mask("999.999.999-99");
    $("#cnpj").mask("99.999.999/9999-99");
    $("#telefone").mask("(99)9999-9999");
    $("#celular").mask("(99)99999-9999");
    $("#cep").mask("99999-999");
    $("#search").mask("99-99-9999");
    
    $("#avatar-aluno").hover(
        function(){
            alert("ok");
            $('#avatar-texto').css({display:"block"});
        }
    );
    
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
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                            return false;
                        }
                    });
                } 
                else {
                    limpa_formulário_cep();
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
        $("#cep").val("");
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

