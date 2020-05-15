<?php if($Sessao::retornaMensagem()){ ?>
    <div class="alert alert-success" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $Sessao::retornaMensagem(); ?>
    </div>
<?php } ?>

<?php

    if(count($viewVar['listaCategorias']) <= 0 ){
        ?>
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Categoria</h4></div>
            <div class="panel-body">
              <div class="alert alert-info" role="alert"> Nenhuma categoria encontrado</div>
            </div>
        </div>    
          
        <?php
    }else { ?>

    <div class="row">
        <div class="col-md-12">
            <a href="http://<?php echo APP_HOST; ?>/categoria/cadastro" class="btn btn-success btn-sm">Nova categoria</a>
        </div>
    </div><br/>  
        
     <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Categorias</h4></div>
                <div class="panel-body">
                    <table class="table table-ordered table-hover">
                        <thead>
                            <th>Código</th>
                            <th>Nome</th>
                        </thead>
                        <tbody>
                        <?php
                            foreach($viewVar['listaCategorias'] as $categoria) { ?>  
                                <tr>
                                    <td><?php echo $categoria->getId() ?> </td>
                                    <td><?php echo $categoria->getNome() ?></td>
                                </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
             </div>
        </div>   
     </div>   
  
   <?php 
    }
    ?> 