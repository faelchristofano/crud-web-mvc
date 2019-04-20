<?php


class Conexao {
    //put your code here
    private $conn;
    private static $instance = null;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $name = 'oficina2'; 

    // The db connection is established in the private constructor.
    private function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host};
        dbname={$this->name};charset=utf8", $this->user,$this->pass,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    
    public static function getInstance()
    {
        if(!self::$instance)
        {
        self::$instance = new Conexao();
        }
    
        return self::$instance;
    }
    
    public function getConnection()
    {
        return $this->conn;
    }
    /*
    public function __construct(){
        //se ainda não existir conexao com o banco
        if(!isset($this->instancia)){
            try { //tenta fazer a conexao, se não acontencer a conexao vai para o catch
                $this->instancia = new PDO('mysql:host=localhost;dbname=oficina;charset=utf8','root','');
              
              //  var_dump($this->instancia);
            } catch (Exception $ex) {
                echo "Não foi possivel realizar a conexao" . $ex->getMessage();
            }
        }

        
        
   }
   
   public function getInstancia(){
        return $this->instancia;
   }
   */
}

