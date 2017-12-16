<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use Request;

use Illuminate\Support\Facades\DB;
use projeto_laravel\Cliente;
use projeto_laravel\ContaReceber;
use projeto_laravel\Http\Requests\ContaReceberRequest;

class ContaReceberController extends Controller
{

	public function __construct()
	{
		  $this->middleware('auth');
	}
		  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
			$user_id = $this->getUserId();
			$datahoje = $this->dataHoje();
					$contas_receber= ContaReceber::where('user_id',$user_id)
														->where('status','not like','recebido')															
																->get();

					//return view('contareceber.contas_receber_index')->with('contas_receber',$contas_receber);
return view('contareceber.contas_receber_index',compact('contas_receber','datahoje'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
				//$clientes = Cliente::all();
				$datahoje= $this->dataHoje();
				return view('contareceber.nova_contareceber')->with('datahoje',$datahoje);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContaReceberRequest $request){
			 $n_pagtos = $request->n_pagtos;
			$user_id = $this->getUserId();
			if(!$n_pagtos){
					$n_pagtos =1;
			}

			$intervalo_pagtos = $request->intervalo_pagtos;

			if(!$intervalo_pagtos){
					$intervalo_pagtos=30;
			}

			$dataemissao = $request->dataemissao;

			if(!$dataemissao){
				$hoje=$this->dataHoje();
			}

      $data = gettype($request->datavencimento);

			$dv = Carbon::parse($request->datavencimento);


			$valor= $request->valor;

				//converte a string para float com a funcao strToFloat()  herdada da classe Controller
				$valorFloat= $this->strToFloat($valor);

				for($i = 0; $i < $n_pagtos;++$i ){
					$dataVenc =  $dv->addDays($intervalo_pagtos*$i);
					$dataVencFormat = $dataVenc->year.'-'.$dataVenc->month.'-'.$dataVenc->day;
					ContaReceber::create(['devedor' => $request->devedor,
																'datavencimento'=>$dataVencFormat,
																'dataemissao'=>$dataemissao,
																'valor_inicial'=>$valorFloat,
																'status'=>'nao recebido',
																'user_id'=>$user_id,
																'valor_recebido'=>0,
																'valor_residual'=>$valorFloat,
																]);
				}


			return redirect()->action('ContaReceberController@index')
					->withInput(Request::only('msg'));		}

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
        //
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
			$conta_receber = ContaReceber::find($id);
	
			if(isset($conta_receber)){
				if($conta_receber->user_id != $user_id){
					return  view('erro_de_acesso');
				}else{
				$conta_receber->delete();
				}
				$c_removida= $id;
				$contas_receber = ContaReceber::where('user_id',$user_id)->get();
			
			return view('contareceber.contas_receber_index',compact('c_removida','contas_receber'));
    }
}

 public function autocomplete($term)
{

	if($term && $term!== ''){
	$queries = DB::table('clientes') //Your table name
		      ->where('nome', 'like', '%'.$term.'%') //Your selected row
		      ->take(6)->get();

		  foreach ($queries as $query)
		  {
		      $results[] = ['id' => $query->id, 'value' => $query->nome]; //you can take custom values as you want
		  }

	}else{
		$queries = [];
	}
	 return response()->json(array(
											'results' => $queries
		              ));

	}
}
