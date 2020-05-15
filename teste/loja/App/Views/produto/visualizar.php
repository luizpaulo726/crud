<div class="row">
 <div class="col-md-3"></div>
 <div class="col-md-6">
     <div class="panel panel-default">
         <div class="panel-body">
             <h4 class='text-center'>Detalhes do Produto <strong><?php echo $viewVar['produto'][0]->nome ?></strong></h4><hr/>
             
             <div class="row">
                <div class="col-md-12 text-center">
                    <a  target="_blank" href="http://<?php echo APP_HOST ?> /upload/<?php echo $viewVar['produto'][0]->imagem ?> " >
                        <img src="http://<?php echo APP_HOST ?> /upload/<?php echo $viewVar['produto'][0]->imagem ?>" alt="Lights" style="width:25%;margin-bottom:10px">
                    </a>
                </div>
                        
             
             <h4 class='text-center'>Descrição: <strong><?php echo $viewVar['produto'][0]->descricao ?></strong></h4>
              <h4 class="text-center">Preço: <strong><?php echo $viewVar['produto'][0]->preco ?> </strong> </h4>
              <h4 class='text-center'>Categorias:<br><br>
           
                <?php 
                    for($i=0;$i<count($viewVar['produto'][0]->categorias);$i++ ) {
                   
                        echo "<strong>" .$viewVar['produto'][0]->categorias[$i]['nome'].'</strong><br><br>';
                    }
                ?>
              </h4>  
         </div>       
     </div>
     <div class="panel-footer"> <a href="http://<?php echo APP_HOST; ?>/produto" class="btn btn-info btn-sm">Voltar</a></div>
 </div>   
 <div class="col-md-3"></div>
</div>


