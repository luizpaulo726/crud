<?php

namespace App\Models\DAO;

use App\Models\Entidades\Produto;

class ProdutoDAO extends BaseDAO
{
    public  function listar($id = null)
    {
        if($id) {
            $resultado = $this->select(
                "SELECT * FROM produto WHERE id = $id"
            );

            return $resultado->fetchObject(Produto::class);
        }else{
            $resultado = $this->select(
                'SELECT * FROM produto'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Produto::class);
        }

        return false;
    }

    public function listarProdutosCategoria ($id = null) {
        if($id) {
            $resultado = $this->select(
                "SELECT * FROM produto where id = $id"
            );

            //Armazena os produtos e suas categorias em um array.
            $produtos = [];
            
            while( $dados = $resultado->fetchObject() ) {
   
              
                $resultado2 = $this->select(
                    "SELECT categoria.nome, categoria.id as idCategoria, produto.id FROM produto
                    INNER JOIN produto_categoria
                    ON produto_categoria.id_produto_chave = produto.id
                    INNER JOIN categoria ON categoria.id = produto_categoria.id_categoria_chave
                    where produto.id = $dados->id"
                );

                $produto = $dados;
                $produto->categorias = $resultado2->fetchAll();
      
                array_push($produtos, $produto);       
            }

            return $produtos;



        }else{
            $resultado = $this->select(
                "SELECT * FROM produto"
            );

            //Armazena os produtos e suas categorias em um array.
            $produtos = [];
            
            while( $dados = $resultado->fetchObject() ) {
   
              
                $resultado2 = $this->select(
                    "SELECT categoria.nome, categoria.id, produto.id FROM produto
                    INNER JOIN produto_categoria
                    ON produto_categoria.id_produto_chave = produto.id
                    INNER JOIN categoria ON categoria.id = produto_categoria.id_categoria_chave
                    where produto.id = $dados->id"
                );

                $produto["produto"] = $dados;
               $produto["produto"]->categorias = $resultado2->fetchAll();

                array_push($produtos, $produto);       
            }

            return $produtos;
        }

        return false;
    }

    public function listarProdutoPalavraChave($palavra_chave) {

      
       
        if(isset($palavra_chave) ) {

           $query = "SELECT * FROM produto where produto.nome like '%$palavra_chave%'";

     
            $resultado = $this->select(
                $query
            );

        

            //Armazena os produtos e suas categorias em um array.
            $produtos = [];
            
            while( $dados = $resultado->fetchObject() ) {
   
              
                $resultado2 = $this->select(
                    "SELECT categoria.nome, categoria.id, produto.id FROM produto
                    INNER JOIN produto_categoria
                    ON produto_categoria.id_produto_chave = produto.id
                    INNER JOIN categoria ON categoria.id = produto_categoria.id_categoria_chave
                    where produto.id = $dados->id"
                );

                $produto["produto"] = $dados;
               $produto["categorias"] = $resultado2->fetchAll();
      
                array_push($produtos, $produto);       
            }

            return $produtos;



        }else{
            return false;
        }

    }

    public function salvar(Produto $produto) 
    {
        try {

            $nome           = $produto->getNome();
            $preco          = $produto->getPreco();
            $quantidade     = $produto->getQuantidade();
            $descricao      = $produto->getDescricao();

            return $this->insert(
                'produto',
                ":nome,:preco,:quantidade,:descricao",
                [
                    ':nome'=>$nome,
                    ':preco'=>$preco,
                    ':quantidade'=>$quantidade,
                    ':descricao'=>$descricao
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public  function atualizar(Produto $produto) 
    {
        try {

            $id             = $produto->getId();
            $nome           = $produto->getNome();
            $preco          = $produto->getPreco();
            $quantidade     = $produto->getQuantidade();
            $descricao      = $produto->getDescricao();

            return $this->update(
                'produto',
                "nome = :nome, preco = :preco, quantidade = :quantidade, descricao = :descricao",
                [
                    ':id'=>$id,
                    ':nome'=>$nome,
                    ':preco'=>$preco,
                    ':quantidade'=>$quantidade,
                    ':descricao'=>$descricao,
                ],
                "id = :id"
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Produto $produto)
    {
        try {
            $id = $produto->getId();

            return $this->delete('produto',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao deletar", 500);
        }
    }

    public function InserirProdutoCategoria($dados) {
        try {
            return $this->insertProdCat($dados);

        }catch (Excepetion $e) {
            throw new \Exception("Erro ao cadastrar", 500);
        }

    }
}