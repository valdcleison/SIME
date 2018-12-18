<?php if(!class_exists('Rain\Tpl')){exit;}?>

     <section id="main-content">
      <section class="wrapper site-min-height">
        <br>
        <a href="/portal/frequencia/new/" class="btn btn-success" id="btnEscola" ><i class="fa fa-plus-circle"></i> Nova Frequencia</a>

        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Lista de Frequência</h4>
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
                      <th ><i class="fa fa-home"> </i> Escola</th>
                      <th ><i class="fa fa-calendar"> </i> Data</th>
                      <th><i class="fa fa-clock-o"> </i> Hora Inicio</th>
                      <th><i class="fa fa-clock-o"> </i> Hora Final</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $counter1=-1;  if( isset($frequencia) && ( is_array($frequencia) || $frequencia instanceof Traversable ) && sizeof($frequencia) ) foreach( $frequencia as $key1 => $value1 ){ $counter1++; ?>

                      <tr>
                        
                        <td data-title="Escola"><?php echo htmlspecialchars( $value1["nomeescola"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Data" ><?php echo formatarData($value1["dtfrequencia"]); ?></td>
                        <?php if( $value1["hrinicio"] == null ){ ?>

                          <td data-title="Hora Inicio">Frequência não realizada</td>
                        <?php }else{ ?>

                          <td data-title="Hora Inicio"><?php echo formatarHora($value1["hrinicio"]); ?></td>
                        <?php } ?>

                        <?php if( $value1["hrtermino"] == null ){ ?>

                          <td data-title="Hora Final">Frequência não realizada</td>
                        <?php }else{ ?>

                          <td data-title="Hora Final"><?php echo formatarHora($value1["hrtermino"]); ?></td>
                        <?php } ?>

                        
                        <td>
                          <a class="btn btn-primary btn-xs" href="/portal/frequencia/<?php echo htmlspecialchars( $value1["idfrequencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalhes"><i class="fa fa-pencil"></i> Detalhes</a>
                        
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
