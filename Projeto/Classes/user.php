<?php
require_once __DIR__ . "/../Models/BDConnector.php";

class User{

    private $_uid;
    private $_nome;
    private $_email;
    private $_password;
    private $_role;
    private $_func;
    private $_area;
    private $_contacto;
    private $_estado;


// GETTERS AND SETTERS UID
    public function setUid($uid){
        $this->_uid = $uid;
    }
    public function getUid(){
        return $this->_uid;
    }
// GETTERS AND SETTERS NOME
    public function setNome($nome){
        if (strlen($nome) < 3) {
            echo "<h2>Nome inválido</h2>";
            echo "<a href='javascript:history.back()'>Voltar</a>";
            exit;
        }else{
            $this->_nome = $nome;
        }
        
    }
    public function getNome(){
        return $this->_nome;
    }
// GETTERS AND SETTERS EMAIL
    public function setEmail($email){
        $this->_email = $email;
    }
    public function getEmail(): string{
        return $this->_email;
    }
// GETTERS AND SETTERS PASSWORD
    public function setPassword($password){
        if (strlen($password) < 5) {
            return false;
        }
        $this->_password = $password;
    }
    public function getPassword(): string{
        return $this->_password;
    }
// GETTERS AND SETTERS ROLE
    public function setFuncao($funcao){
        if (empty($funcao)) {
            $this->_func = "Sem função";
        }
        $this->_func = $funcao;
    }
    public function getFuncao(): string{
        return $this->_func;
    }
// GETTERS AND SETTERS AREA
    public function setArea($area){
        if (empty($area) || strlen($area) < 3) {
            $this->_area = "Sem área";
        }
        $this->_area = $area;
    }
    public function getArea(): string{
        return $this->_area;
    }
// GETTERS AND SETTERS ROLE
    public function setRole($role){
        if (empty($role) || strlen($role) < 3) {
            $this->_role = "Sem função";
        }
        $this->_role = $role;
    }
    public function getRole(){
        return $this->_role;
    }
// GETTERS AND SETTERS CONTACTO
    public function setContacto($contacto){
        if (is_numeric($contacto) && strlen($contacto) == 9) {
            $this->_contacto = $contacto;
        } else {
            $this->_contacto = "Contacto inválido";
        }
    }
    public function getContacto(): string{
        return $this->_contacto;
    }
// GETTERS AND SETTERS ACTIVE
    public function setActive($estado){
        if (empty($estado) || strlen($estado) > 1 || strlen($estado) < 1) {
            $this->_estado = 0;
        }
        $this->_estado = $estado;
    }
    public function getActive(): int{
        return $this->_estado;
    }


// FUNCTIONS 
    public function createUser() {
        $bd = new BDConnector();
        $comando = "INSERT INTO users (name, email, password, role, active, area, funcao, contacto)  VALUES ('$this->_nome','$this->_email', '$this->_password', '$this->_role', '$this->_estado','$this->_area', '$this->_func', '$this->_contacto')";
        $resultado = mysqli_query($bd->connection, $comando);
        if (!$resultado) {
            die("Erro na criação do utilizador");
        }
        $bd->disconnect();
        return $resultado;
    }

    public function registerUser(){
        $bd = new BDConnector();
        $comando = "INSERT INTO users (name, email, password, area, funcao, contacto)  VALUES ('$this->_nome','$this->_email', '$this->_password', '$this->_area', '$this->_func', '$this->_contacto')";
        $resultado = mysqli_query($bd->connection, $comando);
        if (!$resultado) {
            die("Erro na criação do utilizador");
        }
        $bd->disconnect();
        return $resultado;
    }

    public function listarUsers()
    {
        $bd = new BDConnector();
        $comand = "SELECT * FROM users";
        $listarUsers = mysqli_query($bd->connection, $comand);
        if (!$listarUsers) {
            die("Erro na listagem de utilizadores");
        }
        $bd->disconnect();
        return $listarUsers;
    }

    public function apagarUser(){
        $bd = new BDConnector();
        $comando = "DELETE FROM users WHERE user_id = '$this->_uid'";
        $resultado = mysqli_query($bd->connection, $comando);
        if (!$resultado) {
            die("Erro na eliminação do utilizador");
        }
        $bd->disconnect();
    }

    public function updateUser(){
        $bd = new BDConnector();
        $comando = "UPDATE users SET name = '$this->_nome', email = '$this->_email', area = '$this->_area', funcao = '$this->_func', role = '$this->_role', contacto = '$this->_contacto', active = $this->_estado WHERE user_id = '$this->_uid'";
        $resultado = mysqli_query($bd->connection, $comando);
        if (!$resultado) {
            die("Erro na atualização do utilizador");
        }
        return $resultado;
    }
    public function get($idUser): bool
    {
        $bd = new BDConnector();
        $container = mysqli_query($bd->connection, "SELECT * FROM users WHERE user_id = '$idUser'");
        if (mysqli_num_rows($container) > 0) {
            $row = mysqli_fetch_array($container);
            $this->_uid = $row["user_id"];
            $this->_nome = $row["name"];
            $this->_email = $row["email"];
            $this->_area = $row["area"];
            $this->_func = $row["funcao"];
            $this->_contacto = $row["contacto"];
            $this->_estado = $row["active"];
            return true;
        } else {
            $this->_uid = "";
            return false;
        }
    }

    public function loginUser(){
        $bd = new BDConnector();
        $comando = "SELECT * FROM users WHERE email = '$this->_email' AND password = '$this->_password' AND active = 1";
        $resultado = mysqli_query($bd->connection, $comando);
        //var_dump($resultado);
        $dadosUser = mysqli_fetch_assoc($resultado);
        $bd->disconnect();
        if ($dadosUser != "") {
            $this->_uid = $dadosUser["user_id"];
            $this->_nome = $dadosUser["name"];
            $this->_email = $dadosUser["email"];
            $this->_role = $dadosUser["role"];
            $this->_area = $dadosUser["area"];
            $this->_func = $dadosUser["funcao"];
            $this->_contacto = $dadosUser["contacto"];
            $this->_estado = $dadosUser["active"];
            return $dadosUser;
        }
        else{
            
            echo "<h2>Password inválida</h2>";
            return false;
        }
    }
}
?>