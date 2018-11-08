<?php if(!class_exists('Rain\Tpl')){exit;}?>


     <section id="main-content">
      <section class="wrapper site-min-height">
        
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Lista de Usuários</h4>
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
                      <th ><i class="fa fa-user"> </i> Nome da Escola</th>
                      <th><i class="fa fa-envelope-o"> </i> Email</th>
                      <th><i class="fa fa-envelope-o"> </i> CNPJ</th>
                      <th><i class=" fa fa-adress"> </i> Endereço</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $counter1=-1;  if( isset($escola) && ( is_array($escola) || $escola instanceof Traversable ) && sizeof($escola) ) foreach( $escola as $key1 => $value1 ){ $counter1++; ?>

                      <tr>
                        <td data-title="#">
                          <?php echo htmlspecialchars( $value1["idescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>

                        </td>
                        <td data-title="Nome da Escola" class="hidden-phone"><?php echo htmlspecialchars( $value1["nomeescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Email"><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="CNPJ"><?php echo htmlspecialchars( $value1["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Endereço"><?php echo htmlspecialchars( $value1["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $value1["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $value1["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>-<?php echo htmlspecialchars( $value1["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td>
                          
                            <?php if( $value1["statusescola"] == 0 ){ ?>


                              <a class="btn btn-info btn-xs" onclick="return confirm('Deseja desbloquear o acesso a escola: <?php echo htmlspecialchars( $value1["nomeescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?')" href="/admin/escola/<?php echo htmlspecialchars( $value1["idescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/status/<?php echo htmlspecialchars( $value1["statusescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                              <i class="fa fa-lock"></i> Bloqueado</a>

                            <?php }else{ ?>


                            <a class="btn btn-info btn-xs" onclick="return confirm('Deseja desbloquear o acesso a escola: <?php echo htmlspecialchars( $value1["nomeescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?')" href="/admin/escola/<?php echo htmlspecialchars( $value1["idescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/status/<?php echo htmlspecialchars( $value1["statusescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                              <i class="fa fa-unlock"></i> Desbloqueado</a>

                            <?php } ?>

                          <a class="btn btn-primary btn-xs" href="/admin/escola/<?php echo htmlspecialchars( $value1["idescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-pencil"></i> Editar</a>
                          <a class="btn btn-danger btn-xs" onclick="return confirm('Deseja excluir a escola: <?php echo htmlspecialchars( $value1["nomeescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?')" href="/admin/escola/<?php echo htmlspecialchars( $value1["idescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete"><i class="fa fa-trash-o "></i> Deletar</a>
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
