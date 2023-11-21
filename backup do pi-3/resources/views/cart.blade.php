<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estiloCart.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Carrinho</title>
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
                <a class="nav-link disabled" aria-disabled="true">cadastre-se</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        @foreach ($carrinhoItens->groupBy('PRODUTO_ID') as $produtoId => $itens)
            @php $item = $itens->first(); @endphp
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $item->product->ProdutoImagens->first()->IMAGEM_URL ?? '' }}"
                        class="card-img-top" alt="{{ $item->product->PRODUTO_NOME }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->product->PRODUTO_NOME }}</h5>
                        <p class="card-text">Preço: R$ {{ $item->product->PRODUTO_PRECO }}</p>
                        <p class="card-text">Preço Total: R$ <span class="preco-total">{{ $item->product->PRODUTO_PRECO * $itens->sum('ITEM_QTD') }}</span></p>
                        <form action="{{ route('cart') }}" method="POST" class="form-quantidade">
                            @csrf
                            <div class="form-group">
                                <label for="quantidade">Quantidade:</label>
                                <input type="number" name="quantidade" value="{{ $itens->sum('ITEM_QTD') }}" class="form-control quantidade" min="1">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Adiciona um ouvinte de evento para atualizar o preço total ao alterar a quantidade
    $('.form-quantidade .quantidade').on('input', function() {
        var precoUnitario = parseFloat($(this).closest('.card').find('.card-text:first').text().replace('Preço: R$ ', ''));
        var quantidade = parseInt($(this).val());
        var precoTotal = precoUnitario * quantidade;
        $(this).closest('.card').find('.preco-total').text(precoTotal.toFixed(2));
    });
</script>

</body>
</html>
