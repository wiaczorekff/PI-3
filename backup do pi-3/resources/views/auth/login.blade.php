<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sedgwick+Ave+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./estiloLogin.css"/>
    <title>login</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                <a class="nav-link" href="#">Carrinho</a>
                <a class="nav-link" href="#">Pedidos</a>
                <a class="nav-link disabled" aria-disabled="true">login</a>
            </div>
        </div>
    </div>
</nav>
    
<form class="formulario" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="logoCharlie">
            <img src="{!! asset('img/charlie-logooo.png')!!}" alt="logo-charlie">
        </div>
        <div class="mb-3">
            <label class="txtLogin" for="USUARIO_EMAIL">E-mail:</label>
            <input type="email" name="USUARIO_EMAIL" class="form-control" aria-describedby="emailHelp" placeholder="Digite seu email">
        </div>
        <div class="mb-3">
            <label class="txtLogin" for="USUARIO_SENHA">Senha:</label>
            <input type="password" name="USUARIO_SENHA" class="form-control" id="exampleInputPassword1" placeholder="Digite sua senha">
        </div>
        <button type="submit" class="btn-primary">Logar</button>
</form>

</body>
</html> 