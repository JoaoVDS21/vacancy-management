<?php
require_once "../../classes/Vaga.php";

if (isset($_POST['qtd'])){
    foreach($_POST as $key => $value){
        $$key = $value;
    }

    $objQtd = new Vaga();
    $objQtd->setQuantidade($qtd);
    if(isset($culto)){
        $objQtd->adicionar($culto);   
    } else {
        $culto = 1;
        $objQtd->adicionar($culto);
    }
}
?>
<script>
alert("Vagas adicionadas com sucesso!");
</script>
<meta http-equiv="refresh" content="0; url=../../panel.php">
