 <div class="row">

   <div class="col-md-12"> 
        <!-- MENSAGEM DE RETORNO AO INSERIR UM PRODUTO (SUCESSO)-->
        <div class="alert alert-success" role="alert" id="sucesso_produto" style="display:none">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Produto Inserido com sucesso!   
        </div>
    </div>

    <div class='col-md-12'>
        <!-- MENSAGEM DE RETORNO AO INSERIR UM PRODUTO (ERROR) -->
        <div class="alert alert-danger" role="alert" id="erro_produto"  style="display:none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Erro ao inserir um produto!   
        </div>
    </div>


 </div>
 
 <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Cadastro de Produto</h4><hr/>
                <form method="post" id="form_produtos" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="nomeProduto">Nome do Produto</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome" id="nome">
                    </div>

                    <div class="form-group">
                        <label>Categorias</label>
                        <select multiple="multiple" name="categorias[]" id="categoria">
                            <?php foreach($viewVar['checkCategorias'] as $categoria){ ?> 
                                <option value="<?php echo $categoria->getId() ?>"><?php echo $categoria->getNome() ?></option>
                            <?php 
                            } 
                            ?>
                          
                        </select>
                     </div>                     

                    <div class="form-group">
                        <label for="Produto">Descrição do Produto</label>
                        <input type="text" class="form-control" name="descricao_produto" id="descricao_produto" placeholder="Descrição do Produto">
                    </div>

                    <div class="form-group">
                        <label for="Preco">Preco</label>
                        <input type="number" class="form-control" name="preco" step="0.01" id="preco" >
                    </div>

                    <div class="form-group">
                        <label >Imagem do Produto</label>
                        <input type="file" name="img_produto" id="img_produto" accept="image/png, image/jpeg" class="form-control-file">
                    </div>
                        
                    <button class="btn btn-success btn-sm" type="submit">Salvar</button>
                    <a href="http://<?php echo APP_HOST; ?>/produto" class="btn btn-info btn-sm">Voltar</a>
                </form>
            </div>       
        </div>
    </div>   
    <div class="col-md-3"></div>
</div>


