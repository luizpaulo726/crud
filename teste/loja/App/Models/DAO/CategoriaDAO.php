<?php

namespace App\Models\DAO;

use App\Models\Entidades\Categoria;

class CategoriaDAO extends BaseDAO
{
    public  function listar($id = null)
    {
        if($id) {
            $resultado = $this->select(
                "SELECT * FROM categoria WHERE id = $id"
            );

            return $resultado->fetchObject(Categoria::class);
        }else{
            $resultado = $this->select(
                'SELECT * FROM categoria'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Categoria::class);
        }

        return false;
    }

    public  function listarCategoriasSelect($id = null)
    {
        if($id) {
            $resultado = $this->select(
                "SELECT * FROM categoria WHERE id = $id"
            );

            return $resultado->fetchObject(Categoria::class);
        }else{
            $resultado = $this->select(
                'SELECT categoria.id,categoria.nome FROM categoria'
            );
            return $resultado->fetchAll();
        }

        return false;
    }

    public  function salvar(Categoria $Categoria) 
    {
        try {

            $nome           = $Categoria->getNome();
            
            return $this->insert(
                'categoria',
                ":nome",
                [
                    ':nome'=>$nome
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public  function atualizar(Categoria $Categoria) 
    {
        try {

            $id             = $Categoria->getId();
            $nome           = $Categoria->getNome();

            return $this->update(
                'categoria',
                "nome = :nome",
                [
                    ':id'=>$id,
                    ':nome'=>$nome,
                ],
                "id = :id"
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Categoria $Categoria)
    {
        try {
            $id = $Categoria->getId();

            return $this->delete('categoria',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao deletar", 500);
        }
    }
}