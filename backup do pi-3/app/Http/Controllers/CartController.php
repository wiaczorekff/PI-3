<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cart;
use App\Models\produto;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\PedidoStatus;
use App\Models\Endereco;
use Carbon\Carbon;



class CartController extends Controller
{
    public function post($produto_id, Request $request)
{
    if (auth()->check()) {
        // Verifica se o produto existe
        $produto = Produto::find($produto_id);

        if (!$produto) {
            return redirect()->back()->with('error', 'Produto não encontrado.');
        }

        // Obtém o usuário autenticado ou redireciona para o login
        $usuario = auth()->user();

        // Verifica se o produto já está no carrinho
        $carrinhoItem = Cart::where('USUARIO_ID', $usuario->USUARIO_ID)
            ->where('PRODUTO_ID', $produto_id)
            ->first();
            
        if ($carrinhoItem) {
            $carrinhoItem->ITEM_QTD += 1;
            $carrinhoItem->save();
            
        }else {
            // Cria um novo item no carrinho associado ao usuário com quantidade inicial 1
            $novoItem = Cart::create([
                'USUARIO_ID' => $usuario->USUARIO_ID,
                'PRODUTO_ID' => $produto_id,
                'ITEM_QTD' => 1,
            ]);
        }
        
        // Redireciona para a tela do carrinho
        return redirect()->route('cart')->with('success', 'Produto adicionado ao carrinho.');
    } else {
        return redirect()->route('login')->with('error', 'Você precisa estar logado para adicionar produtos ao carrinho.');
    }
}

    public function show()
{
    // Carrega os itens do carrinho com o relacionamento 'product'
    $carrinhoItens = Cart::where('USUARIO_ID', auth()->user()->USUARIO_ID)->with('product')->get();

    return view('cart', ['carrinhoItens' => $carrinhoItens]);
}

public function showProduct($produto_id)
{
    // Recupera o produto do banco de dados
    $produto = Produto::find($produto_id);

    // Verifica se o produto foi encontrado
    if (!$produto) {
        return redirect()->back()->with('error', 'Produto não encontrado.');
    }

    return view('cart', ['produto' => $produto]);
}

public function update(Request $request, $produto_id)
{
    // Recupera o usuário autenticado
    $usuario = auth()->user();

    // Verifica se o produto existe
    $produto = Produto::find($produto_id);

    if (!$produto) {
        return redirect()->back()->with('error', 'Produto não encontrado.');
    }

    // Verifica se o botão Zerar foi pressionado
    if ($request->has('zerar')) {
        // Zera a quantidade do produto no carrinho
        Cart::where('USUARIO_ID', $usuario->USUARIO_ID)
            ->where('PRODUTO_ID', $produto_id)
            ->update(['ITEM_QTD' => 0]);

        return redirect()->back()->with('success', 'Quantidade do produto zerada.');
    }

    // Verifica se o botão Atualizar foi pressionado
    if ($request->has('atualizar')) {
        // Obtém a quantidade do input
        $novaQuantidade = $request->input('quantidade');

        // Atualiza a quantidade do produto no carrinho
        Cart::where('USUARIO_ID', $usuario->USUARIO_ID)
            ->where('PRODUTO_ID', $produto_id)
            ->update(['ITEM_QTD' => $novaQuantidade]);

        return redirect()->back()->with('success', 'Quantidade do produto atualizada.');
    }

    // Se nenhum botão válido foi pressionado, redireciona de volta
    return redirect()->back()->with('error', 'Ação inválida.');
}

public function finalizarCompra(Request $request)
{
    // Obtém o usuário autenticado
    $usuario = auth()->user();
    
    // Verifica se o usuário tem um endereço cadastrado
    $endereco = Endereco::where('USUARIO_ID', $usuario->USUARIO_ID)->first();

    // Cria um novo pedido com a data atual
    $pedido = Pedido::create([
        'USUARIO_ID' => $usuario->USUARIO_ID,
        'ENDERECO_ID' => $endereco ? $endereco->ENDERECO_ID : null,
        'STATUS_ID' => 1, // Defina o valor apropriado para STATUS_ID
        'PEDIDO_DATA' => Carbon::now(), // Utiliza o Carbon para obter a data atual
    ]);
        // Obtém os itens do carrinho do usuário
        $carrinhoItens = Cart::where('USUARIO_ID', $usuario->USUARIO_ID)->with('product')->get();

        // Adiciona os itens do carrinho ao pedido
        foreach ($carrinhoItens as $carrinhoItem) {
            $pedidoItem = PedidoItem::create([
                'PRODUTO_ID' => $carrinhoItem->PRODUTO_ID,
                'PEDIDO_ID' => $pedido->PEDIDO_ID,
                'ITEM_QTD' => $carrinhoItem->ITEM_QTD,
                'PRODUTO_PRECO' => $carrinhoItem->product->ITEM_PRECO,
            ]);
        }

        // Zera os itens do carrinho do usuário
        Cart::where('USUARIO_ID', $usuario->USUARIO_ID)->update(['ITEM_QTD' => 0]);

        // Redireciona o usuário para a home
        return redirect('/home')->with('success', 'Compra finalizada com sucesso!');
    }

}
