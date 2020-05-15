<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\CategoriaDAO;
use App\Models\Entidades\Categoria;
use App\Models\Validacao\CategoriaValidador;

class CategoriaController extends Controller
{
    public function index()
    {
        $CategoriaDAO = new CategoriaDAO();

        self::setViewParam('listaCategorias',$CategoriaDAO->listar());

        $this->render('/Categoria/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/Categoria/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Categoria = new Categoria();
        $Categoria->setNome($_POST['nome']);

        Sessao::gravaFormulario($_POST);

        $CategoriaValidador = new CategoriaValidador();
        $resultadoValidacao = $CategoriaValidador->validar($Categoria);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/Categoria');
        }

        $CategoriaDAO = new CategoriaDAO();

        $CategoriaDAO->salvar($Categoria);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Categoria salva com sucesso!");

        $this->redirect('/Categoria');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $CategoriaDAO = new CategoriaDAO();

        $Categoria = $CategoriaDAO->listar($id);

        if(!$Categoria){
            Sessao::gravaMensagem("Categoria inexistente");
            $this->redirect('/Categoria');
        }
        
        self::setViewParam('categoria',$Categoria);

        $this->render('/Categoria/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()
    {

        $Categoria = new Categoria();
        $Categoria->setId($_POST['id']);
        $Categoria->setNome($_POST['nome']);
        Sessao::gravaFormulario($_POST);

        $CategoriaValidador = new CategoriaValidador();
        $resultadoValidacao = $CategoriaValidador->validar($Categoria);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/Categoria/edicao/'.$_POST['id']);
        }

        $CategoriaDAO = new CategoriaDAO();

        $CategoriaDAO->atualizar($Categoria);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Categoria atualizado com sucesso!");

        $this->redirect('/Categoria');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $CategoriaDAO = new CategoriaDAO();

        $Categoria = $CategoriaDAO->listar($id);

        if(!$Categoria){
            Sessao::gravaMensagem("Categoria inexistente");
            $this->redirect('/Categoria');
        }

        self::setViewParam('Categoria',$Categoria);

        $this->render('/Categoria/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $Categoria = new Categoria();
        $Categoria->setId($_POST['id']);

        $CategoriaDAO = new CategoriaDAO();

        if(!$CategoriaDAO->excluir($Categoria)){
            Sessao::gravaMensagem("Categoria inexistente");
            $this->redirect('/Categoria');
        }

        Sessao::gravaMensagem("Categoria excluido com sucesso!");

        $this->redirect('/Categoria');

    }
}