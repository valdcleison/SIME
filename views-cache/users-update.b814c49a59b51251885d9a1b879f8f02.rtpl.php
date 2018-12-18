<?php if(!class_exists('Rain\Tpl')){exit;}?>  <section id="main-content">
      <section class="wrapper site-min-height">

        <div class="row mt">
          <div class="col-lg-12">
            <br><h3><i class="fa fa-angle-right"></i> Edição de Usuário</h3></b>

          
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
                <form class="cmxform form-horizontal style-form" id="commentForm" method="post" action="/portal/users/<?php echo htmlspecialchars( $user["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/" enctype="multipart/form-data">
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Nome</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="cname" name="nomepessoa" minlength="2" type="text" value="<?php echo htmlspecialchars( $user["nomepessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required />
                    </div>
                  </div>
                  
                 
                  <div class="form-group">
                    <label for="csenha" class="control-label col-lg-2">Avatar</label>
                    <div class="col-lg-10">
                      <?php if( $user["avatar"] == null ){ ?>

                        <input class="form-control custom-file-input" id="icavatar" type="file" value="" name="avatar"/>
                      <?php }else{ ?>

                        <input class="form-control custom-file-input" id="icavatar" type="file" value="/res/Admin/img/user-avatar/<?php echo htmlspecialchars( $user["avatar"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.jpg" name="avatar"/>
                        <br>
                        <img src="/res/Admin/img/user-avatar/<?php echo htmlspecialchars( $user["usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.jpg" id="img-avatar" accept=".jpg, .jpeg, .png .gif" class="img-circle"  width="160" height="160">  
                      <?php } ?>


                    </div>
                  </div>
                  
                  <div class="form-group ">
                    <label for="csenha" class="control-label col-lg-2">Nivel</label>
                    <div class="col-lg-10">
                        <div class="col-md-2">
                          <h5>Administrador</h5>  
                        </div>
                        <div class="col-md-10">
                          
                          <input type="checkbox" style="width: 20px" class="checkbox form-control" id="inadmin" name="inadmin" <?php if( $user["inadmin"] == 1 ){ ?>checked<?php } ?>/>
                          
                           
                        </div>
                       
                        
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <input class="btn btn-theme" type="submit" value="Salvar"></input>
                      <a class="btn btn-theme04" type="button" href="/portal/users/">Cancelar</a>
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