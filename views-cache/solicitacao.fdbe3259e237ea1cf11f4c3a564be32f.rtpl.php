<?php if(!class_exists('Rain\Tpl')){exit;}?><br><br><br><br><br>

<div class="container">

  <form action="/solicitacao/" method="POST">

    <div class="row form-group" id="content">
      <br>

                  <div class="col-md-10">
                    <?php if( $error != '' ){ ?>

                    <br>

                    <div class="alert alert-danger"><b>Algo deu errado!</b> <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>.</div>
                    <?php } ?>

                    <?php if( $success != '' ){ ?>

                    <br>

                    <div class="alert alert-success"><b><?php echo htmlspecialchars( $success, ENT_COMPAT, 'UTF-8', FALSE ); ?></b></div>
                    <?php } ?>

                  </div>


                  <div class="col-md-6 form-group">
                    <h3>DADOS DA ESCOLA</h3>
                    <hr>
                    <div class="row" >
                      <div class="col-md-12">
                        <span><b>Nome da Instituição</b></span>
                      </div>
                    </div>
                    <div class="row" id="fg-nomeescola">

                      <div class="col-md-12">
                        <input type="text" name="nomeescola" id="nomeescola" class="form-control" required/>
                      </div>

                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <span><b>CNPJ da Instituição</b> </span> (Apenas numeros)
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="input-group mb-3">

                          <input type="text" name="cnpjescola" id="cnpj" class="form-control" placeholder="00.000.000/0000-00" aria-describedby="button-addon2"  required>


                        </div>

                      </div>
                    </div>
                     <br>

                    <div class="row">
                      <div class="col-md-12">
                        <span><b>Plano</b></span>
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-md-12">
                        <select class="form-control" name="planos">
                          <?php $counter1=-1;  if( isset($planos) && ( is_array($planos) || $planos instanceof Traversable ) && sizeof($planos) ) foreach( $planos as $key1 => $value1 ){ $counter1++; ?>

                            <option value="<?php echo htmlspecialchars( $value1["idplano"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php if( $value1["preco"] > 500 ){ ?> <?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - R$<?php echo htmlspecialchars( $value1["preco"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/Única - R$300,00/mês <?php }else{ ?> <?php echo utf8_encode($value1["descricao"]); ?> - R$<?php echo htmlspecialchars( $value1["preco"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/mês <?php } ?> </option>
                          <?php } ?>

                        </select>
                      </div>

                    </div>
                    <br>
                    <h3>ENDEREÇO E CONTATO</h3>
                    <hr>
                    <div class="row">

                      <div class="col-md-6">
                        <span><b>Logradouro</b></span>
                        <input type="text" name="logradouro" id="log" class="form-control" required>
                      </div>
                      <div class="col-md-3">
                        <span><b>Bairro</b></span>
                        <input type="text" name="bairro" id="bairro" class="form-control" required>
                      </div>
                      <div class="col-md-3">
                        <span><b>Número</b></span>
                        <input type="text" name="numero" id="numero" class="form-control" required>
                      </div>
                    </div>
                    <br>

                    <div class="row">

                      <div class="col-md-6">
                         <span><b>Cidade</b></span>
                        <input type="text" name="cidade" id="cidade" class="form-control"  required>
                      </div>
                      <div class="col-md-3">
                        <span><b>Estado</b></span>
                        <input type="text" name="estado" id="estado" class="form-control"  required>
                      </div>
                      <div class="col-md-3">
                        <span><b>CEP</b></span>
                        <input type="text" name="cep" id="cep" class="form-control" minlength="8" maxlength="8" required>
                      </div>
                    </div>
                    <hr>


                    <div class="row">
                      <div class="col-md-12">
                        <span><b>Email da Escola</b></span>
                      </div>
                    </div>


                    <div class="row">

                      <div class="col-md-12">
                        <input type="email" name="emailescola" id="emailescola" class="form-control" required>
                      </div>

                    </div>
                    <br>
                    <div class="row">

                      <div class="col-md-6">
                        <span><b>Telefone</b></span>  (Apenas números)
                        <input type="text" name="telefone" id="telefone" class="form-control" >
                      </div>
                      <div class="col-md-6">
                        <span><b>Celular</b></span>  (Apenas números)
                        <input type="text" name="celular" id="celular" class="form-control"  required>
                      </div>
                    </div>
                      <br>

                    <br>
                    <br>
                  </div>

                  <div class="col-md-6">
                    <h3>DADOS DO GESTOR</h3>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <span><b>Nome do Gestor</b></span>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-md-12">
                        <input type="text" name="nomegestor" class="form-control" required>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <span><b>Email do Gestor</b></span>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-md-12">
                        <input type="email" name="emailgestor" class="form-control" required>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <span><b>CPF do Gestor</b></span>  (Apenas números)
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-md-12">
                        <input type="text" name="cpfgestor" class="form-control" required>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <span><b>Nome de usuário</b></span>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-md-12">
                        <input type="text" name="usuarioescola" class="form-control" required>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <span><b>Senha</b></span>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-md-12">
                        <input type="password" name="senhaescola" class="form-control" required>
                      </div>
                    </div>


                  </div>

                      <div class="col-md-10">

                      </div>
                      <div class="col-md-2">

                        <input type="submit" class="btn btn-primary" id="btnEscola" value="Enviar Solicitação"></input>
                      </div>
                      <br>
                      <br>
                      <br>
              </div>
  </form>
</div>
