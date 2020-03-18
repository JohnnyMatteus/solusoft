<?php

namespace App\Http\Controllers;

use App\pedidos;
use App\clientes;
use App\itens_pedidos;
use App\produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use PDF;


class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Buscando todos os pedidos
        $p = pedidos::all();
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
        //Criando novo pedido
        $p = new pedidos();
        $i = new itens_pedidos();

        $p->data = $request->data;
        $p->observacao = $request->observacao;
        $p->forma_pagamento = $request->forma_pagamento;
        $p->cliente_id = $request->cliente_id;
        $p->save();

        foreach ($request->produto as $item) {

            $i::create([
                'pedido_id' =>  $p->id,
                'produto_id' => $item['id'],
                'quantidade' => $item['quantidade']
            ]);
        }
        return response()->json($p);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Buscando pedido por id
        $p = DB::table('pedidos')
            ->join('itens_pedidos', 'pedidos.id', '=', 'itens_pedidos.pedido_id')
            ->join('produtos', 'itens_pedidos.produto_id', '=', 'produtos.id')
            ->select('pedidos.*', 'itens_pedidos.quantidade', 'produtos.nome')
            ->where('pedidos.id', '=', $id)
            ->get();
        if(isset($p)){
            return response()->json($p);
        }
        return response('Produto não encontrado.', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function edit(pedidos $pedidos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Editando produto
        $p = pedidos::find($id);
        if(isset($p)){
            $p->data = $request->data;
            $p->observacao = $request->observacao;
            $p->forma_pagamento = $request->forma_pagamento;
            $p->cliente_id = $request->cliente_id;
            $p->save();
            if($request->produto) {
                foreach ($request->produto as $item) {
                    $i = itens_pedidos::find($item['id']);
                    if(isset($i))
                        $i::create([
                            'pedido_id' =>  $p->id,
                            'produto_id' => $item['id'],
                            'quantidade' => $item['quantidade']
                        ]);
                }
            }
            return response()->json($p);
        }
        return response('Pedido não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Apagar pedido
        $p = pedidos::find($id);
        if(isset($p)){
            $p->delete($id);
            return response('OK', 200);
        }
        return response('Pedido não encontrado', 404);
    }

    public function report ($id) {
        $data = array();
        $soma = 0;
        $p = pedidos::find($id);
        if(isset($p)){
            //Buscando pedidos
            $data['pedido'] = $p;
            //Buscando clientes
            $data['cliente'] = clientes::find($p->cliente_id);
            //Buscando item dos pedidos
            $it = itens_pedidos::all();
            //Buscando produtos
            $prod = produto::all();

            for ($i=0; $i < count($it); $i++) {
                if($it[$i]->pedido_id == $p->id){
                   $data['item'][$i] = $it[$i];

                   for ($j=0; $j < count($prod); $j++) {
                        if($prod[$j]->id == $it[$i]->produto_id){
                        $data['produtos'][$j] = $prod[$j];
                            $data['produtos'][$j]['valor_por_produto'] = $prod[$j]['valor'] * $it[$i]['quantidade'];
                            $data['produtos'][$j]['quantidade'] = $it[$i]['quantidade'];
                            $soma += $data['produtos'][$j]['valor_por_produto'];
                        }
                    }
                }
            }
            $data['valor_total'] = $soma;
            //Enviando dados para template
            $pdf = PDF::loadView('report', compact('data'));
            return $pdf->download('report.pdf');


        }



    }

    public function sedmail ($id) {

        $data = array();
        $soma = 0;
        $p = pedidos::find($id);
       
        if(isset($p)){
            //Buscando pedidos
            $data['pedido'] = $p;
            //Buscando clientes
            $data['cliente'] = clientes::find($p->cliente_id);
            //Buscando item dos pedidos
            $it = itens_pedidos::all();
            //Buscando produtos
            $prod = produto::all();

            for ($i=0; $i < count($it); $i++) {
                if($it[$i]->pedido_id == $p->id){
                   $data['item'][$i] = $it[$i];

                   for ($j=0; $j < count($prod); $j++) {
                        if($prod[$j]->id == $it[$i]->produto_id){
                        $data['produtos'][$j] = $prod[$j];
                            $data['produtos'][$j]['valor_por_produto'] = $prod[$j]['valor'] * $it[$i]['quantidade'];
                            $data['produtos'][$j]['quantidade'] = $it[$i]['quantidade'];
                            $soma += $data['produtos'][$j]['valor_por_produto'];
                        }
                    }
                }
            }
            $data['valor_total'] = $soma;

            return Mail::to('jmatteus20@gmail.com', 'Johnny')
                    ->send(new SendMail($data));

        }

    }
}
