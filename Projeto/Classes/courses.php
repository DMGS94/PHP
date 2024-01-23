<?php
require_once __DIR__ . "/../Models/BDConnector.php";

class Curso{

    private $_cid;
    private $_titulo;
    private $_descricao;
    private $_categoria;
    private $_nivel;


// GETTERS AND SETTERS UID
    public function setCid($cid){
        $this->_cid = $cid;
    }
    public function getCid(){
        return $this->_cid;
    }
// GETTERS AND SETTERS TITULO
    public function setTitulo($titulo){
        $this->_titulo = $titulo;
    }
    public function getTitulo(){
        return $this->_titulo;
    }
// GETTERS AND SETTERS DESCRICAO
    public function setDescricao($descricao){
        $this->_descricao = $descricao;
    }
    public function getDescricao(){
        return $this->_descricao;
    }
// GETTERS AND SETTERS CATEGORIA
    public function setCategoria($categoria){
        $this->_categoria = $categoria;
    }
    public function getCategoria(){
        return $this->_categoria;
    }
// GETTERS AND SETTERS NIVEL
    public function setNivel($nivel){
        $this->_nivel = $nivel;
    }
    public function getNivel(){
        return $this->_nivel;
    }
/* CONSTRUCTOR DA CLASS CURSO

    public function __construct($titulo, $descricao, $categoria, $nivel){
        $this->_titulo = $titulo;
        $this->_descricao = $descricao;
        $this->_categoria = $categoria;
        $this->_nivel = $nivel;
    }
*/
// FUNCTIONS 
    public function createCurso(){
        $bd = new BDConnector();
        $comando = "INSERT INTO curso (titulo, descricao, categoria, nivel) VALUES ('$this->_titulo', '$this->_descricao', '$this->_categoria', '$this->_nivel')";
        $resultado = mysqli_query($bd->connection, $comando);
        if (!$resultado) {
            die("Erro na criação do curso");
        }
        $bd->disconnect();
    }

    public function apagarCurso(){
        $bd = new BDConnector();
        $comando = "DELETE FROM curso WHERE id_curso = '$this->_cid'";
        $resultado = mysqli_query($bd->connection, $comando);
        if (!$resultado) {
            die("Erro na eliminação do curso");
        }
        $bd->disconnect();
    }

    public function updateCurso(){
        $bd = new BDConnector();
        $comando = "UPDATE curso SET titulo = '$this->_titulo', descricao = '$this->_descricao', categoria = '$this->_categoria', nivel = '$this->_nivel' WHERE id_curso = '$this->_cid'";
        $resultado = mysqli_query($bd->connection, $comando);
        if (!$resultado) {
            die("Erro na atualização do curso");
        }
        $bd->disconnect();
    }

    public function listarCurso(){
        $bd = new BDConnector();
        $comando = "SELECT * FROM curso";
        $resultado = mysqli_query($bd->connection, $comando);
        $bd->disconnect();
        return $resultado;
    }
    public function get($idCurso){
        $bd = new BDConnector();
        $comando = "SELECT * FROM curso WHERE id_curso = '$idCurso'";
        $resultado = mysqli_query($bd->connection, $comando);
        $dadosCurso = mysqli_fetch_assoc($resultado);
        $bd->disconnect();
        if ($dadosCurso) {
            $this->_cid = $dadosCurso["id_curso"];
            $this->_titulo = $dadosCurso["titulo"];
            $this->_descricao = $dadosCurso["descricao"];
            $this->_categoria = $dadosCurso["categoria"];
            $this->_nivel = $dadosCurso["nivel"];
        }
        return $dadosCurso;
    }
}
?>