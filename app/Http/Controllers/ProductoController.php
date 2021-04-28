<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // listar y buscar dentro de una tabla: Producto
    public function index(Request $request)
    {

        //select * from producto inne join users on ......     (ORM, Laravel...ELOQUENT)
        //$productos = Producto::with(['user:id,email,name'])->paginate(10);

        //select * from producto where nombre like '%par%' or ......
        $productos = Producto::with(['user:id,email,name'])
                                ->whereCodigo($request->txtBuscar)
                                ->orWhere('nombre', 'like', "%{$request->txtBuscar}%")
                                ->paginate(2);

        return \response()->json($productos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //recoger un solo registro de la bdd
    public function show($id)
    {
        //select * from producto where id = $id
        $producto = Producto::with(['user:id,email,name'])->find($id);
        return \response()->json($producto, 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //elimirar registros
    public function destroy($id)
    {
        try{
            //delete from producto where id = $id
            Producto::destroy($id);
            return \response()->json(['res' => true, 'message'=>'eliminado correctamente'], 200);
        }
        catch(\Exception $e){
            return \response()->json(['res' => false, 'message'=>$e->getMessage()], 200);
        }
    }
}
