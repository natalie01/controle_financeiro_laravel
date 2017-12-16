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

	  	$hoje = Carbon::now();
			$data_hoje = Carbon::today();
			$inicio = $data_hoje->subDays(30);

			$dt1 = $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
			$dt2 = $inicio->year.'-'.$inicio->month.'-'.$inicio ->day;
			$data = 'entre '.$dt2.' e '.$dt1;
			//$registros= Caixa::all();

		$registros= Caixa::whereBetween('data',[$dt2 ,$dt1])->where('user_id',$user_id)->orderBy('data', 'desc')->get();
		return view('caixa.relatorio_caixa',compact('registros','data'));


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
			$descricao = $request->descricao;
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
														'descricao' => $request->descricao,
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


	$periodo= $params['periodo'];


	if($periodo == 'umadata'){

		$data = $params['data'];
		//dd($data);
		if($data && $data!== ''){

			 $registros= Caixa::whereDate('data',$data)->orderBy('id', 'desc')->get();

			return view('caixa.relatorio_caixa',compact('data','registros'));

		}else{
			$mensagem_sem_data= 'você não selecionou nenhuma data.';
			return view('caixa.relatorio_caixa')->with('mensagem_sem_data', $mensagem_sem_data);
		}

	}elseif($periodo == 'duasdatas'){
			$dt1 = $params['data1'];
			$dt2= $params['data2'];

				
      	if($dt1 == '' && $dt2 == ''){
		         $mensagem_sem_data= 'você não selecionou nenhuma data.';
							return view('caixa.relatorio_caixa')->with('mensagem_sem_data',$mensagem_sem_data);
		    }

 				if(($dt1 == '' && $dt2 != '') || ($dt1 != '' && $dt2 == '') ){
					$data = ($dt1 != '') ? $dt1 : $dt2;
					$registros= Caixa::whereDate('data',$data)->orderBy('id', 'desc')->get();
					 $mensagem_uma_data  = 'você selecionou apenas uma data.O resultado mostrado é o resultado para essa data.';
						return view('caixa.relatorio_caixa',compact('data','mensagem_uma_data','registros'));
        
				}

				if($dt1  != '' && $dt2 != ''){
						if($dt1 ==  $dt2){
						$data = $dt1;
		        $mensagem_uma_data  = 'você selecionou datas iguais.O resultado mostrado é o resultado para essa data.';
						$registros= Caixa::whereDate('data',$dt1)->orderBy('id', 'desc')->get();
						return view('caixa.relatorio_caixa',compact('data','mensagem_uma_data','registros'));
						}elseif($dt2 > $dt1){
						$registros= Caixa::whereBetween('data',[$dt1 ,$dt2])->orderBy('data', 'desc')->get();
						$data = 'entre '.$dt1.' e '.$dt2;
						return view('caixa.relatorio_caixa',compact('registros','data'));
						}else{
						$registros= Caixa::whereBetween('data',[$dt2 ,$dt1])->orderBy('data', 'desc')->get();
						$data = 'entre '.$dt2.' e '.$dt1;
						return view('caixa.relatorio_caixa',compact('registros','data'));
						}
        }
			   
			
		}else{
			return response()->json('outro');
		}


	}


	public function mostrarPdf($dt){

		//o parametro $dt é uma string que pode conter uma ou duas datas
	if(strlen($dt)>0 && strlen($dt) <= 10 && $dt!=''  ){
			$data = $dt;
			$registros= Caixa::whereDate('data',$data)->orderBy('id', 'desc')->get();
			//dd($registros);
	}elseif(strlen($dt)>10 && strlen($dt) <= 29 && $dt!=''  ){
			$datas = explode(" ", $dt);
			$dt1 = $datas[1];
			$dt2 =  $datas[3];
			$registros= Caixa::whereBetween('data',[$dt1 ,$dt2])->orderBy('data', 'desc')->get();
			//dd($datas);
			//dd($registros[);
	}else{
			echo 'nenhuma data informada';
	};
    
	PDF::SetTitle('Relatório');
	PDF::AddPage();


	$html ='<h2>Relatório de Caixa</h2>';
		$html .='<h3>'.$dt.'</h3>';
	$html .= '<table style ="color:blue;">';
	$html .= '<thead style="background-color:#FFFF00;">';
	$html .= '<tr>';
	$html .= '<th>N°</th>';
	$html .= '<th>Data</th>';
	$html .= '<th>Valor</th>';
	$html .= '<th>Descri<span>&ccedil;</span><span>&atilde;</span>o</th>';
	$html .= '<th>Tipo</th>';
	$html .= '<th>ref_titulo</th>';
	$html .= '</tr>';
foreach ($registros as $r)
     {

         $html.='<tr>';
         $html.='<td  >'.$r->id.'</td>';
 					$html.='<td  >'.$r->data.'</td>';
         $html.='<td  >'.$r->valor.'</td>';

         $html.='<td  >'.$r->descricao.'</td>';
 					$html.='<td  >'.$r->tipo.'</td>';
         $html.='<td  >'.$r->ref_titulo.'</td>';
         $html.='</tr>';
			
     }

	$html .= '</thead>';
	$html .= '<tbody>';

  
	$html .= '</tbody>';
	$html.='</table>';

	PDF::writeHTML($html, false, false, true, false, '');
	PDF::Output('Relatorio.pdf');


          
	}
}
