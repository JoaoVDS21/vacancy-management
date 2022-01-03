<?php
require_once "classes/Conexao.php";
session_start();

if (!isset($_SESSION['idusuario'])){
    header('Location: index.php');
}
$con = new Conexao();
$sql = $con->conectar()->query("SELECT * FROM vagas WHERE idvaga = 1");
$vagasNoite = $sql->fetch(PDO::FETCH_OBJ);

$sql = $con->conectar()->query("SELECT * FROM vagas WHERE idvaga = 2");
$vagasManha = $sql->fetch(PDO::FETCH_OBJ);

$sql = $con->conectar()->query("SELECT ativo FROM vagas WHERE idvaga = 2");
$culto = $sql->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Igreja Batista Filadélfia</title>
    <link rel="stylesheet" href="css/modal1.css">
    <link rel="stylesheet" href="css/listagem1.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1 class="title-print">Inscrições - Igreja Batista Filadélfia</h1>

        <div class="box-table" >
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <td scope="col">#</td>
                        <td scope="col">Nome e sobrenome</td>
                        <td scope="col">Excluir</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $con = new Conexao();
                        $sql = $con->conectar()->query("SELECT * FROM inscricoes WHERE cnoite = 1 ORDER BY nome, sobrenome");
                        $inscricoes = $sql->fetchAll(PDO::FETCH_OBJ);
                        
                        $position = 0;
                        foreach($inscricoes as $inscricao){
                    ?>
                    <tr>
                        <td><?php echo $position = $position + 1 ?></td>
                        <td><?php echo mb_convert_case($inscricao->nome.' '.$inscricao->sobrenome, MB_CASE_TITLE, "utf-8") ?></td>
                        <td>
                            <a href="controles/inscricoes/deletar.php?id=<?php echo $inscricao->idinscricao ?>">
                                <i class="fas fa-ban"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="box-table" >
            <table class="table" id="table2">
                <thead>
                    <tr>
                        <td scope="col">#</td>
                        <td scope="col">Nome e sobrenome</td>
                        <td scope="col">Excluir</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $con = new Conexao();
                        $sql = $con->conectar()->query("SELECT * FROM inscricoes WHERE cnoite = 1");
                        $inscricoes = $sql->fetchAll(PDO::FETCH_OBJ);
                        
                        $position = 0;
                        foreach($inscricoes as $inscricao){
                    ?>
                    <tr>
                        <td><?php echo $position = $position + 1 ?></td>
                        <td><?php echo mb_convert_case($inscricao->nome.' '.$inscricao->sobrenome, MB_CASE_TITLE, "utf-8") ?></td>
                        <td>
                            <a href="controles/inscricoes/deletar.php?id=<?php echo $inscricao->idinscricao ?>">
                                <i class="fas fa-ban"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <?php 
        if ($culto->ativo == 1){
            ?>
                <div class="box-table">
                    <table class="table" id="table3">
                        <thead>
                            <tr>
                                <td scope="col">#</td>
                                <td scope="col">Nome e sobrenome</td>
                                <td scope="col">Excluir</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $con = new Conexao();
                                $sql = $con->conectar()->query("SELECT * FROM inscricoes WHERE cnoite = 0 ORDER BY nome, sobrenome");
                                $inscricoes = $sql->fetchAll(PDO::FETCH_OBJ);
                                
                                $position = 0;
                                foreach($inscricoes as $inscricao){
                            ?>
                            <tr>
                                <td><?php echo $position = $position + 1 ?></td>
                                <td><?php echo mb_convert_case($inscricao->nome.' '.$inscricao->sobrenome, MB_CASE_TITLE, "utf-8") ?></td>
                                <td>
                                    <a href="controles/inscricoes/deletar.php?id=<?php echo $inscricao->idinscricao ?>">
                                        <i class="fas fa-ban"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-table" >
                    <table class="table" id="table4">
                        <thead>
                            <tr>
                                <td scope="col">#</td>
                                <td scope="col">Nome e sobrenome</td>
                                <td scope="col">Excluir</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $con = new Conexao();
                                $sql = $con->conectar()->query("SELECT * FROM inscricoes WHERE cnoite = 0");
                                $inscricoes = $sql->fetchAll(PDO::FETCH_OBJ);
                                
                                $position = 0;
                                foreach($inscricoes as $inscricao){
                            ?>
                            <tr>
                                <td><?php echo $position = $position + 1 ?></td>
                                <td><?php echo mb_convert_case($inscricao->nome.' '.$inscricao->sobrenome, MB_CASE_TITLE, "utf-8") ?></td>
                                <td>
                                    <a href="controles/inscricoes/deletar.php?id=<?php echo $inscricao->idinscricao ?>">
                                        <i class="fas fa-ban"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
        }
        ?>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <?php
                        if($culto->ativo == 1){
                            if ($vagasNoite->quantidade > 1){
                                echo '<h1 class="text-vaga" style="font-size: 1.3rem; font-weight: 400">Culto da noite: '.$vagasNoite->quantidade.' vagas</h1>';
                            } else if($vagasNoite->quantidade == 1){
                                echo '<h1 class="text-vaga" style="font-size: 1.3rem; font-weight: 400">Culto da noite: '.$vagasNoite->quantidade.' vaga</h1>';
                            } else {
                                echo '<h1 class="text-vaga" style="font-size: 1.3rem; font-weight: 400">Culto da noite: 0 vagas</h1>';
                            }
                            if ($vagasManha->quantidade > 1){
                                echo '<h1 class="text-vaga" style="font-size: 1.3rem; font-weight: 400">Culto da manhã: '.$vagasManha->quantidade.' vagas</h1>';
                            } else if($vagasManha->quantidade == 1){
                                echo '<h1 class="text-vaga" style="font-size: 1.3rem; font-weight: 400">Culto da manhã: '.$vagasManha->quantidade.' vaga</h1>';
                            } else {
                                echo '<h1 class="text-vaga" style="font-size: 1.3rem; font-weight: 400">Culto da manhã: 0 vagas</h1>';
                            }
                        } else {
                            if ($vagasNoite->quantidade >= 0){
                                echo '<h1 class="text-vaga" style="font-size: 1.3rem; font-weight: 400">Vagas disponíveis: '.$vagasNoite->quantidade.'</h1>';
                            } else if($vagasNoite->quantidade < 0){
                                echo '<h1 class="text-vaga" style="font-size: 1.3rem; font-weight: 400">Vagas disponíveis: 0</h1>';
                            }
                        }

 
                    if($culto->ativo == 1){
                        ?>
                        <button class="btn transparent print" onclick="desativaCulto()">Desativar Culto da Manhã</button>
                        <?php
                    } else {
                        ?>
                        <button class="btn transparent print" onclick="ativaCulto()">Ativar Culto da Manhã</button>
                        <?php
                    }
                    ?>
                    <button class="btn transparent print" onclick="abrirModal()">Adicionar vagas</button>
                    <button class="btn transparent print" onclick="confirmDelete()">Resetar tudo</button>
                    <button class="btn transparent print" onclick="print()">Imprimir</button>
                    <button class="btn transparent print" id="btn1" onclick="ordemAlfabetica()">Ordem alfabética</button>
                    <button class="btn transparent print" id="btn2" onclick="ordemInscricao()">Ordem de inscrição</button>
                    <?php
                        if($culto->ativo == 1){
                            ?>
                            <button class="btn transparent print" id="cmanha" onclick="listaManha()">Lista Manhã</button>
                            <?php
                        }
                    ?>
                    <a href="logout.php" class="logout print" style="color: #fff;font-size: rem">Sair do painel</a>
                    <?php
                        if($culto->ativo == 1){
                            ?>
                            <button class="btn transparent print" id="cnoite" onclick="listaNoite()">lista Noite</button>
                            <?php
                        }
                    ?>           
                    
                </div>
                <img src="img/list.svg" alt="" class="image">
            </div>
        </div>
    </div>

    

    <div class="bg-modal" id="bg-modal">
        <div class="modal" id="modal">
            <div class="bar-modal">
                <h1>Quantidade de vagas</h1>
                <span class="close" onclick="fecharModal()">&times;</span>
            </div>

            <form class="form-box" action="controles/vagas/adicionar.php" method="POST">
                <label for="qtd">Quantidade:</label>
                <input type="number" name="qtd" class="modal-input" min="1" step="1" required>
                <?php
                    if($culto->ativo == 1){
                        ?>
                            <select name="culto" >
                                <option value="1">Culto da noite</option>
                                <option value="2">Culto da manhã</option>
                            </select>
                        <?php
                    }
                ?>

                <div class="boxbtn">
                    <button type="submit" 
                    class="btn-form">Adicionar</button>
                </div>    
            </form>
        </div>
    </div>

    <script>

        function abrirModal(){
            $('#bg-modal').fadeIn(350);
        }
        function fecharModal(){
            $('#bg-modal').fadeOut(350);
        }

        function confirmDelete(){
            if (confirm("Tem certeza?")){
                location.href="controles/inscricoes/deleteAll.php";
            }
        }
        function ativaCulto(){
            if (confirm("Tem certeza?")){
                location.href="controles/vagas/ativaculto.php";
            }
        }

        function desativaCulto(){
            if (confirm("Tem certeza?")){
                location.href="controles/vagas/desativaculto.php";
            }
        }

        var btn1 = document.getElementById('btn1');
        var btn2 = document.getElementById('btn2');
        var btnCmanha = document.getElementById('cmanha');
        var btnCnoite = document.getElementById('cnoite');
        const table1 = document.getElementById('table1');
        const table2 = document.getElementById('table2');
        // const table3 = document.getElementById('table3');
        // const table4 = document.getElementById('table4');
        var btn1Ativo = btn1.classList.contains('btn-ativo');
        var btn2Ativo = btn2.classList.contains('btn-ativo');
        var btnCmanhaAtivo = btnCmanha.classList.contains('btn-ativo');
        var btnCnoiteAtivo = btnCnoite.classList.contains('btn-ativo');
        const tables =  document.querySelectorAll('.table');
        console.log(tables);

        function ordemAlfabetica(){
            btn1.classList.add('btn-ativo');
            btn2.classList.remove('btn-ativo');
            btn1Ativo = btn1.classList.contains('btn-ativo');
            btn2Ativo = btn2.classList.contains('btn-ativo');
            ativaTable();
        }
        function ordemInscricao(){
            btn2.classList.add('btn-ativo');
            btn1.classList.remove('btn-ativo');
            btn1Ativo = btn1.classList.contains('btn-ativo');
            btn2Ativo = btn2.classList.contains('btn-ativo');
            ativaTable();
        }
        function listaNoite(){
            btnCnoite.classList.add('btn-ativo');
            btnCmanha.classList.remove('btn-ativo');
            btnCmanhaAtivo = btnCmanha.classList.contains('btn-ativo');
            btnCnoiteAtivo = btnCnoite.classList.contains('btn-ativo');
            ativaTable();
        }
        function listaManha(){
            btnCmanha.classList.add('btn-ativo');
            btnCnoite.classList.remove('btn-ativo');
            btnCmanhaAtivo = btnCmanha.classList.contains('btn-ativo');
            btnCnoiteAtivo = btnCnoite.classList.contains('btn-ativo');
            ativaTable();
        }
        </script>
        
        <?php
            if($culto->ativo == 1){
                ?>
                <script>
                    window.addEventListener('load', ordemAlfabetica);
                    window.addEventListener('load', listaNoite);

                    function ativaTable(){
                        // btn1 = ordem alfabética
                        // btn2 = ordem inscrição
                        if(btnCnoiteAtivo){
                            if (btn1Ativo){
                                for(var i = 0;i < 4; i++){
                                    if(i == 0) tables[i].style.display = "table";
                                    else tables[i].style.display = "none";
                                }
                            } else if (btn2Ativo){
                                for(var i = 0;i < 4; i++){
                                    if(i == 1) tables[i].style.display = "table";
                                    else tables[i].style.display = "none";
                                }
                            }
                        } else if(btnCmanhaAtivo){
                            if (btn1Ativo){
                                for(var i = 0;i < 4; i++){
                                    if(i == 2) tables[i].style.display = "table";
                                    else tables[i].style.display = "none";
                                }
                            } else if (btn2Ativo){
                                for(var i = 0;i < 4; i++){
                                    if(i == 3) tables[i].style.display = "table";
                                    else tables[i].style.display = "none";
                                }
                            }
                        }
                    }
                    
                </script>
                <?php
            } else {
                ?>
                <script>
                window.onload = ordemAlfabetica();
                function ordemAlfabetica(){
                    table1.style.display = "table";
                    table2.style.display = "none";
                    btn1.classList.add('btn-ativo');
                    btn2.classList.remove('btn-ativo');
                }
                function ordemInscricao(){
                    table2.style.display = "table";
                    table1.style.display = "none";
                    btn2.classList.add('btn-ativo');
                    btn1.classList.remove('btn-ativo');
                }
                </script>
                <?php
            }
        ?>
    </script>
</body>
</html>