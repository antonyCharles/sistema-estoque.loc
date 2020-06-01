<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests\CompraRequest;
use App\Http\Requests\CompraUpdateRequest;
use App\Repositories\Interfaces\ICompraRepository;
use App\Repositories\Interfaces\IFornecedorRepository;
use App\Repositories\Interfaces\ITipoPagtoRepository;
use App\Repositories\Interfaces\IProdutoRepository;
use App\Repositories\Interfaces\INotaFiscalRepository;
use Exception;
use Session;

class CompraController extends Controller
{
    private $repository;
    private $fornecedorRepository;
    private $tipoPagtoRepository;
    private $produtoRepository;
    private $notaFiscalRepository;

    public function __construct(
        ICompraRepository $repository,
        IFornecedorRepository $fornecedorRepository,
        ITipoPagtoRepository $tipoPagtoRepository,
        IProdutoRepository $produtoRepository,
        INotaFiscalRepository $notaFiscalRepository
    )
    {
        $this->repository = $repository;
        $this->fornecedorRepository = $fornecedorRepository;
        $this->tipoPagtoRepository = $tipoPagtoRepository;
        $this->produtoRepository = $produtoRepository;
        $this->notaFiscalRepository = $notaFiscalRepository;
    }

    public function list()
    {
        try
        {
            $this->data['compras'] = $this->repository->getAll();
            $this->data['enumStatus'] = StatusEnum::get();
        }
        catch(Exception $e)
        {
            Session::flash('msg-redirect-erro', $e->getMessage());
        }

        return View('compra.list',$this->data);
    }

    public function detalhe(int $id)
    {
        try
        {
            $this->data['compra'] = $this->repository->getId($id);
            $this->data['enumStatus'] = StatusEnum::get();

            if($this->data['compra'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

        }
        catch(Exception $e)
        {
            return redirect()->action('CompraController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('compra.detalhe',$this->data);
    }

    public function create()
    {
        try{
            $this->data['fornecedores'] = $this->fornecedorRepository->GetFornecedorAllSelect();
            $this->data['tiposPagtos'] = $this->tipoPagtoRepository->GetTipoPagtoAllSelect();
            $this->data['notasfiscais'] = $this->notaFiscalRepository->GetNotaFiscalAllSelect();
            $this->data['produtos'] = $this->produtoRepository->GetAll();

            $this->data['enumStatus'] = StatusEnum::get();

        }catch(Exception $e){
            return redirect()->action('CompraController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('compra.create',$this->data);
    }

    public function createPost(CompraRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->createCompraCompleta($dados);

                return redirect()
                          ->action('CompraController@detalhe',$result)
                          ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoInsert',['item' => 'Compra'])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('CompraController@createPost')->withInput()->withErrors($msg);
    }

    public function clonar(int $id)
    {
        try
        {
            $compra = $this->repository->getId($id);

            if($compra == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $dados = [
                'for_codigo' => $compra->for_codigo,
                'tpg_codigo' => $compra->tpg_codigo,
                'com_datacompra' => $compra->com_datacompra,
                'com_observacoes' => $compra->com_observacoes,
                'com_criar_notafiscal' => 'S',
                'nf_codigo' =>  $compra->nf_codigo,
                'pro_codigo' => $compra->itenscompras->pluck('pro_codigo'),
                'com_quantidade' => $compra->itenscompras->pluck('itc_qtde'),
                'com_desconto' => $compra->itenscompras->pluck('itc_desc'),
                'com_status' => $compra->com_status
            ];
        }
        catch(Exception $e)
        {
            return redirect()->action('CompraController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return redirect()->action('CompraController@createPost')->withInput($dados);
    }

    public function update(int $id){
        try
        {
            $this->data['compra'] = $this->repository->getId($id);

            if($this->data['compra'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $this->data['fornecedores'] = $this->fornecedorRepository->GetFornecedorAllSelect();

            $this->data['tiposPagtos'] = $this->tipoPagtoRepository->GetTipoPagtoAllSelect();

            $this->data['enumStatus'] = StatusEnum::get();
        }
        catch(Exception $e)
        {
            return redirect()->action('CompraController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('compra.update',$this->data);
    }

    public function updatePost(int $id,CompraUpdateRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->update($id, $dados);

            return redirect()
                        ->action('CompraController@detalhe',$id)
                        ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoUpdate',['item' => 'Compra'])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('CompraController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['compra'] = $this->repository->getId($id);

            if($this->data['compra'] == null)
                throw new Exception(trans('msgErros.ItemIdNaoEncontrado',['id' => $id]));

            $this->data['enumStatus'] = StatusEnum::get();

        }
        catch(Exception $e)
        {
            return redirect()->action('CompraController@list')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('compra.delete',$this->data);
    }

    public function deletePost(int $id,Request $request)
    {
        $msg = "";
        try
        {
            $request->validate(['com_codigo' => 'required|numeric']);

            $result = $this->repository->delete($request->id);

            if($result)
                return redirect()
                            ->action('CompraController@list')
                            ->with(['msg-redirect-sucesso' => trans('msgSucessos.SucessoDelete')]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('CompraController@delete',$id)->with(['msg-redirect-erro' => $msg]);       
    }
}