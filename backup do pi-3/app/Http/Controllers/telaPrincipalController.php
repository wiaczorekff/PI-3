<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\telaPrincipal;
use App\Models\Categoria;

class telaPrincipalController extends Controller
{
    public function index(){
        //dd(telaPrinciapal::all());
        return view('home', ['produtos' => telaPrincipal::all(),
                                'categorias' => Categoria::all()]);
    }

    public function show(telaPrincipal $produto){
        return view('produto.show',['produto' => $produto]);
    }
}
