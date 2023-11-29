<?php 
session_start();

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$PATH = "/home//domains/public_html/salao_smart/";
include_once($PATH."model/AgendaModel.php");
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

	$objP = new PessoaModel();
	$profissionais = $objP->listAll(0, 9999, null, 3);
	
	//verifica permissao acesso ao id
	if($acesso == "ok")
	{
		if($acao)
		{
			if($acao == "delet")
			{
				if($cod)
				{
					$dado = new AgendaModel();
			        $retorno = $dado->remove($cod);

			        if($retorno)
			        	echo ("<script>alert('Registro excluido com sucesso!'); window.location=\"agendas.php\"</script>");
			        else
			        	echo ("<script>alert('Não foi possível excluir, tente novamente.'); window.location=\"agendas.php\"</script>");
				}
			}
			elseif($acao == "cad") 
			{
				$dado = new AgendaController();
				$dado->setID(null);
				$dado->setIdPessoa(null);
				$dado->setData(null);
				$dado->setHoraInicio(null);
				$dado->setStatus(null);
				$dado->setHoraFinal(null);

				include_once("sk_agenda.html");
			}
			elseif($acao == "add") {
				$agendas = new AgendaController();
				$obj = new AgendaModel();

				$agendas->setIdPessoa(trim(addslashes((($_POST['id_pessoa'])))));
				$agendas->setData(trim(addslashes((($_POST['data'])))));
				$agendas->setStatus(trim(addslashes((($_POST['status'])))));
				$agendas->setHoraInicio(trim(addslashes((($_POST['hora_inicio'])))));
				$agendas->setHoraFinal(trim(addslashes((($_POST['hora_final'])))));

				if($cod)
				{
					$agendas->setID($cod);
					$retorno = $obj->update($agendas);
					if($retorno)
			            echo ("<script>alert('Registro alterado com sucesso!'); window.location=\"agendas.php\"</script>");
			        else
			        	echo ("<script>alert('Não foi possível alterar, tente novamente.'); window.location=\"agendas.php\"</script>");
				}
				else
				{
					$retorno = $obj->save($agendas);
			        if($retorno)
			            echo ("<script>alert('Registro incluido com sucesso!'); window.location=\"agendas.php\"</script>");
			        else
			        	echo ("<script>alert('Não é possível incluir itens iguais, tente novamente.'); window.location=\"agendas.php\"</script>");
		    	}
			}
			elseif($acao == "edit") {
				if($cod)
				{
					$obj = new AgendaModel();
					$dado = $obj->listById($cod);

					include_once("sk_agenda.html");
				}
			}
			else
			{
				echo ("<script>alert('Opção inválida.'); window.location=\"agendas.php\"</script>");
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