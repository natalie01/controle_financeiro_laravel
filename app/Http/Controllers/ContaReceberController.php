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

				ContaReceber::where('user_id',$user_id)
         								 ->where('datavencimento','<' ,$datahoje)
         								 ->where('status','like' ,'nao recebido')
                    		  ->update(['status' => 'atrasado']);

				$total = ContaReceber::select('valor_residual')
													->where('user_id','=',$user_id)
													->sum('valor_residual');

					$resultados= ContaReceber::where('user_id',$user_id)
														->where('status','!=','recebido')->orderBy('datavencimento', 'asc')													
																->get();

		return view('contareceber.contas_receber_index',compact('resultados','datahoje','total'));
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

			if(!$dataemissao || $dataemissao=='' ){
				$hoje=$this->dataHoje();

				$dataemissao= $hoje;
			}

      $data = gettype($request->datavencimento);

			$dv = Carbon::parse($request->datavencimento);


			$valor= $request->valor;

			$count = ContaReceber::where('user_id',$user_id)->count();

				//converte a string para float com a funcao strToFloat()  herdada da classe Controller
				$valorFloat= $this->strToFloat($valor);

				for($i = 0; $i < $n_pagtos;++$i ){
					$dataVenc =  $dv->addDays($intervalo_pagtos*$i);
					$dataVencFormat = $dataVenc->year.'-'.$dataVenc->month.'-'.$dataVenc->day;
					ContaReceber::create(['num_titulo' => ($count + 1),
																'devedor' => $request->devedor,
																'datavencimento'=>$dataVencFormat,
																'dataemissao'=>$dataemissao,
																'valor_inicial'=>$valorFloat,
																'status'=>'nao recebido',
																'user_id'=>$user_id,
																'valor_recebido'=>0,
																'valor_residual'=>$valorFloat,
																'parcelado'=>$parcelado,
																'num_parcela'=>($i+1)
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
    public function edit($id)
    {

			$conta = ContaReceber::find($id);
			$user_id = $this->getUserId();

			if($conta->user_id != $user_id){
				return  view('erro_de_acesso');
			}else{
				return view('contareceber.conta_receber_editar')->with('c', $conta);
			}

		}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContaReceberRequest $request, $id)
    {

			$conta = ContaReceber::find($id);
			$user_id = $this->getUserId();

			if($conta->user_id != $user_id){
				return  view('erro_de_acesso');
			}else{
			ContaReceber::find($id)->update($request->all());
				return redirect()
					->route('contareceber.index')
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
			$conta_receber = ContaReceber::find($id);
	
			if(isset($conta_receber)){
				if($conta_receber->user_id != $user_id){
					return  view('erro_de_acesso');
				}else{
				$conta_receber->delete();
				}
				$c_removida= $id;
				$resultados = ContaReceber::where('user_id',$user_id)->get();
			
			return view('contareceber.contas_receber_index',compact('c_removida','resultados'));
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

public function selecionar_datas_contas_receber(Request $request){
	$params = Request::all();

	//$data= $params['d'];
	$modelo = 'conta_receber';
	$view = 'contareceber.contas_receber_index';
	$query = 'datavencimento';
	$resultado = 'resultados';
	return $this->getView($params,$modelo,$view,$query);
}

/*
public function selecionar_mes(Request $request){
	$params = Request::only('mes');
	dd($params);
}
*/
}
