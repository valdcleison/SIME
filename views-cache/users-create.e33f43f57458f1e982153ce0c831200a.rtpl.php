<?php if(!class_exists('Rain\Tpl')){exit;}?>  <section id="main-content">
      <section class="wrapper">

        <div class="row mt">
          <div class="col-lg-12">
            <br><h3><i class="fa fa-angle-right"></i> Cadastro de Usuario</h3></b>
            <div class="form-panel">
              <div class=" form">
                <form class="cmxform form-horizontal style-form" id="commentForm" method="get" action="">
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Nome</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="cname" name="name" minlength="2" type="text" required />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-2">E-Mail</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="cemail" type="email" name="email" required />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-2">CPF</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="ccpf" type="cpf" name="cpf" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-2">Usuario</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="cuser" type="text" name="user" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-2">Senha</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="cpass" type="password" name="pass" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-2">Repita a Senha</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="crepass" type="passwod" name="repass" />
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-theme" type="submit">Cadastrar</button>
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