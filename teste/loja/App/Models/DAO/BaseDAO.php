<?php

namespace App\Models\DAO;

use App\Lib\Conexao;

abstract class BaseDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getConnection();
    }

    public function select($sql) 
    {
        if(!empty($sql))
        {
            return $this->conexao->query($sql);
        }
    }

    public function insert($table, $cols, $values) 
    {
        if(!empty($table) && !empty($cols) && !empty($values))
        {
            $parametros    = $cols;
            $colunas       = str_replace(":", "", $cols);
            
            $stmt = $this->conexao->prepare("INSERT INTO $table ($colunas) VALUES ($parametros)");
            $stmt->execute($values);

            return $stmt->rowCount();
        }else{
            return false;
        }
    }

    public function update($table, $cols, $values, $where=null) 
    {
        if(!empty($table) && !empty($cols) && !empty($values))
        {
            if($where)
            {
                $where = " WHERE $where ";
            }

            $stmt = $this->conexao->prepare("UPDATE $table SET $cols $where");
            $stmt->execute($values);

            return $stmt->rowCount();
        }else{
            return false;
        }
    }
    
    public function delete($table, $where=null) 
    {
        if(!empty($table))
        {
            /*
                DELETE usuario WHERE id = 1
            */

            if($where)
            {
                $where = " WHERE $where ";
            }

            $stmt = $this->conexao->prepare("DELETE FROM $table $where");
            $stmt->execute();

            return $stmt->rowCount();
        }else{
            return false;
        }
    }


    public function insertProdutoCategoria($dados) {

        if(!empty($dados)) {
            $nome       = $dados->nome;
            $categorias = $dados->categorias;
            $descricao  = $dados->descricao_produto;
            $preco      = $dados->preco;
    
    
            $stmt = $this->conexao->prepare("INSERT INTO produto (nome,preco,descricao) VALUES (:nome,:preco,:descricao)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':descricao', $descricao);
            
            $stmt->execute();

           // $ultimo_id = $this->conexao->lastInsertId();
            return $stmt->rowCount();

        }else {
            return false;
        }

    }
    
    public function InserirProdutoCategoria($params) {
       
    }

    //Funcao para inserir o produto com a categoria
    public function insertProdCat($params) {

        //Valida o Arquivo
        if (isset($_FILES['img_produto']['name'])){

            $extensao = strtolower(substr($_FILES['img_produto']['name'], -4)); //pega a extensao do 

            $novo_nome = md5(time()) . $extensao; //define o nome do arquivo
            
            $diretorio =  $_SERVER['DOCUMENT_ROOT'] . "/teste/loja/upload/"; //define o diretorio para onde enviaremos o arquivo


            move_uploaded_file($_FILES['img_produto']['tmp_name'], $diretorio.$novo_nome); //efetua o upload

            if(!empty($params)) {
                $nome       = $params->nome;
                $categorias = $params->categorias;
                $descricao  = $params->descricao_produto;
                $preco      = $params->preco;

                /* Begin a transaction, turning off autocommit */
                $this->conexao->beginTransaction();

                $stmt = $this->conexao->prepare("INSERT INTO produto (nome,preco,descricao, imagem) VALUES (:nome,:preco,:descricao, :imagem)");

                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':preco', $preco);
                $stmt->bindParam(':descricao', $descricao);
                $stmt->bindParam(':imagem', $novo_nome);
                
                if($stmt->execute()) {

                    $ultimo_id = $this->conexao->lastInsertid();

                    $stmt2 = $this->conexao->prepare("INSERT INTO produto_categoria (id_produto_chave,id_categoria_chave) VALUES (:id_produto_chave,:id_categoria_chave)");

                    foreach($categorias as $categoria) {
                        $stmt2->bindParam(':id_categoria_chave', $categoria);
                        $stmt2->bindParam(':id_produto_chave', $ultimo_id);
                        $stmt2->execute();
                    }             

                    /* Commit the changes */
                $this->conexao->commit();
                return true;

                }else {
                    /* Recognize mistake and roll back changes */
                    $this->conexao->rollBack();
                    return false;
                }

            }else {
                return false;
            }


        }else {

            if(!empty($params)) {
                $nome       = $params->nome;
                $categorias = $params->categorias;
                $descricao  = $params->descricao_produto;
                $preco      = $params->preco;

                /* Begin a transaction, turning off autocommit */
                $this->conexao->beginTransaction();

                $stmt = $this->conexao->prepare("INSERT INTO produto (nome,preco,descricao) VALUES (:nome,:preco,:descricao)");

                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':preco', $preco);
                $stmt->bindParam(':descricao', $descricao);
                
                if($stmt->execute()) {

                    $ultimo_id = $this->conexao->lastInsertid();

                    $stmt2 = $this->conexao->prepare("INSERT INTO produto_categoria (id_produto_chave,id_categoria_chave) VALUES (:id_produto_chave,:id_categoria_chave)");

                    foreach($categorias as $categoria) {
                        $stmt2->bindParam(':id_categoria_chave', $categoria);
                        $stmt2->bindParam(':id_produto_chave', $ultimo_id);
                        $stmt2->execute();
                    }             

                    /* Commit the changes */
                $this->conexao->commit();
                return true;

                }else {
                    /* Recognize mistake and roll back changes */
                    $this->conexao->rollBack();
                    return false;
                }

            }else {
                return false;
            }

        }

    }
}
