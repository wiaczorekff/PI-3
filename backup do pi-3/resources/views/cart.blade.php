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
                <a class="nav-link active" aria-current="page" href="/home">Home</a>
                <a class="nav-link" href="#">Pedidos</a>
                <a class="nav-link disabled" aria-disabled="true">carrinho</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        @foreach ($carrinhoItens->groupBy('PRODUTO_ID') as $produtoId => $itens)
            @php $item = $itens->first(); @endphp
            @if($itens->sum('ITEM_QTD') > 0)
                <div class="col-md-4 mb-4">
                    @if(session('success') && session('removed_product_id') == $produtoId)
                    @else
                        <div class="card">
                            <img src="{{ $item->product->ProdutoImagens->first()->IMAGEM_URL ?? '' }}"
                                class="card-img-top" alt="{{ $item->product->PRODUTO_NOME }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->product->PRODUTO_NOME }}</h5>
                                <p class="card-text">Preço: R$ {{ $item->product->PRODUTO_PRECO }}</p>
                                <p class="card-text">Preço Total: R$ <span class="preco-total">{{ $item->product->PRODUTO_PRECO * $itens->sum('ITEM_QTD') }}</span></p>
                                <form action="{{ route('cart.update', $item->product->PRODUTO_ID) }}" method="POST" class="form-quantidade">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="quantidade">Quantidade:</label>
                                        <input type="number" name="quantidade" value="{{ $itens->sum('ITEM_QTD') }}" class="form-control quantidade" min="1">
                                    </div>
                                    <button type="submit" name="atualizar" class="btn btn-primary">Atualizar</button>
                                </form>
                                <form action="{{ route('cart.update', $item->product->PRODUTO_ID) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                        <button type="submit" name="zerar" class="btn btn-danger">Zerar</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
</div>
<div class="text-center mt-3">
    <a href="{{ route('checkout.show') }}" class="btn btn-primary">CHECKOUT</a>
</div>

<script>
    // Adiciona um ouvinte de evento para atualizar o preço total ao alterar a quantidade
    $('.form-quantidade .quantidade').on('input', function() {
        // Obter o valor da quantidade do input
        var quantidadeAtualizada = parseInt($(this).val());

        // Atualiza o preço total na tela
        var precoUnitario = parseFloat($(this).closest('.card').find('.card-text:first').text().replace('Preço: R$ ', ''));
        var precoTotal = precoUnitario * quantidadeAtualizada;
        $(this).closest('.card').find('.preco-total').text(precoTotal.toFixed(2));
    });

    // Defina o valor inicial do input para a quantidade específica do produto
    $('.form-quantidade .quantidade').each(function() {
        var quantidadeInicial = parseInt($(this).val());
        var precoUnitario = parseFloat($(this).closest('.card').find('.card-text:first').text().replace('Preço: R$ ', ''));
        var precoTotal = precoUnitario * quantidadeInicial;
        $(this).closest('.card').find('.preco-total').text(precoTotal.toFixed(2));
    });
</script>
</body>
</html>
