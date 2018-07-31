<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Cargo extends Eloquent
{
    protected $connection = 'mongodb';
	protected $collection = 'cargo';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'descricao'
    ];
}
