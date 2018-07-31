<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Time extends Eloquent
{
    protected $connection = 'mongodb';
	protected $collection = 'time';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'descricao', 'setor', 'lider', 'coordenador'
    ];
}
