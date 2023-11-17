<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
</head>
<body>
<div class="produto-detalhes">
            <div class="imagem-produto">
                @if( $produto->ProdutoImagens->count() == 0 )
                    <img src="" alt="Produto">
                @else
                    <img src="{{ $produto->ProdutoImagens[0]->IMAGEM_URL }}" alt="{{ $produto->PRODUTO_NOME }}">
                @endif
            </div>
            <div class="info-produto">
                <h2>{{ $produto->PRODUTO_NOME }}</h2>
                <h3>Preço: R$ {{ $produto->PRODUTO_PRECO }}</h3>
            </div>
</div>
        
<form action="{{ route('cart.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" value="1" min="1">
            </div>
            <button type="submit" class="btn btn-primary">Finalizar Compra</button>
        </form>

</body>
</html>