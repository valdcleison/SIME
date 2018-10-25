<?php if(!class_exists('Rain\Tpl')){exit;}?><section id="main-content">
      <section class="wrapper">
        
        <div class="row mt">
          <div class="col-sm-12">
            <div class="form-panel">
              <div class="form">

                <form action="/admin/escola/<?php echo htmlspecialchars( $escola["idescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/" method="POST"> 

                   <div class="row form-group" id="content">
                      
                              
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
                        <div class="row">
                          <div class="col-md-12">
                            <span><b>Nome da Instituição</b></span>
                          </div>
                        </div>
                        <div class="row">
                          
                          <div class="col-md-12">
                            <input type="text" name="nomeescola" id="nomeescola" class="form-control" value="<?php echo htmlspecialchars( $escola["nomeescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>  
                          </div>
                        </div>
                        <br>

                        <div class="row">
                          <div class="col-md-12">
                            <span><b>Nome do Gestor</b></span>
                          </div>
                        </div>
                        <div class="row">
                          
                          <div class="col-md-12">
                            <input type="text" name="nomegestor" class="form-control" value="<?php echo htmlspecialchars( $escola["nomegestor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
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
                              <option value="1">Plano Basico - R$39,90 Mensal ou R$459,90 Anual</option>
                              <option value="2">Plano Médio - R$69,90 Mensal ou R$799,90 Anual</option>
                              <option value="3">Plano Avançado - R$99,90 Mensal ou R$1099,90 Anual</option>
                            </select>
                          </div>
                          
                        </div>
                        <br>
                        <hr>

                    
          
                      </div>
                  
                      <div class="col-md-5">
                        <h3>ENDEREÇO E CONTATO</h3>
                        <hr>
                        
                        <div class="row">
                          
                          <div class="col-md-6">
                            <span><b>Logradouro</b></span>
                            <input type="text" name="rua" id="log" class="form-control" value="<?php echo htmlspecialchars( $escola["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                          </div>
                          <div class="col-md-3">
                            <span><b>Bairro</b></span>
                            <input type="text" name="bairro" id="bairro" class="form-control" value="<?php echo htmlspecialchars( $escola["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                          </div>
                          <div class="col-md-3">
                            <span><b>Numero</b></span>  
                            <input type="number" name="numero" id="numero" class="form-control" value="<?php echo htmlspecialchars( $escola["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                          </div>
                        </div>
                        <br>

                        <div class="row">
                          
                          <div class="col-md-6">
                             <span><b>Cidade</b></span>
                            <input type="text" name="cidade" id="cidade" class="form-control"  value="<?php echo htmlspecialchars( $escola["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                          </div>
                          <div class="col-md-3">
                            <span><b>Estado</b></span>
                            <input type="text" name="estado" id="estado" class="form-control" minlength="8" maxlength="8"  value="<?php echo htmlspecialchars( $escola["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                          </div>
                          <div class="col-md-3">
                            <span><b>CEP</b></span>
                            <input type="text" name="cep" id="cep" class="form-control" minlength="8" maxlength="8" value="<?php echo htmlspecialchars( $escola["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  required>
                          </div>
                        </div>
                        <hr>
                        

                        <div class="row">
                          <div class="col-md-12">
                            <span><b>Email</b></span>
                          </div>
                        </div>
                        

                        <div class="row">
                          
                          <div class="col-md-12">
                            <input type="email" name="email" id="emailescola" class="form-control" value="<?php echo htmlspecialchars( $escola["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                          </div>
                          
                        </div>
                        <br>
                        
                        

                        
                    
                        <div class="row">
                          
                          <div class="col-md-6">
                            <span><b>Telefone</b></span>  (Apenas numeros) 
                            <input type="text" name="telefone" id="telefone" class="form-control" value="<?php echo htmlspecialchars( $escola["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" >
                          </div>
                          <div class="col-md-6">
                            <span><b>Celular</b></span>  (Apenas numeros) 
                            <input type="text" name="celular" id="celular" class="form-control" required value="<?php echo htmlspecialchars( $escola["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" >
                          </div>
                        </div>


                      </div>

                          <br>

                          <div class="col-md-12">
                            
                          <input type="submit" class="btn btn-primary" id="btnEscola" value="Salvar"></input>
                          </div>
                          <br>
                          <br>
                          <br>

                  </div>
                </form>
              </div>
              
              
              
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>