<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\FormasPagamentos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dados =
        [
            'total_cliente' => Clientes::all()->count(),
            'dados_clientes' => Clientes::all(),
            'formas_pagamento' => FormasPagamentos::all(),
        ];

        
        
        return view('home', compact('dados'));
    }
}
