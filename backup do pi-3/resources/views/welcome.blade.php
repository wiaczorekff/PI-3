
@if(Auth::user())
    <h1>Olá! {{ Auth::user()->USUARIO_NOME }}</h1>
@else
    <h1>não está logado</h1>
@endif

