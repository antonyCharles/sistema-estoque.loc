<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContaReceberRequest;
use App\Repositories\Interfaces\IContaReceberRepository;
use Exception;
use Session;

class ContaReceberController extends Controller
{
    private $repository;

    public function __construct(IContaReceberRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(int $nf_codigo)
    {
        $this->data['nf_codigo'] = $nf_codigo;
        return View('contaReceber.create',$this->data);
    }

    public function createPost(int $nf_codigo, ContaReceberRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->insert($dados);

            if($result)
                return redirect()
                            ->action('NotaFiscalController@detalhe',$nf_codigo)
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoInsert',['item' => trans('contaReceber.title')])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('ContaReceberController@createPost',$nf_codigo)->withInput()->withErrors($msg);
    }

    public function update(int $id, int $nf_codigo)
    {
        try
        {
            $this->data['contaReceber'] = $this->repository->getId($id);

            if($this->data['contaReceber'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('NotaFiscalController@detalhe',$nf_codigo)->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('contaReceber.update',$this->data);
    }

    public function updatePost(int $id, int $nf_codigo,ContaReceberRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            
            if($id != $dados['cr_codigo'])
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $result = $this->repository->update($id,$dados);

            if($result)
                return redirect()
                            ->action('NotaFiscalController@detalhe',$dados['nf_codigo'])
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoUpdate',['item' => trans('contaReceber.title')])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('ContaReceberController@updatePost',['id' => $id, 'nf_codigo' => $nf_codigo])->withInput()->withErrors($msg);
    }

    public function delete(int $id, int $nf_codigo)
    {
        try
        {
            $this->data['contaReceber'] = $this->repository->getId($id);

            if($this->data['contaReceber'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('NotaFiscalController@detalhe',$nf_codigo)->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('contaReceber.delete',$this->data);
    }

    public function deletePost(int $id, int $nf_codigo,Request $request)
    {
        $msg = "";
        try
        {
            $request->validate(['cr_codigo' => 'required|numeric']);

            $result = $this->repository->delete($request->cr_codigo);

            if($result)
                return redirect()
                            ->action('NotaFiscalController@detalhe',$nf_codigo)
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoDelete')]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('ContaReceberController@delete',['id' => $id, 'nf_codigo' => $nf_codigo])->with(['msg-redirect-erro' => $msg]);       
    }
}
