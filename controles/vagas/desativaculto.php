<?php

require_once "../../classes/Conexao.php";
require_once "../../classes/Inscricao.php";

$con = new Conexao();
$sql = $con->conectar()->query("UPDATE vagas SET ativo = 0 WHERE idvaga = 2");

$objInsc = new Inscricao;
$objInsc->deleteAllManha();

?>
<script>
    alert("Culto desativado com sucesso!");
</script>
<meta http-equiv="refresh" content="0; url=../../panel.php">