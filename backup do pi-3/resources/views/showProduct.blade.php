<!DOCTYPE html>
<html lang="pt-BR">
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
    <link rel="stylesheet" type="text/css" href="./estiloProd.css">
    <title>Detalhes do Produto</title>
    <style>
        body {
    font-family: 'Arial', sans-serif; 
}

.navbar {
    min-height: 50px; 
    height: 100px;
}

.produto-detalhes {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 20px;
}

.imagem-produto img {
    max-width: 100%; 
    height: auto;
}

.info-produto {
    max-width: 700px; 
    margin-top: 30px;
}

.titulo-produto {
    font-size: 24px;
    margin-bottom: 10px;
}

.descricao-produto {
    font-size: 18px;
    margin-bottom: 10px;
}

.preco-produto {
    font-size: 20px;
    margin-bottom: 20px;
    
}

.btn {
    font-size: 18px;
    padding: 10px 20px;
}

@media (min-width: 768px) {
    .produto-detalhes {
        flex-direction: row;
        justify-content: space-around;
        align-items: flex-start;
    }

    .imagem-produto {
        margin-right: 20px;
    }
}
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="logoCharlie">
            <img src="{!! asset('img/charlie-logooo.png')!!}" alt="logo-charlie">
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="/home">Home</a>
                <a class="nav-link" href="/cart">Carrinho</a>
                <a class="nav-link" href="#">Pedidos</a>
                <a class="nav-link disabled" aria-disabled="true">{{ $produto->Categoria->CATEGORIA_NOME }}</a>
            </div>
        </div>
    </div>
</nav>

<main class="container mt-4">
    <div class="produto-detalhes">
        <div class="row">
            <div class="col-md-6">
                <div class="imagem-produto">
                    @if($produto->ProdutoImagens->count() == 0)
                        <img src="" alt="Produto" class="img-fluid">
                    @else
                        <img src="{{ $produto->ProdutoImagens[0]->IMAGEM_URL }}" alt="{{ $produto->PRODUTO_NOME }}" class="img-fluid">
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-produto">
                    <h2 class="titulo-produto">{{ $produto->PRODUTO_NOME }}</h2>
                    <h3 class="descricao-produto">{{ $produto->Categoria->CATEGORIA_NOME }} - {{ $produto->PRODUTO_DESC }}</h3>
                    <h3 class="preco-produto">Preço: R$ {{ $produto->PRODUTO_PRECO }}</h3>
                    <form action="{{ route('cart.post', $produto->PRODUTO_ID) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-3">Comprar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>