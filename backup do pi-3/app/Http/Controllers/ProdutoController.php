<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produto;

class ProdutoController extends Controller
{
    public function show(Produto $produto)
    {
        return view('showProduct', ['produto' => $produto]);
    }
}
