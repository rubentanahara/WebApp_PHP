<?php
//INSERT INTO `cursos` (id, nombre) VALUES (1, 'Aprende Bash');
//INSERT INTO `cursos` (id, nombre) VALUES (2, 'Aprende Python');
//INSERT INTO `cursos` (id, nombre) VALUES (3, 'Aprende PHP');
include_once('../configuraciones/bd.php');
$conexionBD = BD::crearInstancia();

print_r($_POST);
