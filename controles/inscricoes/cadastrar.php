<?php
require_once "../../classes/Inscricao.php";
require_once "../../classes/Conexao.php";

$con = new Conexao();
$sql = $con->conectar()->query("SELECT * FROM vagas WHERE idvaga = 1");
$vagasNoite = $sql->fetch(PDO::FETCH_OBJ);

$sql = $con->conectar()->query("SELECT * FROM vagas WHERE idvaga = 2");
$vagasManha = $sql->fetch(PDO::FETCH_OBJ);
$cadastrar = 1;

if (isset($_POST['nome'], $_POST['sobreNome'])){
    foreach($_POST as $key => $value){
        $$key = $value;
    }
    
    if(isset($culto)){
        if($culto == 1){
            if($vagasNoite->quantidade <= 0){
                ?>
                <script>
                    alert("As vagas acabaram para este culto!");
                </script>
                <meta http-equiv="refresh" content="0; url=../../index.php">
                <?php
                $cadastrar = 0;
            } else{
                $cadastrar = 1;
            }
        } else if($culto == 0){
            if($vagasManha->quantidade <= 0){
                ?>
                <script>
                    alert("As vagas acabaram para este culto!");
                </script>
                <meta http-equiv="refresh" content="0; url=../../index.php">
                <?php
                $cadastrar = 0;
            } else{
                $cadastrar = 1;
            }
        } else {
            ?>
            <script>
                alert("Não foi possível fazer essa inscrição!");
            </script>
            <meta http-equiv="refresh" content="0; url=../../index.php">
            <?php
            $cadastrar = 0;
        }
    }
    if($cadastrar == 1){
        if ($nome != "" && $sobreNome != ""){
            $insc = new Inscricao();
            $insc->setNome($nome);
            $insc->setSobreNome($sobreNome);
            
            if(isset($culto)){
                $insc->setCnoite($culto);
            }
            if($insc->consulta()){
                $insc->cadastrar()
                ?>
                <script>
                    alert("Inscrição feita com sucesso!");
                </script>
                <meta http-equiv="refresh" content="0; url=../../index.php">
                <?php
            } else {
                ?>
                <script>
                    alert("Nome e sobrenome já encontrados!");
                </script>
                <meta http-equiv="refresh" content="0; url=../../index.php">
                <?php
            }
            
        } else {
            ?>
            <script>
                alert("Campos vazios!");
            </script>
            <meta http-equiv="refresh" content="0; url=../../index.php">
            <?php
        }
    }
}else{
    ?>
    <script>
        alert("Campos vazios!");
    </script>
    <meta http-equiv="refresh" content="0; url=../../index.php">
    <?php
}
?>