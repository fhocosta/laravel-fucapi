<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Dados extends Eloquent
{
    protected $connection = 'mongodb';
	protected $collection = 'dados';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dataExecucao', 'itemTeste', 'prioridade', 'quantidadeTC', 'tempoTotal', 'usuario'
    ];
}
