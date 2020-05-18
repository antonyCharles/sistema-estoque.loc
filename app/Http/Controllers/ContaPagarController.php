<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContaPagarRequest;
use App\Repositories\Interfaces\IContaPagarRepository;
use Exception;
use Session;

class ContaPagarController extends Controller
{
    private $repository;

    public function __construct(IContaPagarRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(int $nf_codigo)
    {
        $this->data['nf_codigo'] = $nf_codigo;
        return View('contaPagar.create',$this->data);
    }

    public function createPost(int $nf_codigo, ContaPagarRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->insert($dados);

            if($result)
                return redirect()
                            ->action('NotaFiscalController@detalhe',$nf_codigo)
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoInsert',['item' => trans('contaPagar.title')])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('ContaPagarController@createPost',$nf_codigo)->withInput()->withErrors($msg);
    }

    public function update(int $id, int $nf_codigo)
    {
        try
        {
            $this->data['contaPagar'] = $this->repository->getId($id);

            if($this->data['contaPagar'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('NotaFiscalController@detalhe',$nf_codigo)->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('contaPagar.update',$this->data);
    }

    public function updatePost(int $id, int $nf_codigo,ContaPagarRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            
            if($id != $dados['cp_codigo'])
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $result = $this->repository->update($id,$dados);

            if($result)
                return redirect()
                            ->action('NotaFiscalController@detalhe',$dados['nf_codigo'])
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoUpdate',['item' => trans('contaPagar.title')])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('ContaPagarController@updatePost',['id' => $id, 'nf_codigo' => $nf_codigo])->withInput()->withErrors($msg);
    }

    public function delete(int $id, int $nf_codigo)
    {
        try
        {
            $this->data['contaPagar'] = $this->repository->getId($id);

            if($this->data['contaPagar'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('NotaFiscalController@detalhe',$nf_codigo)->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('contaPagar.delete',$this->data);
    }

    public function deletePost(int $id, int $nf_codigo,Request $request)
    {
        $msg = "";
        try
        {
            $request->validate(['cp_codigo' => 'required|numeric']);

            $result = $this->repository->delete($request->cp_codigo);

            if($result)
                return redirect()
                            ->action('NotaFiscalController@detalhe',$nf_codigo)
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoDelete')]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('ContaPagarController@delete',['id' => $id, 'nf_codigo' => $nf_codigo])->with(['msg-redirect-erro' => $msg]);       
    }
}
