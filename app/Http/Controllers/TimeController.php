<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Time;
use Validator;
use Response;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $times = Time::all();
        return Response::json([
            $times
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
            'setor' => 'required',
            'lider' => 'required',
            'coordenador' => 'required'
        ]);

        if ($validator->fails()) {
            return Response::json([
                $validator->errors()->all()
            ], 400);
        }
    
        $time = Time::create($request->all());
        return Response::json([
            $time
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
        $time = Time::find($id);
        if($time == null){
            return Response::json([
                'Invalid ID'
            ], 400);
        }
        return Response::json([
            $time
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
        $time = Time::find($id);
        if($time == null){
            return Response::json([
                'Invalid ID'
            ], 404); 
        }

        if($request->isMethod('PATCH')){
            if( !$request->has('nome') && 
                !$request->has('descricao')&&
                !$request->has('setor')&&
                !$request->has('lider')&& 
                !$request->has('coordenador')
                ){
                return Response::json([
                    'Must have at least one valid attribute (nome, descricao, setor, lider or coordenador)'
                ], 400);
            }   
            if($request->has('nome') && $request->input('nome') != null){
                $time->nome = $request->input('nome');
            }
            if($request->has('descricao') && $request->input('descricao') != null){
                $time->descricao = $request->input('descricao');
            }
            if($request->has('setor') && $request->input('setor') != null){
                $time->setor = $request->input('setor');
            }
            if($request->has('lider') && $request->input('lider') != null){
                $time->lider = $request->input('lider');
            }
            if($request->has('coordenador') && $request->input('coordenador') != null){
                $time->coordenador = $request->input('coordenador');
            }
            $time->save();
            return Response::json([
                $time
            ], 200);

        }

        if($request->isMethod('PUT')){
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
                'descricao' => 'required',
                'setor' => 'required',
                'lider' => 'required',
                'coordenador' => 'required'
            ]);

            if ($validator->fails()) {
                return Response::json([
                    $validator->errors()->all()
                ], 400);
            }

            $time->nome = $request->input('nome');
            $time->descricao = $request->input('descricao');
            $time->setor = $request->input('setor');
            $time->lider = $request->input('lider');
            $time->coordenador = $request->input('coordenador');
            $time->save();

            return Response::json([
                $time
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
        $time = Time::find($id);
        if($time == null){
            return Response::json([
                'Invalid ID'
            ], 404);    
        }
        $time->delete();

        return Response::json([
            'Deleted Successfully'
        ], 202);
    }
}
