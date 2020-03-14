<?php

namespace App\Http\Controllers;

use App\clientes;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Buscando todos os clientes
        $c = clientes::all();
        return response()->json($c);
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
        //Criando novo cliente
        $c = new clientes();
        $c->nome = $request->nome;
        $c->cpf = $request->cpf;
        $c->sexo = $request->sexo;
        $c->email = $request->email;
        $c->save();
        return response()->json($c);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Buscando cliente por id
        $c = clientes::find($id);
        return response()->json($c);
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
    public function update(Request $request, $id)
    {
        //Editando cliente
        $c = clientes::find($id);
        if(isset($c)){
            $c->nome = $request->nome;
            $c->cpf = $request->cpf;
            $c->sexo = $request->sexo;
            $c->email = $request->email;
            $c->save();
            return response()->json($c);
        }
        return response('Cliente não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Apagar cliente
        $c = clientes::find($id);
        if(isset($c)){
            $c->delete($id);
            return response('OK', 200);
        }
        return response('Cliente não encontrado', 404);
    }
}
