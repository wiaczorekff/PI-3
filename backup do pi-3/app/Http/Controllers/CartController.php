<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cart;
use App\Models\produto;
use Illuminate\Support\Facades\Auth;


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
                // Atualiza a quantidade do item existente
                $carrinhoItem->ITEM_QTD += $request->input('quantidade', 1);
                $carrinhoItem->save();
            } else {
                // Cria um novo item no carrinho associado ao usuário
                $novoItem = new Cart([
                    'USUARIO_ID' => $usuario->USUARIO_ID,
                    'PRODUTO_ID' => $produto_id,
                    'ITEM_QTD' => $request->input('quantidade', 1),
                ]);
    
                // Salva o novo item no carrinho
                $novoItem->save();
            }
    
            // Redireciona para a tela do carrinho
            return redirect()->route('cart')->with('success', 'Produto adicionado ao carrinho.');
        } else {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para adicionar produtos ao carrinho.');
        }
    }

    public function delete($produto_id)
    {
        // Certifique-se de que o usuário esteja autenticado
        if (Auth::check()) {
            // Encontra o item no carrinho do usuário
            $carrinhoItem = Cart::where('USUARIO_ID', auth()->user()->USUARIO_ID)
                ->where('PRODUTO_ID', $produto_id)
                ->first();

            if ($carrinhoItem) {
                // Remove o item do carrinho
                $carrinhoItem->delete();

                return redirect()->back()->with('success', 'Produto removido do carrinho.');
            } else {
                return redirect()->back()->with('error', 'Produto não encontrado no carrinho.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para remover produtos do carrinho.');
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

    
}

   

