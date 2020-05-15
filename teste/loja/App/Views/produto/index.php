    <div class="row">
         <div class="col-md-6">
            <form class="form-inline" id="form_pesquisa" method="post">
                <h5>Pesquisar Produto</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="input_pesquisar" placeholder="Pesquisar por nome" widht="100%">
                </div>
                <button type="button" onclick= 'getProdutos()' class="btn btn-default">Pesquisar</button>
             </form>
        </div>
        <div class="col-md-6">
            <a class="btn btn-success btn-sm pull pull-right" href="http://<?php echo APP_HOST; ?>/produto/cadastro"> Novo produto</a>
        </div>

    </div><br/>  

    <div class="row">

        <div class="col-md-12"> 
            <!-- MENSAGEM DE RETORNO AO INSERIR UM PRODUTO (SUCESSO)-->
            <div class="alert alert-warning" role="alert" id="warning_produto" style="display:none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Nenhum produto encontrado!   
            </div>
        </div>

        <div class="col-md-12"> 
            <div class="alert alert-success" role="alert" id="carrinho_success" style="display:none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Produto adicionado no carrinho com sucesso!   
            </div>
        </div>
        <div class="col-md-12"> 
            <div class="alert alert-danger" role="alert" id="carrinho_error" style="display:none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Erro ao adicionar o produto no carrinho com sucesso!   
            </div>
        </div>

    </div>
        
     <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="painel_produtos">
                <div class="panel-heading"><h4>Produtos</h4></div>
                <div class="panel-body">
                    <table class="table table-ordered table-hover">
                        <thead>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Ações</th> 
                        </thead>
                        <tbody id="corpo_produtos">
                        </tbody>
                    </table>
                </div>
             </div>
        </div>   
     </div>   
