<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;


class CheckoutController extends Controller
{
    public function index()
    {
      
        return view('checkout');
    }

    public function showCheckout()
{
    // Carrega os itens do carrinho com o relacionamento 'product'
    $carrinhoItens = Cart::where('USUARIO_ID', auth()->user()->USUARIO_ID)->with('product')->get();

    // Agrupa os itens do carrinho pelo ID do produto
    $itensAgrupados = $carrinhoItens->groupBy('PRODUTO_ID');

    // Calcula o total da compra
    $total = $carrinhoItens->sum(function ($item) {
        return $item->product->PRODUTO_PRECO * $item->QTD_ITEM;
    });

    return view('checkout', ['itensAgrupados' => $itensAgrupados, 'total' => $total]);
}

}

