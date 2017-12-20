<?php

namespace projeto_laravel\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use projeto_laravel\DespesasFixas;

class DespesasFixasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$user_id = $this->getUserId();

			$resultados = DespesasFixas::where('user_id',$user_id)->get();
        return view('despesas_fixas.despesas_fixas_index')->with('resultados',$resultados);
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
			$user_id = $this->getUserId();
        $params = $request::except(["_method","_token"]);
				$str= $params['valor'];
				$valor = $this->strToFloat($str);
				//dd($params);

				DespesasFixas::create(
														['categoria'=>$params['categoria'],
														'valor' => $valor,
														'user_id' => $user_id,
														]);
			return redirect()
					->route('despesas_fixas.index')
					->withInput(Request::only('nome'));
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
			$user_id = $this->getUserId();
        $params = $request::except(["_method","_token"]);
				$str= $params['valor'];
				$valor = $this->strToFloat($str);
				//dd($params);

			$df = DespesasFixas::find($id);

			$df->categoria= $params['categoria'];
			$df->valor = $valor;
			$df->user_id = $user_id;

			$df->save();

			return redirect()
					->route('despesas_fixas.index')
					->withInput(Request::only('mensagem'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
			$user_id = $this->getUserId();

			$df = DespesasFixas::find($id);
			$df_desc = $df->descricao;
		
		$mensagem = 'Despesa Fixa '.$df_desc.'removida';
		if($df->user_id != $user_id){
			return  view('erro_de_acesso');
		}else{
			$df->delete();
			return redirect()
					->route('despesas_fixas.index')->with('mensagem', $mensagem);
					
    }
    }
}
