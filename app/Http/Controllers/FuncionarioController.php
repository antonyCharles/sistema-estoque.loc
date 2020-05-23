<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FuncionarioRequest;
use App\Http\Requests\FuncionarioUpdateRequest;
use App\Repositories\Interfaces\IFuncionarioRepository;
use App\Repositories\Interfaces\IProfileRepository;
use App\Enums\SexoEnum;
use Exception;
use Session;

class FuncionarioController extends Controller
{
    private $repository;
    private $profileRepository;

    public function __construct(
        IFuncionarioRepository $repository,
        IProfileRepository $profileRepository
    )
    {
        $this->repository = $repository;
        $this->profileRepository = $profileRepository;
    }

    public function list()
    {
        try
        {
            $this->data['funcionarios'] = $this->repository->getAll();
            $this->data['enumSexo'] = SexoEnum::get();
        }
        catch(Exception $e)
        {
            Session::flash('msg-redirect-erro', $e->getMessage());
        }

        return View('funcionario.list',$this->data);
    }

    public function detalhe(int $id)
    {
        try
        {
            $this->data['funcionario'] = $this->repository->getId($id);
            $this->data['enumSexo'] = SexoEnum::get();

            if($this->data['funcionario'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('FuncionarioController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('funcionario.detalhe',$this->data);
    }

    public function create()
    {
        try
        {
            $this->data['profiles'] = $this->profileRepository->GetProfilesAllSelect();
            $this->data['enumSexo'] = SexoEnum::get();
        }
        catch(Exception $e)
        {
            Session::flash('msg-redirect-erro', $e->getMessage());
        }

        return View('funcionario.create',$this->data);
    }

    public function createPost(FuncionarioRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->insert($dados);

            if($result)
                return redirect()
                            ->action('FuncionarioController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoInsert',['item' => $dados['name']])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('FuncionarioController@createPost')->withInput()->withErrors($msg);
    }

    public function update(int $id)
    {
        try
        {
            $this->data['funcionario'] = $this->repository->getId($id);
            $this->data['profiles'] = $this->profileRepository->GetProfilesAllSelect();
            $this->data['enumSexo'] = SexoEnum::get();

            if($this->data['funcionario'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('FuncionarioController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('funcionario.update',$this->data);
    }

    public function updatePost(int $id,FuncionarioUpdateRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            
            if($id != $dados['fun_codigo'])
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $result = $this->repository->update($id,$dados);

            if($result)
                return redirect()
                            ->action('FuncionarioController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoUpdate',['item' => $dados['name']])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('FuncionarioController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['funcionario'] = $this->repository->getId($id);
            $this->data['enumSexo'] = SexoEnum::get();

            if($this->data['funcionario'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('FuncionarioController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('funcionario.delete',$this->data);
    }

    public function deletePost(int $id,Request $request)
    {
        $msg = "";
        try
        {
            $request->validate(['fun_codigo' => 'required|numeric']);

            $result = $this->repository->delete($request->id);

            if($result)
                return redirect()
                            ->action('FuncionarioController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoDelete')]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('FuncionarioController@delete',$id)->with(['msg-redirect-erro' => $msg]);       
    }
}
