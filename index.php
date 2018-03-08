<?php

require_once ("config.php");

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);*/

//traz um único usuário do BD
/*$root = new Usuario();
$root->loadById(10);
echo $root;*/

//Traz a lista de usuarios do BD
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuários bucando pelo login
//$search = Usuario::search("carmo");

//echo json_encode($search);

//Carrega um usuario e senha validados
$usuario = new Usuario();
$usuario->login("Maria", "12345");


echo $usuario;
?>