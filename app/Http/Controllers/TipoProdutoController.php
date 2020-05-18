<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TipoProdutoRequest;
use App\Repositories\Interfaces\ITipoProdutoRepository;
use Exception;
use Session;

class TipoProdutoController extends Controller
{
    private $repository;

    public function __construct(ITipoProdutoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        try
        {
            $this->data['tiposproduto'] = $this->repository->getAll();
        }
        catch(Exception $e)
        {
            Session::flash('msg-redirect-erro', $e->getMessage());
        }

        return View('tipoProduto.list',$this->data);
    }

    public function create()
    {

        return View('tipoProduto.create');
    }

    public function createPost(TipoProdutoRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->insert($dados);

            if($result)
                return redirect()
                            ->action('TipoProdutoController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoInsert',['item' => $dados['tpp_descricao']])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('TipoProdutoController@createPost')->withInput()->withErrors($msg);
    }

    public function update(int $id)
    {
        try
        {
            $this->data['tipoProduto'] = $this->repository->getId($id);

            if($this->data['tipoProduto'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('TipoProdutoController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('tipoProduto.update',$this->data);
    }

    public function updatePost(int $id,TipoProdutoRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            
            if($id != $dados['tpp_codigo'])
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $result = $this->repository->update($id,$dados);

            if($result)
                return redirect()
                            ->action('TipoProdutoController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoUpdate',['item' => $dados['tpp_descricao']])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('TipoProdutoController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['tipoProduto'] = $this->repository->getId($id);

            if($this->data['tipoProduto'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('TipoProdutoController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('tipoProduto.delete',$this->data);
    }

    public function deletePost(int $id,Request $request)
    {
        $msg = "";
        try
        {
            $request->validate(['tpp_codigo' => 'required|numeric']);

            $result = $this->repository->delete($request->id);

            if($result)
                return redirect()
                            ->action('TipoProdutoController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoDelete')]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('TipoProdutoController@delete',$id)->with(['msg-redirect-erro' => $msg]);       
    }
}
