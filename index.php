<?php

require_once("config.php");

//$pfilho = new Usuario();

//$pfilho->loadByidusuario(1);

//$pfilho = Usuario::search("pf");

//echo json_encode($pfilho);

//$pfilho->login("pfilho","1255255");

//echo $pfilho;

$aluno = new Usuario();

$aluno->setVar_email("pfilho@leiriadeandarde.com.br");
$aluno->setVar_nome("Pedro Sergio");
$aluno->setVar_login("pedro");
$aluno->setVar_senha("123456");
$aluno->setInt_grupousuario("1");
$aluno->setInt_idempresa("2");
$aluno->setInt_idprofissional("3");
$aluno->setInt_idundorganizacional("4");
$aluno->setDt_cadastro("2021-07-30 00:00:00");
$aluno->setBol_ativo(1);

$aluno->insert();

echo $aluno;

?>