<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Setor;
use Validator;
use Response;

class SetorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setores = Setor::all();
        return Response::json([
            $setores
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
            'gerente' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::json([
                $validator->errors()->all()
            ], 400);
        }
    
        $setor = Setor::create($request->all());
        return Response::json([
            $setor
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
        $setor = Setor::find($id);
        if($setor == null){
            return Response::json([
                'Invalid ID'
            ], 400);
        }
        return Response::json([
            $setor
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
        $setor = Setor::find($id);
        if($setor == null){
            return Response::json([
                'Invalid ID'
            ], 404); 
        }
        if($request->isMethod('PATCH')){
            if( !$request->has('nome') && 
                !$request->has('descricao') &&
                !$request->has('gerente')){
                return Response::json([
                    'Must have at least one valid attribute (nome, descricao or gerente)'
                ], 400);
            }   
            if($request->has('nome') && $request->input('nome') != null){
                $setor->nome = $request->input('nome');
            }
            if($request->has('descricao') && $request->input('descricao') != null){
                $setor->descricao = $request->input('descricao');
            }
            if($request->has('gerente') && $request->input('gerente') != null){
                $setor->gerente = $request->input('gerente');
            }
            $setor->save();
            return Response::json([
                $setor
            ], 200);

        }

        if($request->isMethod('PUT')){
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
                'descricao' => 'required',
                'gerente' => 'required',
            ]);

            if ($validator->fails()) {
                return Response::json([
                    $validator->errors()->all()
                ], 400);
            }

            $setor->nome = $request->input('nome');
            $setor->descricao = $request->input('descricao');
            $setor->gerente = $request->input('gerente');
            $setor->save();

            return Response::json([
                $setor
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
        $setor = Setor::find($id);
        if($setor == null){
            return Response::json([
                'Invalid ID'
            ], 404);    
        }
        $setor->delete();

        return Response::json([
            'Deleted Successfully'
        ], 202);
    }
}
