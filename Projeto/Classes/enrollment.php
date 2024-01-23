<?php
require_once __DIR__ . "/../Models/BDConnector.php";
class Enrollment{
    private $_id_aluno;
    private $_id_curso;
    private $_data;
    public function setIdAluno($id_aluno){
        $this->_id_aluno = $id_aluno;
    }
    public function getIdAluno(){
        return $this->_id_aluno;
    }
    public function setIdCurso($id_curso){
        $this->_id_curso = $id_curso;
    }
    public function getIdCurso(){
        return $this->_id_curso;
    }
    public function setData(){
        $this->_data = date("Y/m/d");
    }
    public function getData(){
        return $this->_data;
    }
    public function createEnrollment(){
        $bd = new BDConnector();
        $comando = "INSERT INTO enrollments (UserID, CourseID, EnrollmentDate) VALUES ('$this->_id_aluno', '$this->_id_curso', '$this->_data')";
        $resultado = mysqli_query($bd->connection, $comando);

    }
    public function deleteEnrollment(){
        $bd = new BDConnector();
        $comando = "DELETE FROM enrollments WHERE id_aluno = '$this->_id_aluno' AND id_curso = '$this->_id_curso'";
        $bd->executarSQL($comando);
    }
    public function listEnrollment(){
        $bd = new BDConnector();
        $comando = "SELECT * FROM enrollments WHERE id_aluno = '$this->_id_aluno'";
        $container = $bd->executarSQL($comando);
        return $container;
    }
    public function listEnrollmentByCourse(){
        $bd = new BDConnector();
        $comando = "SELECT * FROM enrollments WHERE id_curso = '$this->_id_curso'";
        $container = $bd->executarSQL($comando);
        return $container;
    }
}
?>