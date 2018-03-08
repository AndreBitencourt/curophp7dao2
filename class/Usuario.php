<?php

class Usuario {
    
    //atriburtos da classe
    private $idusuario;
    private $nome;
    private $senha;
    private $datacadastro;
    
    public function getIdusuario(){
        return $this->idusuario;
    }
    public function setIdusuario($value) {
        $this->idusuario = $value;
    }
    
        public function getNome(){
        return $this->nome;
    }
    public function setNome($value) {
        $this->nome = $value;
    }
    
        public function getSenha(){
        return $this->senha;
    }
    public function setSenha($value) {
        $this->senha = $value;
    }
    
        public function getDataCadastro(){
        return $this->datacadastro;
    }
    public function setDatacadastro($value) {
        $this->datacadastro = $value;
    }
    
    public function loadById($id) {
        
        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));
        
        //if (isset($results[0])){}
        if (count($results)>0){
            $row = $results[0];
            
            $this->setIdusuario($row['idusuario']);
            $this->setNome($row['nome']);
            $this->setSenha($row['senha']);
            $this->setDatacadastro(new DateTime($row['datacadastro']));
        }
    }
    
    //Método
    
    public static function getList(){//métodos estáticos nao precisam ser instanciados
        
        $sql = new Sql();
        
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario");               
        
    }
    
    //Método para buscar usuário pelo login
    public static function search($nome){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE nome LIKE :SEARCH", array(
            ':SEARCH'=>"%".$nome."%"
        ));
    }

    public function login($nome, $senha){
        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE nome = :NOME AND senha = :SENHA",
                array(
                    ":NOME"=>$nome,
                    ":SENHA"=>$senha
                ));
        
        if (count($results)>0){
            $row = $results[0];
            $this->setIdusuario($row['idusuario']);
            $this->setNome($row['nome']);
            $this->setSenha($row['senha']);
            $this->setDatacadastro(new DateTime($row['datacadastro']));
        } else {
            throw new Exception('Nome ou senha incorretos');
        }
        
    }

    public function __toString() {
        
        return json_encode(array(
        
            "idusuario"=> $this->getIdusuario(),
            "nome"=> $this->getNome(),
            "senha"=> $this->getSenha(),
            "datacadastro"=> $this->getDataCadastro()->format("d/m/Y H:i:s")
            
        ));
    }
    
}

?>

