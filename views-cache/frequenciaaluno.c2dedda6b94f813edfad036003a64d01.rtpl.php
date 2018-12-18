<?php if(!class_exists('Rain\Tpl')){exit;}?>


     <section id="main-content">
      <section class="wrapper site-min-height">
        <br>
       
        
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
                      <th ><i class="fa fa-user"> </i> Aluno</th>
                      <th><i class=" fa fa-card"> </i> CPF</th>
                      <th><i class="fa fa-clock-o"> </i> Hora Entrada</th>
                      <th><i class=" fa fa-flag"> </i> Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $counter1=-1;  if( isset($frequencia) && ( is_array($frequencia) || $frequencia instanceof Traversable ) && sizeof($frequencia) ) foreach( $frequencia as $key1 => $value1 ){ $counter1++; ?>

                      <tr>
                        
                        <td data-title="Aluno"  ><?php echo htmlspecialchars( $value1["nomepessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <?php $cpf = $value1["cpfpessoa"]; ?>

                        <?php if( $cpf == null ){ ?>

                          <td data-title="CPF" >Aluno sem CPF</td>
                        <?php }else{ ?>

                          <td data-title="CPF" ><?php echo mascara($cpf, '###.###.###-##'); ?></td>
                        <?php } ?>

                        <?php if( $value1["hrentrada"] == null ){ ?>

                          <td data-title="Hora Entrada">Sem entrada registrada</td>
                        <?php }else{ ?>

                          <td data-title="Hora Entrada"><?php echo formatarHora($value1["hrentrada"]); ?></td>
                        <?php } ?>

                        <td data-title="Status">
                            <?php if( $value1["hrentrada"] == null ){ ?>

                                <?php if( $value1["frequenciaocorrencia_idfrequenciaocorrencia"] == null ){ ?>

                                  Falta não justificada
                                <?php }else{ ?>

                                  Falta justificada
                                <?php } ?>

                            <?php }else{ ?>

                                Presente
                            <?php } ?>


                        </td>
                        <td>
                          <?php if( $value1["hrentrada"] == null ){ ?>

                            <?php if( $value1["frequenciaocorrencia_idfrequenciaocorrencia"] == null ){ ?>

                              <a class="btn btn-primary btn-xs" href="/portal/frequencia/<?php echo htmlspecialchars( $idfrequencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalhes/<?php echo htmlspecialchars( $value1["idfrequenciaaluno"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/"><i class="fa fa-pencil"></i> Justificar Ausência</a>
                            <?php }else{ ?>

                              <a class="btn btn-primary btn-xs disabled"><i class="fa fa-pencil"></i> Justificar Ausência</a>
                            <?php } ?>


                          <?php } ?>

                          
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
