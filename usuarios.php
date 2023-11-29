<?php 
session_start();

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$PATH = "/home//domains/public_html/salao_smart/";
include_once($PATH."model/PessoaModel.php");
include_once($PATH."common/common.php");
include_once($PATH."pai.php");

$filtro = trim(addslashes(($_GET['filtro'])));
$filtro_pesquisa = trim(addslashes(($_GET['filtro_pesquisa'])));

if($_SESSION['codigo'] && (($_SESSION['tipo'] == "2") ))
{
	//paginação
	$limite = 20;
	$pagina = trim(addslashes(($_GET['pag'])));
	if(!isset($pagina) || $pagina == ''){
		$pagina = 1;
	}
	$inicio = ($pagina * $limite) - $limite;

	$dado = new PessoaModel();

	if($_SESSION['tipo'] == "2")
	{
		$total_registros = $dado->contador($filtro_pesquisa, converteTipo($filtro));
		$total_paginas = ceil($total_registros / $limite);

		$dados = $dado->listAll($inicio, $limite, $filtro_pesquisa, converteTipo($filtro));
	}

	$primeira =  "<a href='usuarios.php?filtro_pesquisa=".$filtro_pesquisa."&pag=1' style='color:#9b9b9b'>Primeira página</a>";

	// Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
	if ( $pagina > 1) { 
		$anterior =  "<a href=usuarios.php?filtro_pesquisa=".$filtro_pesquisa."&pag=".($pagina-1)." style='color:#111111'>Página anterior</a>";
		$pag_ant = '<a href="usuarios.php?filtro_pesquisa='.$filtro_pesquisa.'&pag='.($pagina-1).'" style="color:#111111"> '.($pagina-1).'</a>'; // Escreve o número e o link da página
	} else { 
		$anterior = "<font color=#9b9b9b>Página anterior</font>";
	}

	$pag_atual = "<font color=#000000>".$pagina."</font>"; // Escreve somente o número da página sem ação alguma

	// Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
	if (($pagina) < $total_paginas) { 
		$proximo = "<a href=usuarios.php?filtro_pesquisa=".$filtro_pesquisa."&pag=".($pagina+1)." style='color:#111111'>Próxima Página</a>";
		$pag_prox = '<a href="usuarios.php?filtro_pesquisa='.$filtro_pesquisa.'&pag='.($pagina+1).'" style="color:#111111"> '.($pagina+1).'</a>'; // Escreve o número e o link da página
	} else { 
		$proximo = "<font color=#9b9b9b>Próxima Página</font>";
	}

	$ultima =  "<a href='usuarios.php?filtro_pesquisa=".$filtro_pesquisa."pag=".$total_paginas."'><font color=#9b9b9b>Última página</font></a>";

	require_once 'sk_usuarios.html';
}
else
{
	echo ("<script>alert('Você precisa estar logado.'); window.location=\"index.php\"</script>");
}

?>