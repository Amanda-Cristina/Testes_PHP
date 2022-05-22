<?php



    require("vendor/autoload.php");
    

    use Pecee\SimpleRouter\SimpleRouter as Router;
  
    
   
    //rotas seguras 
    
    Router::post('/User/Cadastro', 'UserController@inserirUser');
    Router::post('/User/Atualizar-Cadastro', 'UserController@updateUser');
    Router::delete('/User/Cancelamento', 'UserController@deleteUser');//cadastrado e logado token
    Router::post('/User/Busca', 'UserController@selectUser');
    Router::start();
