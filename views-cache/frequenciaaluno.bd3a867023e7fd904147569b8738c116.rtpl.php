<?php if(!class_exists('Rain\Tpl')){exit;}?>

     <section id="main-content">
      <section class="wrapper">
        <br>
       
        <a type="submit" class="btn btn-warning" id="btnEscola" ><i class="fa fa-minus-square"></i> Finalizar Frequencia</a>

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
                      <th ><i class="fa fa-user"> </i> Aluno</th>
                      <th><i class=" fa fa-flag"> </i> CPF</th>
                      <th><i class="fa fa-envelope-o"> </i> Hora Entrada</th>
                      <th><i class=" fa fa-user"> </i> Hora Saida</th>
                      <th><i class=" fa fa-flag"> </i> Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $counter1=-1;  if( isset($frequencia) && ( is_array($frequencia) || $frequencia instanceof Traversable ) && sizeof($frequencia) ) foreach( $frequencia as $key1 => $value1 ){ $counter1++; ?>
                      <tr>
                        <td data-title="#">
                          <?php echo htmlspecialchars( $value1["idfrequenciaaluno"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </td>
                        <td data-title="Aluno" class="hidden-phone"><?php echo htmlspecialchars( $value1["nomepessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="CPF" class="hidden-phone"><?php echo htmlspecialchars( $value1["cpfpessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Hora Entrada"><?php echo htmlspecialchars( $value1["hrentrada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Hora Saida"><?php echo htmlspecialchars( $value1["hrsaida"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Status">
                            <?php if( $value1["hrentrada"] == null ){ ?>
                                Ausente
                            <?php }elseif( $value1["hrentrada"] != null && $value1["hrsaida"] == null ){ ?>
                                Saida não registrada
                            <?php }else{ ?>
                                Presente
                            <?php } ?>

                        </td>
                        <td>
                          <?php if( $value1["hrentrada"] == null ){ ?>
                              <a class="btn btn-primary btn-xs" href="/portal/frequencia/<?php echo htmlspecialchars( $value1["idfrequencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalhes/justificar/"><i class="fa fa-pencil"></i> Justificar Ausencia</a>
                          <?php }elseif( $value1["hrentrada"] != null && $value1["hrsaida"] == null ){ ?>
                              <a class="btn btn-primary btn-xs" href="/portal/frequencia/<?php echo htmlspecialchars( $value1["idfrequencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalhes/justificar/"><i class="fa fa-pencil"></i> Justificar Ausencia</a>
                          <?php }else{ ?>
                              <a class="btn btn-primary btn-xs disabled" ><i class="fa fa-pencil"></i> Justificar Ausencia</a>
                          <?php } ?>
                          
                          <a class="btn btn-primary btn-xs" href="/portal/frequencia/<?php echo htmlspecialchars( $value1["idfrequencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalhes/<?php echo htmlspecialchars( $value1["idfrequenciaaluno"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-pencil"></i> Editar</a>
                          <a class="btn btn-danger btn-xs" onclick="return confirm('Deseja excluir a frequencia?')" href="/portal/frequencia/<?php echo htmlspecialchars( $value1["idfrequencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalhes/<?php echo htmlspecialchars( $value1["idfrequenciaaluno"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete"><i class="fa fa-trash-o "></i> Deletar</a>
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
