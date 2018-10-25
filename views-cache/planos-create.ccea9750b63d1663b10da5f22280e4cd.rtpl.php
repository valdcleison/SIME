<?php if(!class_exists('Rain\Tpl')){exit;}?>  <section id="main-content">
      <section class="wrapper">

        <div class="row mt">
          <div class="col-lg-12">
            <br><h3><i class="fa fa-angle-right"></i> Editar dados do Usuario</h3></b>
            <div class="form-panel">

               <?php if( $error != '' ){ ?>

                  <br>
                  <div class="alert alert-danger"><b>Algo deu errado!</b> <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>.</div>
                <?php } ?>

              <div class=" form">
                <form class="cmxform form-horizontal style-form" id="commentForm" method="post" action="/admin/planos/create/">
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Descrição</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="cname" name="descricao" minlength="2" type="text"  required />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Preço</label>
                    <div class="col-lg-10">
                      <div class="input-group bootstrap-timepicker">
                      
                      <span class="input-group-btn">
                        <button class="btn btn-theme01" type="button"><b>R$</b></button>

                        </span>
                        <input class=" form-control" id="cname" name="preco" minlength="2" type="text" required />
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