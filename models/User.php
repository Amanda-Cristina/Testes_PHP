<?php
    use JMS\Serializer\Annotation as Serializer;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Symfony\Component\Validator\Mapping\ClassMetadata;
    


    class User extends Query{
       
        public $nome;
        protected $cpf;
        protected $email;
        protected $telefone;
        protected $cep;
        protected $numero;
        protected $rua;
        protected $bairro;
        protected $cidade;
        protected $estado;
        /**
         * @Assert\NotNull
         * @Assert\NotBlank()
         */
        protected $senha;
        public $table;
        



        public function __construct(){
            $config = require("config.php");
            $this -> table = $config['table_user'];
           


            parent::__construct($this -> table);
            
        }

        public function set($data) {
            foreach ($data AS $key => $value) $this->{$key} = $value;
        }

        public static function loadValidatorMetadata(ClassMetadata $metadata)
        {
            $metadata->addPropertyConstraint('senha', new NotBlank());//front, 

            //null, tipo (int, float, string)/, duplicação (id, nome, cpf, email)
            //cpf, nome, cep
        }
    
    }
