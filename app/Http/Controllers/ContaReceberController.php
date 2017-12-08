<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use Request;

use Illuminate\Support\Facades\DB;
use projeto_laravel\Cliente;
use projeto_laravel\ContaReceber;
use projeto_laravel\Http\Requests\ContaReceberRequest;

//use projeto_laravel\Http\Controllers\StrToFloat;

class ContaReceberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
					$contas_receber= ContaReceber::all();
					return view('contareceber.contas_receber_index')->with('contas_receber',$contas_receber);
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

				$hoje= Carbon::now();
				$datahoje= $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
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

			if(!$n_pagtos){
					$n_pagtos =1;
			}

			$intervalo_pagtos = $request->intervalo_pagtos;

			if(!$intervalo_pagtos){
					$intervalo_pagtos=30;
			}

			$dataemissao = $request->dataemissao;

			if(!$dataemissao){
				$hoje= Carbon::now();
				$dataemissao= $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
			}

      $data = gettype($request->datavencimento);

			$dv = Carbon::parse($request->datavencimento);


			$valor = $request->valor;

				//converte a string para float com a funcao strToFloat()  herdada da classe Controller
				$valorFloat= $this->strToFloat($valor);

				for($i = 0; $i < $n_pagtos;++$i ){
					$dataVenc =  $dv->addDays($intervalo_pagtos*$i);
					$dataVencFormat = $dataVenc->year.'-'.$dataVenc->month.'-'.$dataVenc->day;
					ContaReceber::create(['devedor' => $request->devedor,
																'datavencimento'=>$dataVencFormat,
																'dataemissao'=>$dataemissao,
																'valor'=>$valorFloat
																]);
				}

				

		
				//return response()->json(array('a'=>$n_pagtos,'b' => $data));	
				/*return response()->json(array('intervalo_pagtos' => $intervalo_pagtos,
													'n_pagtos ' => $n_pagtos ,
													'$dataVString' => $dataVString,
													'dataemissao' => $dataemissao,
														'$valor' => $valor,
														'$valorT' => $valorT,
														'valorFloat ' =>$valorFloat ,
														'$valorFloatType '	=>$valorFloatType									
														));
		*/
			$mensagem = 'nova conta adicionada';
			$contas_receber = ContaReceber::all();
			return view('contareceber.contas_receber_index',compact('mensagem', 'contas_receber'));
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
		
			$contareceber = ContaReceber::find($id);
			if(isset($contareceber)){
				$contareceber->delete();
				}
				$c_removida= $id;
				$contas_receber = ContaReceber::all();
			
			return view('contareceber.contas_receber_index',compact('c_removida','contas_receber'));
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
