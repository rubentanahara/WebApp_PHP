<?php
include_once '../configuraciones/bd.php';
$conn = BD::crearInstancia();

$id = isset($_POST["id"]) ? $_POST["id"] : '';
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
$apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : '';

$cursos_ids = isset($_POST["cursos"]) ? $_POST["cursos"] : ''; // array
$accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

if ($accion != "") {

   switch ($accion) {
      case "agregar":

         $sql = "INSERT INTO alumnos(id,nombre, apellidos) VALUES (NULL,:nombre,:apellidos)";
         $sentencia = $conn->prepare($sql);
         $sentencia->bindParam(":nombre", $nombre);
         $sentencia->bindParam(":apellidos", $apellidos);
         $sentencia->execute();

         $alumno_id = $conn->lastInsertId();

         foreach ($cursos_ids as $curso_id) {
            $sql = "INSERT INTO alumnos_cursos(id_alumno, id_curso) VALUES (:id_alumno,:id_curso)";
            $sentencia = $conn->prepare($sql);
            $sentencia->bindParam(":id_alumno", $alumno_id);
            $sentencia->bindParam(":id_curso", $curso_id);
            $sentencia->execute();
         }
         break;
      case "editar":
         $sql = "UPDATE alumnos SET nombre=:nombre, apellidos=:apellidos WHERE id=:id";
         $sentencia = $conn->prepare($sql);
         $sentencia->bindParam(":nombre", $nombre);
         $sentencia->bindParam(":apellidos", $apellidos);
         $sentencia->bindParam(":id", $id);
         $sentencia->execute();

         if (isset($cursos_ids)) {
            $sql = "DELETE FROM alumnos_cursos WHERE id_alumno=:id_alumno";
            $sentencia = $conn->prepare($sql);
            $sentencia->bindParam(":id_alumno", $id);
            $sentencia->execute();

            foreach ($cursos_ids as $curso_id) {

               $sql = "INSERT INTO alumnos_cursos(id_alumno, id_curso) VALUES (:id_alumno,:id_curso)";
               $sentencia = $conn->prepare($sql);
               $sentencia->bindParam(":id_alumno", $id);
               $sentencia->bindParam(":id_curso", $curso_id);
               $sentencia->execute();
            }
            $arregloCursos=$$cursos_ids;
         }
         break;
      case "borrar":
         $sql = "DELETE FROM alumnos_cursos WHERE id_alumno=:id_alumno";
         $sentencia = $conn->prepare($sql);
         $sentencia->bindParam(":id_alumno", $id);
         $sentencia->execute();

         $sql = "DELETE FROM alumnos WHERE id=:id";
         $sentencia = $conn->prepare($sql);
         $sentencia->bindParam(":id", $id);
         $sentencia->execute();

         $id = "";
         $nombre = "";
         $apellidos = "";
         $cursos_ids = [];

         break;
      case 'Seleccionar':
         $sql = "SELECT * FROM alumnos WHERE id=:id";
         $consulta = $conn->prepare($sql);
         $consulta->bindParam(':id', $id);
         $consulta->execute();
         $alumno = $consulta->fetch(PDO::FETCH_ASSOC);

         $nombre = $alumno['nombre'];
         $apellidos = $alumno['apellidos'];

         $sql = "SELECT cursos.id FROM alumnos_cursos
         INNER JOIN cursos ON cursos.id = alumnos_cursos.id_curso
         WHERE alumnos_cursos.id_alumno=:id_alumno";

         $consulta = $conn->prepare($sql);
         $consulta->bindParam(':id_alumno', $id);
         $consulta->execute();
         $cursosAlumno = $consulta->fetchAll(PDO::FETCH_ASSOC);

         foreach ($cursosAlumno as $curso) {
            $arregloCursos[] = $curso['id'];
         }
         break;
   }
}


$sql = "SELECT * FROM alumnos";
$listaAlumnos = $conn->query($sql);
$alumnos = $listaAlumnos->fetchAll();

foreach ($alumnos as $clave => $alumno) {

   $sql = "SELECT * FROM cursos WHERE id IN (SELECT id_curso FROM alumnos_cursos WHERE id_alumno=:id_alumno)";
   $sentencia = $conn->prepare($sql);
   $sentencia->bindParam(":id_alumno", $alumno["id"]);
   $sentencia->execute();
   $cursosAlumnos = $sentencia->fetchAll();
   $alumnos[$clave]["cursos"] = $cursosAlumnos;
}

$sql = "SELECT * FROM cursos";
$listaCursos = $conn->query($sql);
$cursos = $listaCursos->fetchAll();

//print_r($cursos);
