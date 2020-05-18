<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FornecedorRequest;
use App\Repositories\Interfaces\IFornecedorRepository;
use Exception;
use Session;

class FornecedorController extends Controller
{
    private $repository;

    public function __construct(IFornecedorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        try
        {
            $this->data['fornecedores'] = $this->repository->getAll();
        }
        catch(Exception $e)
        {
            Session::flash('msg-redirect-erro', $e->getMessage());
        }

        return View('fornecedor.list',$this->data);
    }

    public function detalhe(int $id)
    {
        try
        {
            $this->data['fornecedor'] = $this->repository->getId($id);

            if($this->data['fornecedor'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('FornecedorController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('fornecedor.detalhe',$this->data);
    }

    public function create()
    {
        return View('fornecedor.create');
    }

    public function createPost(FornecedorRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->insert($dados);

            if($result)
                return redirect()
                            ->action('FornecedorController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoInsert',['item' => $dados['for_nome']])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('FornecedorController@createPost')->withInput()->withErrors($msg);
    }

    public function update(int $id)
    {
        try
        {
            $this->data['fornecedor'] = $this->repository->getId($id);

            if($this->data['fornecedor'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('FornecedorController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('fornecedor.update',$this->data);
    }

    public function updatePost(int $id,FornecedorRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            
            if($id != $dados['for_codigo'])
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $result = $this->repository->update($id,$dados);

            if($result)
                return redirect()
                            ->action('FornecedorController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoUpdate',['item' => $dados['for_nome']])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('FornecedorController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['fornecedor'] = $this->repository->getId($id);

            if($this->data['fornecedor'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('FornecedorController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('fornecedor.delete',$this->data);
    }

    public function deletePost(int $id,Request $request)
    {
        $msg = "";
        try
        {
            $request->validate(['for_codigo' => 'required|numeric']);

            $result = $this->repository->delete($request->id);

            if($result)
                return redirect()
                            ->action('FornecedorController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoDelete')]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('FornecedorController@delete',$id)->with(['msg-redirect-erro' => $msg]);       
    }
}
