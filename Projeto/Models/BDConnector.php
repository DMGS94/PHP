<?php

require_once __DIR__ . "/bd_config.php";

class BDConnector {
    private $isOn = false;
    public $connection;

    //Constructor
    public function __construct() {
        //Abrir a Base de Dados
        $this->connect();
    }

    //Destrutor
    public function __destruct() {
        $this->disconnect();
    }

    function connect() {
        if($this->isOn === true) return;
        $this->isOn = true;
        $this->connection = mysqli_connect(BD_ENDERECOSRV, BD_UTILIZADOR, BD_SENHA, BD_NOME);
        return;
    }  
    
    function disconnect() {
        if ($this->isOn === true) {
            mysqli_close($this->connection);
            $this->isOn = false;
            $this->connection = null;
        }
    }
}
?>