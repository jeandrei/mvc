<?php

/**
 * ARQUIVOS QUE DEVEM SER ALTERADOS PARA INICIAR UM NOVO PROJETO
 * Alterar as configurações do banco de dados no arquivo 
 * mvc/app/config.php
 * Alterar a linha dentro do arquivo .htaccess para o diretório do site site/public
 * public/.htaccess * 
 * RewriteBase /site/public
 * 
 * 
 * ENVIO DE EMAIL
 * Arquivos relacionados com o envio do email de recuperação de senha
 * config/config.php
 * helpers/functions.php função validaemail
 * controllers/Users.php método enviasenha
 * models/User.php método sendemail
 * views/users/enviasenha.php
 * inc\PHPMailer-master
 * 
 * 
 * JQUERY VALIDATOR
 * Para funcionar o jquery validator o formulário tem que ter id e no script tem que
 * ser o mesmo id exemplo veja \views\users\register
 * exemplo formulário: <form id="register"
 *  e no script: $('#register').validate({
 * 
 * 
 * CRIANDO UMA NOVA CLASSE PESSOAS COMO EXEMPLO
 * Criando uma nova classe neste caso pessoas deixei como exemplo
 * 1 - Crie um controller controllers\Pessoas.php
 * 2 - Crie um model models\Pessoa.php
 * 3 - Crie um view views\pessoas\index
 * 4 - Crie a classe no controller 
 * não esqueça de extender ao main controller class Pessoas extends Controller
 * deixe a construct em branco ou comentado no carregamento do model
 * 5 - Crie um método index e de início apenas de um echo
 * public function index(){
 * echo "Carregou o index";
 * }
 * 6 - Já crie todas as rotas no controller add, edit, delete
 * 7 - Cada uma delas
 * app/add
 * app/edit
 * app/delete
 * 8 - Crie o Model
 * iniciando o banco de dados na construct
 * class Pessoa {
 *      private $db;
 * 
 *      public function __construct(){
 *          $this->db = new Database;
 *      }
 * }
 * 9 - Na construct do controller carregue o model
 * $this->userModel = $this->model('Pessoa');
 * 10 - Teste para ver se não tem nenhum erro
 * 11 - Crie os views para cada metodo index, add, edits
 * views/pessoas/index
 * views/pessoas/add
 * views/pessoas/edit
 * Coloque algo dentro só para ver se vc consegue acessar 
 * como por exemplo em index HOME
 * 12 - Retorne ao controller de pessoas e carregue o view correspondente
 * para cada método
 * $this->view('pessoas/index');
 * 13 - Teste para ver se apareceu o conteúdo do view
 * 
 * 
 * 
 * 
 */


