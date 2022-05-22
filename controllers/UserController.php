<?php


use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Input\InputHandler;
use Pecee\Http\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Exception\PartialDenormalizationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validation;




    class UserController{
        
        protected User $user;
        protected $dados;
        

        public function __construct()
        {
            $this -> user = new User();
            $this -> dados = file_get_contents("php://input");
            
            
        }

        

        public function inserirUser(){
                  
            try{
                $this -> user = $this -> user -> loadData($this -> dados, User::class);
                $errors = $this -> user -> validatesParameters($this -> user);
                
                if(empty($errors))//se vazio insere
                    
                {   $errors = $this -> user -> validatesInsert($this -> user);
                    if(empty($errors)){
                        $this -> user -> insert();
                        new Response(200, ["Inserção com sucesso"]);
                    }
                    else{
                        new Response(400, $errors[0]);
                    }                    
                }
                else{
                    new Response(400, $errors[0]);
                }
            }

            catch(Exception $e){
                new Response(400, ['Falha na inserção -> ' . $e->getMessage()]);
               
            }
      
        }
           

        public function updateUser(){
            try{
                $this -> user = $this -> user -> loadData($this -> dados, User::class);
                $errors = $this -> user -> validatesParameters($this -> user);
                
                if(empty($errors))
                    
                {   $errors = $this -> user -> validatesUpdate($this -> user);
                    if(empty($errors)){
                        $this -> user -> update();
                        new Response(200, ["Atualização com sucesso"]);
                    }
                    else{
                        new Response(400, $errors[0]);
                    }                    
                }
                else{
                    new Response(400, $errors[0]);
                }
            }

            catch(Exception $e){
                new Response(400, ['Falha na atualização -> ' . $e->getMessage()]);
               
            }
        }

        public function deleteUser(){
            //avaliar método
        }

        public function selectUser(){
            //avaliar método
        }

        
    }
