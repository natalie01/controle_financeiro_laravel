<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use projeto_laravel\Empresa;
use projeto_laravel\Caixa;
use projeto_laravel\ContaReceber;
use projeto_laravel\ContaPagar;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

			$dt = $this->diaHoje();

			$user_id = $this->getUserId();

	  	$hoje = Carbon::now();

			$dt1 = $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
			
			$ontem = Carbon::now()->subDay();

			$tres_meses_antes =Carbon::now()->subDays(90);
			$tres_ma = $tres_meses_antes->year.'-'.$tres_meses_antes->month.'-'.'01'; 

			$dt_ontem = $ontem->year.'-'.$ontem->month.'-'.$ontem->day;

			$dt2 = $hoje->year.'-'.$hoje->month.'-'.'01';  //primeiro dia do mes atual

			$mes_atual = $hoje->month;

			if($mes_atual >=1 && $mes_atual<12){
				$mes_proximo = $mes_atual +1 ;
			$dt3 = $hoje->year.'-'.$mes_proximo.'-'.'01';  //primeiro dia do mes seguinte
			}else{
				$mes_proximo = '01' ;
			$dt3 = ($hoje->year + 1).'-'.$mes_proximo.'-'.'01';  //primeiro dia do mes seguinte
			}

		//dd($mes_proximo);

		//	dd($dt3);
		  $dt4 = Carbon::parse($dt3)->subDay(); //ultimo dia do mes atual

		//dd($dt4);

		$dt5 = $dt4->year.'-'.$dt4->month.'-'.$dt4->day; //último dia do mes atual formato ano-mes-dia

		//dd($dt5);

				$soma_receitas_mes = Caixa::select('valor')
													->where('tipo','like','%receita%')
													->where('user_id','=',$user_id)
													->whereBetween('data',[$dt2 ,$dt1])
													->sum('valor');

				$soma_despesas_mes = Caixa::select('valor')
													->where('tipo','like','%despesa%')
													->where('user_id','=',$user_id)
													->whereBetween('data',[$dt2 ,$dt1])
													->sum('valor');

				$saldo_mes = $soma_receitas_mes - $soma_despesas_mes;

				$soma_receitas_3m = Caixa::select('valor')
													->where('tipo','like','%receita%')
													->where('user_id','=',$user_id)
													->whereBetween('data',[$tres_ma ,$dt1])
													->sum('valor');

				$soma_despesas_3m = Caixa::select('valor')
													->where('tipo','like','%despesa%')
													->where('user_id','=',$user_id)
													->whereBetween('data',[$tres_ma ,$dt1])
													->sum('valor');

				$empresa = Empresa::where('user_id','=',$user_id)->get();
													
				$saldo_atual = Empresa::where('user_id','=',$user_id)
													->pluck('saldo_atual')->first();
				
				if(empty($empresa)){
					echo 'nao criou a empresa ainda';
				}
				
			
				if($saldo_atual == null){
				$saldo_atual = 0;
				}

				$recebimentos_previstos_hoje = ContaReceber::select('valor_inicial')
													->where('user_id','=',$user_id)
													->where('datavencimento','=' ,$dt1)
													->sum('valor_inicial');

				$pagamentos_previstos_hoje =ContaPagar::select('valor_inicial')
													->where('user_id','=',$user_id)
													->where('datavencimento','=' ,$dt1)
													->sum('valor_inicial');


				$recebimentos_previstos_mes =  ContaReceber::select('valor_inicial')
													->where('user_id','=',$user_id)
													->whereBetween('datavencimento',[$dt1 ,$dt5])
													->sum('valor_inicial');

				$pagamentos_previstos_mes =  ContaPagar::select('valor_inicial')
													->where('user_id','=',$user_id)
													->whereBetween('datavencimento',[$dt1 ,$dt5])
													->sum('valor_inicial');

				$recebimentos_feitos_mes =  ContaReceber::select('valor_recebido')
													->where('user_id','=',$user_id)
													->where('status','like','recebido')
													->orWhere('status','like','%parcial')
													->whereBetween('datavencimento',[$dt2 ,$dt5])
													->sum('valor_recebido');

				$pagamentos_feitos_mes =  ContaPagar::select('valor_pago')
													->where('user_id','=',$user_id)
													->where('status','like','pago')
													->orWhere('status','like','%parcial')
													->whereBetween('datavencimento',[$dt2 ,$dt5])
													->sum('valor_pago');

				$recebimentos_falta_mes = abs($recebimentos_previstos_mes - $recebimentos_feitos_mes);
				$pagamentos_falta_mes = abs($pagamentos_previstos_mes - $pagamentos_feitos_mes);
			
				if($recebimentos_previstos_mes > 0){
				$dif_receb_mes =($recebimentos_feitos_mes / $recebimentos_previstos_mes)*100 ;
				}else{
				$dif_receb_mes = 0;
				}

				$porcent_receb_mes = number_format($dif_receb_mes,2);


				if($pagamentos_previstos_mes > 0){
				$dif_pag_mes =($pagamentos_feitos_mes / $pagamentos_previstos_mes)*100 ;
				}else{
				$dif_pag_mes = 0;
				}

				$porcent_pag_mes = number_format($dif_pag_mes,2);

			/*	$recebimentos_feitos_mes =  ContaReceber::select('valor_inicial')
													->where('user_id','=',$user_id)
													->where('status','like','recebido')
													->whereBetween('datavencimento',[$dt1 ,$dt5])
													->sum('valor_inicial');

				$pagamentos_feitos_mes =  ContaPagar::select('valor_inicial')
													->where('user_id','=',$user_id)
													->where('status','like','pago')
													->whereBetween('datavencimento',[$dt1 ,$dt5])
													->sum('valor_inicial');
			*/

				$recebimentos_atraso_mes =  ContaReceber::select('valor_residual')
													->where('user_id','=',$user_id)
													->where('status','not like','recebido')
													->where('status','like','atrasado')
													->whereBetween('datavencimento',[$dt2 ,$dt_ontem])
													->sum('valor_residual');

				$pagamentos_atraso_mes =  ContaPagar::select('valor_residual')
													->where('user_id','=',$user_id)
													->where('status','not like','pago')
													->where('status','like','atrasado')
													->whereBetween('datavencimento',[$dt2 ,$dt_ontem])
													->sum('valor_residual');

				$recebimentos_atraso_todos =  ContaReceber::select('valor_residual')
													->where('user_id','=',$user_id)
													->where('status','not like','recebido')
													->where('status','like','atrasado')
													->sum('valor_residual');

				$pagamentos_atraso_todos =  ContaPagar::select('valor_residual')
													->where('user_id','=',$user_id)
													->where('status','not like','pago')
													->where('status','like','atrasado')
													->sum('valor_residual');
				//dd($recebimentos_atraso_mes);
        //dd($soma_despesas);

        return view('home',
							compact('dt','soma_receitas_mes','soma_despesas_mes','saldo_mes','saldo_atual',
							'recebimentos_previstos_hoje','pagamentos_previstos_hoje',
							'recebimentos_previstos_mes','pagamentos_previstos_mes',
							'recebimentos_feitos_mes','pagamentos_feitos_mes',
							'recebimentos_falta_mes','pagamentos_falta_mes',
							'recebimentos_atraso_mes','pagamentos_atraso_mes',
							'recebimentos_atraso_todos','pagamentos_atraso_todos',
							'porcent_receb_mes','porcent_pag_mes',
							'soma_receitas_3m','soma_despesas_3m'				
							));
				//return response()->json($datahoje->month);
				//return response()->json($dt);

    }


    public function diaHoje()
    {
				$hoje= Carbon::now();
				$dt_hoje = $hoje->toFormattedDateString(); 
				//$hoje =$datahoje->date;
        return $dt_hoje;
				//return response()->json($datahoje->month);
				//return response()->json($dt);

    }
}
