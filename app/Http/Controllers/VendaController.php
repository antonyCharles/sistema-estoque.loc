<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VendaRequest;
use App\Http\Requests\VendaUpdateRequest;
use App\Enums\StatusEnum;
use App\Repositories\VendaRepository;
use App\Repositories\FuncionarioRepository;
use App\Repositories\ItensVendaRepository;
use App\Repositories\TipoPagtoRepository;
use App\Repositories\ProdutoRepository;
use App\Repositories\NotaFiscalRepository;
use Exception;
use Session;

class VendaController extends Controller
{
    private $repository;

    public function __construct(VendaRepository $repository)
    {
        $this->repository = $repository;
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
            $repositoryFuncionario = new FuncionarioRepository();
            $this->data['funcionarios'] = $repositoryFuncionario->GetFuncionarioAllSelect();

            $serTipoPagto = new TipoPagtoRepository();
            $this->data['tiposPagtos'] = $serTipoPagto->GetTipoPagtoAllSelect();

            $serNotaFiscal = new NotaFiscalRepository();
            $this->data['notasfiscais'] = $serNotaFiscal->GetNotaFiscalAllSelect();

            $serProduto = new ProdutoRepository();
            $this->data['produtos'] = $serProduto->GetAllEmEstoque();

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
            $result = $this->repository->insert($dados);

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

            $repositoryFuncionario = new FuncionarioRepository();
            $this->data['funcionarios'] = $repositoryFuncionario->GetFuncionarioAllSelect();

            $serTipoPagto = new TipoPagtoRepository();
            $this->data['tiposPagtos'] = $serTipoPagto->GetTipoPagtoAllSelect();
            
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
