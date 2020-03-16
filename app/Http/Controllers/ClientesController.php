<?php

namespace App\Http\Controllers;

use App\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $date_cadastro = Date('Y-m-d');
        $clientes = Clientes::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'telefone_dois' => $request->telefone_dois,
            'data_nascimento' => $request->data_nascimento,
            'data_cadastro' => $date_cadastro,
            'intervalo_doacao' => $request->intervalo_doacao,
            'valor_doacao' => $request->valor_doacao,
            'id_forma_pg' => $request->forma_pagamento,
            'cep' => $request->cep,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'complemento' => $request->complemento,

        ]);

        return back()->with('status', 'Adicionado!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {  
        $cliente = Clientes::where('id_cliente','=',$request->id)->get();

        foreach($cliente as $dados_clientes){
            $dados = array(
                'id_cliente' => $dados_clientes->id_cliente,
                'nome'=> $dados_clientes->nome,
                'email' => $dados_clientes->email,
                'cpf'=> $dados_clientes->cpf,
                'telefone'=> $dados_clientes->telefone,
                'telefone_dois'=> $dados_clientes->telefone_dois,
                'data_nascimento'=> $dados_clientes->data_nascimento,
                'data_cadastro'=> $dados_clientes->data_cadastro,
                'intervalo_doacao'=> $dados_clientes->intervalo_doacao,
                'valor_doacao'=> $dados_clientes->valor_doacao,
                'id_forma_pg'=> $dados_clientes->id_forma_pg,
                'cep'=> $dados_clientes->cep,
                'rua'=> $dados_clientes->rua,
                'numero'=> $dados_clientes->numero,
                'complemento'=> $dados_clientes->complemento,
            );
        }

        return json_encode($dados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        // dd($request->all());
        $cliente = Clientes::where('id_cliente','=',$request->id_clienteU)->update(['nome' => $request->nomeU,
            'email' => $request->emailU,
            'cpf' => $request->cpfU,
            'telefone' => $request->telefoneU,
            'telefone_dois' => $request->telefone_doisU,
            'data_nascimento' => $request->data_nascimentoU,
            'intervalo_doacao' => $request->intervalo_doacaoU,
            'valor_doacao' => $request->valor_doacaoU,
            'id_forma_pg' => $request->forma_pagamentoU,
            'cep' => $request->cepU,
            'rua' => $request->ruaU,
            'numero' => $request->numeroU,
            'complemento' => $request->complementoU,
        ]);
        return back()->with('status', 'Alterado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cliente = Clientes::where('id_cliente','=',$request->id)->delete();
        return 1;

    }
}
