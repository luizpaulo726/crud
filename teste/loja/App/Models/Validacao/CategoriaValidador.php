<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Categoria;

class CategoriaValidador{

    public function validar(Categoria $categoria)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($categoria->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}