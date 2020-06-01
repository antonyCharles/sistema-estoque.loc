<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Http\Requests\NotaFiscalRequest;
use App\Repositories\Interfaces\INotaFiscalRepository;
use Exception;
use Session;

class NotaFiscalController extends Controller
{
    private $repository;

    public function __construct(INotaFiscalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        try
        {
            $this->data['notasFiscais'] = $this->repository->getAll();
        }
        catch(Exception $e)
        {
            Session::flash('msg-redirect-erro', $e->getMessage());
        }

        return View('notaFiscal.list',$this->data);
    }

    public function detalhe(int $id)
    {
        try
        {
            $this->data['notaFiscal'] = $this->repository->getId($id);
            $this->data['enumStatus'] = StatusEnum::get();

            if($this->data['notaFiscal'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('NotaFiscalController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('notaFiscal.detalhe',$this->data);
    }

    public function create()
    {
        return View('notaFiscal.create');
    }

    public function createPost(NotaFiscalRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->insert($dados);

            if($result)
                return redirect()
                            ->action('NotaFiscalController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoInsert',['item' => 'N.F.'])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('NotaFiscalController@createPost')->withInput()->withErrors($msg);
    }

    public function update(int $id)
    {
        try
        {
            $this->data['notaFiscal'] = $this->repository->getId($id);

            if($this->data['notaFiscal'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('NotaFiscalController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('notaFiscal.update',$this->data);
    }

    public function updatePost(int $id,NotaFiscalRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            
            if($id != $dados['nf_codigo'])
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $result = $this->repository->update($id,$dados);

            if($result)
                return redirect()
                            ->action('NotaFiscalController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoUpdate',['item' => 'N.F.'])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('NotaFiscalController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['notaFiscal'] = $this->repository->getId($id);

            if($this->data['notaFiscal'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('NotaFiscalController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('notaFiscal.delete',$this->data);
    }

    public function deletePost(int $id,Request $request)
    {
        $msg = "";
        try
        {
            $request->validate(['nf_codigo' => 'required|numeric']);

            $result = $this->repository->delete($request->id);

            if($result)
                return redirect()
                            ->action('NotaFiscalController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoDelete')]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('NotaFiscalController@delete',$id)->with(['msg-redirect-erro' => $msg]);       
    }
}
