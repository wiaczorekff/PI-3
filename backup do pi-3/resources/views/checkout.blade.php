<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>

<body>
  
    <main>
        <h2>Checkout</h2>

        @if ($cartItems->isEmpty())
            <p>Seu carrinho está vazio.</p>
        @else
            @foreach ($cartItems as $cartItem)
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $cartItem->product->PRODUTO_NOME }}</h4>
                        <p class="card-text">
                            Preço: R$ {{ $cartItem->product->PRODUTO_PRECO }}<br>
                            Quantidade: {{ $cartItem->QTD_ITEM }}
                        </p>
                    </div>
                </div>
            @endforeach

            <h4>Total da Compra: R$ {{ $total }}</h4>

            <button id="finalizarCompra" class="btn btn-primary">Finalizar Compra</button>
        @endif
    </main>


    <script>
        document.getElementById('finalizarCompra').addEventListener('click', function () {
            alert('Compra efetuada com sucesso!');
            window.location.href = '/';
        });
    </script>
</body>
</html>
