<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use PDF;
//use Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use projeto_laravel\Caixa;
use projeto_laravel\Empresa;
use projeto_laravel\Http\Requests\CaixaRequest;

class CaixaController extends Controller
{
public function __construct()
{
    $this->middleware('auth');
}
		public function index()
		{
			
		$user_id = $this->getUserId();

	  	$data = $this->dataHoje();
	
			//$registros= Caixa::all();

		$resultados= Caixa::where('user_id',$user_id)->orderBy('data', 'desc')
								->get();

				$soma_receitas = Caixa::select('valor')
													->where('tipo','like','%receita%')
													->where('user_id','=',$user_id)
													->sum('valor');

				$soma_despesas = Caixa::select('valor')
													->where('tipo','like','%despesa%')
													->where('user_id','=',$user_id)
													->sum('valor');

				$total = $soma_receitas - $soma_despesas;
		return view('caixa.relatorio_caixa',compact('resultados','data','total','soma_receitas','soma_despesas'));


		}


      public function novareceita()
    {
			
				$datahoje= $this->dataHoje();
				$tipo= 'receita';
				$mensagem= 'nova receita adicionada';
				$tipo_pessoa= 'Recebido de';
				return view('caixa.novo_mov_caixa',compact('datahoje','tipo','mensagem','tipo_pessoa'));
		}

/*    public function incluir_novareceita()
    {
		return response()->json('ok');
		}
*/
      public function novadespesa()
    {
				$datahoje= $this->dataHoje();
				$tipo= 'despesa';
				$mensagem= 'nova despesa adicionada';
				$tipo_pessoa= 'Pago a';
				return view('caixa.novo_mov_caixa',compact('datahoje','tipo','mensagem','tipo_pessoa'));
		}

      public function novo_mov_caixa()
    {
				$datahoje= $this->dataHoje();
				return view('caixa.novo_mov_caixa')->with('datahoje',$datahoje);
		}

/*
      public function incluir_novadespesa()
    {
		return response()->json('ok');
		}
*/

    public function incluir_novo_movim_caixa(CaixaRequest $request)
    {
		$params = Request::all();
			
		$user_id = $this->getUserId();
			$categoria = $request->categoria;
			$str= $request->valor;
			$tipo = $request->tipo;

			$valor = $this->strToFloat($str);

			$dataemissao = $request->dataemissao;

			// se o usuário nao colocar a data de emissao,usar a data atual
			if(!$dataemissao){
				$hoje= Carbon::now();
				$dataemissao= $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
			}


			Caixa::create(['data'=>$dataemissao,
														'valor'=>$valor,
														'categoria' => $request->categoria,
														'tipo'=>$request->tipo,
														'user_id'=>$user_id
														]);
			

			//soma a nova movimentacao com o saldo atual

				$empresa= Empresa::where('user_id','=',$user_id)->first();
				
				$saldo = $empresa->saldo_atual;	 

				if( $request->tipo == 'receita'){
				$saldo += $valor;
				}
				if( $request->tipo == 'despesa'){
				$saldo -= $valor;
				}

				//atualiza o saldo
				$empresa->saldo_atual = $saldo;
				$empresa->save();	

			return redirect('relatorio_caixa')
					->withInput(Request::only('mensagem'));

		}


	public function selecionar_datas_post(Request $request)
	{
	$params = Request::all();

	$modelo = 'caixa';
	$view = 'caixa.relatorio_caixa';
	$query = 'data';
	$resultado = 'resultados';
	return $this->getView($params,$modelo,$view,$query);
	}

    public function excluir($id)
    {

		if( isset($id) && $id != ''){
			$user_id = $this->getUserId();	
			$caixa = Caixa::find($id);
	
			if(isset($caixa)){

				if($caixa->user_id != $user_id){
					return  view('erro_de_acesso');
				}else{
					$caixa->delete();

					$c_removida= $id;
					$resultados = Caixa::where('user_id',$user_id)->get();
			
				return redirect()->action('CaixaController@index');
			}										
    }else{
			return redirect()->action('CaixaController@index');
		}
	}else{
			return redirect()->action('CaixaController@index');
	}
}



}
