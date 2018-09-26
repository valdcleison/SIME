
$(document).ready(function() {
    

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

    $('#seachCNPJ').on('click', function(e) {
    
        // Apesar do botão estar com o type="button", é prudente chamar essa função para evitar algum comportamento indesejado
        e.preventDefault();
        
        // Aqui recuperamos o cnpj preenchido do campo e usamos uma expressão regular para limpar da string tudo aquilo que for diferente de números
        var cnpj = $('#cnpj').val().replace(/[^0-9]/g, '');
        
        // Fazemos uma verificação simples do cnpj confirmando se ele tem 14 caracteres
        if(cnpj.length == 14) {
        
          // Aqui rodamos o ajax para a url da API concatenando o número do CNPJ na url
          $.ajax({
            url:'https://www.receitaws.com.br/v1/cnpj/' + cnpj,
            method:'GET',
            dataType: 'jsonp', // Em requisições AJAX para outro domínio é necessário usar o formato "jsonp" que é o único aceito pelos navegadores por questão de segurança
            complete: function(xhr){
            
              // Aqui recuperamos o json retornado
              response = xhr.responseJSON;
              
              // Na documentação desta API tem esse campo status que retorna "OK" caso a consulta tenha sido efetuada com sucesso
              if(response.status == 'OK') {
              
                // Agora preenchemos os campos com os valores retornados
                $('#nomeescola').val(response.nome);
                $('#log').val(response.logradouro);
                $('#numero').val(response.numero);
                $('#bairro').val(response.bairro);
                $('#cidade').val(response.municipio);
                $('#estado').val(response.uf);
                $('#cep').val(response.cep);

                
              
              // Aqui exibimos uma mensagem caso tenha ocorrido algum erro
              } else {
                alert(response.message); // Neste caso estamos imprimindo a mensagem que a própria API retorna
              }
            }
          });
        
        // Tratativa para caso o CNPJ não tenha 14 caracteres
        } else {
          alert('CNPJ inválido');
        }
    });
});
