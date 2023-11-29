<?php 
session_start();

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$PATH = "/home//domains/public_html/salao_smart/";
include_once($PATH."model/AgendaModel.php");
include_once($PATH."model/PessoaModel.php");
include_once($PATH."common/common.php");
include_once($PATH."pai.php");

$data = trim(addslashes(($_POST['data'])));
$id_pessoa = trim(addslashes(($_POST['id_pessoa'])));

$acao = trim(addslashes(($_GET['acao'])));
$cod = trim(addslashes(($_GET['cod'])));

if($_SESSION['codigo'])
{
	$objP = new PessoaModel();
	$objA = new AgendaModel();

	if($acao == "reserva")
	{
		$agendas = new AgendaController();

		$agendas->setId(trim(addslashes((($cod)))));
		$agendas->setStatus(1);
		$agendas->setIdCliente(trim(addslashes((($_SESSION['codigo'])))));
		$retorno = $objA->updateStatus($agendas);

		if($retorno)
            echo ("<script>alert('Agendamento realizado com sucesso!'); window.location=\"principal.php\"</script>");
        else
        	echo ("<script>alert('Não foi possível realizar o agendamento, tente novamente.'); window.location=\"agendamentos.php\"</script>");
	}

	$profissionais = $objP->listAll(0, 9999, null, 3);
	$periodos = $objA->agrupamentoDatas();

	$dados = $objA->listLivres($id_pessoa, $data);

	require_once 'sk_agendamento.html';
}
else
{
	echo ("<script>alert('Você precisa estar logado.'); window.location=\"index.php\"</script>");
}

?>