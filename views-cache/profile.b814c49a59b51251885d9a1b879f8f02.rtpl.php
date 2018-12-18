<?php if(!class_exists('Rain\Tpl')){exit;}?> <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row mt">
          <div class="col-lg-12">
            <div class="row content-panel" id="profile">
              <div class="col-md-7 profile-text  mb centered">
                  
                  <h4><b><?php echo htmlspecialchars( $escola["nomeescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></h4>
                  <h5><b>CNPJ: <?php echo mascara($escola["cnpj"], "##.###.###/####-##"); ?></b></h5>
                  <h4><b>Gestor: <?php echo htmlspecialchars( $escola["nomegestor"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></h4>
                  
                  <hr>

                
              </div>
              <!-- /col-md-4 -->
              <div class="col-md-3 profile-text mb centered">
               
                 <h4><b>Usuario: <?php echo htmlspecialchars( $username, ENT_COMPAT, 'UTF-8', FALSE ); ?></b></h4>
                  <?php if( $user == 1 ){ ?>
                    <h5><b>Administrator</b><h5>
                  <?php }else{ ?>
                    <h5><b>Usuário</b></h5>
                  <?php } ?>
                  <hr>
                
              </div>
              <!-- /col-md-4 -->
              <div class="col-md-2 centered">
                <div class="profile-pic">
                  <?php if( $avatar == null ){ ?>
                    <p class="centered"><img src="/res/Admin/img/user-avatar/user.jpg" class="img-circle" width="100" height="100"></p> 
                  <?php }else{ ?>
                    <p class="centered"><img src="/res/Admin/img/user-avatar/<?php echo htmlspecialchars( $avatar, ENT_COMPAT, 'UTF-8', FALSE ); ?>.jpg" class="img-circle" width="100" height="100"></p> 
                    
                  <?php } ?>
                 
                </div>
              </div>
              <!-- /col-md-4 -->
            </div>
            <!-- /row -->
          </div>
          
          <!-- /col-lg-12 -->
          <div class="col-lg-12 mt">
            
            <div class="row content-panel">
                
              <div class="panel-heading">
                <?php if( $error != null ){ ?>
                   <div class="row">
                    
                    <div class="col-md-6">
                     
                      <br>

                      <div class="alert alert-danger"><b>Algo deu errado!</b> <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>.</div>
                
                       
                      </div>

                  </div>
                <?php } ?>
                <?php if( $success != null ){ ?>
                   <div class="row">
                   
                    <div class="col-md-6">
                     
                      <br>

                      <div class="alert alert-success"><b><?php echo htmlspecialchars( $success, ENT_COMPAT, 'UTF-8', FALSE ); ?></b></div>
                
                       
                      </div>

                  </div>
                <?php } ?>
                <ul class="nav nav-tabs nav-justified">
                  
                  <li class="active">
                    <a data-toggle="tab" href="#contact" class="contact-map">Contato</a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#edit">Editar Informações</a>
                  </li>
                </ul>
              </div>
              <!-- /panel-heading -->
              <div class="panel-body">
                <div class="tab-content">
                 
                  <!-- /tab-pane -->
                  <div id="contact" class="tab-pane active">
                    <div class="row">
                      
                      <!-- /col-md-6 -->
                      <div class="col-md-12 detailed">
                        <div class="col-md-6">
                          <h4>Localização</h4>
                        <div class="col-md-8 col-md-offset-2 mt">
                          
                            <h5><b>Endereço<br/><br/> <?php echo htmlspecialchars( $escola["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $escola["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $escola["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br/><br/> <?php echo htmlspecialchars( $escola["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $escola["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b>
                            </h5>
                          <br>
                        </div>
                        </div>
                        <div class="col-md-6">
                          <h4>Contato</h4>
                        <div class="col-md-8 col-md-offset-2 mt">
                          <h5>
                            <b>Telefone: <?php echo mascara($escola["telefone"], '(##)#####-####'); ?> <br/> <br/>Celular: <?php echo mascara($escola["celular"], '(##)#####-####'); ?><br/><br/>
                            Email: <?php echo htmlspecialchars( $escola["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br/></b>
                          </h5>
                        </div>
                        </div>
                        
                        
                      </div>

                      <!-- /col-md-6 -->
                    </div>
                    <!-- /row -->
                  </div>
                  <!-- /tab-pane -->
                  <div id="edit" class="tab-pane">
                    <div class="row">
                      <div class="col-lg-12 detailed">
                        <h4 class="mb">Informações da escola</h4>
                        <form class="form-horizontal" action="/portal/profile/" method="POST">
                          
                          <div class="form-group">
                            <label class="col-lg-2 control-label"><b>Nome da Escola</b></label>
                            <div class="col-lg-10">
                              <input type="text" name="nomeescola" placeholder=" " id="c-name" class="form-control" value="<?php echo htmlspecialchars( $escola["nomeescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label"><b>CNPJ</b></label>
                            <div class="col-lg-6">
                              <input type="text" placeholder=" " id="lives-in" class="form-control" readonly value="<?php echo mascara($escola["cnpj"], "##.###.###/####-##"); ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label"><b>Nome do Gestor</b></label>
                            <div class="col-lg-10">
                              <input type="text" name="nomegestor" placeholder=" " id="country" class="form-control" value="<?php echo htmlspecialchars( $escola["nomegestor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>
                          </div>
                  
                        <h4 class="mb">Contato e endereço</h4>
                          <div class="form-group">
                            <label class="col-lg-2 control-label"><b>Rua</b></label>
                            <div class="col-lg-10">
                              <input type="text" name="rua" placeholder=" " id="addr1" class="form-control" value="<?php echo htmlspecialchars( $escola["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-2 control-label"><b>Número</b></label>
                            <div class="col-lg-10">
                              <input type="text" name="numero" placeholder=" " id="addr2" class="form-control" value="<?php echo htmlspecialchars( $escola["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>
                          </div>
                      
                          <div class="form-group">
                            <label class="col-lg-2 control-label"><b>Bairro</b></label>
                            <div class="col-lg-10">
                              <input type="text" name="bairro" placeholder=" " id="addr2" class="form-control" value="<?php echo htmlspecialchars( $escola["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-2 control-label"><b>Telefone</b></label>
                            <div class="col-lg-10">
                              <input type="text" name="telefone" placeholder=" " id="phone" class="form-control" value="<?php echo htmlspecialchars( $escola["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-2 control-label"><b>Celular</b></label>
                            <div class="col-lg-10">
                              <input type="text" name="celular" placeholder=" " id="cell" class="form-control" value="<?php echo htmlspecialchars( $escola["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-2 control-label"><b>Email</b></label>
                            <div class="col-lg-10">
                              <input type="text" name="email" placeholder=" " id="email" class="form-control" value="<?php echo htmlspecialchars( $escola["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                              <button class="btn btn-theme" type="submit">Salvar Informações</button>
                              <a href="/portal/profile/" class="btn btn-theme04" type="button">Cancelar</a>
                            </div>
                          </div>
                        </form> 
                  

                      <!-- /col-lg-8 -->
                    </div>
                    <!-- /row -->
                  </div>
                  <!-- /tab-pane -->
                </div>
                <!-- /tab-content -->
              </div>
              <!-- /panel-body -->
            </div>
            <!-- /col-lg-12 -->
          </div>
          <!-- /row -->
        </div>
        <!-- /container -->
      </section>
      <!-- /wrapper -->
    </section> 

