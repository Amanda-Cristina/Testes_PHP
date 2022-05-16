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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;









$config = require("config.php");

    class UserController{
        
        protected $user;
        protected $dados;
        
        private Serializer $serializer;
        private ValidatorInterface $validator;

        public function __construct()
        {
            //$this -> user = new User();
            $this -> dados = json_decode(file_get_contents("php://input"));
            
        }
            //$postdata = file_get_contents("php://input"); receber dados
            //$cliente = $_GET['email'];
            // $valores = Router::request()->getInputHandler();
            // var_dump($valores);
            // return $valores->value('idade');

        public function inserirUser(){
           
            $encoders = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];

            $this->serializer = new Serializer($normalizers, $encoders);
            //$this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
            $this->validator = Validation::createValidatorBuilder()
                ->addMethodMapping('loadValidatorMetadata')
                ->getValidator();
            //$this -> user = $serializer->deserialize($this -> dados , User::class, 'json');


            
            $this -> user = $this->serializer->deserialize($this -> dados, User::class, 'json');
            $errors = $this->validator->validate($this -> user);
            if (count($errors) > 0) {
                foreach ($errors as $violation) {
                    echo $violation->getMessage().'<br>';
                }
            }

            return $errors;
                
                
        }
            // try{
            //     $this -> user -> insert($parameters);
            // }

            // catch(Exception $e){
            //     echo $e->getMessage();
            // }
           
           
             //return $this -> user -> nome;
            
            
           
        

        public function updateUser(){
            //return $request;
            //avaliar método
            var_dump($this -> dados);
            
        }

        public function deleteUser(){
            //avaliar método
        }

        public function selectUser(){
            //avaliar método
        }

        function input($index = null, $defaultValue = null){
            if ($index !== null) {
                return $this->request()->getInputHandler()->value($index, $defaultValue);
            }
            return $this->request()->getInputHandler();
        }

        function request(): Request{
            return Router::request();
        }
    }
