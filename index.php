<?php



    require("vendor/autoload.php");
    

    use Pecee\SimpleRouter\SimpleRouter as Router;
  
    
   
    //rotas seguras 
    Router::get('/', 'UserController@updateUser');
    Router::post('/User/Cadastro', 'UserController@inserirUser');
    Router::delete('/User/Cancelamento', 'UserController@deleteUser');//cadastrado e logado token
    Router::post('/User/Busca', 'UserController@selectUser');
    Router::post('/User/Atualizar-Cadastro', 'UserController@updateUser');
    

    Router::start();
