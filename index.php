<?php
require_once "classes/Conexao.php";
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
    <title>Inscrições - Igreja Batista Filadélfia</title>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                
                <form action="controles/inscricoes/cadastrar.php" class="sign-in-form" method="POST">
                    <h1 class="title">Inscrição</h1>
                    <?php
                            if (($vagasNoite->quantidade < 1 && $vagasManha->quantidade < 1) || ($culto->ativo == 0 && $vagasNoite->quantidade < 1)){
                                ?>
                                <h1 class="text-alert">Não há mais vagas disponíveis!</h1>
                                <?php
                            } else {
                                ?>
                                <div class="input-field">
                                    <i class="fas fa-user"></i>
                                    <input type="text" placeholder="Nome" name="nome" autocomplete="off" required>
                                </div>
                                <div class="input-field">
                                    <i class="fas fa-user"></i>
                                    <input type="text" placeholder="Sobrenome" name="sobreNome" autocomplete="off" required>
                                </div>
                                <?php
                                    if($culto->ativo == 1){
                                        ?>
                                            <div class="input-field">
                                                <i class="fas fa-info"></i>
                                                <select name="culto">
                                                    <?php
                                                    if($vagasNoite->quantidade > 0){
                                                        echo '<option value="1">Culto da noite</option>';
                                                    } else {
                                                        echo '<option value="1" disabled="disabled" style="color: #666">Culto da noite - ESGOTADO!</option>';
                                                    }
                                                    if($vagasManha->quantidade > 0){
                                                        echo '<option value="0">Culto da manhã</option>';
                                                    } else {
                                                        echo '<option disabled="disabled" style="color: #666">Culto da manhã - ESGOTADO!</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        <?php
                                    }
                                ?>
                                <input type="submit" value="Inscrever" class="btn solid">
                                <?php
                            }
                    ?>
                    <div class="box-txt">
                        <?php
                            if($culto->ativo == 1){
                                if(!($vagasNoite->quantidade < 1 && $vagasManha->quantidade < 1)){
                                    if ($vagasNoite->quantidade > 1){
                                        echo '<h1 class="text-vaga">Culto da noite: '.$vagasNoite->quantidade.' vagas</h1>';
                                    } else if($vagasNoite->quantidade == 1){
                                        echo '<h1 class="text-vaga">Culto da noite: '.$vagasNoite->quantidade.' vaga</h1>';
                                    } else {
                                        echo '<h1 class="text-vaga">Culto da noite: ESGOTADO!</h1>';
                                    }
                                    if ($vagasManha->quantidade > 1){
                                        echo '<h1 class="text-vaga">Culto da manhã: '.$vagasManha->quantidade.' vagas</h1>';
                                    } else if($vagasManha->quantidade == 1){
                                        echo '<h1 class="text-vaga">Culto da manhã: '.$vagasManha->quantidade.' vaga</h1>';
                                    } else {
                                        echo '<h1 class="text-vaga">Culto da manhã: ESGOTADO!</h1>';
                                    }
                                }
                                
                            } else {
                                if ($vagasNoite->quantidade > 1){
                                    echo '<h1 class="text-vaga">Há '.$vagasNoite->quantidade.' vagas disponíveis</h1>';
                                } else if($vagasNoite->quantidade == 1){
                                    echo '<h1 class="text-vaga">Há '.$vagasNoite->quantidade.' vaga disponível</h1>';
                                }
                            }
                            
                        ?>
                    </div>
                </form>
        
                <form action="controles/usuario/logar.php" class="sign-up-form" method="POST">
                    <h1 class="title">Administrador</h1>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="login" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Senha" name="senha" autocomplete="off" required>
                    </div>
                    <input type="submit" value="Entrar" class="btn solid">
                </form>
            </div>
        </div>

        

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>É administrador?</h3>
                    <p>Entre no painel para ver as inscrições.<br>Igreja Batista Filadélfia</p>
                    
                    <button class="btn transparent" id="sign-up-btn">Entrar</button>
                </div>
                <img src="img/login.svg" alt="" class="image">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>Quer se inscrever?</h3>
                    <p>Clique no botão para ir para a área de inscrição. <br>Igreja Batista Filadélfia</p>
                    <button class="btn transparent" id="sign-in-btn">Inscrever-se</button>
                </div>
                <img src="img/cadastro.svg" alt="" class="image">
            </div>
        </div>
    </div>
    
    <script src="js/app.js"></script>


</body>
</html>