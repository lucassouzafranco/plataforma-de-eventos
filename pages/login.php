<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Login</h1>
    <div class="Login">
        <form action="Authentication.php" method="POST">
            <label>Email</label>
            <input type="email" name="email" required>
            
            <label>Senha</label>
            <input type="password" name="senha" required>       
            
            <input type="submit" value="Entrar">
        </form>
        <div class="criar_conta">
            <p>Não possui conta? <a href="User_registration.html">Cadastre-se</a></p>
        </div>
    </div>
</body>
</html>
