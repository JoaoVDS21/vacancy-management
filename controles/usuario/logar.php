<?php
    require_once "../../classes/Usuario.php";
    if (isset($_POST['login'], $_POST['senha'])){
        foreach ($_POST as $key => $value){
            $$key = $value;
        }
        $objUsuario = new Usuario();
        $objUsuario->setLogin($login);
        $objUsuario->setSenha($senha);

        if ($objUsuario->logar()){
            header('Location: ../../panel.php');
        } else {
            ?>
            <script >
                alert("Email ou Senha inválidos!");
            </script>
            <meta http-equiv="refresh" content="0; url=../../index.php">
            <?php
        }
    } else {
        ?>
        <script >
            alert("Campos inválidos!");
        </script>
        <meta http-equiv="refresh" content="0; url=../../index.php">
        <?php
    }
?>