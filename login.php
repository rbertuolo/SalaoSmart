<?php 
session_start();

$PATH = "/home//domains/public_html/salao_smart/";
include_once($PATH."model/PessoaModel.php");
include_once($PATH."pai.php");

$email = trim($_POST['email']);
$senha = trim(md5($_POST['senha']));

if($email && $senha)
{
	$usuario = new PessoaController();
	$obj = new PessoaModel();

	$usuario->setEmail($email);
	$usuario->setSenha($senha);

	$dado = $obj->login($usuario);

	if($dado)
	{
		//ADMINISTRADOR
		$_SESSION['codigo'] = $dado->getId();
		$_SESSION['tipo'] = $dado->getTipo();
		$_SESSION['nome'] = $dado->getNome();

		header ("Location: principal.php");	
		exit();
	}
	else 
	{
		$sk['MSG'] = "<font color='red'>Email e/ou senha não encontrados.</font>";
		include_once("sk_login.html");
	}
}
else 
{
	include_once("sk_login.html");
}

?>