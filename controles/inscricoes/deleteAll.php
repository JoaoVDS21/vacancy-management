<?php
    require_once "../../classes/Inscricao.php";

    $objInsc = new Inscricao;
    $objInsc->deleteAll();
?>
<script>alert("Limpeza feita com sucesso!")</script>
<meta http-equiv="refresh" content="0; url=../../panel.php">