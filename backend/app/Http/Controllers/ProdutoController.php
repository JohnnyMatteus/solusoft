<?php

namespace App\Http\Controllers;

use App\produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Buscando todos os produtos
        $p = produto::all();
        return response()->json($p);
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
        //Criando novo produto
        $p = new produto();
        $p->nome = $request->nome;
        $p->cor = $request->cor;
        $p->tamanho = $request->tamanho;
        $p->valor = $request->valor;
        $p->save();
        return response()->json($p);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(produto $produto)
    {
        //Buscando produto por id
        $p = produto::find($produto);
        if(isset($p)){
            return response()->json($p);
        }
        return response('Produto não encontrado.', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //Editando produto
        $p = produto::find($id);
        if(isset($p)){
            $p->nome = $request->nome;
            $p->cor = $request->cor;
            $p->tamanho = $request->tamanho;
            $p->valor = $request->valor;
            $p->save();
            return response()->json($p);
        }
        return response('Produto não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Apagar produto
        $p = produto::find($id);
        if(isset($p)){
            $p->delete($id);
            return response('OK', 200);
        }
        return response('Produto não encontrado', 404);
    }
}
