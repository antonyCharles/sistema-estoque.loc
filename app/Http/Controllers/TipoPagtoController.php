<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TipoPagtoRequest;
use App\Repositories\Interfaces\ITipoPagtoRepository;
use App\Enums\SimNaoEnum;
use Exception;
use Session;

class TipoPagtoController extends Controller
{
    private $repository;

    public function __construct(ITipoPagtoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        try
        {
            $this->data['tipospagto'] = $this->repository->getAll();
            $this->data['enumSimNao'] = SimNaoEnum::get();
        }
        catch(Exception $e)
        {
            Session::flash('msg-redirect-erro', $e->getMessage());
        }

        return View('tipoPagto.list',$this->data);
    }

    public function create()
    {
        $this->data['enumSimNao'] = SimNaoEnum::get();
        return View('tipoPagto.create',$this->data);
    }

    public function createPost(TipoPagtoRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->insert($dados);

            if($result)
                return redirect()
                            ->action('TipoPagtoController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoInsert',['item' => $dados['tpg_descricao']])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('TipoPagtoController@createPost')->withInput()->withErrors($msg);
    }

    public function update(int $id)
    {
        try
        {
            $this->data['tipoPagto'] = $this->repository->getId($id);
            $this->data['enumSimNao'] = SimNaoEnum::get();

            if($this->data['tipoPagto'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('TipoPagtoController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('tipoPagto.update',$this->data);
    }

    public function updatePost(int $id,TipoPagtoRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            
            if($id != $dados['tpg_codigo'])
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $result = $this->repository->update($id,$dados);

            if($result)
                return redirect()
                            ->action('TipoPagtoController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoUpdate',['item' => $dados['tpg_descricao']])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('TipoPagtoController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['tipoPagto'] = $this->repository->getId($id);
            $this->data['enumSimNao'] = SimNaoEnum::get();

            if($this->data['tipoPagto'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('TipoPagtoController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('tipoPagto.delete',$this->data);
    }

    public function deletePost(int $id,Request $request)
    {
        $msg = "";
        try
        {
            $request->validate(['tpg_codigo' => 'required|numeric']);

            $result = $this->repository->delete($request->id);

            if($result)
                return redirect()
                            ->action('TipoPagtoController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoDelete')]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('TipoPagtoController@delete',$id)->with(['msg-redirect-erro' => $msg]);       
    }
}
