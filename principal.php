<?php
session_start();

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$PATH = "/home//domains/public_html/salao_smart/";
include_once($PATH."model/PessoaModel.php");
include_once($PATH."model/AgendaModel.php");
include_once($PATH."pai.php");

if($_SESSION['codigo'] && (($_SESSION['tipo'] == "1") || ($_SESSION['tipo'] == "2") ))
{
	$objP = new PessoaModel();
	$objA = new AgendaModel();

	if($_SESSION['tipo'] == "2") 
	{
		//adm
		$clientes = $objP->contador('', 1);
		$profissionais = $objP->contador('', 3);
	}
	if($_SESSION['tipo'] == "1") 
	{
		//cliente
	}

	$agendamentos = $objA->quantidadeAgendamentos($_SESSION['codigo']);

	include_once("sk_principal.html");
}
else
{
	echo ("<script>alert('Você precisa estar logado.'); window.location=\"index.php\"</script>");
}

?>