<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Interfaces\ICompraRepository', 'App\Repositories\CompraRepository');
        $this->app->bind('App\Repositories\Interfaces\IContaPagarRepository', 'App\Repositories\ContaPagarRepository');
        $this->app->bind('App\Repositories\Interfaces\IContaReceberRepository', 'App\Repositories\ContaReceberRepository');
        $this->app->bind('App\Repositories\Interfaces\IFornecedorRepository', 'App\Repositories\FornecedorRepository');
        $this->app->bind('App\Repositories\Interfaces\IFuncionarioRepository', 'App\Repositories\FuncionarioRepository');
        $this->app->bind('App\Repositories\Interfaces\IItensCompraRepository', 'App\Repositories\ItensCompraRepository');
        $this->app->bind('App\Repositories\Interfaces\IItensVendaRepository', 'App\Repositories\ItensVendaRepository');
        $this->app->bind('App\Repositories\Interfaces\INotaFiscalRepository', 'App\Repositories\NotaFiscalRepository');
        $this->app->bind('App\Repositories\Interfaces\IProdutoRepository', 'App\Repositories\ProdutoRepository');
        $this->app->bind('App\Repositories\Interfaces\ITipoPagtoRepository', 'App\Repositories\TipoPagtoRepository');
        $this->app->bind('App\Repositories\Interfaces\ITipoProdutoRepository', 'App\Repositories\TipoProdutoRepository');
        $this->app->bind('App\Repositories\Interfaces\IVendaRepository', 'App\Repositories\VendaRepository');
        $this->app->bind('App\Repositories\Interfaces\IProfileRepository', 'App\Repositories\ProfileRepository');
        $this->app->bind('App\Repositories\Interfaces\IGroupParameterRepository', 'App\Repositories\GroupParameterRepository');
        $this->app->bind('App\Repositories\Interfaces\IParameterRepository', 'App\Repositories\ParameterRepository');
        $this->app->bind('App\Repositories\Interfaces\IParameterProfileRepository', 'App\Repositories\ParameterProfileRepository');
        $this->app->bind('App\Repositories\Interfaces\IPasswordResetRepository', 'App\Repositories\PasswordResetRepository');
        $this->app->bind('App\Repositories\Interfaces\IRoleRepository', 'App\Repositories\RoleRepository');
        $this->app->bind('App\Repositories\Interfaces\IRoleActionRepository', 'App\Repositories\RoleActionRepository');
        $this->app->bind('App\Repositories\Interfaces\IRoleActionItemRepository', 'App\Repositories\RoleActionItemRepository');
        $this->app->bind('App\Repositories\Interfaces\IRoleProfileRepository', 'App\Repositories\RoleProfileRepository');
        $this->app->bind('App\Repositories\Interfaces\ISystemRepository', 'App\Repositories\SystemRepository');
    }
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
