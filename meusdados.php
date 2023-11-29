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
$id = $_SESSION['codigo'];

if($_SESSION['codigo'])
{
	$acesso = "ok";
	
	//verifica permissao acesso ao id
	if($acesso == "ok")
	{
		if($acao)
		{
			if($acao == "add") {
				$usuarios = new PessoaController();
				$obj = new PessoaModel();

				$usuarios->setNome(trim(addslashes((($_POST['nome'])))));
				$usuarios->setEmail(trim(addslashes((($_POST['email'])))));
				$usuarios->setTelefone(trim(addslashes((($_POST['telefone'])))));
				$usuarios->setNascimento(trim(addslashes((($_POST['nascimento'])))));

				if($_POST['senha'])
				{
					$usuarios->setSenha(md5(trim(addslashes((($_POST['senha']))))));
				}
				else
				{
					$usuarios->setSenha(null);
				}

				if($cod)
				{
					$usuarios->setID($_SESSION['codigo']);
					$retorno = $obj->updateByUser($usuarios);
					if($retorno)
			            echo ("<script>alert('Registro alterado com sucesso!'); window.location=\"principal.php\"</script>");
			        else
			        	echo ("<script>alert('Não foi possível alterar, tente novamente.'); window.location=\"principal.php\"</script>");
				}
				else
				{
					echo ("<script>alert('Opção inválida.'); window.location=\"principal.php\"</script>");
				}
			}
			else
			{
				echo ("<script>alert('Opção inválida.'); window.location=\"principal.php\"</script>");
			}
		}
		else
		{
			if($_SESSION['codigo'])
			{
				$obj = new PessoaModel();
				$dado = $obj->listById($_SESSION['codigo']);

				include_once("sk_usuario.html");
			}
			else
			{
				echo ("<script>alert('Opção inválida.'); window.location=\"principal.php\"</script>");
			}
		}
	}
	else
	{
		echo ("<script>alert('Você não tem permissão para acessar esse registro.'); window.location=\"usuario.php?cod=$id&acao=edit\"</script>");
	}
}
else
{
	echo ("<script>alert('Você precisa estar logado.'); window.location=\"index.php\"</script>");
}

?>