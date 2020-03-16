<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
   protected $fillable = 
   [
       'id_cliente',
       'nome',
       'email',
       'cpf',
       'telefone',
       'telefone_dois',
       'data_nascimento',
       'data_cadastro',
       'intervalo_doacao',
       'valor_doacao',
       'id_forma_pg',
       'cep',
       'rua',
       'numero',
       'complemento',
   ];

   protected $table = 'clientes';

   
}
