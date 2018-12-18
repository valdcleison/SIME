<?php if(!class_exists('Rain\Tpl')){exit;}?>


     <section id="main-content">
      <section class="wrapper site-min-height">
        <br>
        

        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <div class="col-md-10">
                <h4><i class="fa fa-angle-right"></i> Relatorio Completo</h4>
              </div>
              <div class="col-md-2">
               
              </div>
              
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
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <div id="piechart_3d" style="height: 300px;"></div>
                </div>
                <div class="col-md-2"></div>
              </div>
              <hr>
              <div class="row" id="search-div">
                
                <div class="col-md-3">
                  <form class="form-horizontal">
                    <div class="form-group">
                     
                      <div class="col-sm-1">
                        <label class="control-label"><b>DATA: </b></label>
                      </div>
                      <div class="col-sm-10">
                       
                        <input type="text" id="search" class="form-control round-form obrigate has-error" placeholder="00-00-0000">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
                
          
              <section id="no-more-tables">
                
                <table class="table table-bordered table-striped cf">
                  <thead class="cf">
                    <tr>
                      <th ><i class="fa fa-user"> </i> Aluno</th>
                      <th><i class=" fa fa-credit-card"> </i> CPF</th>
                      <th><i class="fa fa-calendar"> </i> Data</th>
                      <th><i class="fa fa-clock-o"> </i> Hora Entrada</th>
                      <th><i class=" fa fa-flag"> </i> Status</th>
                    </tr>
                  </thead>
                  <tbody id="teste">
                    <?php $counter1=-1;  if( isset($frequencia) && ( is_array($frequencia) || $frequencia instanceof Traversable ) && sizeof($frequencia) ) foreach( $frequencia as $key1 => $value1 ){ $counter1++; ?>

                      <tr >
                        
                        <td data-title="Aluno"  id="okk"><?php echo htmlspecialchars( $value1["nomepessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <?php $cpf = $value1["cpfpessoa"]; ?>

                        <?php if( $cpf == null ){ ?>

                          <td data-title="CPF" >Aluno sem CPF</td>
                        <?php }else{ ?>

                          <td data-title="CPF" ><?php echo mascara($cpf, '###.###.###-##'); ?></td>
                        <?php } ?>

                          <td data-title="Data"><?php echo formatarData($value1["data"]); ?></td>
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
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'Número de alunos'],
          ['Faltas: <?php echo htmlspecialchars( $ausente, ENT_COMPAT, 'UTF-8', FALSE ); ?>',  <?php echo htmlspecialchars( $ausente, ENT_COMPAT, 'UTF-8', FALSE ); ?>],
          ['Faltas Justificadas: <?php echo htmlspecialchars( $justificada, ENT_COMPAT, 'UTF-8', FALSE ); ?>', <?php echo htmlspecialchars( $justificada, ENT_COMPAT, 'UTF-8', FALSE ); ?>],
          ['Presenças: <?php echo htmlspecialchars( $presente, ENT_COMPAT, 'UTF-8', FALSE ); ?>', <?php echo htmlspecialchars( $presente, ENT_COMPAT, 'UTF-8', FALSE ); ?>]
        ]);

        var options = {
          title: 'Relatorio Completo',
          is3D: true,
          slices: {
            0: { color: '#e74c3c' },
            1: { color: '#f1c40f' },
            2: { color: '#2ecc71' }
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>