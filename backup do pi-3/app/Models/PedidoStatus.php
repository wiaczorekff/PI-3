<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoStatus extends Model
{
    protected $table = 'PEDIDO_STATUS';
    protected $primaryKey = 'STATUS_ID';
    protected $fillable = ['STATUS_DESC'];

    // Relacionamento com Pedido
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'STATUS_ID', 'STATUS_ID');
    }
}
