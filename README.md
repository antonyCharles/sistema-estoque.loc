# Fat - Sistema Estoque
Projeto desenvolvido na faculdade para disciplina de Linguagem de Programação com PHP.

![fat-sistema-estoquee](https://user-images.githubusercontent.com/24979597/89249703-4a5e1f00-d5e9-11ea-9bc8-e91d49f0db43.gif)

## Diagrama entidade relacionamento
As tabelas que começam com <b>tb_</b> foram passadas pelo requisitante do sistema (professor) e as tabelas que começam com <b>logn_</b> foram ciradas pelo desenvolvedor para ter um sistema de autenticação e autorização mais eficiente.

![sistema-estoque](https://user-images.githubusercontent.com/24979597/89248272-b2ab0180-d5e5-11ea-9616-c64d6c33c976.png)

## Requisitos
Para executar o projeto, será necessário instalar os seguintes programas:

<ul>
  <li>Visual Studio Code</li>
  <li>Servidor PHP > v. 7.2 </li>
  <li>Banco de dados Mysql</li>
  <li>Composer</li>
    <li>Laravel 6.*</li>
</ul>

## Desenvolvimento

Para iniciar o desenvolvimento, é necessário:
<ol>
  <li>
    Clonar o projeto do GitHub num diretório de sua preferência
    <pre>
      cd "Seu diretorio"
      git clone https://github.com/antonycharles/sistema-estoque.loc.git</pre>
  </li>
  <li>
    Adicionar informações do banco de dados no arquivo .env
  </li>
  <li>
    Baixar pacotes do projeto
      <pre>composer dump
      php composer update</pre>
  </li>
  <li>
    Subir Migrations para o banco de dados no terminal
    <pre>
      php artisan migrate</pre>
  </li>
  <li>
     Subir informações primarias para o banco de dados
      <pre>
        composer dump-autoload
        php artisan db:seed
      </pre>
  </li>
</ol>
