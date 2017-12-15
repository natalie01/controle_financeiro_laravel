<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use Request;

use Illuminate\Support\Facades\DB;
//use projeto_laravel\Cliente;
use projeto_laravel\ContaReceber;
use projeto_laravel\BaixaContaReceber;
use projeto_laravel\Caixa;
use projeto_laravel\Http\Requests\BaixaContaReceberRequest;

class BaixaContaReceberController extends Controller
{

public function __construct()
{
    $this->middleware('auth');
}

//mostra o formulario para ser preenchido com o valor pago
	public function baixa_receber($id)
{

		$datahoje = $this->dataHoje();
		$conta = ContaReceber::find($id);

	// o valor devido aparece como padrao no formulário
		$valor = $conta->valor_residual;
	//referencia da conta a receber
		$ref = $id;

    return view('contareceber.baixa_receber',compact('datahoje','valor','ref'));
}

	public function baixa_receber_salvar(BaixaContaReceberRequest $request)
{
			$user_id = $this->getUserId();
			$params = Request::all();

			$valor_recebido = $params['valor_recebido'];
			$ref = $params['ref_conta_receber'];
			$data = $params['data'];
			$valor_residual = $params['valor_residual'];
			$ref_conta_receber = $params['ref_conta_receber'];

			$conta = ContaReceber::find($ref);

			$valor_devido = $conta->valor_residual;

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

			$valor_devido -= $valor_recebido_float;
		}else{
			$conta->status = "recebido";

			$valor_devido = 0;
		}
			
			$conta->valor_residual = $valor_devido;
			$conta->save();
	


			BaixaContaReceber::create(['data'=>$data,
																'valor_recebido'=>$valor_recebido_float,
																'valor_residual'=>$valor_residual_float,
																'fk_conta_receber'=>$ref_conta_receber,
																'user_id' =>$user_id																
																]);

			Caixa::create(['data'=>$data,
														'valor'=>$valor_recebido_float,
														'descricao' => 'baixa de conta a receber',
														'tipo'=>'receita',
														'user_id'=>$user_id
														]);

		//atualiza a lista das contas a receber
				return redirect()->action('ContaReceberController@index')
					->withInput(Request::only('msg'));

}
}
