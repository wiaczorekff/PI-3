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
    <link rel="stylesheet" type="text/css" href="./estiloUserEdit.css">
    <title>Editar Usuário</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="logoCharlie">
        <img src="{!! asset('img/charlie-logooo.png')!!}" alt="logo-charlie">
    </div>
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="/home">Home</a>
                <a class="nav-link" href="/cart">Carrinho</a>
                <a class="nav-link" href="#">Pedidos</a>
                <a class="nav-link disabled" aria-disabled="true">Editar Usuário</a>
            </div>
        </div>
    </div>
</nav>

<form class="formulario" method="POST" action="{{ route('usuario.update') }}">
        @csrf
        <div class="mb-3">
            <label class="txtLogin" for="USUARIO_NOME">Nome:</label>
            <input type="text" name="USUARIO_NOME" class="form-control" value="{{ $usuario->USUARIO_NOME }}" placeholder="Digite seu nome" required>
        </div>
        <div class="mb-3">
            <label class="txtLogin" for="USUARIO_EMAIL">E-mail:</label>
            <input type="email" name="USUARIO_EMAIL" class="form-control" value="{{ $usuario->USUARIO_EMAIL }}" placeholder="Digite seu email" required>
        </div>
        <div class="mb-3">
            <label class="txtLogin" for="USUARIO_SENHA">Nova Senha:</label>
            <input type="password" name="USUARIO_SENHA" class="form-control" placeholder="Digite sua nova senha">
        </div>
        <div class="mb-3">
            <label class="txtLogin" for="USUARIO_SENHA_CONFIRMATION">Confirme a Nova Senha:</label>
            <input type="password" name="USUARIO_SENHA_CONFIRMATION" class="form-control" placeholder="Confirme sua nova senha">
        </div>
        
        <!-- Campos de endereço -->
        <div class="mb-3">
            <label class="txtLogin" for="ENDERECO_NOME">Nome do Endereço:</label>
            <input type="text" name="ENDERECO_NOME" class="form-control" value="{{ optional($endereco)->ENDERECO_NOME }}" placeholder="Digite o nome do endereço">
        </div>
        <div class="mb-3">
            <label class="txtLogin" for="ENDERECO_LOGRADOURO">Logradouro:</label>
            <input type="text" name="ENDERECO_LOGRADOURO" class="form-control" value="{{ optional($endereco)->ENDERECO_LOGRADOURO }}" placeholder="Digite o logradouro">
        </div>
        <div class="mb-3">
            <label class="txtLogin" for="ENDERECO_NUMERO">Número:</label>
            <input type="text" name="ENDERECO_NUMERO" class="form-control" value="{{ optional($endereco)->ENDERECO_NUMERO }}" placeholder="Digite o número">
        </div>
        <div class="mb-3">
            <label class="txtLogin" for="ENDERECO_COMPLEMENTO">Complemento:</label>
            <input type="text" name="ENDERECO_COMPLEMENTO" class="form-control" value="{{ optional($endereco)->ENDERECO_COMPLEMENTO }}" placeholder="Digite o complemento">
        </div>
        <div class="mb-3">
            <label class="txtLogin" for="ENDERECO_CEP">CEP:</label>
            <input type="text" name="ENDERECO_CEP" class="form-control" value="{{ optional($endereco)->ENDERECO_CEP }}" placeholder="Digite o CEP">
        </div>
        <div class="mb-3">
            <label class="txtLogin" for="ENDERECO_CIDADE">Cidade:</label>
            <input type="text" name="ENDERECO_CIDADE" class="form-control" value="{{ optional($endereco)->ENDERECO_CIDADE }}" placeholder="Digite a cidade">
        </div>
        <div class="mb-3">
            <label class="txtLogin" for="ENDERECO_ESTADO">Estado:</label>
            <input type="text" name="ENDERECO_ESTADO" class="form-control" value="{{ optional($endereco)->ENDERECO_ESTADO }}" placeholder="Digite o estado">
        </div>
        
        <button type="submit" class="btn-primary">Atualizar Informações</button>
    </form>

   <!-- Exibir endereços salvos em um accordion -->
<div class="accordion accordion-flush" id="accordionFlushExample">
    @forelse($enderecos as $key => $endereco)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#enderecoCollapse{{ $key }}" aria-expanded="false" aria-controls="enderecoCollapse{{ $key }}">
                    Endereço {{ $key + 1 }}
                </button>
            </h2>
            <div id="enderecoCollapse{{ $key }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <p><strong>Nome:</strong> {{ $endereco->ENDERECO_NOME }}</p>
                    <p><strong>Logradouro:</strong> {{ $endereco->ENDERECO_LOGRADOURO }}</p>
                    <p><strong>Número:</strong> {{ $endereco->ENDERECO_NUMERO }}</p>
                    <p><strong>Complemento:</strong> {{ $endereco->ENDERECO_COMPLEMENTO }}</p>
                    <p><strong>CEP:</strong> {{ $endereco->ENDERECO_CEP }}</p>
                    <p><strong>Cidade:</strong> {{ $endereco->ENDERECO_CIDADE }}</p>
                    <p><strong>Estado:</strong> {{ $endereco->ENDERECO_ESTADO }}</p>
                </div>
            </div>
        </div>
    @empty
        <p>Nenhum endereço salvo.</p>
    @endforelse
</div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('adicionarEndereco').addEventListener('click', function() {
                document.getElementById('enderecoForm').classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>
