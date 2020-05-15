<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ProdutoDAO;
use App\Models\DAO\CategoriaDAO;
use App\Models\Entidades\Produto;
use App\Models\Entidades\Categoria;
use App\Models\Validacao\ProdutoValidador;

class ProdutoController extends Controller
{
    public function index()
    {

        $this->render('produto/index');

    }

    public function IndexJson()
    {
        $palavra_chave = $_POST['input_pesquisar'];

        $produtoDAO = new ProdutoDAO();    

        if(!empty($palavra_chave) ) {

            $dados = $produtoDAO->listarProdutoPalavraChave($palavra_chave);
         
        }
        else {
        
            $dados = $produtoDAO->listarProdutosCategoria();
        }

        echo json_encode($dados);
    }

    public function cadastro()
    {
        $CategoriasDAO = new CategoriaDAO();

        self::setViewParam('checkCategorias',$CategoriasDAO->listar());

        $this->render('/produto/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $dados = (object)$_POST;

        $produtoDAO = new ProdutoDAO();
    
        $retorno = $produtoDAO->InserirProdutoCategoria($dados);

    
        if($retorno) {
            
            echo 'success';
        }else{
            echo 'error';
        }
      
    }
    
    public function getCategorias()
    {
        $categoriaDAO = new CategoriaDAO();
        $categorias = $categoriaDAO->listarCategoriasSelect();

        echo json_encode($categorias);
    }

    public function visualizar($params)
    {
        $id = $params[0];

        $produtoDAO = new ProdutoDAO();

        $categoriaDAO = new CategoriaDAO();

        $produto = $produtoDAO->listarProdutosCategoria($id);
        
        if(!$produto){
            $this->redirect('/produto');
        }

        self::setViewParam('produto',$produto);

        $this->render('/produto/visualizar');

    }

    public function atualizar()
    {

        $Produto = new Produto();
        $Produto->setId($_POST['id']);
        $Produto->setNome($_POST['nome']);
        $Produto->setPreco($_POST['preco']);
        $Produto->setQuantidade($_POST['quantidade']);
        $Produto->setDescricao($_POST['descricao']);

        Sessao::gravaFormulario($_POST);

        $produtoValidador = new ProdutoValidador();
        $resultadoValidacao = $produtoValidador->validar($Produto);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/produto/edicao/'.$_POST['id']);
        }

        $produtoDAO = new ProdutoDAO();

        $produtoDAO->atualizar($Produto);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Produto atualizado com sucesso!");

        $this->redirect('/produto');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $produtoDAO = new ProdutoDAO();

        $produto = $produtoDAO->listar($id);

        if(!$produto){
            Sessao::gravaMensagem("Produto inexistente");
            $this->redirect('/produto');
        }

        self::setViewParam('produto',$produto);

        $this->render('/produto/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $Produto = new Produto();
        $Produto->setId($_POST['id']);

        $produtoDAO = new ProdutoDAO();

        if(!$produtoDAO->excluir($Produto)){
            Sessao::gravaMensagem("Produto inexistente");
            $this->redirect('/produto');
        }

        Sessao::gravaMensagem("Produto excluido com sucesso!");

        $this->redirect('/produto');

    }
}