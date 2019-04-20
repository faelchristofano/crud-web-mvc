<?php
include_once CONEXAO;
class Uf {
    //put your code here
    public $conn;
    
    public function __construct() {
        $instance = Conexao::getInstance();        
        $this->conn = $instance->getConnection();
    }     
    public function busca()
    {

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM uf ORDER BY nome";
            $create = $this->conn->prepare($sql);
            $create->execute();

            return $create->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            //se deu erro na consulta
            return false;
        }
    }

    public function buscaId($id){

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM uf id = ?";
            $create = $this->conn->prepare($sql);
            $create->bindValue('1',$id);
            $create->execute();

            return $create->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            //se deu erro na consulta
            return false;
        }
    }
}

