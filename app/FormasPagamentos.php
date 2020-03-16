<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormasPagamentos extends Model
{
    protected $fillable = ['id_forma','tipo'];
    protected $table = 'formas_pagamentos';
}
