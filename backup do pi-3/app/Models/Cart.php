<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    
    protected $table = 'CARRINHO_ITEM'; 
    protected $fillable = ['USUARIO_ID', 'PRODUTO_ID', 'ITEM_QTD'];
    public $timestamps = false; 
    
    protected function setKeysForSaveQuery($query){
        return $query->where('USUARIO_ID', $this->getAttribute('USUARIO_ID'))
                     ->where('PRODUTO_ID', $this->getAttribute('PRODUTO_ID'));
    }

    public function product()
{
    return $this->belongsTo(Produto::class, 'PRODUTO_ID', 'PRODUTO_ID');
}

    public function carrinhoItens()
{
    return $this->hasMany(Cart::class, 'PRODUTO_ID', 'PRODUTO_ID');
}


}

