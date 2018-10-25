<?php if(!class_exists('Rain\Tpl')){exit;}?>


     <section id="main-content">
      <section class="wrapper">
        <br>
        <a href="/portal/frequencia/new/" class="btn btn-success" id="btnEscola" ><i class="fa fa-plus-circle"></i> Nova Frequencia</a>

        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Lista de Frequencia</h4>
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
              <section id="no-more-tables">
                <table class="table table-bordered table-striped cf">
                  <thead class="cf">
                    <tr>
                      <th>#</th>
                      <th ><i class="fa fa-user"> </i> Escola</th>
                      <th><i class="fa fa-envelope-o"> </i> Inicio</th>
                      <th><i class=" fa fa-user"> </i> Final</th>
                      <th><i class=" fa fa-flag"> </i> Alunos Presentes</th>
                      <th><i class=" fa fa-flag"> </i> Alunos Ausentes</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $counter1=-1;  if( isset($frequencia) && ( is_array($frequencia) || $frequencia instanceof Traversable ) && sizeof($frequencia) ) foreach( $frequencia as $key1 => $value1 ){ $counter1++; ?>

                      <tr>
                        <td data-title="#">
                          <?php echo htmlspecialchars( $value1["idfrequencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>

                        </td>
                        <td data-title="Nome" class="hidden-phone"><?php echo htmlspecialchars( $value1["nomeescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Email"><?php echo htmlspecialchars( $value1["hrinicio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Nome de Usuario"><?php echo htmlspecialchars( $value1["hrtermino"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Nivel"><?php echo htmlspecialchars( $value1["qtalunospresentes"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Nivel"><?php echo htmlspecialchars( $value1["qtalunosausentes"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td>
                          <a class="btn btn-primary btn-xs" href="/portal/frequencia/<?php echo htmlspecialchars( $value1["idfrequencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalhes"><i class="fa fa-pencil"></i> Detalhes</a>
                          <a class="btn btn-primary btn-xs" href="/portal/frequencia/<?php echo htmlspecialchars( $value1["idfrequencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-pencil"></i> Editar</a>
                          <a class="btn btn-danger btn-xs" onclick="return confirm('Deseja excluir a frequencia?')" href="/portal/frequencia/<?php echo htmlspecialchars( $value1["idfrequencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete"><i class="fa fa-trash-o "></i> Deletar</a>
                        </td>
                      </tr>
                   <?php } ?>

                  </tbody>
                </table>
              </section>
              
            </div>

            <!-- /content-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
