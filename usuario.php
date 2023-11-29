<?php 
session_start();

$PATH = "/home//domains/public_html/salao_smart/";
include_once($PATH."model/PessoaModel.php");
include_once($PATH."common/common.php");
include_once($PATH."pai.php");

date_default_timezone_set('America/Los_Angeles');

$cod = trim(addslashes((($_GET['cod']))));
$acao = trim(addslashes((($_GET['acao']))));
$id = $_SESSION['codigo'];

if($_SESSION['codigo'] && ($_SESSION['tipo'] == "2") )
{
	$acesso = "ok";
	
	//verifica permissao acesso ao id
	if($acesso == "ok")
	{
		if($acao)
		{
			if($acao == "delet")
			{
				if($cod)
				{
					$dado = new PessoaModel();
			        $retorno = $dado->remove($cod);

			        if($retorno)
			        	echo ("<script>alert('Registro excluido com sucesso!'); window.location=\"usuarios.php\"</script>");
			        else
			        	echo ("<script>alert('Não foi possível excluir, tente novamente.'); window.location=\"usuarios.php\"</script>");
				}
			}
			elseif($acao == "cad") 
			{
				$dado = new PessoaController();
				$dado->setID(null);
				$dado->setNome(null);
				$dado->setEmail(null);
				$dado->setSenha(null);
				$dado->setStatus(null);
				$dado->setTipo(null);
				$dado->setTelefone(null);
				$dado->setNascimento(null);
				$dado->setManicure(null);
				$dado->setPedicure(null);
				$dado->setCabelo(null);
				$dado->setMaquiagem(null);

				include_once("sk_usuario.html");
			}
			elseif($acao == "add") {
				$usuarios = new PessoaController();
				$obj = new PessoaModel();

				$usuarios->setNome(trim(addslashes((($_POST['nome'])))));
				$usuarios->setEmail(trim(addslashes((($_POST['email'])))));
				$usuarios->setStatus(trim(addslashes((($_POST['status'])))));
				$usuarios->setTipo(trim(addslashes((($_POST['tipo'])))));
				$usuarios->setTelefone(trim(addslashes((($_POST['telefone'])))));
				$usuarios->setNascimento(trim(addslashes((($_POST['nascimento'])))));
				$usuarios->setManicure(trim(addslashes((($_POST['manicure'])))));
				$usuarios->setPedicure(trim(addslashes((($_POST['pedicure'])))));
				$usuarios->setCabelo(trim(addslashes((($_POST['cabelo'])))));
				$usuarios->setMaquiagem(trim(addslashes((($_POST['maquiagem'])))));

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
					$usuarios->setID($cod);
					$retorno = $obj->update($usuarios);
					if($retorno)
			            echo ("<script>alert('Registro alterado com sucesso!'); window.location=\"usuarios.php\"</script>");
			        else
			        	echo ("<script>alert('Não foi possível alterar, tente novamente.'); window.location=\"usuarios.php\"</script>");
				}
				else
				{
					$retorno = $obj->save($usuarios);
			        if($retorno)
			            echo ("<script>alert('Registro incluido com sucesso!'); window.location=\"usuarios.php\"</script>");
			        else
			        	echo ("<script>alert('Não é possível incluir itens iguais, tente novamente.'); window.location=\"usuarios.php\"</script>");
		    	}
			}
			elseif($acao == "edit") {
				if($cod)
				{
					$obj = new PessoaModel();
					$dado = $obj->listById($cod);

					include_once("sk_usuario.html");
				}
			}
			else
			{
				echo ("<script>alert('Opção inválida.'); window.location=\"usuarios.php\"</script>");
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