<?php if(!class_exists('Rain\Tpl')){exit;}?>  <section id="main-content">
      <section class="wrapper site-min-height">

        <div class="row mt">
          <div class="col-lg-12">
            <br><h3><i class="fa fa-angle-right"></i> Editar dados do Usuario</h3></b>
            <div class="form-panel">
               <?php if( $error != '' ){ ?>

                  <br>
                  <div class="alert alert-danger"><b>Algo deu errado!</b> <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>.</div>
                <?php } ?>

              <div class=" form">
                <form class="cmxform form-horizontal style-form" id="commentForm" method="post" action="/admin/users/<?php echo htmlspecialchars( $user["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Nome</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="cname" name="nomepessoa" minlength="2" type="text" value="<?php echo htmlspecialchars( $user["nomepessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-2">E-Mail</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="cemail" type="email" name="emailpessoa" value="<?php echo htmlspecialchars( $user["emailpessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required disabled />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-2">CPF</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="ccpf" type="cpf" name="cpfpessoa" value="<?php echo htmlspecialchars( $user["cpfpessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required disabled/>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-2">Usuário</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="cuser" type="text" name="usuario" value="<?php echo htmlspecialchars( $user["usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required disabled/>
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