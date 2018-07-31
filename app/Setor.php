<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Setor extends Eloquent
{
    protected $connection = 'mongodb';
	protected $collection = 'setor';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'descricao', 'gerente'
    ];
}
