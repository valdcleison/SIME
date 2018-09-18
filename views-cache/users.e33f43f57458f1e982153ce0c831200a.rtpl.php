<?php if(!class_exists('Rain\Tpl')){exit;}?>
    <section id="main-content">
      <section class="wrapper site-min-height">
       
        <div class="row mt">

          <div class="col-lg-12">
            <div class="row mt">
          <div class="col-md-12">
            <h4><b><i class="fa fa-angle-right blue"></i> Lista de Usuarios</b></h4>
            <div class="content-panel">

              <table class="table table-striped table-advance table-hover">
                <h4> <a href="" class="btn btn-success">Cadastrar</a></h4>
                <hr>
                <thead>
                  <tr>
                    <th><i class="fa fa-home"></i> Nome </th>
                    <th class="hidden-phone"><i class="fa fa-map-marker"></i>Usuario</th>
                    <th><i class="fa fa-envelope-o"></i> Email</th>
                    <th><i class=" fa fa-file-text-o"></i> Data de contrato</th>
                    <th><i class=" fa fa-edit"></i> Nivel</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td>
                      <?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </td>
                    <td class="hidden-phone"><?php echo htmlspecialchars( $value1["nomepessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["cpfpessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><span><?php echo htmlspecialchars( $value1["usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></td>
                    <td><span class="label label-primary label-mini"><?php if( $value1["niveladmin"] == 0 ){ ?>Aluno/Responsavel<?php }elseif( $value1["niveladmin"] == 1 ){ ?>Funcionario Escola<?php }else{ ?>Administrador do Sistema<?php } ?></span></td>
                    <td>
                      <a class="btn btn-primary btn-xs" href="/admin/users/<?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-danger btn-xs" href="/admin/users/<?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete"><i class="fa fa-trash-o "></i></a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-md-12 -->
        </div>
          </div>
        </div>
      </section>

    </section>
