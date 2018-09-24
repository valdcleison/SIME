<?php if(!class_exists('Rain\Tpl')){exit;}?>
   <!-- <section id="main-content">
      <section class="wrapper">
      
       <div class="row mt">
          <div class="col-lg-12">
            <h4><b><i class="fa fa-angle-right blue"></i> Lista de Usuarios</b></h4>
            <div class="content-panel">

              <table class="table table-striped table-advance table-hover">
                <h4> <a href="/admin/users/create" class="btn btn-success">Cadastrar</a></h4>
                <!--<h3><b>Buscar Usuario: </b></h3><input type="text" name="" class="form form-control">
                <hr>
                <thead>
                  <tr>
                    <th><i class="fa fa-number"></i> # </th>
                    <th ><i class="fa fa-user"></i> Nome</th>
                    <th><i class="fa fa-envelope-o"></i> Email</th>
                    <th><i class=" fa fa-user"></i> Nome de Usuario</th>
                    <th><i class=" fa fa-flag"></i> Nivel</th>
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
                    <td><?php echo htmlspecialchars( $value1["emailpessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><span class="label label-primary label-mini"><?php if( $value1["niveladmin"] == 0 ){ ?>Aluno/Responsavel<?php }elseif( $value1["niveladmin"] == 1 ){ ?>Funcionario Escola<?php }else{ ?>Administrador do Sistema<?php } ?></span></td>
                    <td>
                      <a class="btn btn-info btn-xs" href="/admin/users/<?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-lock"></i> Alterar Senha</a>
                      <a class="btn btn-primary btn-xs" href="/admin/users/<?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-pencil"></i> Editar</a>
                      <a class="btn btn-danger btn-xs" onclick="return confirm('Deseja excluir o usuario: <?php echo htmlspecialchars( $value1["usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?')" href="/admin/users/<?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete"><i class="fa fa-trash-o "></i> Deletar</a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /content-panel 
          </div>
          <!-- /col-md-12 
        </div>
         
      </section>

    </section>-->

     <section id="main-content">
      <section class="wrapper">
        
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Lista de Usuarios</h4>
              <section id="no-more-tables">
                <table class="table table-bordered table-striped cf">
                  <thead class="cf">
                    <tr>
                      <th>#</th>
                      <th ><i class="fa fa-user"> </i> Nome</th>
                      <th><i class="fa fa-envelope-o"> </i> Email</th>
                      <th><i class=" fa fa-user"> </i> Nome de Usuario</th>
                      <th><i class=" fa fa-flag"> </i> Nivel</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
                      <tr>
                        <td data-title="#">
                          <?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </td>
                        <td data-title="Nome" class="hidden-phone"><?php echo htmlspecialchars( $value1["nomepessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Email"><?php echo htmlspecialchars( $value1["emailpessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Nome de Usuario"><?php echo htmlspecialchars( $value1["usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td data-title="Nivel"><span class="label label-primary label-mini"><?php if( $value1["niveladmin"] == 0 ){ ?>Aluno/Responsavel<?php }elseif( $value1["niveladmin"] == 1 ){ ?>Funcionario Escola<?php }else{ ?>Administrador do Sistema<?php } ?></span></td>
                        <td>
                          <a class="btn btn-info btn-xs" href="/admin/users/<?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-lock"></i> Alterar Senha</a>
                          <a class="btn btn-primary btn-xs" href="/admin/users/<?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-pencil"></i> Editar</a>
                          <a class="btn btn-danger btn-xs" onclick="return confirm('Deseja excluir o usuario: <?php echo htmlspecialchars( $value1["usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?')" href="/admin/users/<?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete"><i class="fa fa-trash-o "></i> Deletar</a>
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
