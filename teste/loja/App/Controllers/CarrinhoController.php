<?php

namespace App\Controllers;

use App\Models\DAO\CarrinhoDAO;

class CarrinhoController extends Controller
{
    public function index()
    {

        $carrinhoDAO = new CarrinhoDAO();
        $carrinhoDAO->listar();

        self::setViewParam('listaCarrinho',$carrinhoDAO->listar());

        $this->render('carrinho/index');
    }

    public function carrinho()
    {

        $produto = $_POST['id_produto'];

        $carrinhoDAO = new CarrinhoDAO();

        if($carrinhoDAO->adicionarCarrinho($produto)) {
            echo "success";
        }else {
            echo "error";
        }


    }
}