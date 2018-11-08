<?php if(!class_exists('Rain\Tpl')){exit;}?>  <section id="main-content">
      <section class="wrapper">

        <div class="row mt">
          <div class="col-lg-12">
            <br><h3><i class="fa fa-angle-right"></i> Cadastro de Usuario</h3></b>

          
            <div class="form-panel">
              <div class=" form">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if( $error != '' ){ ?>

                        <br>
                        <div class="alert alert-danger"><b>Algo deu errado!</b> <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>.</div>
                        <?php } ?>

                    </div>
                </div>
                <form class="cmxform form-horizontal style-form" id="commentForm" method="post" action="/portal/users/create/" enctype="multipart/form-data">
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Nome</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="cname" name="nomepessoa" minlength="2" type="text" required />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-2">E-Mail</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="cemail" type="email" name="emailpessoa" required />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-2">CPF(Apenas números)</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="ccpf" type="cpf" name="cpfpessoa" maxlength="11" minlength="11" required/>
                    </div>
                  </div>
                  
                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-2">Usuário</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="cuser" type="text" name="usuario" minlength="6" required/>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="csenha" class="control-label col-lg-2">Senha</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="cpass" type="password" name="pass" minlength="8" required />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="csenha" class="control-label col-lg-2">Repita a Senha</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="crepass" type="password" name="repass" minlength="8" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="csenha" class="control-label col-lg-2">Avatar</label>
                    <div class="col-lg-10">
                      
                      <input class="form-control custom-file-input" id="icavatar" type="file" name="avatar"/>
                    </div>
                  </div>
                  
                  <div class="form-group ">
                    <label for="csenha" class="control-label col-lg-2">Nivel</label>
                    <div class="col-lg-10">
                        <div class="col-md-2">
                          <h5>Administrador</h5>  
                        </div>
                        <div class="col-md-10">
                          <input type="checkbox" style="width: 20px" class="checkbox form-control" id="inadmin" name="inadmin" />
                           
                        </div>
                        
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <input class="btn btn-theme" type="submit" value="Salvar"></input>
                      <a class="btn btn-theme04" type="button" href="/admin/users/">Cancelar</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
        
      </section>
      <!-- /wrapper -->
    </section>