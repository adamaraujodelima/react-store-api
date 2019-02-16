<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [        
        'id',
        'nome',
        'descricao',
        'preco',
        'quantidade',
        'imagem',
        'created_at',
        'updated_a',
    ];

    public function getPrecoAttribute($value)
    {
        return number_format($value,2,',','.');
    }
         
}
