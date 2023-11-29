<?php 
session_start();

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$PATH = "/home//domains/public_html/salao_smart/";
include_once($PATH."model/PessoaModel.php");
include_once($PATH."common/common.php");
include_once($PATH."pai.php");

date_default_timezone_set('America/Los_Angeles');

$cod = trim(addslashes((($_GET['cod']))));
$acao = trim(addslashes((($_GET['acao']))));

if($acao == "add")
{
	$usuarios = new PessoaController();
	$obj = new PessoaModel();

	$usuarios->setNome(trim(addslashes((($_POST['nome'])))));
	$usuarios->setEmail(trim(addslashes((($_POST['email'])))));
	$usuarios->setTelefone(trim(addslashes((($_POST['telefone'])))));
	$usuarios->setNascimento(trim(addslashes((($_POST['nascimento'])))));
	$usuarios->setStatus(2);
	$usuarios->setTipo("1");

	if($_POST['senha'])
	{
		$usuarios->setSenha(md5(trim(addslashes((($_POST['senha']))))));
	}
	else
	{
		$usuarios->setSenha(null);
	}

	$retorno = $obj->save($usuarios);

    if($retorno)
    {
    	//faz login
    	$_SESSION['codigo'] = $retorno;
		$_SESSION['tipo'] = "1";
		$_SESSION['nome'] = trim(addslashes((($_POST['nome']))));

        echo ("<script>alert('Registro incluido com sucesso!'); window.location=\"principal.php\"</script>");
    }
    else 
    {
    	echo ("<script>alert('Não é possível incluir itens iguais, tente novamente.'); window.location=\"usuarios.php\"</script>");
    }
}
else
{
	include_once("sk_cadastro.html");
}

?>