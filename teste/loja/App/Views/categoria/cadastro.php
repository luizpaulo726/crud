
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Cadastro de Categoria</h4><hr/>
                <form action="http://<?php echo APP_HOST; ?>/categoria/salvar" method="post">
                    <div class="form-group">
                        <label for="nomeCategoria">Nome da Categoria</label>
                        <input type="text" class="form-control" name="nome">
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                    <a href="http://<?php echo APP_HOST; ?>/categoria" class="btn btn-info btn-sm">Voltar</a>
                </form>
            </div>       
        </div>
    </div>   
    <div class="col-md-3"></div>
</div>


