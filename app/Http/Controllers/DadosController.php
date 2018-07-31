<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Dados;
use Validator;
use Response;

class DadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Dados::all();
        return Response::json([
            $dados
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
            'dataExecucao' => 'required',
            'itemTeste' => 'required',
            'prioridade' => 'required',
            'quantidadeTC' => 'required',
            'tempoTotal' => 'required',
            'usuario' => 'required'
        ]);

        if ($validator->fails()) {
            return Response::json([
                $validator->errors()->all()
            ], 400);
        }
    
        $dados = Dados::create($request->all());
        return Response::json([
            $dados
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
        $dados = Dados::find($id);
        if($dados == null){
            return Response::json([
                'Invalid ID'
            ], 400);
        }
        return Response::json([
            $dados
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
        $dados = Dados::find($id);
        if($dados == null){
            return Response::json([
                'Invalid ID'
            ], 404); 
        }
        if($request->isMethod('PATCH')){
            if( !$request->has('dataExecucao') && 
                !$request->has('itemTeste') &&
                !$request->has('prioridade') &&
                !$request->has('quantidadeTC') &&
                !$request->has('tempoTotal') &&
                !$request->has('usuario') ){
                return Response::json([
                    'Must have at least one valid attribute (dataExecucao, itemTeste, prioridade, quantidadeTC, tempoTotal, usuario)'
                ], 400);
            }   
            if($request->has('dataExecucao') && $request->input('dataExecucao') != null){
                $dados->dataExecucao = $request->input('dataExecucao');
            }
            if($request->has('itemTeste') && $request->input('itemTeste') != null){
                $dados->itemTeste = $request->input('itemTeste');
            }
            if($request->has('prioridade') && $request->input('prioridade') != null){
                $dados->prioridade = $request->input('prioridade');
            }
            if($request->has('quantidadeTC') && $request->input('quantidadeTC') != null){
                $dados->quantidadeTC = $request->input('quantidadeTC');
            }
            if($request->has('tempoTotal') && $request->input('tempoTotal') != null){
                $dados->tempoTotal = $request->input('tempoTotal');
            }
            if($request->has('usuario') && $request->input('usuario') != null){
                $dados->usuario = $request->input('usuario');
            }

            $dados->save();
            return Response::json([
                $dados
            ], 200);

        }

        if($request->isMethod('PUT')){
            $validator = Validator::make($request->all(), [
                'dataExecucao' => 'required',
                'itemTeste' => 'required',
                'prioridade' => 'required',
                'quantidadeTC' => 'required',
                'tempoTotal' => 'required',
                'usuario' => 'required'
            ]);

            if ($validator->fails()) {
                return Response::json([
                    $validator->errors()->all()
                ], 400);
            }

            $dados->dataExecucao = $request->input('dataExecucao');
            $dados->itemTeste = $request->input('itemTeste');
            $dados->prioridade = $request->input('prioridade');
            $dados->quantidadeTC = $request->input('quantidadeTC');
            $dados->tempoTotal = $request->input('tempoTotal');
            $dados->usuario = $request->input('usuario');
            $dados->save();

            return Response::json([
                $dados
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
        $dados = Dados::find($id);
        if($dados == null){
            return Response::json([
                'Invalid ID'
            ], 404);    
        }
        $dados->delete();

        return Response::json([
            'Deleted Successfully'
        ], 202);
    }
}
