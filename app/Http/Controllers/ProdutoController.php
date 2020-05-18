<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProdutoRequest;
use App\Repositories\Interfaces\ITipoProdutoRepository;
use App\Repositories\Interfaces\IProdutoRepository;
use Exception;
use Session;

class ProdutoController extends Controller
{
    private $repository;
    private $tipoProdutoRepository;

    public function __construct(
        IProdutoRepository $repository,
        ITipoProdutoRepository $tipoProdutoRepository
    )
    {
        $this->repository = $repository;
        $this->tipoProdutoRepository = $tipoProdutoRepository;
    }

    public function list()
    {
        try
        {
            $this->data['produtos'] = $this->repository->getAll();
        }
        catch(Exception $e)
        {
            Session::flash('msg-redirect-erro', $e->getMessage());
        }

        return View('produto.list',$this->data);
    }

    public function detalhe(int $id)
    {
        try
        {
            $this->data['produto'] = $this->repository->getId($id);

            if($this->data['produto'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('ProdutoController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('produto.detalhe',$this->data);
    }

    public function create()
    {
        try
        {
            $this->data['tiposProduto'] = $this->tipoProdutoRepository->GetTipoProdutoAllSelect();
        }
        catch(Exception $e)
        {
            Session::flash('msg-redirect-erro', $e->getMessage());
        }

        return View('produto.create',$this->data);
    }

    public function createPost(ProdutoRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->insert($dados);

            if($result)
                return redirect()
                            ->action('ProdutoController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoInsert',['item' => $dados['pro_descricao']])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('ProdutoController@createPost')->withInput()->withErrors($msg);
    }

    public function update(int $id)
    {
        try
        {
            $this->data['produto'] = $this->repository->getId($id);

            if($this->data['produto'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $this->data['tiposProduto'] = $this->tipoProdutoRepository->GetTipoProdutoAllSelect();
        }
        catch(Exception $e)
        {
            return redirect()->action('ProdutoController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('produto.update',$this->data);
    }

    public function updatePost(int $id, ProdutoRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            
            if($id != $dados['pro_codigo'])
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $result = $this->repository->update($id,$dados);

            if($result)
                return redirect()
                            ->action('ProdutoController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoUpdate',['item' => $dados['pro_descricao']])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('ProdutoController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['produto'] = $this->repository->getId($id);

            if($this->data['produto'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('ProdutoController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('produto.delete',$this->data);
    }

    public function deletePost(int $id,Request $request)
    {
        $msg = "";
        try
        {
            $request->validate(['pro_codigo' => 'required|numeric']);

            $result = $this->repository->delete($request->id);

            if($result)
                return redirect()
                            ->action('ProdutoController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoDelete')]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('ProdutoController@delete',$id)->with(['msg-redirect-erro' => $msg]);       
    }
}
