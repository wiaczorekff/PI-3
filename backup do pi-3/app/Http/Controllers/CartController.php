<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cart;
use App\Models\produto;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function post($produto_id)
{
    if (auth()->check()) {
        // Verifica se o produto existe
        $produto = Produto::find($produto_id);

        if (!$produto) {
            return redirect()->back()->with('error', 'Produto não encontrado.');
        }

        // Obtém o ID do usuário autenticado
        $usuario_id = auth()->user()->id;

        // Cria um novo item no carrinho com o ID do usuário
        $novoItem = new Cart([
            'USUARIO_ID' => $usuario_id,
            'PRODUTO_ID' => $produto_id,
            'ITEM_QTD' => 1,
        ]);

        // Salva o novo item no carrinho
        $novoItem->save();

        return redirect()->back()->with('success', 'Produto adicionado ao carrinho.');
    } else {
        return redirect()->route('login')->with('error', 'Você precisa estar logado para adicionar produtos ao carrinho.');
    }
}
    

    // ...

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

    
}

   

