<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VendaRequest;
use App\Http\Requests\VendaUpdateRequest;
use App\Enums\StatusEnum;
use App\Repositories\Interfaces\IVendaRepository;
use App\Repositories\Interfaces\IFuncionarioRepository;
use App\Repositories\Interfaces\IItensVendaRepository;
use App\Repositories\Interfaces\ITipoPagtoRepository;
use App\Repositories\Interfaces\IProdutoRepository;
use App\Repositories\Interfaces\INotaFiscalRepository;
use Exception;
use Session;

class VendaController extends Controller
{
    private $repository;
    private $funcionarioRepository;
    private $itensVendaRepository;
    private $tipoPagtoRepository;
    private $produtoRepository;
    private $notaFiscalRepository;

    public function __construct(
        IVendaRepository $repository,
        IFuncionarioRepository $funcionarioRepository,
        IItensVendaRepository $itensVendaRepository,
        ITipoPagtoRepository $tipoPagtoRepository,
        IProdutoRepository $produtoRepository,
        INotaFiscalRepository $notaFiscalRepository
    )
    {
        $this->repository = $repository;
        $this->funcionarioRepository = $funcionarioRepository;
        $this->itensVendaRepository = $itensVendaRepository;
        $this->tipoPagtoRepository = $tipoPagtoRepository;
        $this->produtoRepository = $produtoRepository;
        $this->notaFiscalRepository = $notaFiscalRepository;
    }

    public function list()
    {
        try
        {
            $this->data['vendas'] = $this->repository->getAll();
            $this->data['enumStatus'] = StatusEnum::get();
        }
        catch(Exception $e)
        {
            Session::flash('msg-redirect-erro', $e->getMessage());
        }

        return View('venda.list',$this->data);
    }

    public function detalhe(int $id)
    {
        try
        {
            $this->data['venda'] = $this->repository->getId($id);
            $this->data['enumStatus'] = StatusEnum::get();

            if($this->data['venda'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('VendaController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('venda.detalhe',$this->data);
    }

    public function create()
    {
        try{
            $this->data['funcionarios'] = $this->funcionarioRepository->GetFuncionarioAllSelect();

            $this->data['tiposPagtos'] = $this->tipoPagtoRepository->GetTipoPagtoAllSelect();

            $this->data['notasfiscais'] = $this->notaFiscalRepository->GetNotaFiscalAllSelect();

            $this->data['produtos'] = $this->produtoRepository->GetAllEmEstoque();

            $this->data['enumStatus'] = StatusEnum::get();

        }catch(Exception $e){
            return redirect()->action('VendaController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('venda.create',$this->data);
    }

    public function createPost(VendaRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->createVendaCompleta($dados);

            return redirect()
                        ->action('VendaController@detalhe', $result)
                        ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoInsert',['item' => 'venda'])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('VendaController@createPost')->withInput()->withErrors($msg);
    }

    public function update(int $id)
    {
        try
        {
            $this->data['venda'] = $this->repository->getId($id);

            if($this->data['venda'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $this->data['funcionarios'] = $this->funcionarioRepository->GetFuncionarioAllSelect();

            $this->data['tiposPagtos'] = $this->tipoPagtoRepository->GetTipoPagtoAllSelect();
            
            $this->data['enumStatus'] = StatusEnum::get();

        }
        catch(Exception $e)
        {
            return redirect()->action('VendaController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('venda.update',$this->data);
    }

    public function updatePost(int $id,VendaUpdateRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            
            if($id != $dados['ven_codigo'])
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $result = $this->repository->update($id,$dados);

            if($result)
                return redirect()
                            ->action('VendaController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoUpdate',['item' => 'venda'])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('VendaController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['venda'] = $this->repository->getId($id);
            $this->data['enumStatus'] = StatusEnum::get();

            if($this->data['venda'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('VendaController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('venda.delete',$this->data);
    }

    public function deletePost(int $id,Request $request)
    {
        $msg = "";
        try
        {
            $request->validate(['ven_codigo' => 'required|numeric']);

            $result = $this->repository->delete($request->id);

            if($result)
                return redirect()
                            ->action('VendaController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoDelete')]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('VendaController@delete',$id)->with(['msg-redirect-erro' => $msg]);       
    }
}
