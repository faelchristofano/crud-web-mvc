<?php
include_once CONEXAO;
class Cliente {
    //put your code here
    public $conn;
    
    public function __construct() {
        $instance = Conexao::getInstance();        
        $this->conn = $instance->getConnection();

    }     
    private function length($start, $length){
        if($length != -1){
            return " LIMIT ".$start.", ".$length;
        } else {
            return " ";
        }
    } 
    public function busca($search, $orderby, $direcao, $start, $length, $rAtivo){
       try {
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $completaSQL = "ORDER BY ".$orderby." ".$direcao. $this->length($start, $length);
                $filtro = $this->trataFiltroAtivo($search, $rAtivo);
                $sql =  "SELECT cl.*, COALESCE(cl.cpf,cl.cnpj) as documento, c.nome as cidade, uf.nome as uf
                        FROM cliente as cl
                            INNER JOIN cidade as c ON c.id = cl.cidade_id
                            INNER JOIN uf ON uf.id = c.uf_id ".$filtro." ".$completaSQL;
                //$stmt = $this->clausulaWhere($search, $orderby, $direcao, $start, $length, $rAtivo);           
                $create = $this->conn->prepare($sql);
                $create->execute();
   
            return $create->fetchAll(PDO::FETCH_OBJ);            
        } catch (Exception $ex) {
            //se deu erro na consulta
            return $ex;
        }
    }
    public function buscaCPFouCNPJ($doc){

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT id FROM CLIENTE WHERE cpf = ? or cnpj = ?";
            $create = $this->conn->prepare($sql);;
            $create->bindValue('1',$doc);
            $create->bindValue('2',$doc);
            $create->execute();

            return $create->fetch(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            //se deu erro na consulta
            return false;
        }
    }
    public function buscaEmail($email){

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT id FROM CLIENTE WHERE email = ?";
            $create = $this->conn->prepare($sql);
            $create->bindValue('1',$email);
            $create->execute();

            return $create->fetch(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            //se deu erro na consulta
            return false;
        }
    }
    private function trataFiltroAtivo($search, $rAtivo){
        if($rAtivo != "" and $search != ""){
            return "where ativo = '$rAtivo' and (cl.nome like '%$search%' 
                    or cpf like '%$search%' or cnpj like '%$search%' or telefone like '%$search%'
                    or celular like '%$search%')";
        } else if($rAtivo != "" and $search == "") {
            return "where ativo = '$rAtivo'";
        } else if($rAtivo == "" and $search != "") {
            return "where cl.nome like '%$search%' 
                    or cpf like '%$search%' or cnpj like '%$search%' or telefone like '%$search%' 
                    or celular like '%$search%'";
        }else if($rAtivo == "" and $search == "") {
            return "";
        }
    }
    public function retornaLinhas($search, $rAtivo){
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$completaSQL = "ORDER BY ".$orderby." ".$direcao." LIMIT ".$start.", ".$length;
            $filtro = $this->trataFiltroAtivo($search, $rAtivo);
            $sql =  "SELECT count(*) as qtdeLinhas
                FROM cliente as cl ".$filtro;
            //$stmt = $this->clausulaWhere($search, $orderby, $direcao, $start, $length, $rAtivo);           
            $create = $this->conn->prepare($sql);
            $create->execute();
    
             return $create->fetch(PDO::FETCH_OBJ);            
         } catch (Exception $ex) {
             //se deu erro na consulta
             return false;
         }
     }


    
    public function buscaId($id){
        
       try {
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT *
                         FROM cliente where id = ?";
                $create = $this->conn->prepare($sql);
                $create->bindValue('1',$id);
                $create->execute();
   
            return $create->fetch(PDO::FETCH_OBJ);            
        } catch (Exception $ex) {
            //se deu erro na consulta
            return false;
        }
    }

    public function buscaNome($nome){

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT *
                         FROM cliente where nome like ? and ativo = 1 limit 15";
            $create = $this->conn->prepare($sql);
            $create->bindValue('1','%'.$nome.'%');
            $create->execute();

            return $create->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            //se deu erro na consultas
            return false;
        }
    }
    public function delete($id){
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM cliente where id = ?";
            $create = $this->conn->prepare($sql);
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
            $sql = "INSERT INTO cliente 
                    (nome, tipo, cpf, rg, cnpj, ie, telefone, celular, endereco, nro, 
                     complemento, bairro, cep, cidade_id, data_cad, datanasc, email, ativo) values
                    (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $create = $this->conn->prepare($sql);
            $create->bindValue('1',$dados['nome']);
            $create->bindValue('2',$dados['tipo']);
            $create->bindValue('3', isset($dados['cpf']) ? $dados['cpf'] : null);
            $create->bindValue('4',isset($dados['rg']) ? $dados['rg'] : null);
            $create->bindValue('5',isset($dados['cnpj']) ? $dados['cnpj'] : null);
            $create->bindValue('6',isset($dados['ie']) ? $dados['ie'] : null);
            $create->bindValue('7',$dados['telefone']);
            $create->bindValue('8',$dados['celular']);
            $create->bindValue('9',$dados['endereco']);
            $create->bindValue('10',$dados['nro']);
            $create->bindValue('11',$dados['complemento']);
            $create->bindValue('12',$dados['bairro']);
            $create->bindValue('13',$dados['cep']);
            if($dados['cidade'] == ""){
                $create->bindValue('14',NULL);
            } else {
                $create->bindValue('14',$dados['cidade']);
            }

            $create->bindValue('15',date('Y-m-d'));
            $create->bindValue('16',isset($dados['datanasc']) ? date('Y-m-d', strtotime(str_replace('/','-',$dados['datanasc']))) : null);
            $create->bindValue('17',$dados['email']);
            $create->bindValue('18',$dados['ativo']);

            return $create->execute();
                
        } catch (Exception $ex) {
            return false;
        }
        
    }

    public function update($dados){
        try{
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE cliente SET nome = ?, tipo = ?, cpf = ?, rg = ?, cnpj = ?, ie = ?, telefone = ?,
                                      celular = ?, endereco = ?, nro = ?, complemento = ?, bairro = ?,
                                       cep = ?, cidade_id = ?, datanasc = ?, email = ?, ativo = ?
                    WHERE id = ?";
               
            $create = $this->conn->prepare($sql);
            $create->bindValue('1',$dados['nome']);
            $create->bindValue('2',$dados['tipo']);
            $create->bindValue('3', isset($dados['cpf']) ? $dados['cpf'] : null);
            $create->bindValue('4',isset($dados['rg']) ? $dados['rg'] : null);
            $create->bindValue('5',isset($dados['cnpj']) ? $dados['cnpj'] : null);
            $create->bindValue('6',isset($dados['ie']) ? $dados['ie'] : null);
            $create->bindValue('7',$dados['telefone']);
            $create->bindValue('8',$dados['celular']);
            $create->bindValue('9',$dados['endereco']);
            $create->bindValue('10',$dados['nro']);
            $create->bindValue('11',$dados['complemento']);
            $create->bindValue('12',$dados['bairro']);
            $create->bindValue('13',$dados['cep']);
            if($dados['cidade'] == ""){
                $create->bindValue('14',NULL);
            } else {
                $create->bindValue('14',$dados['cidade']);
            }
            $create->bindValue('15',isset($dados['datanasc']) ? date('Y-m-d', strtotime(str_replace('/','-',$dados['datanasc']))) : null);
            $create->bindValue('16',$dados['email']);
            $create->bindValue('17',$dados['ativo']);
            $create->bindValue('18',$dados['id']);

            return $create->execute();

        } catch (Exception $ex) {
            return false;
        }

    }
}
