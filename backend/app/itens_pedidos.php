<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itens_pedidos extends Model
{
    //
    protected $fillable = [
        'pedido_id',
        'produto_id',
        'quantidade'
    ];
    public $timestamps = false;
}
