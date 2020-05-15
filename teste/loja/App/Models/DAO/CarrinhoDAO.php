<?php

namespace App\Models\DAO;

class CarrinhoDAO extends BaseDAO
{
    public  function adicionarCarrinho($id = null)
    {
        try {
            
            return $this->insert(
                'carrinho',
                ":id_produto",
                [
                    ':id_produto'=>$id
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }

    }


    public function listar() {

        $resultado = $this->select(
            "SELECT *,
             carrinho.id as idCarrinho   
             FROM carrinho
             INNER JOIN produto ON produto.id = carrinho.id_produto"
             );
        
        $dados = $resultado->fetchAll();
        if(count($dados) > 0) {
            return $dados;
        }else 
        {
            return false;
        }
        
    }

}