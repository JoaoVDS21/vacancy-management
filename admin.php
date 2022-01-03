<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Igreja Batista Filadélfia</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form action="controles/usuario/logar.php" method="POST">
        <label for="login">Login:</label>
        <input type="text" name="login">
        <label for="senha">Senha:</label>
        <input type="password" name="senha">
        <button type="submit">Entrar</button>
        <button type="reset">Limpar</button>
    </form>
</body>
</html>