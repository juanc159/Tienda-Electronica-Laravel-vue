<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return Pedido::all();
        }else{
            return view('pedido.index');
        }
        
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
        $pedido = new Pedido();
        $pedido->id_producto = $request->id_producto;
        $pedido->cantidad = $request->cantidad;
        $pedido->fecha_entrega = $request->fecha_entrega;
        $pedido->save();
        return $pedido;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function buscarFecha($id, $b)
    {
            $pedido_fecha = Pedido::select('pedidos.id as id_pedido','pedidos.cantidad','pedidos.fecha_entrega','productos.nombre as nombre_producto','productos.precio as precio_producto')
                                ->join('productos','pedidos.id_producto','=','productos.id')
                                ->where('pedidos.'.$b,$id)
                             ->get();
        
       
        
            
        
        return $pedido_fecha;
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
        $pedido = Pedido::find($id);
        $pedido->id_producto = $request->id_producto;
        $pedido->cantidad = $request->cantidad;
        $pedido->fecha_entrega = $request->fecha_entrega;
        $pedido->save();
        return $pedido;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();
    }
}
