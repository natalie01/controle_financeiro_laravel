<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use Request;

use Illuminate\Support\Facades\DB;
//use projeto_laravel\Cliente;
use projeto_laravel\ContaPagar;
use projeto_laravel\Caixa;
use projeto_laravel\BaixaContaPagar;
use projeto_laravel\Http\Requests\BaixaContaPagarRequest;

class BaixaContaPagarController extends Controller
{

public function __construct()
{
    $this->middleware('auth');
}
	public function baixa_pagar($id)
{

		$datahoje = $this->dataHoje();
		$conta = ContaPagar::find($id);
		$valor = $conta->valor_residual;
		$ref = $id;

    return view('contapagar.baixa_pagar',compact('datahoje','valor','ref'));
}

	public function baixa_pagar_salvar(BaixaContaPagarRequest $request)
{
			$user_id = $this->getUserId();
			$params = Request::all();

			$valor_pago = $params['valor_pago'];
			$ref = $params['ref_conta_pagar'];
			$data = $params['data'];
			$valor_residual = $params['valor_residual'];
			$ref_conta_pagar = $params['ref_conta_pagar'];

			$conta = ContaPagar::find($ref);
			$valor_devido = $conta->valor_residual;


		if($data == null){
			$data = $this->dataHoje();
		}

		if($valor_residual == null){
			$valor_residual =0;
		}
				//converte a string para float com a funcao strToFloat()  herdada da classe Controller
				$valor_pago_float= $this->strToFloat($valor_pago);
				$valor_residual_float= $this->strToFloat($valor_residual);

		if($valor_pago_float <  $valor_devido){
			$conta->status = "pagamento parcial";

			$valor_devido -= $valor_pago_float;
		}else{
			$conta->status = "pago";

			$valor_devido = 0;
		}
			$conta->valor_residual = $valor_devido;
			$conta->valor_pago = $valor_pago;
			$conta->save();
		

			BaixaContaPagar::create(['data'=>$data,
																'valor_pago'=>$valor_pago_float,
																'valor_residual'=>$valor_residual_float,
																'fk_conta_pagar'=>$ref_conta_pagar,
																'user_id' =>$user_id																
																]);

			Caixa::create(['data'=>$data,
														'valor'=>$valor_pago_float,
														'descricao' => 'baixa de conta a pagar',
														'tipo'=>'despesa',
														'user_id'=>$user_id
														]);

		return redirect()->action('ContaPagarController@index')
					->withInput(Request::only('msg'));
}
}
