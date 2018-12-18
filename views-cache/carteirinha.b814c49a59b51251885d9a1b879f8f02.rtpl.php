<?php if(!class_exists('Rain\Tpl')){exit;}?>

     <section id="main-content">
      <section class="wrappersite-min-height">
        
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Carteirinha</h4>
              <div class="row">
                
                <div class="col-md-6">
                  <?php if( $error != '' ){ ?>
                  <br>

                  <div class="alert alert-danger"><b>Algo deu errado!</b> <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>.</div>
                  <?php } ?>
                  <?php if( $succes != '' ){ ?>
                  <br>

                  <div class="alert alert-success"><b><?php echo htmlspecialchars( $succes, ENT_COMPAT, 'UTF-8', FALSE ); ?></b></div>
                  <?php } ?>
                </div>

              </div>
              
              <div class="row">
                  <div class="col-md-1">
                    
                  </div>
                  <div class="col-md-5">
                    <h3>FRENTE</h3>
                    <img src="/res/Admin/img/alunos-carteirinha/<?php echo htmlspecialchars( $id, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $matricula, ENT_COMPAT, 'UTF-8', FALSE ); ?>-frente.png" width="400" height="250">
                  </div>
                  <div class="col-md-5">
                    <h3>VERSO</h3>
                    <img src="/res/Admin/img/alunos-carteirinha/<?php echo htmlspecialchars( $id, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $matricula, ENT_COMPAT, 'UTF-8', FALSE ); ?>-verso.png" width="400" height="250">
                  </div>
                  <div class="col-md-1">
                    
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-1">
                    
                  </div>
                  <div class="col-md-5">
                    <a href="/res/Admin/img/alunos-carteirinha/<?php echo htmlspecialchars( $id, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $matricula, ENT_COMPAT, 'UTF-8', FALSE ); ?>-frente.png" class="btn btn-info" download>DOWNLOAD</a>
                  </div>
                  <div class="col-md-5">
                    <a href="/res/Admin/img/alunos-carteirinha/<?php echo htmlspecialchars( $id, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $matricula, ENT_COMPAT, 'UTF-8', FALSE ); ?>-verso.png" class="btn btn-info" download>DOWNLOAD</a>
                  </div>
                  <div class="col-md-1">
                    
                  </div>
              </div>
              <br>
              
            
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
