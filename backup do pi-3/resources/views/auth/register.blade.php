<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <form method="POST" action="{{ route('register') }}">
        @csrf

           NOME: <input type="text" name="USUARIO_NOME">
           E-MAIL <input type="text" name="USUARIO_EMAIL">
           SENHA: <input type="text" name="USUARIO_SENHA">
           CPF: <input type="text" name="USUARIO_CPF">

            <button type="submit">enviar</button>
    </form>

    
</body>
</html>
   
       