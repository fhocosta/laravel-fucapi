<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cargo;
use Validator;
use Response;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::all();
        return Response::json([
            $cargos
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'descricao' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::json([
                $validator->errors()->all()
            ], 400);
        }
    
        $cargo = Cargo::create($request->all());
        return Response::json([
            $cargo
        ], 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cargo = Cargo::find($id);
        if($cargo == null){
            return Response::json([
                'Invalid ID'
            ], 400);
        }
        return Response::json([
            $cargo
        ], 200);
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
        $cargo = Cargo::find($id);
        if($cargo == null){
            return Response::json([
                'Invalid ID'
            ], 404); 
        }
        if($request->isMethod('PATCH')){
            if(!$request->has('nome') && !$request->has('descricao')){
                return Response::json([
                    'Must have at least one valid attribute (nome or descricao)'
                ], 400);
            }   
            if($request->has('nome') && $request->input('nome') != null){
                $cargo->nome = $request->input('nome');
            }
            if($request->has('descricao') && $request->input('descricao') != null){
                $cargo->descricao = $request->input('descricao');
            }
            $cargo->save();
            return Response::json([
                $cargo
            ], 200);

        }

        if($request->isMethod('PUT')){
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
                'descricao' => 'required',
            ]);

            if ($validator->fails()) {
                return Response::json([
                    $validator->errors()->all()
                ], 400);
            }

            $cargo->nome = $request->input('nome');
            $cargo->descricao = $request->input('descricao');
            $cargo->save();

            return Response::json([
                $cargo
            ], 200);

        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cargo = Cargo::find($id);
        if($cargo == null){
            return Response::json([
                'Invalid ID'
            ], 404);    
        }
        $cargo->delete();

        return Response::json([
            'Deleted Successfully'
        ], 202);
    }
}
