<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $table = 'PEDIDO_ITEM';
    protected $fillable = ['PRODUTO_ID', 'PEDIDO_ID', 'ITEM_QTD', 'ITEM_PRECO'];
    public $timestamps = false;

    // Relacionamento com Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'PEDIDO_ID', 'PEDIDO_ID');
    }

    // Relacionamento com Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'PRODUTO_ID', 'PRODUTO_ID');
    }

    protected function setKeysForSaveQuery($query){
        return $query->where('USUARIO_ID', $this->getAttribute('USUARIO_ID'))
                     ->where('PRODUTO_ID', $this->getAttribute('PRODUTO_ID'));
    }

    // Evento antes de salvar
    protected static function booted()
    {
        static::saving(function ($pedidoItem) {
            // Certifique-se de que o preço do produto está definido
            if ($pedidoItem->produto->PRODUTO_PRECO) {
                // Calcule o preço total do item
                $pedidoItem->ITEM_PRECO = $pedidoItem->produto->PRODUTO_PRECO * $pedidoItem->ITEM_QTD;
            }
        });
    }
}