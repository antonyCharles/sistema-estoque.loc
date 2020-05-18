<?php
namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepository extends GeneratorCommand
{
  /**
   * O nome e a assinatura do comando do console.
   *
   * @var string
   */
  protected $name = 'make:repository';
  
 /**
   * A descrição do comando do console.
   *
   * @var string
   */
  protected $description = 'Create a new repository class';
  
    /**
   * O tipo de classe sendo gerada.
   *
   * @var string
   */
  protected $type = 'Repository';
   
     /**
     * Substitui o nome da classe para o stub fornecido.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $argName = $this->argument('name');
        $model = str_replace('Repository','',$argName);
        $interfaca = "I" . $argName;

        $stub = parent::replaceClass($stub, $name);
        $result = str_replace('GenericRepository', $argName, $stub);
        $result = str_replace('GenericModel', $model, $result);
        $result = str_replace('GenericInterface', $interfaca, $result);

        $this->call('make:repository-interface', ['name' => $interfaca]);


        return $result;
    }
  /**
   * Obtpem o arquivo stub para o gerador.
   *
   * @return string
   */
  protected function getStub()
  {
    return  app_path() . '/Console/Commands/Stubs/make-repository.stub';
  }
     /**
   * Obtém o namespace padrão para a classe.
   *
   * @param  string  $rootNamespace
   * @return string
   */
  protected function getDefaultNamespace($rootNamespace)
  {
    return $rootNamespace . '\Repositories';
  }

    /**
     * Obtém os argumentos do comando do console.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the repository.'],
        ];
    }
}