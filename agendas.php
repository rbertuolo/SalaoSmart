<?php 
session_start();

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$PATH = "/home//domains/public_html/salao_smart/";
include_once($PATH."model/PessoaModel.php");
include_once($PATH."model/AgendaModel.php");
include_once($PATH."common/common.php");
include_once($PATH."pai.php");

$data = trim(addslashes(($_POST['data'])));
$id_pessoa = trim(addslashes(($_POST['id_pessoa'])));

if($_SESSION['codigo'] && (($_SESSION['tipo'] == "2") ))
{
	$objP = new PessoaModel();
	$objA = new AgendaModel();

	$profissionais = $objP->listAll(0, 9999, null, 3);
	$periodos = $objA->agrupamentoDatas();

	if($id_pessoa || $data)
	{
		$dados = $objA->listAll($id_pessoa, $data);
	}

	require_once 'sk_agendas.html';
}
else
{
	echo ("<script>alert('Você precisa estar logado.'); window.location=\"index.php\"</script>");
}

?>