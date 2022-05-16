<?php
    abstract class Query{
        protected $bd;
        protected $table;

        public function __construct($table)
        {
            $connect = new Conexao();
            $this -> bd =  $connect -> Conectar(); 
            $this -> table = $table;
        }

        public function selectAll(){
            $statement = $this -> bd -> prepare("select * from {$this -> table}");
           try{
            $statement -> execute();
            return  $statement -> fetchAll(PDO::FETCH_CLASS);
           }
           catch(Exception $e){
            throw new Exception($e->getMessage());
        }
           

        }

        public function selectByParameter($parameter, $value){
            $statement = $this -> bd -> prepare("select * from {$this -> table} where {$parameter} = '{$value}'");
            try{
                $statement -> execute();
                return  $statement -> fetchAll(PDO::FETCH_CLASS);
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }

        }


        public function delete($id){
            $statement = $this -> bd -> prepare("delete from {$this -> table} where nome = '{$id}'");
            //print_r($statement);
            try{
                $statement -> execute();
            }
            catch(Exception $e){
                //throw new Exception($e->getMessage());
                echo 'Falha para cancelar o cadastro: ' . $e->getMessage();
            }

        }

        public function insert($parameters){
            $sql = sprintf(
                'insert into %s (%s) values (%s)',
                $this -> table,
                implode(', ', array_keys($parameters)),
                ':' . implode(', :', array_keys($parameters)) //bindParam com :chave
            );
            

            try{
                $statement = $this -> bd -> prepare($sql);

                $statement -> execute($parameters); //bindParam com vetor
                
            }
            catch(Exception $e){
                //throw new Exception($e->getMessage());
                echo 'Falha na inserção dos dados no banco: ' . $e->getMessage();
            }
        }

        public function update($parameters ){
            $sql = "update {$this -> table}  set ";
            foreach (array_keys($parameters) as $parameter):
                if($parameter != "id"):
                    $sql = $sql . $parameter . "= :" . $parameter . ", ";
                endif;
            endforeach;
            $sql = rtrim($sql, ", ");
            $sql = $sql . " where id = :id";

           
            try{
                $statement = $this -> bd -> prepare($sql);

                $statement -> execute($parameters); //bindParam com vetor
            }
            catch(Exception $e){
                //throw new Exception($e->getMessage());
                echo 'Falha na atualização dos dados no banco: ' . $e->getMessage();
            }

        }

        
        
    }