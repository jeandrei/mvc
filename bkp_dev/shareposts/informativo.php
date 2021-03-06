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
 * CRIANDO UMA NOVA CLASSE CADASTROS COMO EXEMPLO
 * Criando uma nova classe neste caso cadastros deixei como exemplo
 * 1 - Crie um controller controllers\Cadastros.php
 * 2 - Crie um model models\Cadastro.php
 * 3 - Crie um view views\cadastros\index
 * 4 - Crie a classe no controller 
 * não esqueça de extender ao main controller class Cadastros extends Controller
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
 * class Cadastro {
 *      private $db;
 * 
 *      public function __construct(){
 *          $this->db = new Database;
 *      }
 * }
 * 9 - Na construct do controller carregue o model
 * $this->userModel = $this->model('Cadastro');
 * 10 - Teste para ver se não tem nenhum erro
 * 11 - Crie os views para cada metodo index, add, edits
 * views/cadastros/index
 * views/cadastros/add
 * views/cadastros/edit
 * Coloque algo dentro só para ver se vc consegue acessar 
 * como por exemplo em index HOME
 * 12 - Retorne ao controller de cadastros e carregue o view correspondente
 * para cada método
 * $this->view('cadastros/index');
 * 13 - Teste para ver se apareceu o conteúdo do view
 * 
 * CODIFICAÇÃO
 * Todo o banco de dados tem que ser definido com utf8
 * CREATE DATABASE shareposts CHARACTER SET utf8 COLLATE utf8_general_ci;
 * as tabelas tem que colocar codificação utf8
 * ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * No php no header tem que setar como default utf8
 * HEADER <?php ini_set('default_charset', 'utf-8');?>
 * A classe Database tem que definir utf8
 * libraries\Database
 * Em Ceate PDO instance no try tem que colocar essa linha
 * $this->dbh->exec('SET NAMES "utf8"'); 
 * 
 * 
 * IMPEDIR O ACESSO SEM ESTAR LOGADO
 * Colocar no início do método no controller
 * if(!isLoggedIn()){
 *    redirect('users/login'); 
 * }
 * Essa função está em helpers\session_helper.php
 * se não estiver logado vai redirecionar para o login
 * 
 */



