
<?php

    if(count($viewVar['listaCarrinho']) <= 0 ){
        ?>
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Categoria</h4></div>
            <div class="panel-body">
              <div class="alert alert-info" role="alert"> Nenhuma item encontrado</div>
            </div>
        </div>    
          
        <?php
    }else {

        ?>

    <div class="row">
        <div class="col-md-12">
            <a href="http://<?php echo APP_HOST; ?>/produto" class="btn btn-success btn-sm">Comprar</a>
        </div>
    </div><br/>  
        
     <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Itens Carrinho</h4></div>
                <div class="panel-body">
                    <table class="table table-ordered table-hover">
                        <thead>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Valor</th>
                        </thead>
                        <tbody>
                        <?php
                            foreach($viewVar['listaCarrinho'] as $carrinho) { ?>  
                                <tr>
                                    <td><?php echo $carrinho['idCarrinho'] ?> </td>
                                    <td><?php echo $carrinho['nome'] ?></td>
                                    <td><?php echo "R$ " .number_format($carrinho['preco'],2, ',','') ?></td>
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