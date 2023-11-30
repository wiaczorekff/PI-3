<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pedido extends Model
{
    protected $table = 'PEDIDO'; 

    protected $primaryKey = 'PEDIDO_ID';

    protected $fillable = ['USUARIO_ID', 'ENDERECO_ID', 'STATUS_ID', 'PEDIDO_DATA'];

    public $timestamps = false; 

    // Relacionamento com os itens do pedido
    public function itensPedido()
    {
        return $this->hasMany(PedidoItem::class, 'PEDIDO_ID', 'PEDIDO_ID', 'STATUS_ID', 'PEDIDO_DATA');
    }
}