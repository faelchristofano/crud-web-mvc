<?php
include_once CONEXAO;
class Cidade {
    //put your code here
    private $conn;
    
    public function __construct() {
        $instance = Conexao::getInstance();        
        $this->conn = $instance->getConnection();
    }    
    
    public function busca($search, $orderby, $direcao, $start, $length){
        try {
                 $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $completaSQL = "ORDER BY ".$orderby." ".$direcao." LIMIT ".$start.", ".$length;
                 $filtro = $this->trataFiltroAtivo($search);
                 $sql =  "SELECT c.id, c.nome as cidade, uf.nome as uf 
                           FROM cidade as c
                           INNER JOIN uf ON c.uf_id = uf.id "
                         .$filtro." ".$completaSQL;
                 //$stmt = $this->clausulaWhere($search, $orderby, $direcao, $start, $length, $rAtivo);           
                 $create = $this->conn->prepare($sql);
                 $create->execute();
    
             return $create->fetchAll(PDO::FETCH_OBJ);            
         } catch (Exception $ex) {
             //se deu erro na consulta
             return false;
         }
     }
   
     private function trataFiltroAtivo($search){
         if($search != "") {
             return "where c.nome like '%$search%' or uf.nome like '%$search%'";
         }else {
             return "";
         }
     }
     public function retornaLinhas($search){
         try {
             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             //$completaSQL = "ORDER BY ".$orderby." ".$direcao." LIMIT ".$start.", ".$length;
             $filtro = $this->trataFiltroAtivo($search);
             $sql =  "SELECT count(*) as qtdeLinhas 
                       FROM cidade as c
                         INNER JOIN uf ON c.uf_id = uf.id ".$filtro;
             //$stmt = $this->clausulaWhere($search, $orderby, $direcao, $start, $length, $rAtivo);           
             $create = $this->conn->prepare($sql);
             $create->execute();
     
              return $create->fetch(PDO::FETCH_OBJ);            
          } catch (Exception $ex) {
              //se deu erro na consulta
              return false;
          }
      }
    public function buscaTodos(){

       try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT cidade.id as idcidade, cidade.nome as cidade, uf.id as iduf, uf.nome as uf 
                        FROM cidade, uf 
                        where uf.id = cidade.uf_id ORDER BY cidade.nome";
                $create = $this->conn->prepare($sql);;
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
            $sql = "SELECT cidade.id as idcidade, cidade.nome as cidade, uf.id as iduf, uf.nome as uf 
                        FROM cidade, uf 
                        where uf.id = cidade.uf_id and cidade.id = ?
                        ORDER BY cidade.nome";
            $create = $this->conn->prepare($sql);;
            $create->bindValue('1',$id);
            $create->execute();

            return $create->fetch(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            //se deu erro na consulta
            return false;
        }
    }

    public function delete($id){
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM cidade where id = ?";
            $create = $this->conn->prepare($sql);;
            $create->bindValue('1',$id);
            return $create->execute();
        } catch (Exception $ex) {
            //se deu erro na remoção
            return false;
        }
    }

    public function insert($dados){
        try{
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO cidade 
                    (nome, uf_id) values
                    (?,?)";
            $create = $this->conn->prepare($sql);;
            $create->bindValue('1',$dados['cidade']);
            $create->bindValue('2',$dados['uf']);

            return $create->execute();

        } catch (Exception $ex) {
            return false;
        }

    }

    public function update($dados){
        try{
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE cidade SET nome = ?, uf_id = ?
                    WHERE id = ?";
            $create = $this->conn->prepare($sql);;
            $create->bindValue('1',$dados['cidade']);
            $create->bindValue('2',$dados['uf']);
            $create->bindValue('3',$dados['id']);

            return $create->execute();

        } catch (Exception $ex) {
            return false;
        }

    }
   
    
}