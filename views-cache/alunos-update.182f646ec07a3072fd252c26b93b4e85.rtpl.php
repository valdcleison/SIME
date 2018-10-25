<?php if(!class_exists('Rain\Tpl')){exit;}?>  
  <section id="main-content">
  <section class="wrapper site-min-height">
    
    <div class="row mt">
      <div class="col-sm-12">
        <div class="form-panel">
          <div class="form">

            <form action="/admin/escola/create/" method="POST"> 

               <div class="row form-group" id="content">
                  
                          
                  <div class="col-md-10">
                    <?php if( $error != '' ){ ?>

                    <br>

                    <div class="alert alert-danger"><b>Algo deu errado!</b> <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>.</div>
                    <?php } ?>

                    
                  </div>

                  
                  <div class="col-md-6 form-group">
                    <h3>DADOS DO ALUNO</h3>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <span><b>Nome do Aluno</b></span>
                      </div>
                    </div>
                    <div class="row">
                      
                      <div class="col-md-12">
                        <input type="text" name="nomealuno" id="nomeescola" class="form-control" required>  
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <span><b>CPF do Aluno</b> </span> (Apenas numeros) 
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10">

                          <input type="text" name="cpfaluno" id="cnpj" class="form-control" placeholder="000.000.000-00" aria-describedby="button-addon2" minlength="11" maxlength="11" required>
                          
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <span><b>Numero Matricula</b></span> (Apenas numeros) 
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10">
                        <input type="text" name="numeromatricula" class="form-control" required>
                      </div>
                      <!--<div class="col-md-4">
                        <input type="button" name="btngerar" value="Gerar Matricula" class="btn btn-primary  form-control" required>
                      </div>-->
                    </div>


                    <h3>DADOS DO RESPONSAVEL</h3>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <span><b>Nome do Responsavel</b></span>
                      </div>
                    </div>
                    <div class="row">
                      
                      <div class="col-md-12">
                        <input type="text" name="nomeresponsavel" id="nomeescola" class="form-control" required>  
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <span><b>CPF do Responsavel</b> </span> (Apenas numeros) 
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">

                          <input type="text" name="cpfresponsavel" id="cnpj" class="form-control" placeholder="000.000.000-00" aria-describedby="button-addon2" minlength="11" maxlength="11" required>
                          
                      </div>
                    </div>
                    <br>

                    <br>
                

                  </div>
              
                  <div class="col-md-6">
                    <h3>ENDEREÇO E CONTATO</h3>
                    <hr>
                    
                    <div class="row">
                      
                      <div class="col-md-6">
                        <span><b>Logradouro</b></span>
                        <input type="text" name="rua" id="log" class="form-control" required>
                      </div>
                      <div class="col-md-3">
                        <span><b>Bairro</b></span>
                        <input type="text" name="bairro" id="bairro" class="form-control" required>
                      </div>
                      <div class="col-md-3">
                        <span><b>Numero</b></span>  
                        <input type="number" name="numero" id="numero" class="form-control" required>
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
                        <input type="text" name="estado" id="estado" class="form-control" minlength="8" maxlength="8"  required>
                      </div>
                      <div class="col-md-3">
                        <span><b>CEP</b></span>
                        <input type="text" name="cep" id="cep" class="form-control" minlength="8" maxlength="8" required>
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
                        <input type="email" name="emailresponsavel" id="emailescola" class="form-control" required>
                      </div>
                      
                    </div>
                    <br>         
                    <div class="row">
                      
                      <div class="col-md-6">
                        <span><b>Telefone</b></span>  (Apenas numeros) 
                        <input type="text" name="telefone" id="telefone" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <span><b>Celular</b></span>  (Apenas numeros) 
                        <input type="text" name="celular" id="celular" class="form-control" required>
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

