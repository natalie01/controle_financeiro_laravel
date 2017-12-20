<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use Request;

use Illuminate\Support\Facades\DB;
use projeto_laravel\Fornecedor;
use projeto_laravel\ContaPagar;
use projeto_laravel\Http\Requests\ContaPagarRequest;

class ContaPagarController extends Controller
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

				ContaPagar::where('user_id',$user_id)
         								 ->where('datavencimento','<' ,$datahoje)
         								 ->where('status','like' ,'nao pago')
                    		  ->update(['status' => 'atrasado']);

				$total = ContaPagar::select('valor_residual')
													->where('user_id','=',$user_id)
													->sum('valor_residual');

					$resultados= ContaPagar::where('user_id',$user_id)->orderBy('datavencimento', 'asc')													
													->where('status','!=','pago')->get();

					return view('contapagar.contas_pagar_index',compact('resultados','datahoje','total'));
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
				return view('contapagar.nova_contapagar')->with('datahoje',$datahoje);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContaPagarRequest $request){
			 $n_pagtos = $request->n_pagtos;
			$user_id = $this->getUserId();
			if(!$n_pagtos){
					$n_pagtos =1;
			}

			if($n_pagtos ==1){
					$parcelado=0;
			}else{
					$parcelado=1;
			}

			$intervalo_pagtos = $request->intervalo_pagtos;

			if(!$intervalo_pagtos){
					$intervalo_pagtos=30;
			}

			$dataemissao = $request->dataemissao;

			if(!$dataemissao || $dataemissao == ''){
				$hoje= $this->dataHoje();

				$dataemissao= $datahoje;
			}

      $data = gettype($request->datavencimento);

			$dv = Carbon::parse($request->datavencimento);


			$valor = $request->valor;
		
			$count = ContaPagar::where('user_id',$user_id)->count();

				//converte a string para float com a funcao strToFloat()  herdada da classe Controller
				$valorFloat= $this->strToFloat($valor);

				for($i = 0; $i < $n_pagtos;++$i ){
					$dataVenc =  $dv->addDays($intervalo_pagtos*$i);
					$dataVencFormat = $dataVenc->year.'-'.$dataVenc->month.'-'.$dataVenc->day;
					ContaPagar::create(['num_titulo' => ($count + 1),
																'credor' => $request->credor,
																'datavencimento'=>$dataVencFormat,
																'dataemissao'=>$dataemissao,
																'valor_inicial'=>$valorFloat,
																'status'=>'nao pago',
																'user_id'=>$user_id,
																'valor_pago'=>0,
																'valor_residual'=>$valorFloat,
																'parcelado'=>$parcelado,
																'num_parcela'=>($i+1)
																]);
				}


					return redirect()->action('ContaPagarController@index')
					->withInput(Request::only('msg'));
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

			$conta = ContaPagar::find($id);
			$user_id = $this->getUserId();

			if($conta->user_id != $user_id){
				return  view('erro_de_acesso');
			}else{
				return view('contapagar.conta_pagar_editar')->with('c', $conta);
			}

		}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContaPagarRequest $request, $id)
    {

			$conta = ContaPagar::find($id);
			$user_id = $this->getUserId();

			if($conta->user_id != $user_id){
				return  view('erro_de_acesso');
			}else{
			ContaPagar::find($id)->update($request->all());
				return redirect()
					->route('contapagar.index')
					->withInput(Request::only('mensagem'));
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

				$user_id = $this->getUserId();	
			$conta_pagar = ContaPagar::find($id);
	
			if(isset($conta_pagar)){
				if($conta_pagar->user_id != $user_id){
					return  view('erro_de_acesso');
				}else{
					$conta_pagar->delete();
				}

				$c_removida= $id;
				$contas_pagar = ContaPagar::where('user_id',$user_id)->get();
			
			return view('contapagar.contas_pagar_index',compact('c_removida','contas_pagar'));
    }
	}

	 public function autocomplete($term)
	{

	if($term && $term!== ''){
	$queries = DB::table('fornecedores') //Your table name
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

public function selecionar_datas_contas_pagar(Request $request){
	$params = Request::all();

	//$data= $params['d'];
	$modelo = 'conta_pagar';
	$view = 'contapagar.contas_pagar_index';
	$query = 'datavencimento';
	$resultado = 'resultados';
	return $this->getView($params,$modelo,$view,$query);
}
}

