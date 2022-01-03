<?php

require_once "../../classes/Conexao.php";

$con = new Conexao();
$sql = $con->conectar()->query("UPDATE vagas SET ativo = 1 WHERE idvaga = 2");
?>
<script>
    alert("Culto habilitado com sucesso!");
</script>
<meta http-equiv="refresh" content="0; url=../../panel.php">