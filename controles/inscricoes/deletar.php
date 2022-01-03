<?php
require_once "../../classes/Inscricao.php";

$id = (int)$_GET['id'];

$objInsc = new Inscricao();
$objInsc->setIdinscricao($id);
$objInsc->deletar();

?>
<script>alert("Inscrição excluída com sucesso!")</script>
<meta http-equiv="refresh" content="0; url=../../panel.php">