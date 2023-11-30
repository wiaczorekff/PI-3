<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Endereco;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function create()
    {
        return view('usuario.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:USUARIO,USUARIO_EMAIL',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'USUARIO_NOME' => $request->name,
            'USUARIO_EMAIL' => $request->email,
            'USUARIO_SENHA' => Hash::make($request->password),
        ]);

        // Redireciona para a página de login após o registro bem-sucedido.
        return redirect(route('login'))->with('success', 'Conta criada com sucesso. Faça login agora.');
    }

    public function edit()
    {
        $usuario = auth()->user();
        $enderecos = $usuario->endereco()->get(); // Alterado para recuperar os endereços corretamente
        $endereco = $enderecos->first() ?? new Endereco();
    
        return view('usuarioEdit', compact('usuario', 'enderecos', 'endereco'));
    }
    
    public function update(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'USUARIO_NOME' => 'required|string|max:255',
            'USUARIO_EMAIL' => 'required|email|unique:USUARIO,USUARIO_EMAIL,' . $userId . ',USUARIO_ID',
            'USUARIO_SENHA' => 'nullable|min:6|confirmed',
            'ENDERECO_NOME' => 'nullable|string|max:255',
            'ENDERECO_LOGRADOURO' => 'nullable|string|max:255',
            'ENDERECO_NUMERO' => 'nullable|string|max:10',
            'ENDERECO_COMPLEMENTO' => 'nullable|string|max:255',
            'ENDERECO_CEP' => 'nullable|string|max:20',
            'ENDERECO_CIDADE' => 'nullable|string|max:255',
            'ENDERECO_ESTADO' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($userId);
        $user->fill($request->only(['USUARIO_NOME', 'USUARIO_EMAIL']));

        if ($request->filled('USUARIO_SENHA')) {
            $user->USUARIO_SENHA = bcrypt($request->input('USUARIO_SENHA'));
        }

        $user->save();

        // Atualizar ou criar endereço
        $endereco = $user->endereco ?? new Endereco();
        $endereco->fill($request->only([
            'ENDERECO_NOME', 'ENDERECO_LOGRADOURO', 'ENDERECO_NUMERO', 'ENDERECO_COMPLEMENTO',
            'ENDERECO_CEP', 'ENDERECO_CIDADE', 'ENDERECO_ESTADO'
        ]));
        $user->endereco()->save($endereco);

        return redirect()->route('usuario.edit')->with('success', 'Informações do usuário atualizadas com sucesso!');
    }
}
    

