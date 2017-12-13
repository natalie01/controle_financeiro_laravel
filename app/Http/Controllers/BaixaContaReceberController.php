<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use Request;

use Illuminate\Support\Facades\DB;
//use projeto_laravel\Cliente;
use projeto_laravel\ContaReceber;
use projeto_laravel\BaixaContaReceber;
use projeto_laravel\Http\Requests\BaixaContaReceberRequest;

class BaixaContaReceberController extends Controller
{

public function __construct()
{
    $this->middleware('auth');
}
	public function baixa_receber($id)
{
	/*  $hoje= Carbon::now();
		$datahoje= $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
*/
		$datahoje = $this->dataHoje();
		$conta = ContaReceber::find($id);
		$valor = $conta->valor;
		$ref = $id;

    return view('contareceber.baixa_receber',compact('datahoje','valor','ref'));
}

	public function baixa_receber_salvar(BaixaContaReceberRequest $request)
{

			$params = Request::all();

			$valor_recebido = $params['valor_recebido'];
			$ref = $params['ref_conta_receber'];
			$data = $params['data'];
			$valor_residual = $params['valor_residual'];
			$ref_conta_receber = $params['ref_conta_receber'];

			$conta = ContaReceber::find($ref);
			$valor_devido = $conta->valor;

	/*	if($valor_recebido > $valor_devido){
		echo 'O valor recebido é maior que o valor devido';
		}else{
			echo 'Ainda precisa salvar os dados';
		}
*/

		if($data == null){
			$data = $this->dataHoje();
		}

		if($valor_residual == null){
			$valor_residual =0;
		}
				//converte a string para float com a funcao strToFloat()  herdada da classe Controller
				$valor_recebido_float= $this->strToFloat($valor_recebido);
				$valor_residual_float= $this->strToFloat($valor_residual);

		if($valor_recebido_float <  $valor_devido){
			$conta->status = "recebimento parcial";
			$conta->save();
		}


			BaixaContaReceber::create(['data'=>$data,
																'valor_recebido'=>$valor_recebido_float,
																'valor_residual'=>$valor_residual_float,
																'fk_conta_receber'=>$ref_conta_receber,																
																]);

 //Ainda precisa atualizar a lista das contas a receber
   return redirect('contareceber')->with('status', 'Pagamento registrado!');
}
}
