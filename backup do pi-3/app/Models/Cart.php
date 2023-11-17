<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'CARRINHO_ITEM'; // ou 'CARRINHO_ITEM' se necessário
    protected $fillable = ['USUARIO_ID', 'PRODUTO_ID', 'ITEM_QTD'];
    public $timestamps = false; // Adicione esta linha

    public function product()
    {
        return $this->belongsTo(Produto::class);
    }
}
