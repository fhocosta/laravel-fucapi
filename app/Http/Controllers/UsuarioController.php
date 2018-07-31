<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Usuario;
use Validator;
use Response;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return Response::json([
            $usuarios
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
            'usuario' => 'required',
            'senha' => 'required',
            'setor' => 'required',
            'cargo' => 'required',
            'time' => 'required'
        ]);

        if ($validator->fails()) {
            return Response::json([
                $validator->errors()->all()
            ], 400);
        }
    
        $usuario = Usuario::create($request->all());
        return Response::json([
            $usuario
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
        $usuario = Usuario::find($id);
        if($usuario == null){
            return Response::json([
                'Invalid ID'
            ], 400);
        }
        return Response::json([
            $usuario
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
        $usuario = Usuario::find($id);
        if($usuario == null){
            return Response::json([
                'Invalid ID'
            ], 404); 
        }
        if($request->isMethod('PATCH')){
            if( !$request->has('nome') && 
                !$request->has('usuario') &&
                !$request->has('senha') &&
                !$request->has('setor') &&
                !$request->has('cargo') &&
                !$request->has('time')){
                return Response::json([
                    'Must have at least one valid attribute (nome, usuario, senha, setor, cargo or time)'
                ], 400);
            }   
            if($request->has('nome') && $request->input('nome') != null){
                $usuario->nome = $request->input('nome');
            }
            if($request->has('usuario') && $request->input('usuario') != null){
                $usuario->usuario = $request->input('usuario');
            }
            if($request->has('senha') && $request->input('senha') != null){
                $usuario->senha = $request->input('senha');
            }
            if($request->has('setor') && $request->input('setor') != null){
                $usuario->setor = $request->input('setor');
            }
            if($request->has('cargo') && $request->input('cargo') != null){
                $usuario->cargo = $request->input('cargo');
            }
            if($request->has('time') && $request->input('time') != null){
                $usuario->time = $request->input('time');
            }

            $usuario->save();
            return Response::json([
                $usuario
            ], 200);

        }

        if($request->isMethod('PUT')){
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
                'usuario' => 'required',
                'senha' => 'required',
                'setor' => 'required',
                'cargo' => 'required',
                'time' => 'required'
            ]);

            if ($validator->fails()) {
                return Response::json([
                    $validator->errors()->all()
                ], 400);
            }

            $usuario->nome = $request->input('nome');
            $usuario->usuario = $request->input('usuario');
            $usuario->senha = $request->input('senha');
            $usuario->setor = $request->input('setor');
            $usuario->cargo = $request->input('cargo');
            $usuario->time = $request->input('time');
            $usuario->save();

            return Response::json([
                $usuario
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
        $usuario = Usuario::find($id);
        if($usuario == null){
            return Response::json([
                'Invalid ID'
            ], 404);    
        }
        $usuario->delete();

        return Response::json([
            'Deleted Successfully'
        ], 202);
    }
}
