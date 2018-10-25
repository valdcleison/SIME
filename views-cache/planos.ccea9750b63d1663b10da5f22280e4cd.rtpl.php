<?php if(!class_exists('Rain\Tpl')){exit;}?>


     <section id="main-content">
      <section class="wrapper">
        
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Lista de Planos</h4>
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
                      <th ><i class="fa fa-books"> </i> Planos</th>
                      <th><b>$</b> Preço</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $counter1=-1;  if( isset($planos) && ( is_array($planos) || $planos instanceof Traversable ) && sizeof($planos) ) foreach( $planos as $key1 => $value1 ){ $counter1++; ?>

                      <tr>
                        <td data-title="#">
                          <?php echo htmlspecialchars( $value1["idplano"], ENT_COMPAT, 'UTF-8', FALSE ); ?>

                        </td>
                        <td data-title="Planos" class="hidden-phone"><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Preço">R$ <?php echo htmlspecialchars( $value1["preco"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td>
                          <a class="btn btn-primary btn-xs" href="/admin/planos/<?php echo htmlspecialchars( $value1["idplano"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-pencil"></i> Editar</a>
                          <a class="btn btn-danger btn-xs" onclick="return confirm('Deseja excluir o plano: <?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?')" href="/admin/planos/<?php echo htmlspecialchars( $value1["idplano"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete"><i class="fa fa-trash-o "></i> Deletar</a>
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
