<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function show(Categoria $categoria){
        return view('home', ['produtos' => $categoria->Produtos,
                            'categorias' => Categoria::all()]);

    }
}
